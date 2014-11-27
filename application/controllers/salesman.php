<?php

class Salesman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('sales_model');
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
        else if ( $this->session->userdata["logged_in"]["role_id"] ==  3 )
        {
            echo "U heeft niet de juiste gebruikersrol, u wordt doorgestuurd naar uw homepage.";
            header('refresh:3;url='.base_url().'edumed/welcome_edumed');
            exit();
        }
        else if ( $this->session->userdata["logged_in"]["role_id"] ==  2 )
        {
            echo "U heeft niet de juiste gebruikersrol, u wordt doorgestuurd naar uw homepage.";
            header('refresh:3;url='.base_url().'manager/welcome_manager');
            exit();
        }
    }

    public function welcome_salesman()
    {
        $this->load->view('header');
        $this->load->view('salesman/welcome');
        $this->load->view('footer');
    }

    public function create_ticket() {
        $this->load->view('header');
        $this->load->view('salesman/create_ticket');
        $this->load->view('footer');
    }

    public function get_pdf()
    {
        //load the pdf library
        $this->load->library('mpdf');
        //get data from the model
        $data['query'] = $this->sales_model->get_ticket();
        $mpdf = new mPDF('c', 'A4', '', '', 32, 25, 27, 25, 16, 13);
        $mpdf->SetDisplayMode('fullpage');
        //whether to indent the first level of a list
        $mpdf->list_indent_first_level = 0; // 1 or 0 -
        //load view for the pdf
        $html = $this->load->view('salesman/ticket_view', $data, TRUE);
        $mpdf->WriteHTML($html);
        //output pdf as ticket.pdf and download immediately
        $mpdf->Output('ticket.pdf', 'D');
    }

    public function payment() {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('price', 'Price', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo "Failed";
            $this->welcome_salesman();
        } else {
            echo "Done";
            $this->sales_model->create_ticket();
            $this->get_pdf();
            $this->welcome_salesman();
        }
    }
}