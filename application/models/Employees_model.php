<?php
class employees_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM employees");
        return $query;    
    }
    
    function update($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_empl_id']); $x++) {
            $id = $post['p_empl_id'][$x];
            
            $empl_name = $post['p_empl_name'][$x];
            
            if($empl_name !='') {        

                $data = array(
                     'empl_name' =>  $empl_name
                    ,'position_id '=>  $post['p_position_id'][$x]
                    ,'daily_rate'=>  $post['p_daily_rate'][$x]
                    ,'loc_id'=>  $post['p_loc_id'][$x]
                    ,'store_loc_id' =>  $post['p_store_loc_id'][$x]
                    ,'active'    =>  $post['p_active'][$x]                
                );
                
                
                if($id==''){
                    //insert        
                    $data['created_by'] =1;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('employees', $data);

                }else{
                    //update                        
                    $data['updated_by'] =1;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('empl_id', $id);
                    $this->db->update('employees', $data);
                } 
                
            }//end of no data 
            
            
            
     } //end of loop

    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"employees","empl_id");        
    }    

}
?>