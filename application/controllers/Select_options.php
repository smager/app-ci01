<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class select_options extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('select_options_model'); 
    }
    
	public function index()
	{
        check_login();       
            $this->load->view('select_options_list');        
	}
    
	public function procedure()
	{   
	    $segments = $this->uri->segments;
	    $sLength  =  sizeof($segments);
	    $params ="";
	    if($sLength>3){
	         
            for ($x = 4; $x <= $sLength; $x++) {
                if($params!=="") $params .=",";
                $params .= $segments[$x];
            } 
	        
	    }
	    
        check_login();
        $query =$this->db->query("call ".$segments[3]."($params)");
        jsonOut( $query->result());
	}    
        
	public function code($code)
	{
        check_login();
        $query = $this->select_options_model->getdata_by_code($code, $this->input->get("p"));
        if($query==null)
            jsonOut( array());
        else 
            jsonOut( $query->result());
	}    
    
    
    public function getdata_json(){
    
        jsonOut($this->select_options_model->getdata()->result());
        
    }    
    
        
    public function update()
	{
        $this->select_options_model->update($this->input->post());
        redirect( base_url("select_options") );
      
	}    
   
    public function delete()
	{
        
        $this->select_options_model->delete($this->input->post());
	}   
    
}
