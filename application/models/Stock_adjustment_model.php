<?php
class stock_adjustment_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getNewData($loc_id,$store_loc_id,$stock_adjmt_id){
        $query = $this->db->query("call getLocPC($loc_id,$store_loc_id,$stock_adjmt_id);");
        return $query;    
    }


     function getUnpostedData(){
        $query = $this->db->query("select * from stock_adjustments where posted=0");
        return $query;    
    }
   

    function update($post){
        $params=array(           
             'pk'=> 'stock_adjmt_id'
            ,'dbKeys'=> array('stock_adjmt_no','adjmt_date','loc_id','store_loc_id','loc_supply_brand_id','store_loc_supply_daily_id','adjmt_qty','posted')
            ,'table'=>'stock_adjustments'
            ,'allowNull'=>true
        );       
        
        $stock_adjmt_id = $this->common_model->update($post,$params);

        // posted=true;
        if($post["p_posted"]==true){        
            $store_loc_id =0;
            if(isset($post["p_store_loc_id"] )) $store_loc_id = $post["p_store_loc_id"];    
            $adjmt_date=$post["p_adjmt_date"];
            $sql = "call setStockAdjustmentPosted($stock_adjmt_id,$store_loc_id,'$adjmt_date')";
            $this->db->query($sql);
            
        }
        
    }        
    
    
    function delete($id){                
        $this->db->where("stock_adjmt_id", $id);
        $this->db->delete("stock_adjustments");
    }
}
?>