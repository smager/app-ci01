<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class systems extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('systems_model'); 
        $this->load->helper(array('url','zsi','include'));
    }
    
	public function index()
	{
  
		$this->load->view('systems_list');
	}
    
    
    
    public function getjson(){    
        $chkStart = "<input type=''checkbox'' onclick=''zsi.table.setCheckBox(this,";
        $chkEnd = ");'' />";    
        $hid = "<input name=''p_sel'' type=''hidden'' />";
        
        $query = $this->db->query("SELECT concat('$chkStart', s.snippet_id,'$chkEnd','$hid') AS a,s.* FROM systems as s");
        $result=toDHTMLXData($query);
        jsonOut($result);  

    }
    
    
    public function update()
	{
        $this->systems_model->update($this->input->post());
        redirect( base_url("systems") );
      
	}    
   

    public function delete()
	{
        
        $this->systems_model->delete($this->input->post());
	}   
    
}
