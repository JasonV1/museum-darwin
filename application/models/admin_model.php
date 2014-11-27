<?php

class Admin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function get_photo_data()
    {
        $query = $this->db->query("SELECT * FROM image");
        return $query->result();
    }

    /**
     * @return mixed
     */
    public function get_video_data()
    {
        $query = $this->db->query("SELECT * FROM video");
        return $query->result();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get_video_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('video');
        return $query->result();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get_image_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('image');
        return $query->result();
    }

    public function edit_image()
    {
        //update the image with post data
        $this->db->query("UPDATE image SET title ='" . $this->input->post('title') . "',
                                           description   = '" . $this->input->post('description') . "',
                                           bestand = '" . $_FILES['image']['name'] . "'
                            WHERE id = '" . $this->input->post('id') . "'");
    }

    public function edit_video($post)
    {
        //update the video with post data
        $this->db->query("UPDATE video SET title ='" . $post['title'] . "',
                                           description   = '" . $post['description'] . "',
                                           bestand = '" . $_FILES['video']['name'] . "'
                            WHERE id='" . $post['id'] . "'");
    }

    /**
     * @return mixed
     */
    public function get_user_data()
    {
        $query = $this->db->query("SELECT * FROM employee_role
                                   LEFT JOIN employee ON employee_id = employee.id");
        return $query->result();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get_user_id($id)
    {
        $query = $this->db->query("SELECT * FROM employee_role
                                   LEFT JOIN employee ON employee_id = employee.id
                                   RIGHT JOIN password ON employee_id = password.employee
                                   WHERE employee.id = '" . $id . "'");
        return $query->result();
    }

    public function add_user()
    {
        $this->db->trans_start();
        $data = array(
            'naam' => $this->input->post('name'),
            'email' => $this->input->post('email')
        );


        $this->db->insert('employee', $data);

        $table1_id = $this->db->insert_id();

        $password = array(
            'employee' => $table1_id,
            'password' => ($this->input->post('password'))
        );

        $this->db->insert('password', $password);

        $this->db->query('INSERT INTO employee_role VALUES(' . $table1_id . ', ' . $this->input->post('role') . ')');

        $this->db->trans_complete();
    }

    /**
     * @return mixed
     */
    public function get_login_attempts()
    {
        $query = $this->db->query("SELECT * FROM login_attempts");

        return $query->result();
    }

    /**
     * @return mixed
     */
    public function get_logins()
    {
        $query = $this->db->query("SELECT * FROM succesful_login");

        return $query->result();
    }

    /**
     * @return mixed
     */
    public function get_blocked_users()
    {
        $query = $this->db->query("SELECT * FROM employee
                                   WHERE blocked = 'yes'");

        return $query->result();
    }

    public function unblock_user($id) {
        //Unblock the user
        $this->db->query("UPDATE employee SET blocked = 'no'
                          WHERE id = '".$id."'");

        //get the employee id
        $query = $this->db->query("SELECT * FROM employee
                                   WHERE id = '".$id."'");

        //erase the login attempts
        foreach ($query->result() as $row) {
            $this->db->query("DELETE FROM login_attempts
                          WHERE emailadres = ?", array($row->email));
        }


    }

    public function edit_user($post)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE employee SET
                                  naam = '" . $post['name'] . "',
                                  email = '" . $post['email'] . "'
                            WHERE id = '" . $post['id'] . "'");

        $last_id = $post['id'];

        $this->db->query("UPDATE password SET
                                  password = '" . $post['password'] . "'
                            WHERE employee = '".$last_id."'");

        $this->db->query("UPDATE employee_role SET role_id = '" . $this->input->post('role') . "'
                                                WHERE employee_id = '" . $last_id . "'");

        $this->db->trans_complete();

    }

    public function delete_user($id)
    {
        //delete record with selected id
        $this->db->query("DELETE FROM employee
                        WHERE id = '" . $id . "'");
    }

    public function delete_image($id)
    {
        //delete record with selected id
        $this->db->query("DELETE FROM image
                        WHERE id = '" . $id . "'");
    }

    public function delete_video($id)
    {
        //delete record with selected id
        $this->db->query("DELETE FROM video
                        WHERE id = '" . $id . "'");
    }

    public function add_image()
    {
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'bestand' => $_FILES['image']['name']); // <- put only the file name in database


        $this->db->insert('image', $data);
    }

    public function add_video()
    {
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'bestand' => $_FILES['video']['name']); // <- put only the file name in database


        $this->db->insert('video', $data);
    }
}