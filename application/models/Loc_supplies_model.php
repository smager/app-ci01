<?php
class loc_supplies_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata($sid){
        $query = $this->db->query("SELECT * FROM loc_supplies_v where loc_id=".$sid);
        return $query;    
    }
    function getdata_ad($sid){
        $query = $this->db->query("SELECT * FROM loc_supplies_ad_v where loc_id='' or loc_id=".$sid);
        return $query;    
    }    
    
    function update($post){ //zsi.form.displayLOV
        $loc_id = $post['p_loc_id'];
        for ($x = 0; $x < sizeof($post['p_loc_supply_id']); $x++) {
            $id = $post['p_loc_supply_id'][$x];
            $supply_id = $post['p_supply_id'][$x];
            $isCheck =  $post['p_isCheck'][$x];
            
                if($isCheck==1 && $id=='')  {            
                        //insert        
                        $data = array(
                             'loc_id'  => $loc_id
                            ,'supply_id' => $supply_id
                        );

                        $data['created_by'] =1;
                        $this->db->set('created_date', 'NOW()', FALSE);
                        $this->db->insert('loc_supplies', $data);

                }else if($isCheck==0 && $id!='')  {
                        $this->db->where('loc_supply_id', $id);
                        $this->db->delete('loc_supplies');
                }
                
            
        } //end of loop

    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"loc_supplies","loc_supply_id");        
    }    

}
?>