<?php
class systems_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM systems");
        return $query;    
    }
    
    function update($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_system_id']); $x++) {
            $id = $post['p_system_id'][$x];
            $system = $post['p_system_name'][$x];
            
            if($system !='') {        

                $data = array(
                     'system_name' => $system
                    ,'system_desc' => $post['p_system_desc'][$x]

                );
                
                
                
                if($id==''){
                    //insert        
                    $data['created_by'] =1;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('systems', $data);

                }else{
                    //update                        
                    $data['updated_by'] =1;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('system_id', $id);
                    $this->db->update('systems', $data);
                } 
                
            }//end of no data 
            
            
            
     } //end of loop

    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"systems","system_id");        
    }    

}
?>