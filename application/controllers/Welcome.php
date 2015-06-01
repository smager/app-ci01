<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('menu_model'); 
        $this->load->model('menu_types_model');       
        $this->load->helper(array('url','include'));
    }    
	public function index()
	{
		$this->load->view('welcome_message');
	}
    
	public function test()
	{
		echo "test";
	}    
	public function test2()
	{
		$this->load->view('test_form');
	}      
}
