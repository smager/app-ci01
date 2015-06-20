<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bank_ref extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('bank_ref_model'); 
    }
    
	public function index()
	{
        check_login();
		$this->load->view('bank_ref_list');
	}
    
    
    
    public function getjson(){    
        $chkStart = "<input type=''checkbox'' onclick=''zsi.table.setCheckBox(this,";
        $chkEnd = ");'' />";    
        $hid = "<input name=''p_sel'' type=''hidden'' />";
        
        $query = $this->db->query("SELECT concat('$chkStart', s.snippet_id,'$chkEnd','$hid') AS a,s.* FROM bank_ref as s");
        $result=toDHTMLXData($query);
        jsonOut($result);  
    }
    
    
    public function update()
	{
        $this->bank_ref_model->update($this->input->post());
        redirect( base_url("bank_ref") );
      
	}    
   

    public function delete()
	{
        
        $this->bank_ref_model->delete($this->input->post());
	}   
    
}
