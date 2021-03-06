<?php
class purchase_order_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM po_unposted_v");
        return $query;    
    }

    function getdata_dtls($id,$withbal='n'){
        $where = "where po_id=$id";
        if(strtolower($withbal)=='y') $where = $where . " and bal_qty>0";
        
        $query = $this->db->query("SELECT * FROM po_dtls_v $where");
        return $query;    
    }


    function getPOWithBal($id=''){
        $where='';
        if($id!='') $where = "where po_id=$id"; 
        
        $query = $this->db->query("SELECT * FROM powithbal_v $where");
        return $query;    
    }
        
        
    
    function update($post){
        $params=array(            
            'parent' => array(
                 'pk'=> 'po_id'
                ,'dbKeys'=> array('po_no','po_date','loc_id','supplier_id','posted')
                ,'table'=>'po'
            )           
            ,'details' => array(
                'pk'=> 'po_dtl_id'
                ,'uiKeys'=> array('loc_supply_id','po_qty','po_qty')
                ,'dbKeys'=> array('loc_supply_id','po_qty','bal_qty')
                ,'mustNotEmptyKeys'=> array('po_qty')
                ,'table'=>'po_dtls'
            )
        );       
        
        $po_id = $this->common_model->update($post,$params);                     
        if($post["p_posted"]==true){        
            $this->db->query("call setLocSupplyOrderedQty($po_id)");
        }
        
        return $po_id;     
    }        
    
    
    function delete($id){                
        //delete header:
        $this->db->where("po_id", $id);
        $this->db->delete("po_dtls");    
        //delete details:
        $this->db->where("po_id", $id);
        $this->db->delete("po");
        
    }
    
    function delete_dtls($post){        
        $this->common_model->delete($this->input->post(),"po_dtls","po_dtl_id");        
    }        
    

}
?>