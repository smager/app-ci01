<?php
class select_options_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM select_options order by code");
        return $query;    
    }

    function getdata_by_code($code,$get){
        $query = $this->db->query("SELECT * FROM select_options where code='$code'");
        $result=null;
        
        if($query->num_rows()>0) {
            $i = $query->result()[0];
            
            $l_condition="where 1=1";        
            $l_order_by = " order by " . $i->text ; 
            
            //database where condition
            if($i->condition_text!='' )  $l_condition .=" and " . $i->condition_text;          
            
            //order by
            if($i->order_by!='' )  $l_order_by = " order by " . $i->order_by;          

            //client where condition
            if(isset($get["where"])) $l_condition .= " and " . $get["where"];
            
            
            $sql = "SELECT  " . $i->text . " as text, " . $i->value  . " as value  FROM " . $i->table_name  . " " . $l_condition . $l_order_by ;               
            $result = $this->db->query($sql);
        }
        return $result;    
    }  
        
    function update($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_select_id']); $x++) {
            $id = $post['p_select_id'][$x];
            $code = $post['p_code'][$x];
            
            if($code !='') {        

                $data = array(
                     'code' => $code
                    ,'table_name' => $post['p_table_name'][$x]
                    ,'text' => $post['p_text'][$x]
                    ,'value' => $post['p_value'][$x]
                    ,'condition_text' => $post['p_condition_text'][$x]
                    ,'order_by' => $post['p_order_by'][$x]

                );

                if($id==''){
                    //insert        
                    $data['created_by'] =current_user()->empl_id;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('select_options', $data);

                }else{
                    //update                        
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('select_id', $id);
                    $this->db->update('select_options', $data);
                } 
                
            }//end of no data 

     } //end of loop

    }        
    
    function delete($post){        
        $this->common_model->delete($this->input->post(),"select_options","select_id");        
    }    

}
?>