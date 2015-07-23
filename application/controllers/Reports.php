<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class reports extends Base_Controller {
    function __construct() {
        parent::__construct();       
    }
        
 
	public function daily_store_stocks()
	{
        check_login();
		$this->load->view('default_view');
	}    
    
	public function daily_store_cashbox()
	{
        check_login();
		$this->load->view('default_view');
	}        

    public function getSupplyISdetails(){
        $this->load->model('supply_is_model'); 
        $store_loc_id = $this->input->get("p_store_loc_id");
        $isDate=  $this->input->get("p_is_date");
        jsonOut($this->supply_is_model->getSupplyISdetails($store_loc_id,$isDate)->result());        
    }
    
    public function get_dailycash_inq(){
        $this->load->model('store_daily_cash_model');         
        $store_loc_id = $this->input->get("p_store_loc_id");
        $isDate=  $this->input->get("p_is_date");
        jsonOut($this->store_daily_cash_model->getDailyCashInq($store_loc_id,$isDate)->result());        
    }

    public function get_store_loc_exp_inq(){
        $this->load->model('store_daily_expenses_model');         
        $store_loc_id = $this->input->get("p_store_loc_id");
        $isDate=  $this->input->get("p_is_date");
        jsonOut($this->store_daily_expenses_model->storeLocExpInq($store_loc_id,$isDate)->result());        
    }
    
    
}
