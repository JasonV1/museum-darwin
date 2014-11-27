<?php

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $emailadres
     * @param $wachtwoord
     * @return mixed
     */
    public function login($emailadres, $wachtwoord)
    {
        $query = $this->db->query("SELECT * FROM `employee`
                             LEFT JOIN `employee_role` ON `id` = `employee_role`.`employee_id`
                             RIGHT JOIN `password` ON `id` = `password`.`employee`
                             WHERE `employee`.`email` =  '" . $emailadres . "'
                             AND `password`.`password` = '" . $wachtwoord . "'");

        return $query->result();
    }

    public function add_login_attempt() {
        date_default_timezone_set('Europe/Amsterdam');
        $now = date('Y-m-d H:i:s');
        $data = array(
            'emailadres' => $this->input->post('email'),
            'wachtwoord' => $this->input->post('password'),
            'datum' => $now
        );

        $this->db->insert('login_attempts', $data);
    }

    public function add_login() {
        date_default_timezone_set('Europe/Amsterdam');
        $now = date('Y-m-d H:i:s');
        $data = array(
            'emailadres' => $this->input->post('email'),
            'datum' => $now
        );

        $this->db->insert('succesful_login', $data);
    }

    public function block_user() {
        // Check if the user logged in more than three times
        $query = $this->db->query("SELECT emailadres FROM login_attempts
                                    GROUP BY emailadres
                                    HAVING COUNT(emailadres) >= 3");

        //Block the given result

        foreach ($query->result() as $row)
        {
            $this->db->query("UPDATE employee SET blocked = 'yes' WHERE email = ? ", array($row->emailadres));
            $data = array(
                'emailadres' => $row->emailadres
            );
            $this->db->insert('blocked_users', $data);
        }
    }

    /**
     * @param $emailadres
     * @param $wachtwoord
     * @param $blocked
     * @return mixed
     */
    public function get_blocked_user($emailadres, $wachtwoord, $blocked) {
        //Get the blocked user
        $query = $this->db->query("SELECT * FROM `employee`
                             LEFT JOIN `employee_role` ON `id` = `employee_role`.`employee_id`
                             RIGHT JOIN `password` ON `id` = `password`.`employee`
                             WHERE `employee`.`email` =  '" . $emailadres . "'
                             AND `password`.`password` = '" . $wachtwoord . "'
                             AND `employee`.`blocked` = '".$blocked."'");

        return $query->result();
    }

    /**
     * @return mixed
     */
    public function get_users()
    {
        $query = $this->db->get('user');
        return $query->result();
    }

    public function add_user()
    {
        $this->db->trans_start();
        $data = array(
            'voornaam' => $this->input->post('voornaam'),
            'tussenvoegsel' => $this->input->post('tussenvoegsel'),
            'achternaam' => $this->input->post('achternaam'),
            'email' => $this->input->post('email'),
            'geboortedatum' => $this->input->post('geboortedatum'),
            'postcode' => $this->input->post('postcode'),
            'woonplaats' => $this->input->post('woonplaats'),
            'password' => sha1($this->input->post('password'))
        );


        $this->db->insert('user', $data);

        $table1_id = $this->db->insert_id();

        $this->db->query('INSERT INTO user_role VALUES(' . $table1_id . ', 4)');

        $this->db->trans_complete();
    }
}