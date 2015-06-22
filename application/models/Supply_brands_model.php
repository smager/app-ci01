<?php
class supply_brands_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata($sid){
        $query = $this->db->query("SELECT * FROM supply_brands_v where supply_id=".$sid);
        return $query;    
    }
    
    function getDataSupplyBrands(){
        $query = $this->db->query("SELECT * FROM supply_brands_v ");
        return $query;    
    }
    
    function getdata_ad($sid){
        $query = $this->db->query(
            
             "SELECT * FROM supply_brands_v where supply_id=" . $sid
            ." UNION SELECT * FROM supply_brands2_v a" 
            ." WHERE NOT EXISTS(SELECT b.brand_id FROM supply_brands_v b WHERE b.supply_id=" . $sid 
            ." AND b.brand_id = a.brand_id)" 
        );       
        return $query;    
    }    
    
 
    
    function update($post){ //zsi.form.displayLOV
        
        for ($x = 0; $x < sizeof($post['p_supply_brand_id']); $x++) {
            $id = $post['p_supply_brand_id'][$x];            
            $isCheck =  $post['p_isCheck'][$x];
            
            $data = array(
                 'supply_id'  => $post['p_supply_id']
                ,'brand_id' => $post['p_brand_id'][$x]
                 ,'conv_id' => $post['p_conv_id'][$x]
                 ,'supply_srp' => $post['p_supply_srp'][$x]
                 ,'supply_cost' => $post['p_supply_cost'][$x]
            );
                        
            if($isCheck==1 && $id=='')  {                     
                    //insert    
                    $data['created_by'] =current_user()->empl_id;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('supply_brands', $data);

            }else if($isCheck==1 && $id!='')  {                     
                    //update        
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('supply_brand_id', $id);
                    $this->db->update('supply_brands', $data);

            }else if($isCheck==0 && $id!='')  {
                    $this->db->where('supply_brand_id', $id);
                    $this->db->delete('supply_brands');
            }
            
        } //end of loop

    }        
    
    function delete($post){        
        $this->common_model->delete($this->input->post(),"supply_brands","supply_brand_id");        
    }    

}
?>