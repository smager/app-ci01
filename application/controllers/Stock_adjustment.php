<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class stock_adjustment extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('stock_adjustment_model'); 
    }
    
	public function index()
	{
        check_login();
        $this->load->view('default_view');
	}

    public function get_stock_adjustment($loc_id=0,$store_loc_id=0,$stock_adjmt_id=0){    
        jsonOut($this->stock_adjustment_model->getNewData($loc_id,$store_loc_id,$stock_adjmt_id)->result());        
    }
    
    
    public function getunposteditems(){
    
        jsonOut($this->stock_adjustment_model->getUnpostedData()->result());
        
    }

        
    public function update()
	{
        $this->stock_adjustment_model->update($this->input->post());        
    }    
   
    public function delete($stock_adjmt_id)
	{
        
        $this->stock_adjustment_model->delete($stock_adjmt_id);
	}   
    
}
