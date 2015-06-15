<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class select_options extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('select_options_model'); 
        $this->load->helper(array('url','zsi','include'));
    }
    
	public function index()
	{
        check_login();        
        $this->load->view('select_options_list');        
	}
    
	public function code($code)
	{
        check_login();
        $query = $this->select_options_model->getdata_by_code($code);
        if($query==null)
            jsonOut( array());
        else 
            jsonOut( $query->result());
	}    
    
    
    public function getdata_json(){
    
        jsonOut($this->select_options_model->getdata()->result());
        
    }    
    
        
    public function update()
	{
        $this->select_options_model->update($this->input->post());
        redirect( base_url("select_options") );
      
	}    
   
    public function delete()
	{
        
        $this->select_options_model->delete($this->input->post());
	}   
    
}
