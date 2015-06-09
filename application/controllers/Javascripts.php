<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class javascripts extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('javascripts_model'); 
        $this->load->helper(array('url','zsi','include'));
    }
    
	public function index()
	{
  
		$this->load->view('javascripts_list');
	}
    
    function source(){
        $url =$this->input->get("p_url");
        $query= $this->javascripts_model->getdata_by_url(strtolower($url));
        if($query->num_rows() > 0){
            $source =  $query->result()[0]->content;            
            $this->output
            ->set_content_type('application/javascript')
            ->set_output($source);
        }else{
            $source = '//no source yet';
            
            $data = array('page_url' =>  $url, 'content' => $source );
            $this->db->set('created_date', 'NOW()', FALSE);
            $this->db->insert('javascripts', $data);        
            
            $this->output
            ->set_content_type('application/javascript')
            ->set_output($source );   
            
        }
            
    }

    

    public function getdata_json($js_id=null)
	{  
        jsonOut($this->javascripts_model->getdata($js_id)->result());
      
	}   
  
    
    public function update()
	{
        $this->javascripts_model->update($this->input->post());
	}    
    public function delete()
	{
        
        $this->javascripts_model->delete($this->input->post());
	}       
}
