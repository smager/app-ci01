<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class events extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('events_model'); 
    }
    
	public function index()
	{
        check_login();
		$this->load->view('default_view');
	}
    
    public function getdata(){    
        jsonOut($this->events_model->getdata()->result());        
    }
    
    
    public function update()
	{
        $this->events_model->update($this->input->post());
        redirect( base_url("events") );
      
	}    
   

    public function delete()
	{
        
        $this->events_model->delete($this->input->post());
	}   
    
}
