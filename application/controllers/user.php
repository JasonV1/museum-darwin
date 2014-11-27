<?php

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->user_model->block_user();
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
        //check form values
        $emailadres = $this->input->post('email');
        $wachtwoord = ($this->input->post('password'));

        //get db query to check credentials
        $result = $this->user_model->login($emailadres, $wachtwoord);
        //check if result is found
        if ($result) {
            //check if user is blocked, if not create session
            foreach ($result as $rows) {
                if ($rows->blocked != 'yes') {
                    $newdata = array(
                        'role_id' => $rows->role_id,
                        'employee_id' => $rows->employee_id,
                        'email' => $rows->email,
                        'naam' => $rows->naam,
                        'logged_in' => TRUE,
                    );
                    $this->session->set_userdata('logged_in', $newdata);
                    //check user roles and redirect them to their welcome page
                    $role = $this->session->userdata["logged_in"]["role_id"];
                    //admin
                    if ($role == 1) {
                        $this->user_model->add_login();
                        $this->log_login();
                        redirect('admin/welcome_admin', 'refresh');
                    }
                    //manager
                    else if ($role == 2) {
                        $this->user_model->add_login();
                        $this->log_login();
                        redirect('manager/welcome_manager', 'refresh');
                    }
                    //employee
                    else if ($role == 3) {
                        $this->user_model->add_login();
                        $this->log_login();
                        redirect('edumed/welcome_edumed', 'refresh');
                    }
                    //salesman
                    else if ($role == 4) {
                        $this->user_model->add_login();
                        $this->log_login();
                        redirect('salesman/welcome_salesman', 'refresh');
                    } else {
                        echo "Login mislukt, probeer opnieuw";
                        $this->login();
                    }
                    //if account is blocked, stop login
                } else {
                    $this->log_banned();
                    $this->user_model->add_login_attempt();
                    echo "Uw account is geblokkeerd";
                    $this->login();
                }

            }
        }
        //if no result is found or credentials are wrong, add login attempt and block login
        else {
            $this->log_failed_login();
            $this->user_model->add_login_attempt();
            //$this->log_failed_login();
            echo "verkeerde credentials";
            $this->login();
        }
    }

    //log succesful login
    private function log_login()
    {
        //load file helper
        $this->load->helper('file');
        //set timezone
        date_default_timezone_set('Europe/Amsterdam');
        //get date
        $date = date('d-m-Y H:i:s');
        //get credentials
        $name = $this->session->userdata["logged_in"]["naam"];
        $email = $this->session->userdata["logged_in"]["email"];
        //write data
        $data = $date . ': ' . $name . ' heeft succesvol ingelogd met ' . $email . '';
        //write file
        write_file('./assets/log/login_attempts.txt', $data."\n", 'a+');
    }

    private function log_failed_login() {
        //load file helper
        $this->load->helper('file');
        //set timezone
        date_default_timezone_set('Europe/Amsterdam');
        //get date
        $date = date('d-m-Y H:i:s');
        //get credentials
        $emailadres = $this->input->post('email');
        $wachtwoord = $this->input->post('password');
        $result = $this->user_model->login($emailadres, $wachtwoord);
        //write data
        $data = $date . ': ' . $emailadres . ' probeerde in te loggen met wachtwoord '.$wachtwoord.'';
        //write file
        write_file('./assets/log/login_attempts.txt', $data."\n", 'a+');
    }

    private function log_banned() {
        //load file helper
        $this->load->helper('file');
        //set timezone
        date_default_timezone_set('Europe/Amsterdam');
        //get date
        $date = date('d-m-Y H:i:s');
        //get credentials
        $emailadres = $this->input->post('email');
        $wachtwoord = $this->input->post('password');
        $result = $this->user_model->login($emailadres, $wachtwoord);
        //write data
        $data = $date . ': ' . $emailadres . ' is geblokkeerd';
        //write file
        write_file('./assets/log/login_attempts.txt', $data."\n", 'a+');
    }

    public
    function new_user()
    {
        $this->load->view('header');
        $this->load->view('user/create_user');
        $this->load->view('footer');
    }

    public
    function create_user()
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

    public
    function logout()
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