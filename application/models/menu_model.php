<?php
class menu_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM menu");
        return $query;    
    }
    
    function update($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_menu_name']); $x++) {
            $id = $post['p_menu_id'][$x];
            $menu_name = $post['p_menu_name'][$x];
            
            if($menu_name !='') {        

                $data = array(
                     'menu_name' => $menu_name
                    ,'seq_no' => $post['p_seq_no'][$x]
                    ,'menu_type_id' => $post['p_menu_type_id'][$x]
                    ,'system_id' => $post['p_system_id'][$x]
                );
                
                
                
                if($id==''){
                    //insert        
                    $data['created_by'] =1;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('menu', $data);

                }else{
                    //update                        
                    $data['updated_by'] =1;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('menu_id', $id);
                    $this->db->update('menu', $data);
                } 
                
            }//end of no data 
            
            
            
     } //end of loop

    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"menu","menu_id");        
    }    

}
?>