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
            ,array('name'=>'bsLabelYesNo','url'=>base_url('assets/templates/bsLabelYesNo.txt'))
            ,array('name'=>'bsButton','url'=>base_url('assets/templates/bsButton.txt'))
         );
        jsonOut($result);         
        
    }
    
}
