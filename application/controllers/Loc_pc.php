<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class loc_pc extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('loc_pc_model'); 
    }
    
	public function index()
	{
        check_login();
		$this->load->view('loc_pc_list');
	}

    public function getdata($loc_id){
    
        jsonOut($this->loc_pc_model->getdata($loc_id)->result());
        
    }
    
    public function getdata_dtls($loc_pc_id){
    
        jsonOut($this->loc_pc_model->getdata_dtls($loc_pc_id)->result());
        
    }
    
    
    public function getunpostedpc(){
    
        jsonOut($this->loc_pc_model->get_unposted_pc()->result());
        
    }

        
    public function update()
	{
        jsonOut(
            array( "loc_pc_id" => $this->loc_pc_model->update($this->input->post()) )
        );        
	}    
   
    public function delete($po_id)
	{
        
        $this->loc_pc_model->delete($po_id);
	}   
    
}
