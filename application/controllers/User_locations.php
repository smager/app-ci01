<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_locations extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('user_locations_model'); 
    }
    	 
    public function getdata_json($id){    
        jsonOut($this->user_locations_model->getdata_ad($id)->result());        
    }
    
    
    public function update(){
        $this->user_locations_model->update($this->input->post());    
    }

}
