<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Snippets extends Base_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('snippets_model');         
    }
    
	public function index()
	{

        check_login();
		$this->load->view('snippets_list');
	}
    
    
    
    public function getjson(){    
        $chkStart = "<input type=''checkbox'' onclick=''zsi.table.setCheckBox(this,";
        $chkEnd = ");'' />";    
        $hid = "<input name=''p_sel'' type=''hidden'' />";
        
        $query = $this->db->query("SELECT concat('$chkStart', s.snippet_id,'$chkEnd','$hid') AS a,s.* FROM snippets as s");
        $result=toDHTMLXData($query);
        jsonOut($result);  

    }
    
    
    public function form()
	{
        $this->load->view('snippets_form');
	}
    
     public function update()
	{
        $data = array(
             'snippet_name' => $this->input->post('p_snippet_name')
            ,'snippet_content' => $this->input->post('p_snippet_content')
        );

                        
        $this->snippets_model->form_insert($data);
        $data['message'] = 'Data Inserted Successfully';         
         echo "<p>updated.</p>";
        //$this->load->view('snippets_form',$data);
        redirect("snippets/index");

	}
       
    

    
	public function test()
	{
        echo "test";
	}
    
}
