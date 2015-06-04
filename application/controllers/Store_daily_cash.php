<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class store_daily_cash extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('store_daily_cash_model'); 
        $this->load->model('denomination_ref_model'); 
        $this->load->helper(array('url','zsi','include'));
    }
    
	public function index()
	{
  
		$this->load->view('store_daily_cash_list');
	}

    public function get_json()
	{  
        $store_loc_id = $this->input->get("store_loc_id");
        $tran_date = $this->input->get("tran_date");
        jsonOut($this->store_daily_cash_model->getdata($store_loc_id,$tran_date)->result());
      
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
        redirect( base_url("store_daily_cash") );
	}    
}
