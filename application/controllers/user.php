<?php

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('welcome_message');
        $this->load->view('footer');
    }

    public function view_users()
    {
        $this->load->view('header');
        $data['user'] = $this->user_model->get_users();
        $this->load->view('user/view_users', $data);
        $this->load->view('footer');
    }

    public function get_pdf()
    {
        $this->load->library('mpdf');
        //get data from the model
        $data['user'] = $this->user_model->get_users();
        $mpdf = new mPDF('c', 'A4', '', '', 32, 25, 27, 25, 16, 13);
        $mpdf->SetDisplayMode('fullpage');
        //whether to indent the first level of a list
        $mpdf->list_indent_first_level = 0; // 1 or 0 -
        //load view for the pdf
        $html = $this->load->view('user/pdf_view', $data, TRUE);

        $mpdf->WriteHTML($html);
        $mpdf->Output();
//==============================================================
//==============================================================
//==============================================================
    }

    public function login()
    {
        $this->load->view('header');
        $this->load->view('user/login');
        $this->load->view('footer');
    }

    public function log_in()
    {
        $emailadres = $this->input->post('email');
        $wachtwoord = ($this->input->post('password'));

        $result = $this->user_model->login($emailadres, $wachtwoord);
        if ($result[0]->role_id == 1) {
            redirect('admin/welcome_admin', 'refresh');
        }
        if ($result[0]->role_id == 2) {
            redirect('manager/welcome_manager', 'refresh');
        }
        if ($result[0]->role_id == 3) {
            redirect('edumed/welcome_edumed','refresh');
        }
        if ($result[0]->role_id == 4) {
            redirect('salesman/welcome_salesman','refresh');
        } else {
            echo "Login mislukt, probeer opnieuw";
            $this->login();
        }
    }

    public function new_user()
    {
        $this->load->view('header');
        $this->load->view('user/create_user');
        $this->load->view('footer');
    }

    public function create_user()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('voornaam', 'Voornaam', 'trim|required');
        $this->form_validation->set_rules('tussenvoegsel', 'Tussenvoegsel', 'trim');
        $this->form_validation->set_rules('achternaam', 'Achternaam', 'trim|required');
        $this->form_validation->set_rules('email', 'E-mailadres', 'trim|required|valid_email');
        $this->form_validation->set_rules('geboortedatum', 'Geboortedatum', 'required');
        $this->form_validation->set_rules('postcode', 'Postcode', 'trim|required');
        $this->form_validation->set_rules('woonplaats', 'Woonplaats', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');

        if ($this->form_validation->run() == FALSE) {

            echo "Failed";
            $this->new_user();
        } else {
            echo "Succes";
            $this->user_model->add_user();
            $this->index();

            //$this->output->set_header('refresh:3;url=login_view');
        }
    }

    public function logout()
    {
        $newdata = array(
            'user_id' => '',
            'email' => '',
            'logged_in' => FALSE,
        );
        $this->session->unset_userdata($newdata);
        $this->session->sess_destroy();
        $this->index();
    }
}