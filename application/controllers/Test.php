<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class test extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model($this->router->fetch_class() . '_model'); 
    }
    
	public function index()
	{
        check_login();
		$this->load->view('test_list');
	}
    
    public function update()
	{
        $this->test_model->update($this->input->post());
        redirect( base_url($this->router->fetch_class()) );
      
	}    
   

    public function delete()
	{
        
        $this->test_model->delete($this->input->post());
	}   
    
}
