<?php
class store_daily_cash_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata($store_loc_id,$date){
        $str = "SELECT * FROM store_daily_cash where store_loc_id='$store_loc_id' and DATE_FORMAT(tran_date,'%m/%d/%Y')='$date'";
        $query = $this->db->query($str);
        return $query;    
    }
    
    function getdata_detail($store_daily_cash_id){
        $query = $this->db->query("SELECT * FROM store_daily_cash_dtl where store_daily_cash_id=$store_daily_cash_id");
        return $query;    
    }
    
    
    function update($post){
        $store_daily_cash_id =  $post['p_store_daily_cash_id'];   
        $data = array(
             'store_loc_id' => $post['p_store_loc_id']
            ,'tran_date' =>   date('Y-m-d', strtotime($post['p_tran_date']))  
            ,'posted' => $post['p_posted']
        );

        if($store_daily_cash_id==''){
            //insert        
            $data['created_by'] =current_user()->empl_id;
            $this->db->set('created_date', 'NOW()', FALSE);
            $this->db->insert('store_daily_cash', $data);
             $store_daily_cash_id = $this->db->insert_id();

        }else{
            //update                        
            $data['updated_by'] =current_user()->empl_id;
            $this->db->set('updated_date', 'NOW()', FALSE);
            $this->db->where('store_daily_cash_id', $store_daily_cash_id);
            $this->db->update('store_daily_cash', $data);
        }         

        //detail:
        for ($x = 0; $x < sizeof($post['p_store_daily_cash_dtl_id']); $x++) {
            $id = $post['p_store_daily_cash_dtl_id'][$x];
            
                $data = array(
                     'store_daily_cash_id' => $store_daily_cash_id
                    ,'denomination' => $post['p_denomination'][$x]
                    ,'denomination_qty' => $post['p_denomination_qty'][$x]
                    ,'cash_amount' => $post['p_cash_amount'][$x]
                );
                
                if($id==''){
                    //insert        
                    $data['created_by'] =current_user()->empl_id;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('store_daily_cash_dtl', $data);

                }else{
                    //update                        
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('store_daily_cash_dtl_id', $id);
                    $this->db->update('store_daily_cash_dtl', $data);
                } 
            
        } //end of loop

    }        
    
    function delete($post){        
        $this->common_model->delete($this->input->post(),"store_daily_cash","store_daily_cash_id");        
    }    

}
?>