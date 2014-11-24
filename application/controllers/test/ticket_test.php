<?php
require_once(APPPATH . '/controllers/test/Toast.php');
require_once(APPPATH . '/controllers/booking.php'); //Require the tested class's file

class ticket_test extends Toast
{
    private $ticket;

    function __construct()
    {
        parent::__construct(__FILE__);
        $this->ticket = new Booking(true);    //Instantiate class
    }

    function _pre()
    {

        //Prepare unit test user database entry

        $data = array(
            'id' => '905',
            'voornaam' => 'Test',
            'tussenvoegsel' => 'de',
            'achternaam' => 'Gebruiker',
            'email' => 'test@gmail.com',
            'geboortedatum' => '1994-09-18',
            'postcode' => '3897OO',
            'woonplaats' => 'Nieuweleuk'
        );


        $this->db->insert('visitor', $data);
        $now = date('Y-m-d H:i:s');
        $ticket = array(
            'ticket_id' => '905',
            'user_id' => $this->db->insert_id(),
            'price' => '2.5',
            'created_at' => $now
        );
        $this->db->insert('booking', $ticket);
    }


    function test_ticket()
    {
        $this->_assert_true($this->ticket->ticket_model->get_ticket_cred('test@gmail.com', '905'));
    }

    function _post()
    {

        //Remove unit test office from database
        $this->db->delete('visitor', array('id' => '905'));
        $this->db->delete('booking', array('user_id' => '905'));
    }
}