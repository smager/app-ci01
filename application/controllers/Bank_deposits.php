<?php defined('BASEPATH') OR exit('No direct script access allowed');

class bank_deposits extends Base_Controller {    
        function __construct() {        
            parent::__construct();        
            $this->load->model('bank_deposits_model');     
            
        }    	
        
        public function index()	{        
            check_login();        
            $this->load->view('default_view');	
            
        }	    
        
        public function get_store_daily_cash_depo_amount()	
        {   
            $store_loc_id = $this->input->get("p_store_loc_id");        
            $tran_date = $this->input->get("p_tran_date");        
            jsonOut($this->bank_deposits_model->getStoreDailyCashDepoAmt($store_loc_id,$tran_date)->result());	
            
        } 	    
        
        public function get_store_banks_depo()	{        
            $store_loc_id = $this->input->get("p_store_loc_id");        
            $tran_date = $this->input->get("p_tran_date");        
            jsonOut($this->bank_deposits_model->getStoreBanksDepo($store_loc_id,$tran_date)->result());
        } 	        
        
        public function update()	{        
            $this->bank_deposits_model->update($this->input->post());        
            redirect( base_url($this->router->fetch_class()) );	
        }    
    
}