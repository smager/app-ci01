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
        $this->load->view('default_view');
	}

    public function get_loc_pc($loc_id=0,$store_loc_id=0,$loc_pc_id=0){    
        jsonOut($this->loc_pc_model->getLocPCNew($loc_id,$store_loc_id,$loc_pc_id)->result());        
    }
    
    
    public function getunpostedpc(){
    
        jsonOut($this->loc_pc_model->get_unposted_pc()->result());
        
    }

        
    public function update()
	{
        jsonOut(  $this->loc_pc_model->update($this->input->post()) );        
    }    
   
    public function delete($po_id)
	{
        
        $this->loc_pc_model->delete($po_id);
	}   
    
}
