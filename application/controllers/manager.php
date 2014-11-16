<?php

/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 11/12/2014
 * Time: 10:54 AM
 */
class Manager extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('manager_model');
    }

    public function welcome_manager()
    {
        $this->load->view('header');
        $this->load->view('manager/welcome');
        $this->load->view('footer');
    }

    public function get_visitors()
    {
        $this->load->view('header');
        $data['reservations'] = $this->manager_model->get_reservation_data();
        $data['created_at'] = $this->manager_model->get_reservation_dates();
        $this->load->view('manager/visitors', $data);
        $this->load->view('footer');
    }

    public function show_visitors() {
        $data['visitors'] = $this->manager_model->get_given_date($_POST);
        $this->load->view("header");
        $this->load->view("manager/visitors_per_day", $data);
        $this->load->view("footer");
    }

    public function get_day_data()
    {
        $data['reservations'] = $this->manager_model->get_given_date($_POST);
        $this->load->view("header");
        $this->load->view("manager/reservations_per_day", $data);
        $this->load->view("footer");

    }
    public function get_reservations()
    {
        $this->load->view('header');
        $data['reservations'] = $this->manager_model->get_reservation_data();
        $data['created_at'] = $this->manager_model->get_reservation_dates();
        $this->load->view('manager/reservations', $data);
        $this->load->view('footer');
    }

    public function weekoverview()
    {
        $this->load->view('header');
        $this->load->view('manager/weekoverview');
        $this->load->view('footer');
    }
} 