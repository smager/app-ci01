<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper(array('url'));
        
    }    

	public function index()
	{
         $result = array(         
             array('name'=>'bsLabelInput','url'=> base_url('assets/templates/bsLabelInput.txt'))
            ,array('name'=>'bsLabelSelect','url'=>base_url('assets/templates/bsLabelSelect.txt'))
            ,array('name'=>'bsButton','url'=>base_url('assets/templates/bsButton.txt'))
         );
        
 
        
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ->_display();

        exit;            
        
    }
    
}
