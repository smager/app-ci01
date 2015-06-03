<?php
class store_daily_cash_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM store_daily_cash");
        return $query;    
    }
    
    function update($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_bank_acctno']); $x++) {
            $id = $post['p_store_daily_cash_id'][$x];
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
                    $this->db->insert('store_daily_cash', $data);

                }else{
                    //update                        
                    $data['updated_by'] =1;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('store_daily_cash_id', $id);
                    $this->db->update('store_daily_cash', $data);
                } 
                
            }//end of no data 
            
            
            
     } //end of loop

    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"store_daily_cash","store_daily_cash_id");        
    }    

}
?>