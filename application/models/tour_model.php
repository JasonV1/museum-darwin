<?php

/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 11/17/2014
 * Time: 12:50 PM
 */
class Tour_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function get_tours()
    {
        $query = $this->db->query("SELECT * FROM tours");
        return $query->result();
    }

    /**
     * @return mixed
     */
    public function get_tour_test()
    {
        $query = $this->db->query("SELECT * FROM tours");
        return $query->result();
    }

    public function tour_overview($id) {
        $query = $this->db->query("SELECT * FROM tours
                                    WHERE t_id = '".$id."'");
        return $query->result();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get_tour_id($id)
    {
        $query = $this->db->query("SELECT * FROM tours
                                    WHERE t_id = '" . $id . "'");
        return $query->result();
    }

    public function get_all_tickets() {
        $query = $this->db->query("SELECT * FROM booking");

        return $query->result();
    }

    /**
     * @param int $starting
     * @return mixed
     */
    public function get_tour_date($starting = 7)
    {
        $date = new DateTime("+ $starting days");
        $day = $date->format('Y-m-d');

        $query = $this->db->query("
                    SELECT t.t_id, t.name, t.status, COUNT(r.reservation_id) as c
                    FROM tours t
                    JOIN tours_reservations r ON t.t_id=r.tour_id
                    WHERE day = '$day'
                    GROUP BY t.t_id");

        return $query->result();


    }

    public function update_tour_full() {
        $query = $this->db->query("SELECT t.t_id, t.name, t.status, COUNT( r.reservation_id ) AS c
                      FROM tours t
                      JOIN tours_reservations r ON t.t_id = r.tour_id
                      GROUP BY t.t_id
                      HAVING COUNT( c ) = 20");

        foreach ($query->result() as $row)
        {
            $this->db->query("UPDATE tours SET status = 'vol' WHERE t_id = ? ", array($row->t_id));
        }
    }

    public function update_tour($starting = 7)
    {
        $date = new DateTime("+ $starting days");
        $day = $date->format('Y-m-d');

        //get tours that have less than 8 reservations a week from now
        $query = $this->db->query("SELECT t.t_id, t.name, t.status, COUNT( r.reservation_id ) AS c
                      FROM tours t
                      JOIN tours_reservations r ON t.t_id = r.tour_id
                      WHERE t.day =  ?
                      GROUP BY t.t_id
                      HAVING COUNT( c ) <=8", array($day));

        //loop result from SELECT query and update the result
        foreach ($query->result() as $row)
        {
            $this->db->query("UPDATE tours SET status = 'geannuleerd' WHERE t_id = ? ", array($row->t_id));
        }

    }

    /**
     * @param $email
     */
    public function add_reservation($email)
    {
        $query = $this->db->query("SELECT id, email FROM visitor
                           WHERE email = " . $this->db->escape($email) . " LIMIT 1");

        $result = $query->result();

        // Collect data array
        $data = array(
            'voornaam' => $this->session->userdata["tour_data"]["voornaam"],
            'tussenvoegsel' => $this->session->userdata["tour_data"]["tussenvoegsel"],
            'achternaam' => $this->session->userdata["tour_data"]["achternaam"],
            'email' => $this->session->userdata["tour_data"]["email"],
            'geboortedatum' => $this->session->userdata["tour_data"]["geboortedatum"],
            'postcode' => $this->session->userdata["tour_data"]["postcode"],
            'woonplaats' => $this->session->userdata["tour_data"]["woonplaats"]
        );

        $now = date('Y-m-d H:i:s');


        if (count($result) < 1) {
            $this->db->insert('visitor', $data);
            $tour = array(
                'tour_id' => $this->session->userdata["tour_data"]["tour_id"],
                'user_id' => $this->db->insert_id(),
                'created_at' => $now
            );
            $this->db->insert('tours_reservations', $tour);
            echo "<h1>Bedankt! Uw toer is gereserveerd.</h1>";
        } else {
            $tour = array(
                'tour_id' => $this->session->userdata["tour_data"]["tour_id"],
                'user_id' => $result[0]->id,
                'created_at' => $now
            );
            $this->db->insert('tours_reservations', $tour);
            echo "<h1>Bedankt! Uw toer is gereserveerd.</h1>";
        }
    }
} 