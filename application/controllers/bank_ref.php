<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bank_ref extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('bank_ref_model'); 
        $this->load->helper(array('url','zsi','head'));

        
    }
    
	public function index()
	{
  
		$this->load->view('bank_ref_list');
	}
    
    
    
    public function getjson(){    
        $chkStart = "<input type=''checkbox'' onclick=''zsi.table.setCheckBox(this,";
        $chkEnd = ");'' />";    
        $hid = "<input name=''p_sel'' type=''hidden'' />";
        
        $query = $this->db->query("SELECT concat('$chkStart', s.snippet_id,'$chkEnd','$hid') AS a,s.* FROM bank_ref as s");
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
        $this->load->view('bank_ref_form');
	}
    
     public function update()
	{
        $data = array(
             'bank_acctno' => $this->input->post('p_bank_acctno')
            ,'bank_acctname' => $this->input->post('p_bank_acctname')
            ,'active' => $this->input->post('p_active')
        );

                        
        $this->bank_ref_model->form_insert($data);
        $data['message'] = 'Data Inserted Successfully';         
         echo "<p>updated.</p>";
        //$this->load->view('bank_ref_form',$data);
        redirect("bank_ref/index");

	}
       
   
    
}
