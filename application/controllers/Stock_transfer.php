<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class stock_transfer extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('stock_transfer_model'); 
    }
    
	public function index()
	{
        check_login();
		$this->load->view('default_view');
	}

    public function getUnpostedST(){
    
        jsonOut($this->stock_transfer_model->getUnpostedST()->result());
        
    }
    
    public function getdata_dtls_json($id){
    
        jsonOut($this->stock_transfer_model->getdata_dtls($id)->result());
        
    }
    
    public function powith_bal($id=''){
    
        jsonOut($this->stock_transfer_model->getPOWithBal($id)->result());
        
    }      
    
        
    public function update()
	{
        jsonOut(
            array( "st_id" => $this->stock_transfer_model->update($this->input->post()) )
        );        
	}    
   
    public function delete($po_id)
	{
        
        $this->stock_transfer_model->delete($po_id);
	}   
    
    public function delete_dtls()
	{
        
        $this->stock_transfer_model->delete_dtls($this->input->post());
	}   
    
}
