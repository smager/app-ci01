<?php
class store_daily_expenses_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    function getdata_detail($store_loc_exp_id){
        $query = $this->db->query("select * from store_loc_exp_dtls where store_loc_exp_id=$store_loc_exp_id");
        return $query;    
    }

    function getinfo($store_loc_id,$exp_date){
        $sql = "select * from store_loc_exp where store_loc_id=$store_loc_id and  DATE_FORMAT(exp_date,'%m/%d/%Y')='$exp_date'";
        $q = $this->db->query($sql);
        if($q->num_rows()>0)
            $result= $q->result(); 
        else
            $result =array();             
        return $result;    
    }
    
    
    function update($post){
            
        $params=array(            
            'parent' => array(
                 'pk'=> 'store_loc_exp_id'
                ,'dbKeys'=> array("store_loc_id","exp_date","posted")
                ,'table'=>'store_loc_exp'
            )           
            ,'details' => array(
                'pk'=> 'store_loc_exp_dtl_id'
                ,'dbKeys'=> array('exp_desc','exp_amt')
                ,'mustNotEmptyKeys'=> array('exp_desc','exp_amt')
                ,'table'=>'store_loc_exp_dtls'
            )
        );       
        $is_id = $this->common_model->update($post,$params);          
    
    }        
        
   
    function delete_dtls($post){        
        $this->common_model->delete($this->input->post(),"store_loc_exp_dtls","store_loc_exp_dtl_id");        
    }    
    
}
?>