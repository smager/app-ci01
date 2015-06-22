<?php
class bank_ref_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM bank_ref");
        return $query;    
    }
    
    function update($post){            
        $params=array(
             'pk'=> 'bank_ref_id'
            ,'dbKeys'=> array('bank_acctno','bank_acctname','bank_name','depo_pct_share','active')
            ,'mustNotEmptyKeys'=> array('bank_acctno')
            ,'mustNotEmptyOnInsert'=> array('bank_acctname')
            ,'table'=>'bank_ref'
        );
        $this->common_model->update($post,$params); 
    }

    function delete($post){        
        $this->common_model->delete($this->input->post(),"bank_ref","bank_ref_id");        
    }    

}
?>