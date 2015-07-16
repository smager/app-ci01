<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class loc_supplies extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('loc_supplies_model'); 
    }
    
    public function getdata_json($id){    
        jsonOut($this->loc_supplies_model->getdata_ad($id)->result());        
    }

    public function get_loc_supply_brands($loc_supply_id){    
        jsonOut($this->loc_supplies_model->get_loc_supply_brands($loc_supply_id)->result());        
    }
    
    
    public function supply_brands(){    
        jsonOut($this->loc_supplies_model->getSupplyBrands()->result());        
    }
        
    
    public function update(){
        $this->loc_supplies_model->update($this->input->post());    
    }

}
