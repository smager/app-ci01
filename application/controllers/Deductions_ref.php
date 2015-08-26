<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class deductions_ref extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('deductions_ref_model'); 
    }
    
	public function index()
	{
        check_login();
		$this->load->view('default_view');
	}
    
    public function getdata(){    
        jsonOut($this->deductions_ref_model->getdata()->result());        
    }
    
    
    public function update()
	{
        $this->deductions_ref_model->update($this->input->post());
        redirect( base_url("deductions_ref") );
      
	}    
   

    public function delete()
	{
        
        $this->deductions_ref_model->delete($this->input->post());
	}   
    
}
    