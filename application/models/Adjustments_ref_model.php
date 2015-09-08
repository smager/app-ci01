<?php
class adjustments_ref_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM adjustments_ref");
        return $query;    
    }
    
    function update($post){            
        $params=array(
             'pk'=> 'adjmt_id'
            ,'dbKeys'=> array('adjmt_desc')
            ,'mustNotEmptyKeys'=> array('adjmt_desc')
            ,'table'=>'adjustments_ref'
        );
        $this->common_model->update($post,$params); 
    }

    function delete($post){        
        $this->common_model->delete($this->input->post(),"adjustments_ref","adjmt_id");        
    }    

}
?>