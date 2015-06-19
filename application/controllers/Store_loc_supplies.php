<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class store_loc_supplies extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('store_loc_supplies_model'); 
        $this->load->helper(array('url','zsi','include'));
    }
        
    public function getdata_json($id){
    
        jsonOut($this->store_loc_supplies_model->getdata_ad($id)->result());
        
    }
    
    
    public function update(){
        $this->store_loc_supplies_model->update($this->input->post());    
    }

}
