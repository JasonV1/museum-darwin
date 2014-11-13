<?php

class User_model extends CI_Model {
 public function __construct()
 {
     parent::__construct();
 }

 public function login($emailadres, $wachtwoord)
    {
        $query = $this->db->query("SELECT * FROM `employee`
                             LEFT JOIN `employee_role` ON `id` = `employee_role`.`employee_id`
                             WHERE `employee`.`email` =  '".$emailadres."'
                             AND `employee`.`password` = '".$wachtwoord."'");
        if($query->num_rows()>0)
        {
            foreach($query->result() as $rows)
            {
                //add all data to session
                $newdata = array(
                    'role_id' => $rows->role_id,
                    'employee_id'  => $rows->employee_id,
                    'email'    => $rows->email,
                    'naam' => $rows->naam,
                    'logged_in'  => TRUE,
                );
            }
            $this->session->set_userdata("logged_in", $newdata);
            return $query->result();

        }
    }
 public function get_users() {
     $query = $this->db->get('user');
     return $query->result();
 }
 public function add_user() {
 $this->db->trans_start();
  $data=array(
    'voornaam'=>$this->input->post('voornaam'),
    'tussenvoegsel'=>$this->input->post('tussenvoegsel'),
    'achternaam'=>$this->input->post('achternaam'),
    'email'=>$this->input->post('email'),
    'geboortedatum'=>$this->input->post('geboortedatum'),
    'postcode'=>$this->input->post('postcode'),
    'woonplaats'=>$this->input->post('woonplaats'),
    'password'=>sha1($this->input->post('password'))
   );


  $this->db->insert('user', $data);

  $table1_id = $this->db->insert_id();

  $this->db->query('INSERT INTO user_role VALUES('.$table1_id.', 4)');

  $this->db->trans_complete();
}
}