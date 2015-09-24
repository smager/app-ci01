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
        $str = "SELECT count(*) as value FROM $table WHERE lower($field)=lower('$value')";
        $query = $this->db->query($str);         
        $result ='{"exist":false}';
        if ($query->row()->value > 0 )  $result  = '{"exist":true}';
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
	
}
