<?php

class Salesman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function welcome_salesman()
    {
        $this->load->view('header');
        $this->load->view('salesman/welcome');
        $this->load->view('footer');
    }
}