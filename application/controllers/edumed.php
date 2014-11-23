<?php

class Edumed extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('edumed_model');
        $this->check_tour();
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