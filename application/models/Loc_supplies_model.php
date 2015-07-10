<?php
class loc_supplies_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata($sid){
        $query = $this->db->query("SELECT * FROM loc_supplies_v where loc_id=".$sid);
        return $query;    
    }
    
     function getdata_sb($sid){
        $query = $this->db->query("SELECT * FROM loc_supply_brands_v where loc_id=".$sid);
        return $query;    
    }   
    
    function get_loc_supply_brands($sid){
        $query = $this->db->query("SELECT * FROM loc_supply_brands_v where loc_supply_id=".$sid . " and stock_qty>0");
        return $query;    
    }   
    
    
    
    
        
    function getdata_ad($sid){
        $query = $this->db->query(
             "SELECT * FROM loc_supplies_v where loc_id=" . $sid
            ." UNION SELECT * FROM supplies2_v a" 
            ." WHERE NOT EXISTS(SELECT b.supply_id FROM loc_supplies_v b WHERE b.loc_id=" . $sid 
            ." AND b.supply_id = a.supply_id)" 
        );
        return $query;    
    }    
    
    function update($post){ //zsi.form.displayLOV
        
        for ($x = 0; $x < sizeof($post['p_loc_supply_id']); $x++) {
            $id = $post['p_loc_supply_id'][$x];            
            $isCheck =  $post['p_isCheck'][$x];
            $loc_id =  $post['p_loc_id'];
            
            $data = array(
                 'loc_id'  => $loc_id
                ,'supply_id' => $post['p_supply_id'][$x]
                ,'reorder_level' => $post['p_reorder_level'][$x]
                ,'max_level' => $post['p_max_level'][$x]
            );
                        
            if($isCheck==1 && $id=='')  {                     
                    //insert    
                    $data['created_by'] =current_user()->empl_id;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('loc_supplies', $data);

            }else if($isCheck==1 && $id!='')  {                     
                    //update        
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('loc_supply_id', $id);
                    $this->db->update('loc_supplies', $data);

            }else if($isCheck==0 && $id!='')  {
                    $this->db->where('loc_supply_id', $id);
                    $this->db->delete('loc_supplies');
            }
            
        } //end of loop

        $this->db->query("call LocSupplyBrandsIns($loc_id)");

    }        
    
    function delete($post){        
        $this->common_model->delete($this->input->post(),"loc_supplies","loc_supply_id");        
    }    

}
?>