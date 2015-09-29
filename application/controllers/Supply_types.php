<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class supply_types extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('supply_types_model'); 
    }
    
	public function index()
	{
        check_login();
		$this->load->view('default_view');
	}
    
	public function getdata()
	{
        check_login();
		jsonOut($this->supply_types_model->getdata()->result());
	}
        

    public function getjson(){    
        $chkStart = "<input type=''checkbox'' onclick=''zsi.table.setCheckBox(this,";
        $chkEnd = ");'' />";    
        $hid = "<input name=''p_sel'' type=''hidden'' />";
        
        $query = $this->db->query("SELECT concat('$chkStart', s.snippet_id,'$chkEnd','$hid') AS a,s.* FROM supply_types as s");
        $result=toDHTMLXData($query);
        jsonOut($result);  

    }
    
    
    public function update()
	{
        $this->supply_types_model->update($this->input->post());
         redirect( base_url("supply_types") );
      
	}    
   

    public function delete()
	{
        
        $this->supply_types_model->delete($this->input->post());
	}   
    
}
