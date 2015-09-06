<?php
class store_daily_cash_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }

    function getStoreDailyCash($store_loc_id,$date){
        $str = "call getStoreDailyCash($store_loc_id,'$date')";
        $query = $this->db->query($str);
        return $query;    
    }
    
    function getdata($store_loc_id,$date){
        $str = "SELECT * FROM store_daily_cash where store_loc_id='$store_loc_id' and DATE_FORMAT(tran_date,'%m/%d/%Y')='$date'";
        $query = $this->db->query($str);
        return $query;    
    }
    
    function getdata_detail($store_daily_cash_id){
        $query = $this->db->query("SELECT * FROM store_daily_cash_dtls where store_daily_cash_id=$store_daily_cash_id order by denomination desc");
        return $query;    
    }
    
    
    //inq:
    function getDailyCashInq($store_loc_id,$tran_date){
        $query = $this->db->query("call store_daily_cash_report($store_loc_id,'$tran_date')");
        return $query;    
    }    
    
    
    function update($post){
        $store_daily_cash_id =  $post['p_store_daily_cash_id'];   
        $data = array(
             'store_loc_id' => $post['p_store_loc_id']
            ,'empl_id' => $post['p_empl_id']
            ,'event_id' => $post['p_event_id']             
            ,'tran_date' =>   date('Y-m-d', strtotime($post['p_tran_date']))  
        );
        
        if($post["p_tran_type"]=="cashbox")
            $data['posted_dcash'] = $post['p_posted'];                 
        else
            $data['posted_dsales'] = $post['p_posted'];            

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
                $data = array();
                if($post["p_tran_type"]=="cashbox"){                    
                    $data['store_daily_cash_id'] = $store_daily_cash_id;
                    $data['denomination']= $post['p_denomination'][$x];                                           
                    $data['cash_amount'] = $post['p_cash_amount'][$x];
                    $data['denomination_qty'] = $post['p_denomination_qty'][$x];                
                }
                else{
                    $data['return_denomination_qty'] = $post['p_denomination_qty'][$x];
                    $data['return_amount'] = $post['p_return_amount'][$x];
                }
            
                if($id==''){
                    //insert        
                    $data['created_by'] =current_user()->empl_id;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('store_daily_cash_dtls', $data);

                }else{
                    //update                        
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('store_daily_cash_dtl_id', $id);
                    $this->db->update('store_daily_cash_dtls', $data);
                } 
            
        } //end of loop
        if($post["p_tran_type"]=="cashbox") {
            if ( $post['p_posted']==1) 
                $this->db->query("call store_daily_cash_postedCB($store_daily_cash_id)");
        }
        else {
            if ( $post['p_posted']==1) 
                $this->db->query("call store_daily_cash_postedRet($store_daily_cash_id)");
        }

    }        
    
    function delete($post){        
        $this->common_model->delete($this->input->post(),"store_daily_cash","store_daily_cash_id");        
    }    

}
?>