<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class receiving extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('receiving_model'); 
    }
    
	public function index()
	{
        check_login();
		$this->load->view('receiving_list');
	}

    public function getdata_json(){
    
        jsonOut($this->receiving_model->getdata()->result());
        
    }
    
        
    public function update()
	{
        $this->receiving_model->update($this->input->post());
        redirect( base_url($this->router->fetch_class()) );
      
	}    
   
    public function delete()
	{
        
        $this->receiving_model->delete($this->input->post());
	}   
    
}
