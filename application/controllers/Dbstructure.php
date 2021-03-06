<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dbstructure extends Base_Controller {
    function __construct() {
        parent::__construct();
        //$this->load->model($this->router->fetch_class() . '_model'); 
    }
    
  
	public function index()
	{
        check_login();
        $data["tables"] = $this->db->query("show full tables")->result_array();        
        $this->load->view('dbstructure_view',$data);
	}    
    
	public function db()
	{
        check_login();
        $this->load->view('default_view');
	}
	
	public function generatebackup()
	{
        check_login();
        $this->load->helper('file'); 
         $path = "./database/structure/dbfiles/";
         $content="";

         $query = $this->db->query("select 	content from dbstructures where object_type='function' order by seq_no;");
        foreach ($query->result() as $row)
        {   
              if($content!=="") $content .="\r\n\r\n";
              $content .= $row->content;
        }
        
        $content .="\r\n\r\n\r\n/*PROCEDURES*/\r\n";
         $query = $this->db->query("select 	content from dbstructures where object_type='procedure' order by seq_no;");
        foreach ($query->result() as $row)
        {   
              $content .="\r\n\r\n";
              $content .= $row->content;
        }
        
        write_file( $path."1.Proc_Func.sql" ,$content );   
        
         $content="";
         $query = $this->db->query("select 	content from dbstructures where object_type='table' order by seq_no;");
        foreach ($query->result() as $row)
        {   
              if($content!=="") $content .="\r\n\r\n";
              $content .= $row->content;
        }
        
        $content .="\r\n\r\n\r\n/*VIEWS*/\r\n";
         $query = $this->db->query("select 	content from dbstructures where object_type='view' order by seq_no;");
        foreach ($query->result() as $row)
        {   
              $content .="\r\n\r\n";
              $content .= $row->content;
        }

        write_file( $path."2.tables_views.sql" ,$content );   
        jsonOut(array("msg"=>"All database files successfully created."));
	} 
	
    
	public function getdata($objectType='')
	{
        $where ="";
        if($objectType!='')  $where = "where object_type='$objectType'";
        $sql="SELECT * FROM dbstructures $where ORDER BY object_type,seq_no,object_name";
        $query = $this->db->query($sql);        
        jsonOut($query->result());        
	}

   
    public function dbupdate(){
        $params=array(
             'pk'=> 'dbstruct_id'
            ,'dbKeys'=> array('seq_no')
            ,'mustNotEmptyKeys'=> array('seq_no')
            ,'table'=>'dbstructures'
        );
        $this->common_model->update($this->input->post(),$params);           
    }        
    
    function dbdelete($post){        
        $this->load->model('common_model'); 
        $this->common_model->delete($this->input->post(),"dbstructures","dbstruct_id");        
    }    
    
	public function tables()
	{
        check_login();
        $data["tables"] = $this->db->query("show full tables where Table_Type = 'BASE TABLE'")->result_array();        
        $this->load->view('dbstructure_view',$data);
	}
    
	public function views()
	{
        check_login();
        $data["tables"] = $this->db->query("show full tables where Table_Type = 'VIEW'")->result_array();        
        $this->load->view('dbstructure_view',$data);
	}
        
	public function procedures()
	{
        check_login();
        $data["tables"] = $this->getProceduresAndFunctions('procedure');        
        $this->load->view('dbstructure_view',$data);    
	}
    
	public function functions()
	{
        check_login();
        $data["tables"] = $this->getProceduresAndFunctions('function');        
        $this->load->view('dbstructure_view',$data);    
	}  
    
    public function procs_funcs()
	{
        check_login();
        $procs = $this->getProceduresAndFunctions('procedure');  
        $funcs = $this->getProceduresAndFunctions('function');        
        $data["tables"] = array_merge($procs,$funcs);
        $this->load->view('dbstructure_view',$data);    
	}    
        
    
    function getProceduresAndFunctions($type){
    
        $dbname = $this->db->database;
        $dbResult = $this->db->query("show $type status where db='$dbname'")->result_array();     
        $data = array();
        foreach($dbResult as $row){
            array_push(
                 $data
                ,array("name" =>  $row["Name"], "type"=>  $row["Type"])
            );
         }
        return $data; 

    }
    
    
    public function getddl($name,$type=''){
        check_login();
        $type=strtoupper($type);
         $query = $this->db->query("SHOW CREATE $type $name");
         if($type=='TABLE' || $type=='VIEW'){
            $data["info"]  = array_values($query->row_array())[1];
         }else{
            $data["info"]  = array_values($query->row_array())[2];         
         }        
         $this->load->view('dbstructure_info_view',$data);        
    }
    
    public function getcode($name,$type=''){
        check_login();
        $content="";
        $isTableViews=false;
         $query= $this->db->query("select content from dbstructures where object_name='$name' limit 1");
        if($query->num_rows() > 0){
            $content=$query->result()[0]->content;
        }else{
            $type=strtoupper($type);
            if($type=="TABLE" || $type=="VIEW"){
                $isTableViews=true;
            }            
            $sql= "SHOW CREATE $type $name";
            $query = $this->db->query($sql);  
            
            if($isTableViews)
                $content= array_values($query->row_array())[1];
            else
                $content= array_values($query->row_array())[2];
        }
        echo $content;               
    }    
    
    
    public function edit($name='',$type=''){  
        check_login();
        $data["object_name"] = $name;
        $data["object_type"] = $type;
        $this->load->view('dbstructure_edit_view',$data);
    }    

    public function sql(){
        check_login();
        $this->load->view('dbstructure_sql_view');
    }  

    public function runsql(){
        check_login();
        $sql = $this->input->post("p_sql");
        $query= $this->db->query($sql);
        
        if(gettype($query)=="object"){
            if($query->num_rows() >0){
                jsonOut( $query->result());
            }
        }
        else{
            jsonOut(array(array("Result"=>(int)$query)));            
        }
        
    }  
 
    
    public function update()
	{
        $table          = 'dbstructures';
        $post           = $this->input->post();
        $object_name    = $post['p_object_name'];  
        $object_type    = $post['p_object_type'];
        $content        = $post['p_content'];
        $overwrite      = $post['p_overwrite'];
        $dbstruct_id=0;
        $isFound        =false;

        //check source exist;
        $query= $this->db->query("select dbstruct_id from $table where object_name='$object_name' limit 1");
        if($query->num_rows() > 0){
            $info=$query->result()[0];
            $dbstruct_id=$info->dbstruct_id;
            $isFound=true;
        }
        //set parametters
        $data = array(
             'object_name' =>  $object_name
            ,'content '=>  $post['p_content']
            ,'object_type'=>  $object_type
        );     

        if($isFound==false){
            //insert        
            $data['created_by'] =current_user()->empl_id;
            $this->db->set('created_date', 'NOW()', FALSE);
            $this->db->insert($table, $data);
            $dbstruct_id = $this->db->insert_id();

        }else{
            //update                        
            $data['updated_by'] =current_user()->empl_id;
            $this->db->set('updated_date', 'NOW()', FALSE);
            $this->db->where('dbstruct_id', $dbstruct_id);
            $this->db->update($table, $data);
        }         
        
        if($overwrite==1){
            if($object_type=='table'){
                $this->db->query("DROP TABLE IF EXISTS $object_name");
            }else if($object_type=='function' || $object_type=='procedure'){
                $this->db->query("DROP $object_type IF EXISTS $object_name");
            }
        }
        
        //create cotent to physical db objects.
        return $this->db->query($content);
	}    
   
    
}
