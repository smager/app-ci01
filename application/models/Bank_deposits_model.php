<?php

class bank_deposits_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }

    function getStoreBanksDepoInfo($store_loc_id,$date){
        $str = "call getStoreBankDepoInfo($store_loc_id,'$date')";
        $query = $this->db->query($str);        
        return $query;    
    }
    
    function getStoreBanksDepo($storeBankDepoId,$dpAmount){
        
        $str = "call getStoreBanksDepo($storeBankDepoId,$dpAmount)";
        $query = $this->db->query($str);
        return $query;    
    }


    //issuance

    function getdata_detail($store_loc_id){

        $query = $this->db->query("call getStoreLocSupplies($store_loc_id)");

        return $query;    

    }

    //update for issuance

    function update($post){        
        $params=array(            
            'parent' => array(
                 'pk'=> 'bank_deposits_id'
                ,'dbKeys'=> array('store_loc_id','is_no','depo_date',"posted")
                ,'table'=>'bank_deposits'
            )           
            ,'details' => array(
                'pk'=> 'bank_deposits_dtl_id'
                ,'dbKeys'=> array('loc_supply_brand_id','bank_deposits_qty')
                ,'mustNotEmptyKeys'=> array('loc_supply_brand_id')
                ,'table'=>'bank_deposits_dtls'
            )
        );       
        $is_id = $this->common_model->update($post,$params);                        
        // posted=true;
        $store_loc_id=$post['p_store_loc_id'];
        $is_date=$post['p_is_date'];
        if($post["p_posted"]==true) {
             $this->db->query("call setLocStockIsPost($is_id)");
             $this->db->query("call setStoreStockIsPost($is_id,$store_loc_id,'$is_date')");
        }
    } 
}

?>