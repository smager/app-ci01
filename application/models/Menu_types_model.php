<?php
class menu_types_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM menu_types");
        return $query;    
    }
    
    function update($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_menu_type']); $x++) {
            $id = $post['p_menu_type_id'][$x];
            $menu_type = $post['p_menu_type'][$x];
            
            if($menu_type !='') {        

                $data = array(
                     'menu_type' => $menu_type
                    ,'seq_no' => $post['p_seq_no'][$x]

                );
                
                
                
                if($id==''){
                    //insert        
                    $data['created_by'] =current_user()->empl_id;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('menu_types', $data);

                }else{
                    //update                        
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('menu_type_id', $id);
                    $this->db->update('menu_types', $data);
                } 
                
            }//end of no data 
            
            
            
     } //end of loop

    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"menu_types","menu_type_id");        
    }    

}
?>