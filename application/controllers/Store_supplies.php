<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class store_supplies extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('store_supplies_model'); 
    }
        
    public function getdata_json($id){
    
        jsonOut($this->store_supplies_model->getdata_ad($id)->result());
        
    }
    public function get_store_supplies(){
    
        jsonOut($this->store_supplies_model->getStoreSuppliesData()->result());
        
    }
    
    
    public function update(){
        $this->store_supplies_model->update($this->input->post());    
    }

}
