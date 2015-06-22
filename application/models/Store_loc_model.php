<?php
class store_loc_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM store_loc");
        return $query;    
    }
    
    function update($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_store_loc']); $x++) {
            $id = $post['p_store_loc_id'][$x];
            $acct_no = $post['p_store_loc'][$x];
            
            if($acct_no !='') {        

                $data = array(
                     'store_loc' => $acct_no
                    ,'loc_id' => $post['p_loc_id'][$x]
                    ,'store_id' => $post['p_store_id'][$x]
                    ,'active' => $post['p_active'][$x]
                );
                                                
                if($id==''){
                    //insert        
                    $data['created_by'] =current_user()->empl_id;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('store_loc', $data);
                    $last_id = $this->db->insert_id();
                    $proc="call store_loc_supplies_ins(" . $last_id  . "," . $post['p_store_id'][$x] . ")";            
                    $this->db->query($proc);                 

                }else{
                    //update                        
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('store_loc_id', $id);
                    $this->db->update('store_loc', $data);
                } 
                
            }//end of no data 
            
            
            
     } //end of loop

    }        
    
    function delete($post){        
        $this->common_model->delete($this->input->post(),"store_loc","store_loc_id");        
    }    

}
?>