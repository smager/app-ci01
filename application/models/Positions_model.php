<?php
class positions_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM positions");
        return $query;    
    }
    
    function update($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_position_desc']); $x++) {
            $id = $post['p_position_id'][$x];
            $position_desc = $post['p_position_desc'][$x];
            
            if($position_desc !='') {        

                $data = array(
                     'position_desc' => $position_desc

                );
                
                
                
                if($id==''){
                    //insert        
                    $data['created_by'] =current_user()->empl_id;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('positions', $data);

                }else{
                    //update                        
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('position_id', $id);
                    $this->db->update('positions', $data);
                } 
                
            }//end of no data 
            
            
            
     } //end of loop

    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"positions","position_id");        
    }    

}
?>