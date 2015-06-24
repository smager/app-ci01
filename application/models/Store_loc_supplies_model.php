<?php
class store_loc_supplies_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata($sid){
        $query = $this->db->query("SELECT * FROM store_loc_supplies_v where store_loc_id=".$sid);
        return $query;    
    }
    function getdata_ad($sid){
        $query = $this->db->query(
              "SELECT * FROM store_loc_supplies_v where store_loc_id=" . $sid 
            . " UNION SELECT * FROM store_supplies2_v a "
            . " WHERE NOT EXISTS(SELECT b.supply_brand_id FROM store_loc_supplies_v b WHERE b.store_loc_id=" . $sid
            . " AND b.supply_brand_id = a.supply_brand_id)" 
            . " AND a.store_id = (SELECT store_id FROM store_loc WHERE store_loc_id=" . $sid . ")"
        );
        return $query;    
    }    
    
    function update($post){ //zsi.form.displayLOV
       $params=array(
             'pk'=> 'store_loc_supply_id'
            ,'dbKeys'=> array('store_loc_id','supply_brand_id','stock_daily_qty')
            //,'mustNotEmptyKeys'=> array('stock_daily_qty')
            ,'table'=>'store_loc_supplies'
        );
        $this->common_model->update($post,$params); 
    }
}
?>