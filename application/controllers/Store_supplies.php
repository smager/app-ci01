<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class store_supplies extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('store_supplies_model'); 
        $this->load->helper(array('url','zsi','include'));
    }
    
	public function select()
	{
  
		$this->load->view('store_supplies_select');
	}
    
    public function getdata_json($id){
    
        jsonOut($this->store_supplies_model->getdata($id)->result());
        
    }

}
