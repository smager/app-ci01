<?php
class bank_ref_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM bank_ref");
        return $query;    
    }
    
    function submit($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_bank_acctno']); $x++) {
            $id = $post['p_bank_ref_id'][$x];
            $acct_no = $post['p_bank_acctno'][$x];
            
            if($acct_no !='') {        

                $data = array(
                     'bank_acctno' => $acct_no
                    ,'bank_acctname' => $post['p_bank_acctname'][$x]
                    ,'bank_name' => $post['p_bank_name'][$x]
                    ,'active' => $post['p_active'][$x]
                );
                
                
                
                if($id==''){
                    //insert        
                    $data['created_by'] =1;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('bank_ref', $data);

                }else{
                    //update                        
                    $data['updated_by'] =1;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('bank_ref_id', $id);
                    $this->db->update('bank_ref', $data);
                } 
                
            }//end of no data 
            
            
            
     } //end of loop

    }        

}
?>