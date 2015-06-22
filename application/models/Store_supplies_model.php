<?php
class store_supplies_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata($sid){
        $query = $this->db->query("SELECT * FROM store_supplies_v where store_id=".$sid);
        return $query;    
    }
    function getdata_ad($sid){
        $query = $this->db->query(
              "SELECT * FROM store_supplies_v where store_id=" . $sid 
            . " UNION SELECT * FROM supplies_v a "
            . " WHERE NOT EXISTS(SELECT b.supply_id FROM store_supplies_v b WHERE b.store_id=" . $sid
            . " AND b.supply_id = a.supply_id)" 
        );
        return $query;    
    }    
    
    function update($post){ //zsi.form.displayLOV
        $store_id = $post['p_store_id'];
        for ($x = 0; $x < sizeof($post['p_store_supply_id']); $x++) {
            $id = $post['p_store_supply_id'][$x];
            $supply_id = $post['p_supply_id'][$x];
            $isCheck =  $post['p_isCheck'][$x];
            
                if($isCheck==1 && $id=='')  {            
                        //insert        
                        $data = array(
                             'store_id'  => $store_id
                            ,'supply_id' => $supply_id
                        );

                        $data['created_by'] =current_user()->empl_id;
                        $this->db->set('created_date', 'NOW()', FALSE);
                        $this->db->insert('store_supplies', $data);

                }else if($isCheck==0 && $id!='')  {
                        $this->db->where('store_supply_id', $id);
                        $this->db->delete('store_supplies');
                }
                
            
        } //end of loop

    }        
    
    function delete($post){        
        $this->common_model->delete($this->input->post(),"store_supplies","store_supply_id");        
    }    

}
?>