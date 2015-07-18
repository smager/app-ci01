<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class store_daily_expenses extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('store_daily_expenses_model'); 
        $this->load->model('store_supplies_model'); 
    }
    
	public function index()
	{
        check_login();
		$this->load->view('store_daily_expenses_list');
	}
    
    public function getinfo()
	{
        $store_loc_id = $this->input->get("p_store_loc_id");
        $exp_date = $this->input->get("p_exp_date");
        jsonOut($this->store_daily_expenses_model->getinfo($store_loc_id,$exp_date));
      
	}  
    
	public function usage()
	{
        check_login();
		$this->load->view('supply_usage_list');
	}    

    public function getdetail($store_loc_exp_id)
	{
        jsonOut($this->store_daily_expenses_model->getdata_detail($store_loc_exp_id)->result());
      
	}     
    
    public function update()
	{
        $this->store_daily_expenses_model->update($this->input->post());
        redirect( base_url($this->router->fetch_class()) );
	}
    
    
    public function delete_dtls()
	{        
        $this->store_daily_expenses_model->delete_dtls($this->input->post());
	}   
    
    
}
