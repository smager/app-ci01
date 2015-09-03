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
                 'pk'=> 'store_bank_depo_id'
                ,'dbKeys'=> array('act_depo_date',"posted")
                //,'mustNotEmptyKeys'=> array('store_bank_depo_id')
                ,'table'=>'store_bank_depo'
        );       
        $is_id = $this->common_model->update($post,$params);                        
    
    } 
}

?>