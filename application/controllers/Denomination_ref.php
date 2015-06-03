<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class denomination_ref extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('denomination_ref_model'); 
        $this->load->helper(array('url','zsi','include'));
    }
    
	public function index()
	{
  
		$this->load->view('denomination_ref_list');
	}
    
    
    
    public function getjson(){    
        $chkStart = "<input type=''checkbox'' onclick=''zsi.table.setCheckBox(this,";
        $chkEnd = ");'' />";    
        $hid = "<input name=''p_sel'' type=''hidden'' />";
        
        $query = $this->db->query("SELECT concat('$chkStart', s.snippet_id,'$chkEnd','$hid') AS a,s.* FROM denomination_ref as s");
        $result=toDHTMLXData($query);
        jsonOut($result);

        exit;    
    }
    
    
    public function update()
	{
        $this->denomination_ref_model->update($this->input->post());
        redirect( base_url("denomination_ref") );
      
	}    
   

    public function delete()
	{
        
        $this->denomination_ref_model->delete($this->input->post());
	}   
    
}
