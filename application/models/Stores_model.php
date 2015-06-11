<?php
class stores_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM stores");
        return $query;    
    }
    
    function update($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_store_name']); $x++) {
            $id = $post['p_store_id'][$x];
            $store_name = $post['p_store_name'][$x];
            
            if($store_name !='') {        

                $data = array(
                     'store_name' => $store_name

                );
                
                
                
                if($id==''){
                    //insert        
                    $data['created_by'] =current_user()->empl_id;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('stores', $data);

                }else{
                    //update                        
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('store_id', $id);
                    $this->db->update('stores', $data);
                } 
                
            }//end of no data 
            
            
            
     } //end of loop

    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"stores","store_id");        
    }    

}
?>