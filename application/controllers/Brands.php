<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class brands extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('brands_model'); 
        $this->load->helper(array('url','zsi','include'));
    }
    
	public function index()
	{
        check_login();
		$this->load->view('brands_list');
	}
    
    
    
    public function getjson(){    
        $chkStart = "<input type=''checkbox'' onclick=''zsi.table.setCheckBox(this,";
        $chkEnd = ");'' />";    
        $hid = "<input name=''p_sel'' type=''hidden'' />";
        
        $query = $this->db->query("SELECT concat('$chkStart', s.snippet_id,'$chkEnd','$hid') AS a,s.* FROM brands as s");
        $result=toDHTMLXData($query);
        jsonOut($result);  
    }
    
    
    public function update()
	{
        $this->brands_model->update($this->input->post());
        redirect( base_url("brands") );
      
	}    
   

    public function delete()
	{
        
        $this->brands_model->delete($this->input->post());
	}   
    
}
