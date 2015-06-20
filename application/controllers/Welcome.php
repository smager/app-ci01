<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Public_Controller {
    function __construct() {
        parent::__construct();       
        $this->load->model('menu_model'); 
        $this->load->model('menu_types_model');    
        $this->load->library('session');
    }    
	public function index()
	{
		$this->load->view('welcome_message');
	} 
}
