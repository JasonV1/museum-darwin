<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
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
        else if ( $this->session->userdata["logged_in"]["role_id"] ==  4 )
        {
            echo "U heeft niet de juiste gebruikersrol, u wordt doorgestuurd naar uw homepage.";
            header('refresh:3;url='.base_url().'salesman/welcome_salesman');
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

    //first page for the admin to see upon login
    public function welcome_admin()
    {
        $this->load->view('header');
        $this->load->view('admin/welcome');
        $this->load->view('footer');
    }

    public function files()
    {
        $this->load->view('header');
        //load images
        $data['images'] = $this->admin_model->get_photo_data();
        //load videos
        $data['videos'] = $this->admin_model->get_video_data();
        //load the view with files
        $this->load->view('admin/files', $data);
        $this->load->view('footer');
    }

    public function image_overview($id)
    {
        $this->load->view("header");
        //get image id
        $data['query'] = $this->admin_model->get_image_id($id);
        //load view with image id
        $this->load->view('admin/image_overview', $data);
        $this->load->view("footer");
    }

    public function video_overview($id)
    {
        $this->load->view("header");
        //get video id
        $data['query'] = $this->admin_model->get_video_id($id);
        //load view with video id
        $this->load->view('admin/video_overview', $data);
        $this->load->view("footer");
    }

    public function upload_photo()
    {
        $this->load->view('header');
        //load upload view
        $this->load->view('admin/upload_photo');
        $this->load->view('footer');
    }

    public function edit_image($id)
    {
        $this->load->view("header");
        //get image id
        $data['query'] = $this->admin_model->get_image_id($id);
        //get edit form for image
        $this->load->view('admin/edit_image', $data);
        $this->load->view("footer");
    }

    public function image_edit()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules

        $this->form_validation->set_rules('title', 'Titel', 'trim|required');
        $this->form_validation->set_rules('description', 'Beschrijving', 'trim|required');
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_rules('image', 'Image', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            echo "Kan record niet wijzigen";
            $this->files();
        } else {
            if (!empty($_FILES["image"]["name"])) {
                $uploads_dir = 'C:/wamp/www/museum-darwin/assets/img/uploads';
                if ($_FILES["image"] > 0) {
                    if (!is_dir($uploads_dir)) {
                        mkdir('C:/wamp/www/museum-darwin/assets/img/uploads', 777);
                    }
                    $tmp_name = $_FILES["image"]["tmp_name"];
                    $name = $_FILES["image"]["name"];
                    move_uploaded_file($tmp_name, "$uploads_dir/$name");
                }
            }
            echo "Het bestand is toegevoegd!";
            $this->admin_model->edit_image();
            $this->files();
            redirect('admin/files', 'refresh');
        }
    }

    public function upload_video()
    {
        $this->load->view('header');
        //load upload view
        $this->load->view('admin/upload_video');
        $this->load->view('footer');
    }

    public function edit_video($id)
    {
        $this->load->view('header');
        $data['query'] = $this->admin_model->get_video_id($id);
        $this->load->view('admin/edit_video', $data);
        $this->load->view('footer');
    }

    public function video_edit()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules

        $this->form_validation->set_rules('title', 'Titel', 'trim|required');
        $this->form_validation->set_rules('description', 'Beschrijving', 'trim|required');
        if (empty($_FILES['video']['name'])) {
            $this->form_validation->set_rules('video', 'Video', 'required');
        }
        if ($this->form_validation->run() == FALSE) {
            echo "Kan bestand niet toevoegen";
            $this->files();
        } else {
            if (!empty($_FILES["video"]["name"])) {
                $uploads_dir = 'C:/wamp/www/museum-darwin/assets/vid/uploads';
                if ($_FILES["video"] > 0) {
                    if (!is_dir($uploads_dir)) {
                        mkdir('C:/wamp/www/museum-darwin/assets/vid/uploads', 777);
                    }
                    $tmp_name = $_FILES["video"]["tmp_name"];
                    $name = $_FILES["video"]["name"];
                    move_uploaded_file($tmp_name, "$uploads_dir/$name");
                }
            }
            echo "Het bestand is toegevoegd!";
            $this->admin_model->edit_video($_POST);
            $this->files();
            redirect('admin/files', 'refresh');
        }
    }

    public function video_upload()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules

        $this->form_validation->set_rules('title', 'Titel', 'trim|required');
        $this->form_validation->set_rules('description', 'Beschrijving', 'trim|required');
        if (empty($_FILES['video']['name'])) {
            $this->form_validation->set_rules('video', 'Video', 'required');
        }
        if ($this->form_validation->run() == FALSE) {
            echo "Kan bestand niet toevoegen";
            $this->upload_video();
        } else {
            if (!empty($_FILES["video"]["name"])) {
                $uploads_dir = 'C:/wamp/www/museum-darwin/assets/vid/uploads';
                if ($_FILES["video"] > 0) {
                    if (!is_dir($uploads_dir)) {
                        mkdir('C:/wamp/www/museum-darwin/assets/vid/uploads', 777);
                    }
                    $tmp_name = $_FILES["video"]["tmp_name"];
                    $name = $_FILES["video"]["name"];
                    move_uploaded_file($tmp_name, "$uploads_dir/$name");
                }
            }
            echo "Het bestand is toegevoegd!";
            $this->admin_model->add_video();
            $this->upload_video();
        }
    }

    public function photo_upload()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules

        $this->form_validation->set_rules('title', 'Titel', 'trim|required');
        $this->form_validation->set_rules('description', 'Beschrijving', 'trim|required');
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_rules('image', 'Image', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            echo "Kan record niet bewerken";
            $this->upload_photo();
        } else {
            if (!empty($_FILES["image"]["name"])) {
                $uploads_dir = 'C:/wamp/www/museum-darwin/assets/img/uploads';
                if ($_FILES["image"] > 0) {
                    if (!is_dir($uploads_dir)) {
                        mkdir('C:/wamp/www/museum-darwin/assets/img/uploads', 777);
                    }
                    $tmp_name = $_FILES["image"]["tmp_name"];
                    $name = $_FILES["image"]["name"];
                    move_uploaded_file($tmp_name, "$uploads_dir/$name");
                }
            }
            echo "Het bestand is toegevoegd!";
            $this->admin_model->add_image();
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

    public function new_user()
    {
        $this->load->view('header');
        $this->load->view('admin/new_user');
        $this->load->view('footer');
    }

    public function create_user()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('name', 'Naam', 'trim|required');
        $this->form_validation->set_rules('email', 'E-mailadres', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {

            echo "Failed";
            $this->new_user();
        } else {
            //add the user
            $this->admin_model->add_user();
            //go back to users overview
            $this->users();
            redirect('admin/users', 'refresh');
            //$this->output->set_header('refresh:3;url=login_view');
        }
    }



    public function edit_user($id)
    {
        $this->load->view('header');
        //get user id
        $data['user'] = $this->admin_model->get_user_id($id);
        //load view to edit user
        $this->load->view('admin/edit_user', $data);
        $this->load->view('footer');
    }

    public function delete_user($id)
    {
        //delete the selected user id
        $this->admin_model->delete_user($id);
        //go back to users overview
        $this->users();
        //redirect the page so browser won't re-do the action upon refreshing page
        redirect('admin/users', 'refresh');
    }

    public function print_log()
    {
        $filename = '././assets/log/login_attempts.txt';
        $contents = file($filename);

        $data['contents'] = $contents;
        $this->load->view('header');
        $this->load->view('admin/log', $data);
        $this->load->view('footer');
    }

    public function delete_image($id)
    {
        //delete selected image
        $this->admin_model->delete_image($id);
        //go back to files overview
        $this->files();
        //redirect the page so browser won't re-do the action upon refreshing page
        redirect('admin/files', 'refresh');
    }

    public function delete_video($id)
    {
        //delete selected video
        $this->admin_model->delete_video($id);
        //go back to view overview
        $this->files();
        //redirect the page so browser won't re-do the action upon refreshing page
        redirect('admin/files', 'refresh');
    }

    public function user_edit()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('name', 'Naam', 'trim|required');
        $this->form_validation->set_rules('email', 'E-mailadres', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {

            echo "Failed";
            $this->users();

        } else {
            $this->admin_model->edit_user($_POST);
            $this->users();
            redirect('admin/users', 'refresh');
            //$this->output->set_header('refresh:3;url=login_view');
        }
    }

    public function logins() {
        $this->load->view('header');
        //get attempts
        $data['logins'] = $this->admin_model->get_login_attempts();
        //get succesful logins
        $data['login'] = $this->admin_model->get_logins();
        $this->load->view('admin/logins', $data);
        $this->load->view('footer');
    }

    public function blocked_users() {
        $this->load->view('header');
        $data['users'] = $this->admin_model->get_blocked_users();
        $this->load->view('admin/blocked_users', $data);
        $this->load->view('footer');
    }

    public function unblock_user($id) {
        $this->admin_model->unblock_user($id);
        $this->blocked_users();
    }
}