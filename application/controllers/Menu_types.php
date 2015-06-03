<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class menu_types extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('menu_types_model'); 
        $this->load->helper(array('url','zsi','include'));
    }
    
	public function index()
	{
  
		$this->load->view('menu_types_list');
	}
    
    
    
    public function getjson(){    
        $chkStart = "<input type=''checkbox'' onclick=''zsi.table.setCheckBox(this,";
        $chkEnd = ");'' />";    
        $hid = "<input name=''p_sel'' type=''hidden'' />";
        
        $query = $this->db->query("SELECT concat('$chkStart', s.snippet_id,'$chkEnd','$hid') AS a,s.* FROM menu_types as s");
        $result=toDHTMLXData($query);
        jsonOut($result);  

    }
    
    
    public function update()
	{
        $this->menu_types_model->update($this->input->post());
        redirect( base_url("menu_types") );
      
	}    
   

    public function delete()
	{
        
        $this->menu_types_model->delete($this->input->post());
	}   
    
}
