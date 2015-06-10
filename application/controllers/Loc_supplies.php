<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class loc_supplies extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('loc_supplies_model'); 
        $this->load->helper(array('url','zsi','include'));
    }
    	 
    public function getdata_json($id){    
        jsonOut($this->loc_supplies_model->getdata_ad($id)->result());        
    }
    
    
    public function update(){
        $this->loc_supplies_model->update($this->input->post());    
    }

}
