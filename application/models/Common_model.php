<?php
class common_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function delete($post, $table_name, $field_name){            
        $d= $post['p_del_id'];        
        for ($x = 0; $x < sizeof($d); $x++) {
                $this->db->where($field_name,$d[$x] );
                $this->db->delete($table_name);
        }
    }    

}
?>