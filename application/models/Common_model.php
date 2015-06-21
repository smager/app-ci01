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
    
    
    function update($params){
        if(isset($params->post)){
            for ($x = 0; $x < sizeof($params->post['p_'. $params->ui[0]]); $x++) {
                $id = $params->post['p_' . $params->pk->ui][$x];

                $isFoundEmptyKeys =findEmptyKeys($params->post,$params->mustNotEmptyKeys);

                if($isFoundEmptyKeys==false) {        
                    $data = array();
                    for ($i = 0; $i < sizeof($params->ui); $i++) {
                        $data[$params->db[$i]] = $params->post['p_'. $params->ui[$i]];
                    }
                    if($id==''){
                        //insert        
                        $data['created_by'] =current_user()->empl_id;
                        $this->db->set('created_date', 'NOW()', FALSE);
                        $this->db->insert($params->table, $data);

                    }else{
                        //update                        
                        $data['updated_by'] =current_user()->empl_id;
                        $this->db->set('updated_date', 'NOW()', FALSE);
                        $this->db->where('bank_ref_id', $id);
                        $this->db->update($params->table, $data);
                    } 

                }//end of - if(isFoundEmptyKeys)

            } //end of loop
        }//end of - if post is set
    }
    
    function findEmptyKeys($post,$keys){
        $result=false;
        for ($x = 0; $x < sizeof($keys); $x++) {
            if($post[$keys[$x]]=='') {
                $result=true;
                break;
            }
        }
        
        return $result;
    }    
    

}
?>