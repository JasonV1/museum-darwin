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

    //first page for the manager to see upon login
    public function welcome_manager()
    {
        $this->load->view('header');
        $this->load->view('manager/welcome');
        $this->load->view('footer');
    }

    public function get_visitors()
    {
        $this->load->view('header');
        //get reservation data
        $data['reservations'] = $this->manager_model->get_reservation_data();
        //get all the creation dates
        $data['created_at'] = $this->manager_model->get_reservation_dates();
        //load the view
        $this->load->view('manager/visitors', $data);
        $this->load->view('footer');
    }

    public function show_visitors() {
        //get date that was just selected
        $data['visitors'] = $this->manager_model->get_given_date($_POST);

        $this->load->view("header");
        //load the view with all the visitors
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

    public function past_three_months() {
        $this->load->view('header');
        $data['visitors'] = $this->manager_model->past_three_months();
        $this->load->view('manager/past_three_months', $data);
        $this->load->view('footer');
    }

    public function weekoverview()
    {
        $this->load->view('header');
        $data['visitors'] = $this->manager_model->weekoverview();
        $this->load->view('manager/weekoverview', $data);
        $this->load->view('footer');
    }
} 