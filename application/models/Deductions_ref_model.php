<?php
class deductions_ref_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM deductions_ref");
        return $query;    
    }
    
    function update($post){            
        $params=array(
             'pk'=> 'deduction_ref_id'
            ,'dbKeys'=> array('deduction_code','deduction_desc','deduction_pct','default_amt')
            ,'mustNotEmptyKeys'=> array('deduction_code','deduction_desc')
            ,'table'=>'deductions_ref'
        );
        $this->common_model->update($post,$params); 
    }

    function delete($post){        
        $this->common_model->delete($this->input->post(),"deductions_ref","deduction_ref_id");        
    }    

}
?>