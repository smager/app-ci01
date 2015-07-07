<?php
class supply_brands_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata($sid){
        $query = $this->db->query("SELECT * FROM supply_brands_v where supply_id=".$sid);
        return $query;    
    }
    
    function getDataSupplyBrands(){
        $query = $this->db->query("SELECT * FROM supply_brands_v ");
        return $query;    
    }
    
    function getDataSupplyBrandsPODtl(){
        $query = $this->db->query("SELECT * FROM supply_brands_po_dtls_v");
        return $query;    
    }    
    
    function getdata_ad($sid){
        $query = $this->db->query(
            
             "SELECT * FROM supply_brands_v where supply_id=" . $sid
            ." UNION SELECT * FROM supply_brands2_v a" 
            ." WHERE NOT EXISTS(SELECT b.brand_id FROM supply_brands_v b WHERE b.supply_id=" . $sid 
            ." AND b.brand_id = a.brand_id)" 
        );       
        return $query;    
    }    
    
    
    function update($post){ //zsi.form.displayLOV
         $params=array(
             'pk'=> 'supply_brand_id'
            ,'dbKeys'=> array('supply_id','brand_id','conv_id','supply_cost')
            ,'table'=>'supply_brands'
        );
        $supply_brand_id=$this->common_model->update($post,$params); 
        $supply_id=$post()['supply_id'];
        $this->db->query("call LocSupplyBrandsIns2($supply_brand_id,$supply_id");
    } 
    

    
    function delete($post){        
        $this->common_model->delete($this->input->post(),"supply_brands","supply_brand_id");        
    }    

}
?>