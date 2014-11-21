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
        $this->edumed_model->update_tour($id);
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