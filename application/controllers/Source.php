<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class source extends Base_Controller {
    function __construct() {
        parent::__construct();      
    }
    
	public function index()
	{
        check_login();
        $this->load->helper('directory');
        $data["controllers"]  = $this->dir_map_sort(directory_map('./application/controllers'));
        $data["models"]  = $this->dir_map_sort(directory_map('./application/models'));        
        $data["views"]  = $this->dir_map_sort(directory_map('./application/views'));
        $data["css"]  = $this->dir_map_sort(directory_map('./assets/css'));
        $this->load->view('source_view',$data);                
	}
    
    
    
    function dir_map_sort($array)
    {
        $items = array();
        foreach ($array as $key => $val)
        {
            if (is_string($val)){           
                $items[$val] = $val;
            }
        }

        ksort($items); 
        return $items;
    }
     
    
}
