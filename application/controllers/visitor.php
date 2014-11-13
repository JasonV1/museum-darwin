<?php

class Visitor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function museum() {
        $this->load->view('header');
        $this->load->view('visitor/museum');
        $this->load->view('footer');
    }
}