<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class stores extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model(array('stores_model','store_supplies_model')); 
    }
    
	public function index()
	{
        check_login();
		$this->load->view('default_hb_view');
	}
    

	public function getdata()
	{
        check_login();
		jsonOut($this->stores_model->getdata()->result());
	}
    
        
    
    public function getjson(){    
        $chkStart = "<input type=''checkbox'' onclick=''zsi.table.setCheckBox(this,";
        $chkEnd = ");'' />";    
        $hid = "<input name=''p_sel'' type=''hidden'' />";
        
        $query = $this->db->query("SELECT concat('$chkStart', s.snippet_id,'$chkEnd','$hid') AS a,s.* FROM stores as s");
        $result=toDHTMLXData($query);
        jsonOut($result);  

    }
    
    
    public function update()
	{
        $this->stores_model->update($this->input->post());
        redirect( base_url("stores") );
      
	}    
   

    public function delete()
	{
        
        $this->stores_model->delete($this->input->post());
	}   
    
}
