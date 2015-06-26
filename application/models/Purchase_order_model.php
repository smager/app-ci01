<?php
class purchase_order_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM po");
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
                ,'uiKeys'=> array('supply_id','po_qty','po_qty')
                ,'dbKeys'=> array('supply_id','po_qty','bal_qty')
                ,'mustNotEmptyKeys'=> array('po_qty')
                ,'table'=>'po_dtls'
            )
        );       
        $this->common_model->update($post,$params);      
    }        
    
    function delete($post){        
        $this->common_model->delete($this->input->post(),"po","po_id");        
    }    

}
?>