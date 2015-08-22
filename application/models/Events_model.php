<?php
class events_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function getdata(){
        $query = $this->db->query("SELECT * FROM events");
        return $query;    
    }
    
    function update($post){            
        $params=array(
             'pk'=> 'event_id'
            ,'dbKeys'=> array('event_desc')
            ,'mustNotEmptyKeys'=> array('event_desc')
            ,'mustNotEmptyOnInsert'=> array('event_desc')
            ,'table'=>'events'
        );
        $this->common_model->update($post,$params); 
    }

    function delete($post){        
        $this->common_model->delete($this->input->post(),"events","events_id");        
    }    

}
?>