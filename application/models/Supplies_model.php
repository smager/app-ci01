<?php
class supplies_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM supplies_v ORDER BY seq_no");
        return $query;    
    }
    
    function getPoSupplies(){
        $query = $this->db->query("SELECT * FROM loc_supplies_v ORDER BY seq_no");
        return $query;    
    }
    
    
    function update($post){
        $params=array(
             'pk'=> 'supply_id'
            ,'dbKeys'=> array('seq_no','supply_code','supply_desc','supply_type_id','supply_srp','supply_cost','unit_id','weight_serve')
            ,'mustNotEmptyKeys'=> array('supply_code')
            ,'mustNotEmptyOnInsert'=> array('supply_code')
            ,'table'=>'supplies'
        );
        $this->common_model->update($post,$params);           
    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"supplies","supply_id");        
    }    

}
?>