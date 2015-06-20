<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class Base_Controller extends CI_Controller {    
    public $isShowDatePicker=false;
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url','include','zsi'));
    }    
    
}
