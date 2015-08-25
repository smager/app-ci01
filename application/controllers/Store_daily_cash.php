<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class store_daily_cash extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('store_daily_cash_model'); 
        $this->load->model('denomination_ref_model'); 
    }
    
	public function index()
	{
        check_login();
		$this->load->view('default_view');
        
	}
    
	public function sales()
	{
        check_login();
		$this->load->view('default_view');
	}
    

    public function get_json()
	{  
        $store_loc_id = $this->input->get("store_loc_id");
        $tran_date = $this->input->get("tran_date");
        jsonOut($this->store_daily_cash_model->getdata($store_loc_id,$tran_date)->result());
      
	}  
	
    public function get_storedailycash_by_id($store_daily_cash_id)
	{  
       
        jsonOut($this->store_daily_cash_model->getStoreDailyCashById($store_daily_cash_id)->result());
      
	}   	
    
    public function get_detail_json($store_daily_cash_id)
	{
        jsonOut($this->store_daily_cash_model->getdata_detail($store_daily_cash_id)->result());
      
	}       
    
    
    public function getdhtmlxjson(){    
        $chkStart = "<input type=''checkbox'' onclick=''zsi.table.setCheckBox(this,";
        $chkEnd = ");'' />";    
        $hid = "<input name=''p_sel'' type=''hidden'' />";
        
        $query = $this->db->query("SELECT concat('$chkStart', s.store_daily_cash_id,'$chkEnd','$hid') AS a,s.* FROM store_daily_cash as s");
        $result=toDHTMLXData($query);
        jsonOut($result);  

    }
    
    
    public function update()
	{
        $this->store_daily_cash_model->update($this->input->post());
	}    
}
