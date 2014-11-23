<?php

/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 11/17/2014
 * Time: 12:40 PM
 */
class Tour extends CI_Controller
{

    //functions or libraries to be loaded upon first interaction with constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tour_model');
        $this->load->library('form_validation');
        $this->update_tour();
    }

    //test if the model function is correct
    public function test() {
        $this->load->library('unit_test');

        //get data array
        $result = $this->tour_model->get_tour_test();

        //define test name
        $test_name = 'Check alle toeren in de database';

        //run unit test
        $this->unit->run($result, $this->tour_model->get_tour_test($result[0]), $test_name);
        //load view for unit tests
        $this->load->view('tests');
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('welcome_message');
        $this->load->view('footer');
    }

    //load view for the tours
    public function view_tours()
    {
        $this->load->view('header');
        //get data array
        $data['tours'] = $this->tour_model->get_tours();
        $this->load->view('tour/view_tours', $data);
        $this->load->view('footer');
    }

    /**
     * @param $id
     */
    public function reservate_tour($id)
    {
        $this->load->view('header');
        //get data array
        $data['tours'] = $this->tour_model->get_tour_id($id);
        $this->load->view('tour/reservate_tour', $data);
        $this->load->view('footer');
    }

    public function tour_overview($id) {
        $this->load->view('header');
        //get data array
        $data['query'] = $this->tour_model->tour_overview($id);
        $this->load->view('tour/tour_overview', $data);
        $this->load->view('footer');
    }

    public function check_sold_ticket() {
        $this->load->view('header');
        $data['tours'] = $this->tour_model->get_tour_date();

        $this->load->view('tour/check_sold_tickets', $data);
        $this->load->view('footer');
    }

    //constructor function to check the tour reservations.
    public function update_tour() {
        //this model function updates the tour if it is equal to 20 reservations
        $this->tour_model->update_tour_full();
        //this model function updates the tour if there are less than 8 reservations for it a week from now.
        $this->tour_model->update_tour();
    }

    public function payment()
    {
        //validate form
        $this->form_validation->set_rules('voornaam', 'Voornaam', 'trim|required');
        $this->form_validation->set_rules('tussenvoegsel', 'Tussenvoegsel', 'trim');
        $this->form_validation->set_rules('achternaam', 'Achternaam', 'trim|required');
        $this->form_validation->set_rules('email', 'E-mailadres', 'trim|required|valid_email');
        $this->form_validation->set_rules('geboortedatum', 'Geboortedatum', 'required');
        $this->form_validation->set_rules('postcode', 'Postcode', 'trim|required');
        $this->form_validation->set_rules('woonplaats', 'Woonplaats', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            echo "Failed";
            $this->view_tours();
        } else {
            //get data for session
            $data = array(
                'voornaam' => $this->input->post('voornaam'),
                'tussenvoegsel' => $this->input->post('tussenvoegsel'),
                'achternaam' => $this->input->post('achternaam'),
                'email' => $this->input->post('email'),
                'geboortedatum' => $this->input->post('geboortedatum'),
                'postcode' => $this->input->post('postcode'),
                'woonplaats' => $this->input->post('woonplaats'),
                'tour_id' => $this->input->post('tour_id'),
                'tour_name' => $this->input->post('tour_name')
            );
            //create session to pass data to next page
            $this->session->set_userdata("tour_data", $data);
            $this->load->view('header');
            //load view with data array
            $this->load->view('tour/payment', $data);
            $this->load->view('footer');
        }
    }

    public function add_reservation()
    {
        // get email
        $email = $this->session->userdata["tour_data"]["email"];
        // add reservation to db
        $this->tour_model->add_reservation($email);
        $this->index();
    }
} 