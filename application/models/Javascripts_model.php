<?php
class javascripts_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata($id=0){
        $where ="";        
        if(isset($id) || $id==0 )  $where ="where js_id=$id";        
        $query = $this->db->query("SELECT * FROM javascripts $where");
        return $query;    
    }
    
    function update($post){
       
        $data = array(
             'p_js_id' =>$post['p_js_id']
            ,'p_page_url' =>  $post['p_page_url']
            ,'p_content' => $post['p_content']
        );



        if($id==''){
            //insert        
            $data['created_by'] =1;
            $this->db->set('created_date', 'NOW()', FALSE);
            $this->db->insert('javascripts', $data);

        }else{//update                        

            //get version id        
            $info = $this->db->query("SELECT version_id FROM javascripts where js_id=" . $post['p_js_id'] )->result()[0];

            $data['updated_by'] =1;
            $this->db->set('updated_date', 'NOW()', FALSE);
            $this->db->set('version_id', intval($info->version_id) + 1, FALSE);
            $this->db->where('js_id', $id);
            $this->db->update('javascripts', $data);
        } 


    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"javascripts","js_id");        
    }    

}
?>