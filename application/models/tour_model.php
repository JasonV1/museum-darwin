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
     * @param $id
     * @return mixed
     */
    public function get_tour_id($id)
    {
        $query = $this->db->query("SELECT * FROM tours
                                    WHERE t_id = '" . $id . "'");
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

    public function update_tour($starting = 7) {
        $result = $this->get_tour_date();
        $date = new DateTime("+ $starting days");
        $day = $date->format('Y-m-d');

        if (count($result) < 8 ) {
            $this->db->query("UPDATE tours t JOIN tours_reservations r
                              ON t.t_id=r.tour_id
                              SET status = 'in afwachting'
                              WHERE r.reservation_id <= 8
                              AND day = '$day'");
        }
        else {
            echo "oeps";
        }
    }

    /**
     * @param $tours
     * @param $email
     */
    public function add_reservation($tours, $email)
    {
        $query = $this->db->query("SELECT id, email FROM visitor
                           WHERE email = " . $this->db->escape($email) . " LIMIT 1");

        $result = $query->result();

        $reservations = $this->db->query("SELECT tour_id FROM tours_reservations
                                          WHERE tour_id = " . $this->db->escape($tours) . "");

        $result2 = $reservations->result();

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
            if (count($result2) == 20) {
                echo "<h1>De toer die u probeert te reserveren is vol.</h1>";
                return false;
            }
            $this->db->insert('visitor', $data);
            $tour = array(
                'tour_id' => $this->session->userdata["tour_data"]["tour_id"],
                'user_id' => $this->db->insert_id(),
                'created_at' => $now
            );
            $this->db->insert('tours_reservations', $tour);
            echo "Bedankt! Uw toer is gereserveerd.";
        } else {
            if (count($result2) == 20) {
                echo "<h1>De toer die u probeert te reserveren is vol.</h1>";
                return false;
            }
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