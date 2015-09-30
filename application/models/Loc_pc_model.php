<?php
class loc_pc_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }

    function getLocPCNew($loc_id,$store_id,$loc_pc_id){
        $query = $this->db->query("call getLocPC($loc_id,$store_id,$loc_pc_id);");
        return $query;
    }

    /*
    function getdata_dtls($loc_pc_id){
        $query = $this->db->query("SELECT * FROM loc_pc_dtls_v where loc_pc_id=$loc_pc_id");
        return $query;
    }
    */

     function get_unposted_pc($loc_id){
        $query = $this->db->query("call getLocPC_Unposted($loc_id);");
        return $query;
    }


    function update($post){
        $params=array(
            'parent' => array(
                 'pk'=> 'loc_pc_id'
                ,'dbKeys'=> array('pc_no','pc_date','loc_id','store_id','posted')
                ,'table'=>'loc_pc'
                ,'allowNull'=>true
            )
            ,'details' => array(
                'pk'=> 'loc_pc_dtl_id'
                ,'dbKeys'=> array('loc_supply_brand_id','pc_qty')
               // ,'mustNotEmptyKeys'=> array('pc_qty')
                ,'table'=>'loc_pc_dtls'
            )
        );

        $loc_pc_id = $this->common_model->update($post,$params);

        // posted=true;
        if($post["p_posted"]==true){
            $pc_date=$post["p_pc_date"];
            $sql = "call loc_pc_post($loc_pc_id,'$pc_date')";
            $this->db->query($sql);
        }

        $query = $this->db->query("select * from loc_pc where loc_pc_id=$loc_pc_id");
        return  $query->result()[0];
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