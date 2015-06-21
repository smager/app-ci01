<?php
class bank_ref_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM bank_ref");
        return $query;    
    }
    
    function update2($post){    
        $params=array(
             'post'=>$post
            ,'pk'=> array('ui'=>'bank_ref_id','db'=>'bank_ref_id')
            ,'ui'=> array('bank_acctno','bank_acctname','bank_name','depo_pct_share','active')
            ,'db'=> array('bank_acctno','bank_acctname','bank_name','depo_pct_share','active')
            ,'mustNotEmptyKeys'=> array('bank_acctno','bank_acctname')
            ,'table'=>'bank_ref'
            //,'notEmptyOnInsert'=> array('bank_acctno')
        );
        
        $this->load->model('common_model'); 
        $this->common_model->update($params); 
    }
    
    function update($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_bank_acctno']); $x++) {
            $id = $post['p_bank_ref_id'][$x];
            $acct_no = $post['p_bank_acctno'][$x];
            
            if($acct_no !='') {        

                $data = array(
                     'bank_acctno' => $acct_no
                    ,'bank_acctname' => $post['p_bank_acctname'][$x]
                    ,'bank_name' => $post['p_bank_name'][$x]
                    ,'depo_pct_share' => $post['p_depo_pct_share'][$x]
                    ,'active' => $post['p_active'][$x]
                );
                
                
                
                if($id==''){
                    //insert        
                    $data['created_by'] =current_user()->empl_id;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('bank_ref', $data);

                }else{
                    //update                        
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('bank_ref_id', $id);
                    $this->db->update('bank_ref', $data);
                } 
                
            }//end of no data 
            
            
            
     } //end of loop

    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"bank_ref","bank_ref_id");        
    }    

}
?>