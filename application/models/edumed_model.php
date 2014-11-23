<?php

/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 11/20/2014
 * Time: 11:31 AM
 */
class Edumed_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function get_tour_status()
    {
        $query = $this->db->query("SELECT toestemming FROM tours
                                    WHERE toestemming = 'nee'
                                    AND status = 'geannuleerd'");

        return $query->result();
    }

    public function update_tour($id)
    {
        $this->db->query("UPDATE tours SET toestemming = 'ja'
                          WHERE t_id = '" . $id . "'");
    }

    public function get_email_results($id)
    {
        $query = $this->db->query("SELECT t.t_id, t.name, r.reservation_id, r.user_id, v.id, v.email
                                   FROM tours t
                                   LEFT JOIN tours_reservations r ON t.t_id = r.tour_id
                                   RIGHT JOIN visitor v ON r.user_id = v.id
                                   WHERE t.t_id =  '".$id."'");

        return $query->result();
    }

    public function get_tours()
    {
        $query = $this->db->query("SELECT * FROM tours
                                    WHERE toestemming = 'nee'
                                    AND status = 'geannuleerd'");
        return $query->result();
    }
}