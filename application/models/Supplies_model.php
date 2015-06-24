<?php
class supplies_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM supplies");
        return $query;    
    }
    
    function update($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_supply_id']); $x++) {
            $id = $post['p_supply_id'][$x];
            $supply_code = $post['p_supply_code'][$x];
            
            if($supply_code !='') {        

                $data = array(
                     'supply_code' => $supply_code
                    ,'supply_desc' => $post['p_supply_desc'][$x]
                    ,'supply_type_id' => $post['p_supply_type_id'][$x]
                    ,'supply_srp' => $post['p_supply_srp'][$x]
                    ,'unit_id' => $post['p_unit_id'][$x]
                );
                
                
                
                if($id==''){
                    //insert        
                    $data['created_by'] =current_user()->empl_id;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('supplies', $data);

                }else{
                    //update                        
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('supply_id', $id);
                    $this->db->update('supplies', $data);
                } 
                
            }//end of no data 
            
            
            
     } //end of loop

    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"supplies","supply_id");        
    }    

}
?>