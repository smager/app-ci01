<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class positions extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('positions_model'); 
        $this->load->helper(array('url','zsi','include'));
    }
    
	public function index()
	{
  
		$this->load->view('positions_list');
	}
    
    
    
    public function getjson(){    
        $chkStart = "<input type=''checkbox'' onclick=''zsi.table.setCheckBox(this,";
        $chkEnd = ");'' />";    
        $hid = "<input name=''p_sel'' type=''hidden'' />";
        
        $query = $this->db->query("SELECT concat('$chkStart', s.snippet_id,'$chkEnd','$hid') AS a,s.* FROM positions as s");
        $result=toDHTMLXData($query);
        jsonOut($result);  

    }
    
    
    public function update()
	{
        $this->positions_model->update($this->input->post());
        redirect( base_url("positions") );
      
	}    
   

    public function delete()
	{
        
        $this->positions_model->delete($this->input->post());
	}   
    
}
