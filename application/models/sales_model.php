<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 11/24/2014
 * Time: 9:31 AM
 */

class Sales_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_ticket() {
        $query = $this->db->query("SELECT * FROM booking
                                   WHERE ticket_id = '".$this->db->insert_id()."'");

        return $query->result();

    }

    public function create_ticket() {
        $now = date('Y-m-d');
        $data = array(
            'price' => $this->input->post('price'),
            'employee_id' => $this->session->userdata["logged_in"]["employee_id"],
            'created_at' => $now
        );

        $this->db->insert('booking', $data);
    }
} 