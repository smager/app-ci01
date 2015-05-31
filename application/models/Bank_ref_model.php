<?php
class bank_ref_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }

    function form_insert($data){                    
        $data['created_by'] =1;
        $this->db->set('created_date', 'NOW()', FALSE);
        $this->db->insert('bank_ref', $data);
    }

    function form_update($data){                    
        $data['updated_by'] =1;
        $this->db->set('updated_date', 'NOW()', FALSE);
        $this->db->insert('bank_ref', $data);
    }

}
?>