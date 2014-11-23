<?php

class Booking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ticket_model');
    }

    //test if the model function is correct
    public function test() {
        $this->load->library('unit_test');

        //get data array
        $result = $this->ticket_model->get_tickets();

        //define test name
        $test_name = 'Check alle tickets in de database';

        //run unit test
        $this->unit->run($result, $this->ticket_model->get_tickets($result[0]), $test_name);
        //load view for unit tests
        $this->load->view('ticket/tests');
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('welcome_message');
        $this->load->view('footer');
    }

    public function thank()
    {
        $data['title'] = 'Thanks';
        $this->load->view('headeronecolumn', $data);
        $this->load->view('ticket/thank_you', $data);
        $this->load->view('footeronecolumn', $data);
    }
    // load view for the reservation view
    public function reservate()
    {
        $this->load->view('header');
        $this->load->view('ticket/reservation');
        $this->load->view('footer');
    }

    //calculate the age
    /**
     * @return bool|DateInterval
     */
    public function calc_age()
    {
        $now = new DateTime();
        $birthday = new DateTime($this->input->post('geboortedatum'));
        $age = $now->diff($birthday);
        return $age;
    }

    // calculate the price
    /**
     * @return float|string
     */
    public function calc_price()
    {
        //get age from previous function
        $age = $this->calc_age();
        //child is always free
        $price = "gratis";
        if ($age->y >= 12) {
            //if older than 12, price = 2.50
            $price = 2.50;
        }
        if ($age->y >= 18) {
            //if older than 18, price = 4.00
            $price = 4.00;
        }
        if ($age->y >= 60) {
            //if older than 12, price = 2.50
            $price = 2.50;
        }
        return $price;
    }

    //process the reservation form
    public function payment()
    {
        $age = $this->calc_age();
        $price = $this->calc_price();
        //$data['user'] = $this->ticket_model->get_user($id);
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('voornaam', 'Voornaam', 'trim|required');
        $this->form_validation->set_rules('tussenvoegsel', 'Tussenvoegsel', 'trim');
        $this->form_validation->set_rules('achternaam', 'Achternaam', 'trim|required');
        $this->form_validation->set_rules('email', 'E-mailadres', 'trim|required|valid_email');
        $this->form_validation->set_rules('geboortedatum', 'Geboortedatum', 'required');
        $this->form_validation->set_rules('postcode', 'Postcode', 'trim|required');
        $this->form_validation->set_rules('woonplaats', 'Woonplaats', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            echo "Failed";
            $this->reservate();
        } else {
            //get data for session
            $data = array(
                'voornaam' => $this->input->post('voornaam'),
                'tussenvoegsel' => $this->input->post('tussenvoegsel'),
                'achternaam' => $this->input->post('achternaam'),
                'email' => $this->input->post('email'),
                'age' => $age,
                'geboortedatum' => $this->input->post('geboortedatum'),
                'postcode' => $this->input->post('postcode'),
                'woonplaats' => $this->input->post('woonplaats'),
                'price' => $price
            );
            //create session to pass data to next page
            $this->session->set_userdata("ticket_data", $data);
            $this->load->view('header');
            //load view with data array
            $this->load->view('ticket/payment', $data);
            $this->load->view('footer');

        }

    }

    /**
     *
     */
    public function get_pdf()
    {
        //load the pdf library
        $this->load->library('mpdf');
        //get data from the model
        $data['query'] = $this->ticket_model->get_ticket_data();
        $mpdf = new mPDF('c', 'A4', '', '', 32, 25, 27, 25, 16, 13);
        $mpdf->SetDisplayMode('fullpage');
        //whether to indent the first level of a list
        $mpdf->list_indent_first_level = 0; // 1 or 0 -
        //load view for the pdf
        $html = $this->load->view('ticket/ticket_view', $data, TRUE);
        $mpdf->WriteHTML($html);
        //output pdf as ticket.pdf and download immediately
        $mpdf->Output('ticket.pdf', 'D');
    }

    public function add_ticket()
    {
        // get email
        $email = $this->session->userdata["ticket_data"]["email"];
        // add ticket to db
        $this->ticket_model->add_ticket($email);
        // generate pdf
        $this->get_pdf();
        //set session for a certain time, unset after 10 minutes
        if (isset($_SESSION['most_recent_activity']) &&
            (time() - $_SESSION['most_recent_activity'] > 600)
        ) {

            //600 seconds = 10 minutes
            $this->session->unset_userdata('ticket_data');

        }
        $_SESSION['most_recent_activity'] = time(); // the start of the session.
    }
}