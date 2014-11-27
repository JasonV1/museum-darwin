<?php

class Edumed extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('edumed_model');
        $this->check_tour();
        $this->security();
    }

    public function security()
    {
        if ( !isset( $this->session->userdata["logged_in"]["email"]) )
        {
            echo "U bent niet ingelogd en daarom niet bevoegd om deze pagina te bekijken.";
            header('refresh:3;url='.base_url().'');
            exit();
        }
        else if ( $this->session->userdata["logged_in"]["role_id"] ==  1 )
        {
            echo "U heeft niet de juiste gebruikersrol, u wordt doorgestuurd naar uw homepage.";
            header('refresh:3;url='.base_url().'admin/welcome_admin');
            exit();
        }
        else if ( $this->session->userdata["logged_in"]["role_id"] ==  4 )
        {
            echo "U heeft niet de juiste gebruikersrol, u wordt doorgestuurd naar uw homepage.";
            header('refresh:3;url='.base_url().'salesman/welcome_salesman');
            exit();
        }
        else if ( $this->session->userdata["logged_in"]["role_id"] ==  2 )
        {
            echo "U heeft niet de juiste gebruikersrol, u wordt doorgestuurd naar uw homepage.";
            header('refresh:3;url='.base_url().'manager/welcome_manager');
            exit();
        }
    }

    /**
     * @return bool
     */
    public function check_tour() {
        $result = $this->edumed_model->get_tour_status();

        if ($result) {
            echo "<h1 style='background:#000;'>Let op! Een of meerdere toeren hebben toestemming nodig om geannuleerd te worden.</h1>";
        }
        else {
            return false;
        }
    }

    public function welcome_edumed()
    {
        $this->load->view('header');
        $this->load->view('edumed/welcome');
        $this->load->view('footer');
    }

    public function cancel_tour($id) {
        $data = $this->edumed_model->get_email_results($id);
        $this->edumed_model->update_tour($id);

        $this->load->library('email');
        foreach ($data as $row) {
            $this->email->from('admin@jason-vandervegte.nl', 'Darwin Museum');
            $this->email->to($row->email);

            $this->email->subject('Annulering toer');
            $this->email->message('Geachte bezoeker,

                                   Onlangs heeft u een reservering gemaakt voor de toer: '.$row->name. '
                                   Echter kan deze toer niet doorgaan vanwege een tekort aan verkochte tickets voor deze toer.
                                   Het geld dat u heeft betaald voor deze toer wordt per direct teruggestort.

                                   Ons excuses voor dit ongemak.

                                   Met vriendelijke groet,

                                   Het Russisch Darwin museum
                ');

            $this->email->send();
        }
        $this->view_tours();
    }
    public function view_tours()
    {
        $this->load->view('header');
        $data['tours'] = $this->edumed_model->get_tours();
        $this->load->view('edumed/view_tours', $data);
        $this->load->view('footer');
    }
}