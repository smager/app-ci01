<?php
class denomination_ref_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("call getDenominations('desc')");
        return $query;    
    }
    
    function update($post){
        for ($x = 0; $x < sizeof($post['p_denomination_ref_id']); $x++) {
            $id = $post['p_denomination_ref_id'][$x];
            $denomination = $post['p_denomination'][$x];

            if($denomination!=''){
                
                $data = array(
                     'denomination' => $denomination
                );
            
                if($id==''){
                    //insert        
                    $data['created_by'] =current_user()->empl_id;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('denomination_ref', $data);
                }else{
                    //update                        
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('denomination', $id);
                    $this->db->update('denomination_ref', $data);
                } 
            }
                
            

     } //end of loop

    }        
    
    function delete($post){        
        $this->common_model->delete($this->input->post(),"denomination_ref","denomination");        
    }    

}
?>