<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class page_templates extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('page_templates_model'); 
    }
    
	public function index()
	{
        check_login();
		$this->load->view('page_templates_list');
	}
    
    
	public function form()
	{
        check_login();
		$this->load->view('page_templates_form');
	}
    
    
    function source(){
        $url =$this->input->get("p_url");
        $query= $this->page_templates_model->getdata_by_url(strtolower($url));
        $result="";
        if($query->num_rows() > 0){
            $result =  $query->result()[0]->content;                     

        }
        return $result;            
    }

    

    public function getdata_json($js_id=null)
	{  
        jsonOut($this->page_templates_model->getdata($js_id)->result());
      
	}   
        
    public function search()
	{  
        jsonOut($this->page_templates_model->search($this->input->get())->result());      
	}   
  
    
    public function update()
	{
        $this->page_templates_model->update($this->input->post());
	}    
    public function delete()
	{
        
        $this->page_templates_model->delete($this->input->post());
	}       
}
