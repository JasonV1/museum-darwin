<?php

require_once(APPPATH . '/controllers/test/Toast.php');
require_once(APPPATH . '/controllers/user.php'); //Require the tested class's file

class user_test extends Toast
{
	private $user;

	function __construct()
	{
		parent::__construct(__FILE__);
		$this->user = new User(true);	//Instantiate class
	}

	function _pre() {

		//Prepare unit test user database entry

        $this->db->trans_start();
        $data = array(
            'id' => '803',
            'naam' => 'testemployee',
            'email' => 'test@mail.com',
            'password' => 'hello'
        );


        $this->db->insert('employee', $data);

        $table1_id = $this->db->insert_id();

        $this->db->query('INSERT INTO employee_role VALUES(' . $table1_id . ', 4)');

        $this->db->trans_complete();

	}

	function test_login()
	{
		$this->_assert_true($this->user->user_model->login('test@mail.com', 'hello'));
	}

	function _post() {

		//Remove unit test office from database
		$this->db->delete('employee', array('id' => '803'));
	}
}
