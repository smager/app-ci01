<?php
class units_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM units");
        return $query;    
    }
    
    function update($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_unit_id']); $x++) {
            $id = $post['p_unit_id'][$x];
            $unit_sdesc = $post['p_unit_sdesc'][$x];
            
            if($unit_sdesc !='') {        

                $data = array(
                     'unit_sdesc' => $unit_sdesc
                    ,'unit_desc' => $post['p_unit_desc'][$x]

                );
                if($id==''){
                    //insert        
                    $data['created_by'] =current_user()->empl_id;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('units', $data);

                }else{
                    //update                        
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('unit_id', $id);
                    $this->db->update('units', $data);
                } 
                
            }//end of no data 
            
            
            
     } //end of loop

    }        
    
    function delete($post){        
        $this->common_model->delete($this->input->post(),"units","unit_id");        
    }    

}
?>