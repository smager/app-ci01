<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class brands extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('brands_model'); 
    }
    
	public function index()
	{
        check_login();
		$this->load->view('default_view');
	}
	
	public function getdata()
	{
        check_login();
		jsonOut($this->brands_model->getdata()->result());
		
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
