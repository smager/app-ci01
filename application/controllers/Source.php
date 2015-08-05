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
    
	public function form()
	{
        check_login();
		$this->load->view('source_form');
	}    
    
	public function get_content($codePath,$fileName)
	{
        check_login();
        $this->load->helper('file');         
        $path= $this->getCodePath($codePath);
        $string = read_file($path.$fileName);
		echo $string;
	}   
    
    function getCodePath($code){
        $path="";
        switch($code){
            case "m" : $path = "./application/models/"; break;
            case "v" : $path = "./application/views/"; break;
            case "c" : $path = "./application/controllers/"; break;
            case "css" : $path = "./assets/css/"; break;
            
            default:break;
        }        
        return $path;
    }
    
    
    
    function getExt($filename)            
	{
        return substr(strrchr($filename,'.'),1);
    
    }
    
 
    public function update()            
	{
        $this->load->helper('file');    
        $codepath = $this->input->post("p_codepath");
        $filename = $this->input->post("p_filename");
        $content  = $this->input->post("p_content");    
        $path= $this->getCodePath($codepath);        
        $query = $this->db->query("select content from revision_logs where filename='$filename' order by created_date DESC limit 20"  );        
        $isEqualContent=false;
        if ($query->num_rows() > 0){
            $dbInfo = $query->result()[0]; 
            
            //compare
            if($dbInfo->content !== $content){
                $this->insert($filename,$path,$content);
            }else{
                $isEqualContent=true;
            }
            
            if ($query->num_rows() > 4){ //limit is 5 records only
                $revision_id = $this->db->query("select revision_id from revision_logs where filename='$filename' order by created_date limit 1")->result()[0]->revision_id;
                $this->db->where("revision_id",$revision_id );
                $this->db->delete("revision_logs");
            }
        }
        else{
            $this->insert($filename,$path,$content);
        }
        $result = array("msg" =>"success");  
        if($isEqualContent==false){
            if (!write_file( $path.$filename, $content)) 
                $result = array("msg" =>"error");
        }
        jsonOut($result);
    }    
    
    function insert($filename,$path,$content){
    
           $data = array(
                 'filename' => $filename
                ,'path' => $path
                ,'content' => $content  
                ,'filetype' => $this->getExt($filename)
            );
            $data['created_by'] =current_user()->empl_id;
            $this->db->set('created_date', 'NOW()', FALSE);
            $this->db->insert('revision_logs', $data);
        
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
