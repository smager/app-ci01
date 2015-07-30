<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class supply_out extends Base_Controller {
    function __construct() {
        parent::__construct();  
         $this->load->model('supply_out_model'); 
    }
         
	public function index()
	{
        check_login();
		$this->load->view('default_view');
	}    
    
    public function getdetail()
	{        
        jsonOut($this->supply_out_model->getdata_detail($this->input->get())->result());
      
	} 
        
    public function update()
	{
        $this->supply_out_model->update($this->input->post());
        redirect( base_url($this->router->fetch_class()) );
      
	}  
    
}
