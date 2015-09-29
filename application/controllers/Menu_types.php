<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class menu_types extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('menu_types_model'); 
    }
    
	public function index()
	{
        check_login();
		$this->load->view('default_view');
	}
	
	public function getdata()
	{
        check_login();
		jsonOut($this->menu_types_model->getdata()->result());
	}
        
    public function getdata_json(){
        $this->load->model('menu_model'); 
        $q=$this->menu_types_model->getdata_idname();
        $d=$q->result();
        foreach($d as $i){            
             $q_mi=$this->menu_model->getSubMenuItem($i->id);            
             $i->subMenus=$q_mi->result();
        }        
        jsonOut($d);        
    }        
    
    
    public function update()
	{
        $this->menu_types_model->update($this->input->post());
        redirect( base_url("menu_types") );
      
	}    
   

    public function delete()
	{
        
        $this->menu_types_model->delete($this->input->post());
	}   
    
}
