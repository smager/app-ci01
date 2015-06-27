<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class supply_brands extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('supply_brands_model'); 
    }
    	 
    public function getdata_json($id){    
        jsonOut($this->supply_brands_model->getdata_ad($id)->result());        
    }
    
    public function getdata_supply_brands_json(){    
        jsonOut($this->supply_brands_model->getDataSupplyBrands()->result());        
    }

    
    public function getsupply_brands_podtls_json(){    
        jsonOut($this->supply_brands_model->getDataSupplyBrandsPODtl()->result());        
    }
    
    
    public function update(){
        $this->supply_brands_model->update($this->input->post());    
    }

}
