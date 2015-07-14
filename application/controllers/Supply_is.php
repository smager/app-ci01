<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class supply_is extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('supply_is_model'); 
        $this->load->model('store_supplies_model'); 
    }
    
	public function index()
	{
        check_login();
		$this->load->view('supply_is_list');
	}
    
	public function usage()
	{
        check_login();
		$this->load->view('supply_usage_list');
	}    

 
    public function get_detail_json($id)
	{
        jsonOut($this->supply_is_model->getdata_detail($id)->result());
      
	} 
    
    public function get_is_detail($store_loc_id,$loc_supply_id)
	{
        jsonOut($this->supply_is_model->get_is_detail($store_loc_id,$loc_supply_id)->result());
      
	}           
      
    

    public function get_is_info($id)
	{
        jsonOut($this->supply_is_model->getIsInfo($id));
      
	}  
    
    
    public function update()
	{
        $this->supply_is_model->update($this->input->post());
        redirect( base_url($this->router->fetch_class()) );
	}    
}
