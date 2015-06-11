<?php
class menu_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    
    function getMenus(){
        $html='';
        $q=$this->menu_types_model->getdata();
        $d=$q->result();
        $html= $html .  '<ul class="nav navbar-nav">'; 
        foreach($d as $i){
            
            $html= $html .   '<li class="dropdown"><a href="#">' . $i->menu_type . '</a>';

                     $q_mi=$this->menu_model->getSubMenuItem($i->menu_type_id);
                      if($q_mi->num_rows() > 0){
                        $html= $html .  '<ul class="dropdown-menu">'; 
                        foreach($q_mi->result() as $subM){                    
                             $html=  $html .   '<li><a href="#">' . $subM->menu_name . '</a></li>';
                        }
                        $html= $html .  '</ul>';              
                     }


            $html= $html .   '</li>'; 

        }
        $html= $html .   '</ul>';     
        
        return $html;
    
    }
    
    
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM menu");
        return $query;    
    }
    
    function getSubMenuItem($id){
        
          $query = $this->db->get_where('menu', array('menu_type_id' => $id) );
        return $query;    
    }
    
    function update($post){
    //print_r($post);
        
        for ($x = 0; $x < sizeof($post['p_menu_name']); $x++) {
            $id = $post['p_menu_id'][$x];
            $menu_name = $post['p_menu_name'][$x];
            
            if($menu_name !='') {        

                $data = array(
                     'menu_name' => $menu_name
                    ,'seq_no' => $post['p_seq_no'][$x]
                    ,'menu_url' => $post['p_menu_url'][$x]
                    ,'menu_type_id' => $post['p_menu_type_id'][$x]
                    ,'system_id' => $post['p_system_id'][$x]
                );
                
                
                
                if($id==''){
                    //insert        
                    $data['created_by'] =current_user()->empl_id;
                    $this->db->set('created_date', 'NOW()', FALSE);
                    $this->db->insert('menu', $data);

                }else{
                    //update                        
                    $data['updated_by'] =current_user()->empl_id;
                    $this->db->set('updated_date', 'NOW()', FALSE);
                    $this->db->where('menu_id', $id);
                    $this->db->update('menu', $data);
                } 
                
            }//end of no data 
            
            
            
     } //end of loop

    }        
    
    function delete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"menu","menu_id");        
    }    

}
?>