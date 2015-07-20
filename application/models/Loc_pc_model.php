<?php
class loc_pc_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata($loc_id){
        $query = $this->db->query("SELECT * FROM loc_supply_brands_v where loc_id=$loc_id");
        return $query;    
    }

    
    function getdata_dtls($loc_pc_id){
        $query = $this->db->query("SELECT * FROM loc_pc_dtls_v where loc_pc_id=$loc_pc_id");
        return $query;    
    }

     function get_unposted_pc(){
        $query = $this->db->query("select * from loc_pc where posted=0");
        return $query;    
    }
   

    function update($post){
        $params=array(           
            'parent' => array(
                 'pk'=> 'loc_pc_id'
                ,'dbKeys'=> array('pc_no','pc_date','loc_id','store_loc_id','posted')
                ,'table'=>'loc_pc'
                ,'allowNull'=>true
            )           
            ,'details' => array(
                'pk'=> 'loc_pc_dtl_id'
                ,'dbKeys'=> array('loc_supply_brand_id','pc_qty')
               // ,'mustNotEmptyKeys'=> array('po_qty')
                ,'table'=>'loc_pc_dtls'
            )
        );       
        
        $loc_pc_id = $this->common_model->update($post,$params);

        // posted=true;
        if($post["p_posted"]==true){        
            $store_loc_id =0;
            if(isset($post["p_store_loc_id"] )) $store_loc_id = $post["p_store_loc_id"];      
            $sql = "call loc_pc_post($loc_pc_id,$store_loc_id)";
            $this->db->query("call loc_pc_post($loc_pc_id,$store_loc_id)");
        }
        
        return  $loc_pc_id;
    }        
    
    
    function delete($id){                
        //delete header:
        $this->db->where("loc_pc_id", $id);
        $this->db->delete("loc_pc_dtls");    
        //delete details:
        $this->db->where("loc_pc_id", $id);
        $this->db->delete("loc_pc");
        
    }
}
?>