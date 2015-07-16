<?php
class stock_transfer_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM stock_transfer");
        return $query;    
    }

    function getdata_dtls($id){        
        $query = $this->db->query("SELECT * FROM stock_transfer_dtls where st_id=$id");
        return $query;    
    }
        
    
    function update($post){
        $params=array(            
            'parent' => array(
                 'pk'=> 'st_id'
                ,'dbKeys'=> array('st_no','st_date','loc_id','loc_id_to','posted')
                ,'table'=>'stock_transfer'
            )           
            ,'details' => array(
                'pk'=> 'st_dtl_id'
               // ,'uiKeys'=> array('supply_id','po_qty','po_qty')
                ,'dbKeys'=> array('st_qty','loc_supply_brand_id')
                ,'mustNotEmptyKeys'=> array('st_qty')
                ,'table'=>'stock_transfer_dtls'
            )
        );       
        $st_id = $this->common_model->update($post,$params);              
        // posted=true;
        if($post["p_posted"]==true){        
            $loc_id_to = $post["p_loc_id_to"];            
            $this->db->query("call stock_transfer_post($st_id,$loc_id_to)");
        } 
        return $st_id;
        
    }        
    
    
    function delete($id){                
        //delete header:
        $this->db->where("st_id", $id);
        $this->db->delete("stock_transfer_dtls");    
        //delete details:
        $this->db->where("st_id", $id);
        $this->db->delete("stock_transfer");
        
    }
    
    function delete_dtls($post){        
        $this->common_model->delete($this->input->post(),"stock_transfer_dtls","st_dtl_id");        
    }        
    

}
?>