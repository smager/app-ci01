<?php
class supply_is_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    //issuance
    function getdata_detail($store_loc_id){
        $query = $this->db->query("call getStoreLocSupplies($store_loc_id)");
        return $query;    
    }

     //usage   
    function getdata_usage($supply_is_id){
        $query = $this->db->query("SELECT * FROM is_dtls_v where supply_is_id=$supply_is_id");
        return $query;    
    }
    
    //issuance : sub-detail
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
    
 
    function getIsUsageInfo($id){
        $result = array();
        $query = $this->db->query("SELECT * FROM supply_is where supply_is_id=$id");        
        if($query->num_rows()>0) $result =  $query->result()[0];                
        return $result;    
    }        
    
    //inq:
    function getSupplyISdetails($store_loc_id,$isDate){
        $query = $this->db->query("SELECT * FROM supply_is_dtls_v where store_loc_id=$store_loc_id and date_format(is_date,'%m/%d/%Y')='$isDate'");
        return $query;    
    }    
    
        
    //update for issuance
    function update($post){        
        $params=array(            
            'parent' => array(
                 'pk'=> 'supply_is_id'
                ,'dbKeys'=> array('store_loc_id','is_no','is_date',"posted")
                ,'table'=>'supply_is'
            )           
            ,'details' => array(
                'pk'=> 'supply_is_dtl_id'
                ,'dbKeys'=> array('loc_supply_brand_id','supply_is_qty')
                ,'mustNotEmptyKeys'=> array('loc_supply_brand_id')
                ,'table'=>'supply_is_dtls'
            )
        );       
        $is_id = $this->common_model->update($post,$params);                        
        // posted=true;
        $store_loc_id=$post['p_store_loc_id'];
        if($post["p_posted_is"]==true) {
             $this->db->query("call setLocStockIsPost($is_id)");
             $this->db->query("call setStoreStockIsPost($is_id,$store_loc_id)");
        }
    } 
    
    
        
  //update for usage
  function usage_update($post){
        $params=array(            
            'parent' => array(
                 'pk'=> 'supply_is_id'
                ,'dbKeys'=> array('posted_used')
                ,'table'=>'supply_is'
            )           
            ,'details' => array(
                'pk'=> 'supply_is_dtl_id'
                ,'dbKeys'=> array('used_qty','returned_qty')
                //,'mustNotEmptyKeys'=> array('used_qty')
                ,'table'=>'supply_is_dtls'
            )
        );       
        $is_id = $this->common_model->update($post,$params);          
        // posted=true;
        $supply_is_id=$post['p_supply_is_id'];
      
        if($post["p_posted_used"]==true) $this->db->query("call setLocStockIsUsagePost($supply_is_id)");

    }        
            
    function delete($post){        
        $this->common_model->delete($this->input->post(),"supply_is","supply_is_id");        
    }    

}
?>