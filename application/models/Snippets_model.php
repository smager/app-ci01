<?php
class snippets_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }

    function form_insert($data){                    
        $data['created_by'] =current_user()->empl_id;
        $this->db->set('created_date', 'NOW()', FALSE);
        $this->db->insert('snippets', $data);
    }
}


/*
    foreach ($data as $row)
        {
                echo $row; //or whatever the query returns
        }
*/
?>