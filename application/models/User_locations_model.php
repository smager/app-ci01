<?php
class user_locations_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata($sid){
        $query = $this->db->query("SELECT * FROM user_locations_v where loc_id=".$sid);
        return $query;    
    }
    function getdata_ad($sid){
        $query = $this->db->query(
             "SELECT * FROM user_locations_v where loc_id=" . $sid
            ." UNION SELECT * FROM supplies2_v a" 
            ." WHERE NOT EXISTS(SELECT b.loc_id FROM user_locations_v b WHERE b.loc_id=" . $sid 
            ." AND b.loc_id = a.loc_id)" 
        );
        return $query;    
    }    
    
    function update($post){ //zsi.form.displayLOV
        
        for ($x = 0; $x < sizeof($post['p_user_loc_id']); $x++) {
            $id = $post['p_user_loc_id'][$x];            
            $isCheck =  $post['p_isCheck'][$x];
            
            $data = array(
                 'loc_id'  => $post['p_loc_id']
                ,'loc_id' => $post['p_loc_id'][$x]
                ,'reorder_level' => $post['p_reorder_level'][$x]
                ,'max_level' => $post['p_max_level'][$x]
            );
             echo "\r\n test:$isCheck  -  $id";
                        
            if($isCheck==1 && $id=='')  {                     
                    //insert    
                    echo "\r\ninsert.".
                    $data['created_by'] =current_user()->empl_id;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('user_locations', $data);

            }else if($isCheck==1 && $id!='')  {                     
                    //update        
                   echo "\r\nupdate - Id:" . $id . ", reorder_level:" .  $data['reorder_level'] . " max_level: " . $data['max_level'];
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('user_loc_id', $id);
                    $this->db->update('user_locations', $data);

            }else if($isCheck==0 && $id!='')  {
                    echo "\r\ndelete.".
                    $this->db->where('user_loc_id', $id);
                    $this->db->delete('user_locations');
            }
            
        } //end of loop

    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"user_locations","user_loc_id");        
    }    

}
?>