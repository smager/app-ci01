<?php
class supply_types_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM supply_types");
        return $query;    
    }
    
    function update($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_supply_type']); $x++) {
            $id = $post['p_supply_type_id'][$x];
            $supply_type = $post['p_supply_type'][$x];
            
            if($supply_type !='') {        

                $data = array(
                     'supply_type' => $supply_type

                );
                
                if($id==''){
                    //insert        
                    $data['created_by'] =current_user()->empl_id;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('supply_types', $data);

                }else{
                    //update                        
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('supply_type_id', $id);
                    $this->db->update('supply_types', $data);
                } 
                
            }//end of no data 
            
     } //end of loop

    }        
    
    function delete($post){        
        $this->common_model->delete($this->input->post(),"supply_types","supply_type_id");        
    }    

}
?>