<?php
class store_loc_supplies_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata($sid){
        $query = $this->db->query("SELECT * FROM store_loc_suppliesr_ref_v where store_loc_id=".$sid);
        return $query;    
    }
    function getdata_ad($sid){
        $query = $this->db->query(
              "SELECT * FROM store_loc_supplies_ref_v where store_loc_id=" . $sid 
            . " UNION SELECT * FROM store_loc_supplies_ref2_v a "
            . " WHERE NOT EXISTS(SELECT b.supply_id FROM store_loc_supplies_ref_v b WHERE b.store_loc_id=" . $sid
            . " AND b.supply_id = a.supply_id)" 
            . " AND a.store_id = (SELECT store_id FROM store_loc WHERE store_loc_id=" . $sid . ")"
        );
        return $query;    
    }    
    
    function update($post){ //zsi.form.displayLOV
 
        $params=array(            
            'parent' => array(
                 'pk'=> 'store_loc_id'
            )           
            ,'details' => array(
                'pk'=> 'store_loc_supply_id'
                ,'dbKeys'=> array('supply_id','stock_daily_qty')
                ,'table'=>'store_loc_supplies'
            )
        );       
        
        $this->common_model->update($post,$params); 
    }
}
?>