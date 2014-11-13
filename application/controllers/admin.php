<?php

class Admin extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function welcome_admin()
    {
        $this->load->view('header');
        $this->load->view('admin/welcome');
        $this->load->view('footer');
    }

    public function files()
    {
        $this->load->view('header');
        $this->load->view('admin/files');
        $this->load->view('footer');
    }

    public function upload_photo() {
        $this->load->view('header');
        $this->load->view('admin/upload_photo');
        $this->load->view('footer');
    }

    public function upload() {
        $this->load->library('form_validation');
        // field name, error message, validation rules

        $this->form_validation->set_rules('title', 'Titel', 'trim|required');
        $this->form_validation->set_rules('description', 'Beschrijving', 'trim|required');
        if (empty($_FILES['image']['name']))
        {
            $this->form_validation->set_rules('image', 'Image', 'required');
        }

        if($this->form_validation->run() == FALSE)
        {
            echo "Kan bestand niet toevoegen";
            $this->upload_photo();
        }
        else
        {
            if (!empty($_FILES["image"]["name"]))
            {
                $uploads_dir = 'C:/wamp/www/museum-darwin/assets/img/uploads';
                if ($_FILES["image"] > 0) {
                    if (!is_dir($uploads_dir))
                    {
                        mkdir('C:/wamp/www/museum-darwin/assets/img/uploads', 777);
                    }
                    $tmp_name = $_FILES["image"]["tmp_name"];
                    $name = $_FILES["image"]["name"];
                    move_uploaded_file($tmp_name, "$uploads_dir/$name");
                }
            }
            echo "Het bestand is toegevoegd!";
            $this->admin_model->add_file();
            $this->upload_photo();
        }
    }

    public function users()
    {
        $this->load->view('header');
        $data['user'] = $this->admin_model->get_user_data();
        $this->load->view('admin/users', $data);
        $this->load->view('footer');
    }
} 