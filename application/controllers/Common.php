<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class common extends CI_Controller {
    function __construct() {
        parent::__construct();
         $this->load->database();
        $this->load->helper(array('url'));
        
    }    

	public function get_select_data($table,$text,$value,$condition='')
	{
        $query = $this->db->query("SELECT $text as text, $value as value  FROM $table");        
        
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($query->result(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ->_display();

        exit;            
        
    }
    
}