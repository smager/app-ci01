<?php
class purchase_order_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM po");
        return $query;    
    }

    function getdata_dtls($id){
        $query = $this->db->query("SELECT * FROM po_dtls where po_id=" . $id);
        return $query;    
    }

    
        
        
    
    function update($post){

        $po_id =  $post['p_po_id'];   
        $data = array(
             'po_id' =>$po_id
            ,'po_no' => $post['p_po_no']
            ,'po_date' =>   date('Y-m-d', strtotime($post['p_po_date']))  
            ,'loc_id' => $post['p_loc_id']
            ,'supplier_id' => $post['p_supplier_id']
        );

        if($po_id==''){
            //insert        
            $data['created_by'] =current_user()->empl_id;
            $this->db->set('created_date', 'NOW()', FALSE);
            $this->db->insert('po', $data);
            $po_id = $this->db->insert_id();

        }else{
            //update                        
            $data['updated_by'] =current_user()->empl_id;
            $this->db->set('updated_date', 'NOW()', FALSE);
            $this->db->where('po_id', $po_id);
            $this->db->update('po', $data);
        }      
        
        
        //detail        
        for ($x = 0; $x < sizeof($post['p_po_dtls_id']); $x++) {
            $id = $post['p_po_dtls_id'][$x];
            $po_qty = $post['p_po_qty'][$x];
            
            if($po_qty!=''){
                $data = array(
                     'po_id' => $po_id
                    ,'supply_brand_id' => $post['p_supply_brand_id'][$x]
                    ,'po_qty' => $po_qty
                    ,'unit_price' => $post['p_unit_price'][$x]
                );


                if($id==''){
                    //insert        
                    $data['created_by'] =current_user()->empl_id;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('po_dtls', $data);

                }else{
                    //update                        
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('po_dtls_id', $id);
                    $this->db->update('po_dtls', $data);
                } 
            }
            
            
     } //end of loop

    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"po","po_id");        
    }    

}
?>