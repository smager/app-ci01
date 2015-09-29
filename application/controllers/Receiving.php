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
		$this->load->view('default_view');
	}

    public function get_unposted_dr(){
    
        jsonOut($this->receiving_model->get_unposted_dr()->result());
        
    }
    public function get_unposted_dr_dtls($receiving_id){
    
        jsonOut($this->receiving_model->get_unposted_dr_dtls($receiving_id)->result());
        
    }
    
    public function getdata_po_with_bal($id){
    
        jsonOut($this->receiving_model->getdata_po_with_bal($id)->result());
        
    }    
        
    public function update()
	{
        $this->receiving_model->update($this->input->post());
        redirect( base_url($this->router->fetch_class()) );
      
	}    
   
    
        
    public function delete($receiving_id)
	{        
        $this->receiving_model->delete($receiving_id);
	}  
    
    public function delete_dtls()
	{        
        $this->receiving_model->delete_dtls($this->input->post());
	}   
    
}
