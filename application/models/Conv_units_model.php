<?php
class conv_units_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM conv_units");
        return $query;    
    }
    
    function update($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_conv_id']); $x++) {
            $id = $post['p_conv_id'][$x];
            $from_unit_id = $post['p_from_unit_id'][$x];
            
            if($from_unit_id !='') {        

                $data = array(
                     'from_unit_id' => $from_unit_id
                    ,'conv_unit_id' => $post['p_conv_unit_id'][$x]
                    ,'conv_unit_qty' => $post['p_conv_unit_qty'][$x]
                );
                
                
                
                if($id==''){
                    //insert        
                    $data['created_by'] =1;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('conv_units', $data);

                }else{
                    //update                        
                    $data['updated_by'] =1;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('conv_id', $id);
                    $this->db->update('conv_units', $data);
                } 
                
            }//end of no data 
            
            
            
     } //end of loop

    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"conv_units","conv_id");        
    }    

}
?>