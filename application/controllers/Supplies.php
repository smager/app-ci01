<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class supplies extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('supplies_model'); 
    }
    
	public function index()
	{
		$this->load->view('default_hb_view');
	}
    
    
    public function getdata_json(){    
        jsonOut($this->supplies_model->getdata()->result());        
    }
    
    public function get_po_supplies(){    
        jsonOut($this->supplies_model->getPoSupplies()->result());        
    }
    
    public function update()
	{
        $this->supplies_model->update($this->input->post());
        redirect( base_url("supplies") );
      
	}    
   

    public function delete()
	{
        
        $this->supplies_model->delete($this->input->post());
	}   
    
}
