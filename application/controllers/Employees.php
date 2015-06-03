<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class employees extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('employees_model'); 
        $this->load->helper(array('url','zsi','include'));
    }
    
	public function index()
	{
  
		$this->load->view('employees_list');
	}
    
    
    
    public function getjson(){    
        $chkStart = "<input type=''checkbox'' onclick=''zsi.table.setCheckBox(this,";
        $chkEnd = ");'' />";    
        $hid = "<input name=''p_sel'' type=''hidden'' />";
        
        $query = $this->db->query("SELECT concat('$chkStart', s.empl_id,'$chkEnd','$hid') AS a,s.* FROM employees as s");
        $result=toDHTMLXData($query);
        jsonOut($result);  
    }
    
    
    public function update()
	{
        $this->employees_model->update($this->input->post());
        redirect( base_url("employees") );
      
	}    
   

    public function delete()
	{
        
        $this->employees_model->delete($this->input->post());
	}   
    
}
