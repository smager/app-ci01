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

    
     public function getStoreLocSupplyDaily(){
        $this->load->model('supply_out_model'); 
        jsonOut($this->supply_out_model->getdata_detail($this->input->get())->result());        
    }   
    
    public function get_dailycash_inq(){
        $this->load->model('store_daily_cash_model');         
        $store_loc_id = $this->input->get("p_store_loc_id");
        $isDate=  $this->input->get("p_is_date");
        jsonOut($this->store_daily_cash_model->getDailyCashInq($store_loc_id,$isDate)->result());        
    }

    public function get_store_loc_sales_exp_inq(){
        $this->load->model('store_daily_expenses_model');         
        $store_loc_id = $this->input->get("p_store_loc_id");
        $isDate=  $this->input->get("p_is_date");
        jsonOut($this->store_daily_expenses_model->storeLocSalesExpInq($store_loc_id,$isDate)->result());        
    }
    public function get_store_loc_exp_inq(){
        $this->load->model('store_daily_expenses_model');         
        $store_loc_id = $this->input->get("p_store_loc_id");
        $isDate=  $this->input->get("p_is_date");
        jsonOut($this->store_daily_expenses_model->storeLocExpInq($store_loc_id,$isDate)->result());        
    }
    

    
    
}
