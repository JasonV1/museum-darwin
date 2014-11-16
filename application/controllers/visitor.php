<?php

class Visitor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function museum()
    {
        $this->load->view('header');
        $this->load->view('visitor/museum');
        $this->load->view('footer');
    }

    public function collection()
    {
        $this->load->view('header');
        $this->load->view('visitor/collection');
        $this->load->view('footer');
    }

    public function artefact()
    {
        $this->load->view('header');
        $this->load->view('visitor/artefact');
        $this->load->view('footer');
    }

    public function about_darwin()
    {
        $this->load->view('header');
        $this->load->view('visitor/about_darwin');
        $this->load->view('footer');
    }

    public function earth()
    {
        $this->load->view('header');
        $this->load->view('visitor/earth');
        $this->load->view('footer');
    }

    public function darwin()
    {
        $this->load->view('header');
        $this->load->view('visitor/darwin');
        $this->load->view('footer');
    }

    public function intelligent_design()
    {
        $this->load->view('header');
        $this->load->view('visitor/intelligent_design');
        $this->load->view('footer');
    }

    public function exhibitions() {
        $this->load->view('header');
        $this->load->view('visitor/exhibitions');
        $this->load->view('footer');
    }

    public function evolution() {
        $this->load->view('header');
        $this->load->view('visitor/evolution');
        $this->load->view('footer');
    }

    public function geological_periods() {
        $this->load->view('header');
        $this->load->view('visitor/geological_periods');
        $this->load->view('footer');
    }
}