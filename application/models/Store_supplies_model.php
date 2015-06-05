<?php
class store_supplies_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata($sid){
        $query = $this->db->query("SELECT * FROM store_supplies_v where store_id=".$sid);
        return $query;    
    }
    
    function update($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_store_supply_id']); $x++) {
            $id = $post['p_store_supply_id'][$x];
            $store_id = $post['p_store_id'][$x];
            $supply_id = $post['p_supply_id'][$x];
            
            if($store_id !='' && $supply_id !='') {        

                $data = array(
                     'store_id'  => $store_id
                    ,'supply_id' => $supply_id
                );
                
                
                
                if($id==''){
                    //insert        
                    $data['created_by'] =1;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('store_supplies', $data);

                }else{
                    //update                        
                    $data['updated_by'] =1;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('store_supply_id', $id);
                    $this->db->update('store_supplies', $data);
                } 
                
            }//end of no data 
            
            
            
     } //end of loop

    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"store_supplies","store_supply_id");        
    }    

}
?>