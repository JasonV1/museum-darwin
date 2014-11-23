<?php

/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 11/22/2014
 * Time: 9:59 PM
 */
class PostTest extends PHPUnit_Framework_TestCase
{
    private $CI;

    public function setUp()
    {
        $this->CI = &get_instance();
    }

    public function test()
    {
        $this->CI->load->model('test_model');
        $posts = $this->CI->post->getAll();
        $this->assertEquals(5, count($posts));
    }
}