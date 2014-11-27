<?php
require_once(APPPATH . '/controllers/test/Toast.php');
require_once(APPPATH . '/controllers/user.php'); //Require the tested class's file

class login_test extends Toast
{
    private $user;

    function __construct()
    {
        parent::__construct(__FILE__);
        $this->user = new User(true);    //Instantiate class
    }

    function _pre()
    {

        //Prepare unit test user database entry

        $data = array(
            'id' => '5',
            'naam' => 'De Tester',
            'email' => 'test@gmail.com',
            'blocked' => 'yes'
        );
        $this->db->insert('employee', $data);

        $ticket = array(
            'employee' => '5',
            'password' => 'awesome'
        );
        $this->db->insert('password', $ticket);
    }


    function test_ticket()
    {
        $this->_assert_true($this->user->user_model->get_blocked_user('test@gmail.com', 'awesome', 'yes'));
    }

    function _post()
    {

        //Remove unit test office from database
        $this->db->delete('employee', array('id' => '5'));
    }
}