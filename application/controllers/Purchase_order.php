<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class purchase_order extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('purchase_order_model'); 
        $this->load->helper(array('url','zsi','include'));
    }
    
	public function index()
	{
        check_login();
		$this->load->view('purchase_order_list');
	}

    public function getdata_json(){
    
        jsonOut($this->purchase_order_model->getdata()->result());
        
    }
    
    public function getdata_dtls_json($id){
    
        jsonOut($this->purchase_order_model->getdata_dtls($id)->result());
        
    }        
        
    public function update()
	{
        $this->purchase_order_model->update($this->input->post());
        redirect( base_url("purchase_order") );
      
	}    
   
    public function delete()
	{
        
        $this->purchase_order_model->delete($this->input->post());
	}   
    
}
