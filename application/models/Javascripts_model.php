<?php
class javascripts_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata($id=null){
        $where ="";        
        if(isset($id) || $id!=null )  $where ="where js_id=$id";      
        $query = $this->db->query("SELECT * FROM javascripts $where");
        return $query;    
    }
    
    function getdata_by_url($url=''){
        $where ="";        
        if($url!='' )  $where ="where page_url='$url'";    
        $query = $this->db->query("SELECT * FROM javascripts $where");
        return $query;    
    }
        
    function update($post){
       $id=$post['p_js_id'];
        $data = array(
             'js_id' =>$id
            ,'page_url' =>  $post['p_page_url']
            ,'content' => $post['p_content']
        );
        if($id==''){
            //insert        
            $data['created_by'] =current_user()->empl_id;
            $this->db->set('created_date', 'NOW()', FALSE);
            $this->db->insert('javascripts', $data);

        }else{//update                        

            //get version id        
            $info = $this->db->query("SELECT version_id FROM javascripts where js_id=" . $post['p_js_id'] )->result()[0];

            $data['updated_by'] =current_user()->empl_id;
            $this->db->set('updated_date', 'NOW()', FALSE);
            $this->db->set('version_id', intval($info->version_id) + 1, FALSE);
            $this->db->where('js_id', $id);
            $this->db->update('javascripts', $data);
        } 

    }        
    
    function delete($post){        
        $this->common_model->delete($this->input->post(),"javascripts","js_id");        
    }    

}
?>