<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 11/22/2014
 * Time: 9:58 PM
 */

class Test_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll() {
        return array(
            array('title'=>'post 1','content'=>'...'),
            array('title'=>'post 2','content'=>'...'),
            array('title'=>'post 3','content'=>'...'),
            array('title'=>'post 4','content'=>'...'),
            array('title'=>'post 5','content'=>'...'),
        );
    }
}