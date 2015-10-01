<?php
class roles_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM roles");
        return $query;    
    }
    
    function update($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_role_desc']); $x++) {
            $id = $post['p_role_id'][$x];
            $role_desc = $post['p_role_desc'][$x];
            
            if($role_desc !='') {        

                $data = array(
                      'role_desc' => $role_desc
                     ,'role_code' =>  $post['p_role_code'][$x]
                );
                
                if($id==''){
                    //insert        
                    $data['created_by'] =current_user()->empl_id;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('roles', $data);

                }else{
                    //update                        
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('role_id', $id);
                    $this->db->update('roles', $data);
                } 
                
            }//end of no data 

     } //end of loop

    }        
    
    
    function roleMenuUpdate($post){ //zsi.form.displayLOV
        
        for ($x = 0; $x < sizeof($post['p_role_menu_id']); $x++) {
            $id = $post['p_role_menu_id'][$x];            
            $isCheck =  $post['p_isCheck'][$x];
            
            $data = array(
                 'role_id'  => $post['p_role_id']
                ,'menu_id' => $post['p_menu_id'][$x]
            );
                        
            if($isCheck==1 && $id=='')  {                     
                    //insert    
                    $data['created_by'] =current_user()->empl_id;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('role_menus', $data);

            }else if($isCheck==1 && $id!='')  {                     
                    //update        
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('user_loc_id', $id);
                    $this->db->update('role_menus', $data);

            }else if($isCheck==0 && $id!='')  {
                    $this->db->where('user_loc_id', $id);
                    $this->db->delete('role_menus');
            }
            
        } //end of loop

    }        
        
    
    function delete($post){        
        $this->common_model->delete($this->input->post(),"roles","role_id");        
    }    

}
?>