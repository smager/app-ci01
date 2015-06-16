<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class users extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('users_model'); 
        $this->load->library('session');
        $this->load->helper(array('url','zsi','include'));
    }
    
	public function index()
	{
        check_login();
		$this->load->view('users_list');
	}
    
	public function login()
	{

        $isSuccess = $this->users_model->authenticate($this->input->post());
        
        if ($isSuccess==false )  {
            $data = array( 
                 'err_title'=>"Please re-enter your password."
                ,'err_message'=>"The password you entered is incorrect. Please try again (make sure your caps lock is off)."

            );
            
            $this->load->view('welcome_message', $data);
        }
        else{
            redirect( base_url() );        
        }
        
        
	}  
	public function logout()
	{
        $this->session->unset_userdata('current_user');
        redirect( base_url() );            
    }

    public function getdata_json(){
    
        jsonOut($this->users_model->getdata()->result());
        
    }    
    
    
    
    public function update()
	{
        $this->users_model->update($this->input->post());
        redirect( base_url("users") );
      
	}    
   

    public function delete()
	{
        
        $this->users_model->delete($this->input->post());
	}   
    
}
