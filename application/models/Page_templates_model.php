<?php
class page_templates_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata($id=null){
        $where ="";        
        if(isset($id) || $id!=null )  $where ="where page_template_id=$id";      
        $query = $this->db->query("SELECT * FROM page_templates $where");
        return $query;    
    }
    
    function getdata_by_url($url=''){
        $where ="";        
        if($url!='' )  $where ="where page_url='$url'";    
        $query = $this->db->query("SELECT * FROM page_templates $where");
        return $query;    
    }
        
    function update($post){
       $id=$post['p_page_template_id'];
        $data = array(
             'page_template_id' =>$id
            ,'page_url' =>  $post['p_page_url']
            ,'content' => $post['p_content']
        );
        if($id==''){
            //insert        
            $data['created_by'] =current_user()->empl_id;
            $this->db->set('created_date', 'NOW()', FALSE);
            $this->db->insert('page_templates', $data);

        }else{//update                        

            $data['updated_by'] =current_user()->empl_id;
            $this->db->set('updated_date', 'NOW()', FALSE);
            $this->db->where('page_template_id', $id);
            $this->db->update('page_templates', $data);
        } 
    }        
    
    function delete($post){        
        $this->common_model->delete($this->input->post(),"page_templates","page_template_id");        
    }    

}
?>