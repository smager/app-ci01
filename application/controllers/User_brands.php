<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_brands extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('user_brands_model'); 
        $this->load->helper(array('url','zsi','include'));
    }
    	 
    public function getdata_json($id){    
        jsonOut($this->user_brands_model->getdata_ad($id)->result());        
    }
    
    
    public function update(){
        $this->user_brands_model->update($this->input->post());    
    }

}
