<?php
class supply_is_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    
    function getdata_detail($store_loc_id){
        //getSupply_IS_Unposted <-removed
        $query = $this->db->query("call getStoreLocSupplies($store_loc_id)");
        return $query;    
    }
    
    
    function get_is_detail($store_loc_id,$loc_supply_id){
        $query = $this->db->query("call getSupplyIsUnposted($store_loc_id,$loc_supply_id)");
        return $query;    
    }  
    
    
    function getIsInfo($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM supply_is_unposted_v where store_loc_id=$id");        
        if($query->num_rows()>0) $result =  $query->result()[0];                
        return $result;    
    }
        
    //update for issuance
    function update($post){
    
        if( isset($post["p_posted_is"]) )
            $posted_name ="posted_is";
        else
            $posted_name ="posted_used";
            
        $params=array(            
            'parent' => array(
                 'pk'=> 'supply_is_id'
                ,'dbKeys'=> array('store_loc_id','is_no','is_date',$posted_name)
                ,'table'=>'supply_is'
            )           
            ,'details' => array(
                'pk'=> 'supply_is_dtl_id'
                ,'dbKeys'=> array('prev_qty','beg_qty','loc_supply_brand_id','supply_is_qty')
                ,'mustNotEmptyKeys'=> array('loc_supply_brand_id')
                ,'table'=>'supply_is_dtls'
            )
        );       
        $is_id = $this->common_model->update($post,$params);          
        // posted=true;
        $store_loc_id=$post['p_store_loc_id'];
        if( isset($post["p_posted_is"]) ){
            if($post["p_posted_is"]==true) {
                 $this->db->query("call setLocStockIsPost($is_id)");
                 $this->db->query("call setStoreStockIsPost($is_id,$store_loc_id)");
            }
        }
        
        if( isset($post["p_posted_used"]) ){
             if($post["p_posted_used"]==true) $this->db->query("call setLocStockIsPostt($is_id)");
        }
             
        
    }        
        
  //update for usage
  function usage_update($post){
    
        if( isset($post["p_posted_is"]) )
            $posted_name ="posted_is";
        else
            $posted_name ="posted_used";
            
        $params=array(            
            'parent' => array(
                 'pk'=> 'supply_is_id'
                ,'dbKeys'=> array('store_loc_id','is_no','is_date',$posted_name)
                ,'table'=>'supply_is'
            )           
            ,'details' => array(
                'pk'=> 'supply_is_dtl_id'
                ,'dbKeys'=> array('beg_qty','loc_supply_brand_id','supply_is_qty')
                ,'mustNotEmptyKeys'=> array('loc_supply_brand_id')
                ,'table'=>'supply_is_dtls'
            )
        );       
        $is_id = $this->common_model->update($post,$params);          
        // posted=true;
        $store_loc_id=$post['p_store_loc_id'];
        if( isset($post["p_posted_is"]) ){
            if($post["p_posted_is"]==true) {
                 $this->db->query("call setLocStockIsPost($is_id)");
                 $this->db->query("call setStoreStockIsPost($is_id,$store_loc_id)");
            }
        }
        
        if( isset($post["p_posted_used"]) ){
             if($post["p_posted_used"]==true) $this->db->query("call setLocStockIsPostt($is_id)");
        }
             
        
    }        
            
    
    function delete($post){        
        $this->common_model->delete($this->input->post(),"supply_is","supply_is_id");        
    }    

}
?>