<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class conv_units extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('conv_units_model'); 
        $this->load->helper(array('url','zsi','include'));
    }
    
	public function index()
	{
  
		$this->load->view('conv_units_list');
	}
    
    
    
    public function getjson(){    
        $chkStart = "<input type=''checkbox'' onclick=''zsi.table.setCheckBox(this,";
        $chkEnd = ");'' />";    
        $hid = "<input name=''p_sel'' type=''hidden'' />";
        
        $query = $this->db->query("SELECT concat('$chkStart', s.snippet_id,'$chkEnd','$hid') AS a,s.* FROM conv_units as s");
        $result=toDHTMLXData($query);
        
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ->_display();

        exit;    
    }
    
    
    public function update()
	{
        $this->conv_units_model->update($this->input->post());
        redirect( base_url("conv_units") );
      
	}    
   

    public function delete()
	{
        
        $this->conv_units_model->delete($this->input->post());
	}   
    
}
