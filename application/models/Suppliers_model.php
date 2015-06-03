<?php
class suppliers_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM suppliers");
        return $query;    
    }
    
    function update($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_supplier_name']); $x++) {
            $id = $post['p_supplier_id'][$x];
            $supplier_name = $post['p_supplier_name'][$x];
            
            if($supplier_name !='') {        

                $data = array(
                     'supplier_name' => $supplier_name
                     ,'active' => $post['p_active'][$x]
                );
                
                
                
                if($id==''){
                    //insert        
                    $data['created_by'] =1;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('suppliers', $data);

                }else{
                    //update                        
                    $data['updated_by'] =1;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('supplier_id', $id);
                    $this->db->update('suppliers', $data);
                } 
                
            }//end of no data 
            
            
            
     } //end of loop

    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"suppliers","supplier_id");        
    }    

}
?>