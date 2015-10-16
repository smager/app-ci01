<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class common extends Base_Controller {
    function __construct() {
        parent::__construct();        
    }    

	public function get_select_data($table,$text,$value,$condition='')
	{
        $query = $this->db->query("SELECT $text as text, $value as value  FROM $table");        
        jsonOut($query->result());
        
    }
    
	public function select_data()        
	{
        $l_condition="";
        $d=$this->input->get();
        
        if(isset($d['p_con']))  $l_condition="where " . $d['p_con'];
        $sql = "SELECT  " . $d['p_text'] . " as text, " . $d['p_value'] . " as value  FROM " . $d['p_table'] . " " . $l_condition;        
        $query = $this->db->query( $sql);        
        jsonOut($query->result());
        
    }
    

	public function checkDataExist($table,$field,$value)
	{
	    $value= urldecode($value);
        $str = "SELECT count(*) as value FROM $table WHERE lower($field)=lower('$value')";
        $query = $this->db->query($str);         
        $result = array("exist"=>false);
        if ($query->row()->value > 0 )  $result = array("exist"=>true);
        jsonOut($result);
    }
    
   public function executeproc($sql)
	{
        check_login();
        $params= $this->input->get("p");
        $str = "call $sql($params)"; 
	    $query = $this->db->query($str);
	   jsonOut($query->result());
	} 	

	public function errors_update()        
	{
        
        $d=$this->input->get();
        if( $d['p_url'] !==""){ 
        
            $query = $this->db->query("SELECT url  FROM errors WHERE UPPER(url) = UPPER('" . $d['p_url']  . "');");  
            $occurence = $query->num_rows();
            $data = array(
                         'url'          => $d['p_url']
                        ,'error_type'    => $d['p_error_type']
                        ,'error_message' => $d['p_error_message']
                    );
        
            if($occurence==0){
                //insert      
                $data['occurence'] =1;
                $data['created_by'] =current_user()->empl_id;
                $this->db->set('created_date', 'NOW()', FALSE);
                $this->db->insert('errors', $data);
            }else{
                //update
                $data['occurence'] =$occurence + 1;
                $data['updated_by'] =current_user()->empl_id;
                $this->db->set('updated_date', 'NOW()', FALSE);
                $this->db->where('url',  $d['p_url']);
                $this->db->update('errors', $data);                
                
            }
        }
        
    }
	
}
