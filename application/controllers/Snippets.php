<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Snippets extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('snippets_model'); 
        $this->load->helper(array('url','zsi'));
        
    }
    
	public function index()
	{
        //$query = $this->db->query('SELECT snippet_name FROM snippets');
        
        /*foreach ($query->result() as $row)
        {
                echo $row->snippet_name;
        }
        */

		$this->load->view('snippets_list');
	}
    
    
    
    public function getjson(){    
        $query = $this->db->query('SELECT * FROM snippets');
        $result=toDHTMLXData($query);
        
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ->_display();

        exit;    
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
