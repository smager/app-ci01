<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class javascripts extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('javascripts_model'); 
    }
    
	public function index()
	{
        check_login();
		$this->load->view('javascripts_list');
	}

	public function generatebackup()
	{
        check_login();
        $this->load->helper('file'); 
         $query = $this->db->query("SELECT CONCAT(REPLACE(page_url, '/', '-') , '.js') as filename,content FROM javascripts");
         $path = "./assets/js/jsdb/";
         
        foreach ($query->result() as $row)
        {
            write_file( $path.$row->filename , $row->content );       
        }
        jsonOut(array("msg"=>"All javascript files successfully created."));
	}    
    
	public function form()
	{
        check_login();
		$this->load->view('javascripts_form');
	}
    
    
    function source(){
        $url =$this->input->get("p_url");
        $query= $this->javascripts_model->getdata_by_url(strtolower($url));
        if($query->num_rows() > 0){
            $source =  $query->result()[0]->content;            
            $this->output
            ->set_content_type('application/javascript')
            ->set_output($source);
        }else{
            $source = '//This is system generated. new javascript created.';
            
            $data = array('page_url' =>  $url, 'content' => $source );
            $this->db->set('created_date', 'NOW()', FALSE);
            $this->db->insert('javascripts', $data);        
            
            $this->output
            ->set_content_type('application/javascript')
            ->set_output($source );   
            
        }
            
    }

    

    public function getdata_json($js_id=null)
	{  
        jsonOut($this->javascripts_model->getdata($js_id)->result());
      
	}   

    public function search()
	{  
        jsonOut($this->javascripts_model->search($this->input->get())->result());      
	}   
  
  
    
    public function update()
	{
        $this->javascripts_model->update($this->input->post());
	}    
    public function delete()
	{
        
        $this->javascripts_model->delete($this->input->post());
	}       
}
