<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class adjustments_ref extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('adjustments_ref_model'); 
    }
    
	public function index()
	{
        check_login();
		$this->load->view('default_view');
	}
    
    public function getdata(){    
        jsonOut($this->adjustments_ref_model->getdata()->result());        
    }
    
    
    public function update()
	{
        $this->adjustments_ref_model->update($this->input->post());
        redirect( base_url("adjustments_ref") );
      
	}    
   

    public function delete()
	{
        
        $this->adjustments_ref_model->delete($this->input->post());
	}   
    
}
