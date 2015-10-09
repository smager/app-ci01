<?php
class users_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM users");
        return $query;    
    }
    
    function authenticate($p){
        $str = "SELECT * FROM users WHERE lower(user_name)=lower('" . $p["p_login"] . "') and user_password='"  . $p["p_pwd"] . "'";        
        $query = $this->db->query($str);
        $result =false;
        if ($query->num_rows() > 0 ){  
            $result = true;
            $user = $query->result()[0];
            //get role code
            $sql = "select * from roles where role_id=$user->role_id";
            $user->roleInfo = $this->db->query($sql)->result()[0];  
            $this->session->set_userdata('current_user', $user);
                
        }
        return $result;
    }
    
    function update($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_user_id']); $x++) {
            $id = $post['p_user_id'][$x];
            
            $user_name = $post['p_user_name'][$x];
            
            if($user_name !='') {        

                $data = array(
                     'user_name' =>  $user_name
                    ,'empl_id' =>  $post['p_empl_id'][$x]
                    ,'role_id' =>  $post['p_role_id'][$x]
                    ,'active'    =>  $post['p_active'][$x]                
                );
                
                if($id==''){
                    //insert        
                    $data['created_by'] =current_user()->empl_id;
                    $data['user_password'] ="pass@123";
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('users', $data);

                }else{
                    //update                        
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('user_id', $id);
                    $this->db->update('users', $data);
                } 
                
            }//end of no data 
            
            
            
     } //end of loop

    }        

    function updatepwd($post){
        $result =  array("status"=>0);
        $currentPwd = $post['p_current_pwd'];
        $newPwd     = $post['p_new_pwd'];
        
        $sql = "select * from users  where user_id=" . current_user()->user_id;
        $info= $this->db->query($sql)->result()[0];  
        
        if($info->user_password == $currentPwd){
            $data['updated_by'] =current_user()->empl_id;
            $data['user_password'] = $newPwd;
            $this->db->set('updated_date', 'NOW()', FALSE);
            $this->db->where('user_id', current_user()->user_id);
            $this->db->update('users', $data);
            
            $result =  array("status"=>1);
        }
            
        return $result;
    }        

    
    function delete($post){        
        $this->common_model->delete($this->input->post(),"users","user_id");        
    }    

}
?>