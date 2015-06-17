<?php
class supply_is_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata($store_loc_id,$date){
        $str = "SELECT * FROM supply_is where store_loc_id='$store_loc_id' and DATE_FORMAT(is_date,'%m/%d/%Y')='$date'";
        $query = $this->db->query($str);
        return $query;    
    }
    
    function getdata_detail($supply_is_id){
        $query = $this->db->query("SELECT * FROM supply_is_dtl where supply_is_id=$supply_is_id");
        return $query;    
    }
    
    
    function update($post){
        $supply_is_id =  $post['p_supply_is_id'];   
        $data = array(
             'store_loc_id' => $post['p_store_loc_id']
            ,'is_no' => $post['p_is_no']
            ,'is_date' =>   date('Y-m-d', strtotime($post['p_is_date']))  
            ,'posted' => $post['p_posted']
        );

        if($supply_is_id==''){
            //insert        
            $data['created_by'] =current_user()->empl_id;
            $this->db->set('created_date', 'NOW()', FALSE);
            $this->db->insert('supply_is', $data);
             $supply_is_id = $this->db->insert_id();

        }else{
            //update                        
            $data['updated_by'] =current_user()->empl_id;
            $this->db->set('updated_date', 'NOW()', FALSE);
            $this->db->where('supply_is_id', $supply_is_id);
            $this->db->update('supply_is', $data);
        }         

        //detail:
        for ($x = 0; $x < sizeof($post['p_supply_is_dtl_id']); $x++) {
            $id = $post['p_supply_is_dtl_id'][$x];
            
                $data = array(
                     'supply_is_id' => $supply_is_id
                    ,'supply_brand_id' => $post['p_supply_brand_id'][$x]
                    ,'supply_is_qty' => $post['p_supply_qty'][$x]

                );
                
                if($id==''){
                    //insert        
                    $data['created_by'] =current_user()->empl_id;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('supply_is_dtl', $data);

                }else{
                    //update                        
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('supply_is_dtl_id', $id);
                    $this->db->update('supply_is_dtl', $data);
                } 
            
        } //end of loop

    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"supply_is","supply_is_id");        
    }    

}
?>