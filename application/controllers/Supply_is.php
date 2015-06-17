<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class supply_is extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('supply_is_model'); 
        $this->load->model('store_supplies_model'); 
        $this->load->helper(array('url','zsi','include'));
    }
    
	public function index()
	{
        check_login();
		$this->load->view('supply_is_list');
	}

    public function get_json()
	{  
        $store_loc_id = $this->input->get("store_loc_id");
        $is_no = $this->input->get("is_no");
        $is_date = $this->input->get("is_date");
        jsonOut($this->supply_is_model->getdata($store_loc_id,$is_no,$is_date)->result());
      
	}   
    
    public function get_detail_json($supply_is_id)
	{
        jsonOut($this->supply_is_model->getdata_detail($supply_is_id)->result());
      
	}       
      
    
    public function update()
	{
        $this->supply_is_model->update($this->input->post());
	}    
}
