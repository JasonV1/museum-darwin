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
    public function get_tour_status() {
        $query = $this->db->query("SELECT toestemming FROM tours
                                    WHERE toestemming = 'nee'
                                    AND status = 'geannuleerd'");

        return $query->result();
    }

    public function update_tour($id) {
        $this->db->query("UPDATE tours SET toestemming = 'ja'
                          WHERE t_id = '".$id."'");
    }

    public function get_tours() {
        $query = $this->db->query("SELECT * FROM tours
                                    WHERE toestemming = 'nee'
                                    AND status = 'geannuleerd'");
        return $query->result();
    }
}