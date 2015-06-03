<?php
class locations_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM locations");
        return $query;    
    }
    
    function update($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_location']); $x++) {
            $id = $post['p_loc_id'][$x];
            $location = $post['p_location'][$x];
            
            if($location !='') {        

                $data = array(
                     'location' => $location

                );
                
                
                
                if($id==''){
                    //insert        
                    $data['created_by'] =1;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('locations', $data);

                }else{
                    //update                        
                    $data['updated_by'] =1;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('loc_id', $id);
                    $this->db->update('locations', $data);
                } 
                
            }//end of no data 
            
            
            
     } //end of loop

    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"locations","loc_id");        
    }    

}
?>