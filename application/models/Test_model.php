<?php
class test_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM test");
        return $query;    
    }
    
    function update($post){            
        $params=array(            
            'parent' => array(
                 'pk'=> 'empl_id'
                ,'dbKeys'=> array('empl_no','empl_name','empl_add')
                ,'mustNotEmptyKeys'=> array('empl_no')
                ,'mustNotEmptyOnInsert'=> array('empl_name')
                ,'table'=>'test_empl'
            )           
            ,'details' => array(
                'pk'=> 'bank_ref_id'
                ,'dbKeys'=> array('bank_acctno','bank_acctname','bank_name','depo_pct_share','active')
                ,'mustNotEmptyKeys'=> array('bank_acctno')
                ,'mustNotEmptyOnInsert'=> array('bank_acctname')
                ,'table'=>'bank_ref'
            )
        );       
        $this->common_model->update($post,$params);         
    }
    
    
    function delete($post){        
        $this->common_model->delete($this->input->post(),"test","test_id");        
    }    

}
?>