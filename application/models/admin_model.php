<?php

class Admin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_user_data()
    {
        $query = $this->db->query("SELECT * FROM employee");
        return $query->result();
    }

    public function add_file()
    {
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'bestand' => $_FILES['image']['name']);


        $this->db->insert('files', $data);
    }
}