<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class locations extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('locations_model'); 
    }
    
	public function index()
	{
        check_login();
		//$this->load->view('locations_list');
		$this->load->view('default_hb_view');
	}
	
	
	public function getdata()
	{
        check_login();
        jsonOut($this->locations_model->getdata()->result());

	}
    
    
    
    public function getjson(){    
        $chkStart = "<input type=''checkbox'' onclick=''zsi.table.setCheckBox(this,";
        $chkEnd = ");'' />";    
        $hid = "<input name=''p_sel'' type=''hidden'' />";
        
        $query = $this->db->query("SELECT concat('$chkStart', s.snippet_id,'$chkEnd','$hid') AS a,s.* FROM locations as s");
        $result=toDHTMLXData($query);
        jsonOut($result);  

    }
    
    
    public function update()
	{
        $this->locations_model->update($this->input->post());
        redirect( base_url("locations") );
      
	}    
   

    public function delete()
	{
        
        $this->locations_model->delete($this->input->post());
	}   
    
}
