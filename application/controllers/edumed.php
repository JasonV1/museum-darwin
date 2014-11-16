<?php

class Edumed extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function welcome_edumed()
    {
        $this->load->view('header');
        $this->load->view('edumed/welcome');
        $this->load->view('footer');
    }
}