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
        $mt=$this->menu_types_model->getdata_idname()->result();
        $m=$this->menu_model->getSubMenuItems()->result();

        foreach($mt as $i){            
            $item= array();
             foreach($m as $subM){  
                 if($i->id==$subM->menu_type_id){
                     array_push($item,$subM);
                 }
             }
            $i->subMenus = $item;
            
        }        
        jsonOut($mt);        
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
