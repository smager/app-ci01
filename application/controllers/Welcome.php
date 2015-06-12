<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('menu_model'); 
        $this->load->model('menu_types_model');    
        $this->load->library('session');
        $this->load->helper(array('url','include','zsi'));
    }    
	public function index()
	{
        check_login();
		$this->load->view('welcome_message');
	} 
}
