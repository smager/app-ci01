<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class store_loc extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('store_loc_model'); 
    }
    
	public function index()
	{
        check_login();
		$this->load->view('default_hb_view');
	}
    
	public function getdata()
	{
        check_login();
		jsonOut($this->store_loc_model->getdata()->result());
	}
    
    
    public function getjson(){    
        $chkStart = "<input type=''checkbox'' onclick=''zsi.table.setCheckBox(this,";
        $chkEnd = ");'' />";    
        $hid = "<input name=''p_sel'' type=''hidden'' />";
        
        $query = $this->db->query("SELECT concat('$chkStart', s.snippet_id,'$chkEnd','$hid') AS a,s.* FROM store_loc as s");
        $result=toDHTMLXData($query);
        jsonOut($result);  
 
    }
    
    
    public function update()
	{
        $this->store_loc_model->update($this->input->post());
        redirect( base_url("store_loc") );
      
	}    
   

    public function delete()
	{
        
        $this->store_loc_model->delete($this->input->post());
	}   
    
}
