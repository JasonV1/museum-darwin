<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 10/6/2014
 * Time: 1:49 PM
 */

class Ticket_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
    /*
    public function get_user() {
        $query = $this->db->query("SELECT * FROM visitor
                                   WHERE id = '".$_POST['id']."'");

            return $query->result();

    }
    */

    public function find_user($id) {
        $query = $this->db->query("SELECT email FROM visitor
                           WHERE id = '".$id."'");

        return $query->result();
    }

    public function get_ticket_data() {
        $query = $this->db->query("SELECT * FROM visitor, booking
                                   WHERE email = '".$this->session->userdata["ticket_data"]["email"]."'
                                   AND ticket_id = ".$this->db->insert_id()."");

        return $query->result();

    }
    public function add_ticket($email) {
        $query = $this->db->query("SELECT id, email FROM visitor
                           WHERE email = ".$this->db->escape($email)." limit 1");

        $result = $query->result();

        // Collect data array
        $data = array(
            'voornaam' => $this->session->userdata["ticket_data"]["voornaam"],
            'tussenvoegsel' => $this->session->userdata["ticket_data"]["tussenvoegsel"],
            'achternaam' => $this->session->userdata["ticket_data"]["achternaam"],
            'email' => $this->session->userdata["ticket_data"]["email"],
            'geboortedatum' => $this->session->userdata["ticket_data"]["geboortedatum"],
            'postcode' => $this->session->userdata["ticket_data"]["postcode"],
            'woonplaats' => $this->session->userdata["ticket_data"]["woonplaats"]
        );

        $now = date('Y-m-d H:i:s');

        if (count($result) < 1) {
            $this->db->insert('visitor', $data);
            $ticket = array(
                'user_id' => $this->db->insert_id(),
                'price' => $this->session->userdata["ticket_data"]["price"],
                'created_at' => $now
            );
            $this->db->insert('booking', $ticket);
        }
        else {
            $ticket = array(
                'user_id' => $result[0]->id,
                'price' =>$this->session->userdata["ticket_data"]["price"],
                'created_at' => $now
            );
            $this->db->insert('booking', $ticket);
        }
    }
}