<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class javascripts extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('javascripts_model'); 
        $this->load->helper(array('url','zsi','include'));
    }
    
	public function index()
	{
  
		$this->load->view('javascripts_list');
	}

    public function getdata_json($js_id=null)
	{  
        jsonOut($this->javascripts_model->getdata($js_id)->result());
      
	}   
  
    
    public function update()
	{
        $this->javascripts_model->update($this->input->post());
	}    
    public function delete()
	{
        
        $this->javascripts_model->delete($this->input->post());
	}       
}
