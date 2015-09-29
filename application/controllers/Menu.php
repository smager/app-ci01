<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class menu extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('menu_model'); 
    }
    
	public function index()
	{
        check_login();        
		$this->load->view('default_view');
	}
	
	public function getdata()
	{
        check_login();        
		jsonOut($this->menu_model->getdata()->result());
	}
	

    public function getdata_json($menu_type_id){
    
        jsonOut($this->menu_model->getSubMenuItem($menu_type_id)->result());
        
    }        
    public function update()
	{
        $this->menu_model->update($this->input->post());
        redirect( base_url("menu") );
      
	}    
	
    public function delete()
	{
        $this->menu_model->delete($this->input->post());
	}   
    
}
