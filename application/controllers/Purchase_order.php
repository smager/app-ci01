<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class purchase_order extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('purchase_order_model'); 
    }
    
	public function index()
	{
        check_login();
		$this->load->view('default_view');
	}

    public function getdata_json(){
    
        jsonOut($this->purchase_order_model->getdata()->result());
        
    }
    
    public function getdata_dtls_json($id,$withbal='n'){
    
        jsonOut($this->purchase_order_model->getdata_dtls($id,$withbal)->result());
        
    }
    
    public function powith_bal($id=''){
    
        jsonOut($this->purchase_order_model->getPOWithBal($id)->result());
        
    }      
    
        
    public function update()
	{
        jsonOut(
            array( "po_id" => $this->purchase_order_model->update($this->input->post()) )
        );        
	}    
   
    public function delete($po_id)
	{
        
        $this->purchase_order_model->delete($po_id);
	}   
    
    public function delete_dtls()
	{
        
        $this->purchase_order_model->delete_dtls($this->input->post());
	}   
    
}
