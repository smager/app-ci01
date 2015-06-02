<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class users extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('users_model'); 
        $this->load->helper(array('url','zsi','include'));
    }
    
	public function index()
	{
  
		$this->load->view('users_list');
	}
    
    
    
    public function getjson(){    
        $chkStart = "<input type=''checkbox'' onclick=''zsi.table.setCheckBox(this,";
        $chkEnd = ");'' />";    
        $hid = "<input name=''p_sel'' type=''hidden'' />";
        
        $query = $this->db->query("SELECT concat('$chkStart', s.user_id,'$chkEnd','$hid') AS a,s.* FROM users as s");
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
        $this->users_model->update($this->input->post());
        redirect( base_url("users") );
      
	}    
   

    public function delete()
	{
        
        $this->users_model->delete($this->input->post());
	}   
    
}
