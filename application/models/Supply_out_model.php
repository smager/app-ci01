<?php
class supply_out_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata_detail($get){
        $store_loc_id=$get["p_store_loc_id"];
        $date=$get["p_date"];        
        $query = $this->db->query("call getStoreLocSupplyDaily($store_loc_id,'$date')");
        return $query;    
    }

    function delete($post){        
        $this->common_model->delete($this->input->post(),"store_loc_supply_daily","store_loc_supply_daily_id");        
    }    
    
    
    function update($post){        
        $params=array(            
            'pk'=> 'store_loc_supply_daily_id'
            ,'dbKeys'=> array('out_qty','end_qty')
            ,'mustNotEmptyKeys'=> array('out_qty')
            ,'table'=>'store_loc_supply_daily'
        );       
        $is_id = $this->common_model->update($post,$params);      
        
        $store_loc_id=$post["p_store_loc_id"];
        $date=$post["p_date"];                    
        $this->db->query("call setStoreLocSuppDailyRemQty($store_loc_id,'$date')");        
    } 

}
?>