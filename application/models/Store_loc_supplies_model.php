<?php
class store_loc_supplies_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata($sid){
        $query = $this->db->query("SELECT * FROM store_loc_supplies_v where store_loc_id=".$sid);
        return $query;    
    }
    function getdata_ad($sid){
        $query = $this->db->query(
              "SELECT * FROM store_loc_supplies_v where store_loc_id=" . $sid 
            . " UNION SELECT * FROM store_supplies2_v a "
            . " WHERE NOT EXISTS(SELECT b.supply_brand_id FROM store_loc_supplies_v b WHERE b.store_loc_id=" . $sid
            . " AND b.supply_brand_id = a.supply_brand_id)" 
        );
        return $query;    
    }    
    
    function update($post){ //zsi.form.displayLOV
        $store_id = $post['p_store_id'];
        for ($x = 0; $x < sizeof($post['p_store_loc_supply_id']); $x++) {
            $id = $post['p_store_loc_supply_id'][$x];
        
           $data = array(
                 'stock_daily_qty'  => $post['p_stock_daily_qty']
            );
            
            if($id!='')  {
                
                        $data['updated_by'] =current_user()->empl_id;
                        $this->db->set('updated_date', 'NOW()', FALSE);
                        $this->db->where('store_loc_supply_id', $id);
                        $this->db->delete('store_loc_supplies');
                }
                
            
        } //end of loop

    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"store_loc_supplies","store_loc_supply_id");        
    }    

}
?>