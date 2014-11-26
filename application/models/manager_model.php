<?php

/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 11/12/2014
 * Time: 11:10 AM
 */
class Manager_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_given_date($post)
    {
        $query = $this->db->query("SELECT *
                                    FROM booking
                                    LEFT JOIN visitor ON user_id = visitor.id
                                    WHERE booking.created_at = '" . $post['created_at'] . "'");

        return $query->result();
    }

    public function get_reservation_dates()
    {
        $return[''] = 'Selecteer een dag';
        $query2 = $this->db->query("SELECT DISTINCT created_at AS `d` FROM booking");

        foreach ($query2->result_array() as $row) {
            $return[] = $row['d'];
        }

        return $return;
    }

    public function past_three_months()
    {
        $query = $this->db->query("SELECT *
                                    FROM booking
                                    LEFT JOIN visitor ON user_id = visitor.id
                                    WHERE booking.created_at >= NOW() - INTERVAL 3 MONTH
                                    ORDER BY visitor.woonplaats");

        return $query->result();
    }

    public function weekoverview()
    {
        $query = $this->db->query("SELECT * FROM booking
                                    LEFT JOIN visitor ON user_id = visitor.id
                                    WHERE booking.created_at >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY
                                    AND booking.created_at < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY
                                    ORDER BY booking.created_at");

        return $query->result();
    }

    public function get_reservation_data()
    {
        $query = $this->db->query("SELECT *
                                    FROM booking
                                    LEFT JOIN visitor ON user_id = visitor.id
                                    WHERE created_at < CURRENT_DATE
                                    GROUP BY booking.created_at
                                    ORDER BY booking.created_at ASC

                                    ");
        return $query->result();
    }
} 