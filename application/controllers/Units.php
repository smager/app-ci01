<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class units extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('units_model'); 
        $this->load->helper(array('url','zsi','include'));
    }
    
	public function index()
	{
  
		$this->load->view('units_list');
	}
    
    
    
    public function getjson(){    
        $chkStart = "<input type=''checkbox'' onclick=''zsi.table.setCheckBox(this,";
        $chkEnd = ");'' />";    
        $hid = "<input name=''p_sel'' type=''hidden'' />";
        
        $query = $this->db->query("SELECT concat('$chkStart', s.snippet_id,'$chkEnd','$hid') AS a,s.* FROM units as s");
        $result=toDHTMLXData($query);
        jsonOut($result);  

    }
    
    
    public function update()
	{
        $this->units_model->update($this->input->post());
        redirect( base_url("units") );
      
	}    
   

    public function delete()
	{
        
        $this->units_model->delete($this->input->post());
	}   
    
}