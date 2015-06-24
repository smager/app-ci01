<?php
class receiving_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata_po_with_bal($po_id){
        $query = $this->db->query("SELECT * FROM powithbal_v where po_id=$po_id");
        return $query;        
    }
    
    function getdata($receiving_id){
        $query = $this->db->query("SELECT * FROM receiving where receiving_id=$receiving_id");
        return $query;    
    }
    
    function update($post){
        $params=array(            
            'parent' => array(
                 'pk'=> 'receiving_id'
                ,'dbKeys'=> array('po_id','dr_no','dr_date','loc_id')
                ,'table'=>'receiving'
            )           
            ,'details' => array(
                'pk'=> 'receiving_dtl_id'
                ,'dbKeys'=> array('dr_qty','po_dtl_id')
                ,'table'=>'receiving_dtls'
            )
        );       
        
        $this->common_model->update($post,$params);         

    }
    
    function delete($post){        
        $this->common_model->delete($this->input->post(),"po","po_id");        
    }    

}
?>