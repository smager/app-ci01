<?php
class common_model extends CI_Model{
    function __construct() {
        parent::__construct();

    }
    
    function delete($post, $table_name, $field_name){            
        $d= $post['p_del_id'];        
        for ($x = 0; $x < sizeof($d); $x++) {
                $this->db->where($field_name,$d[$x] );
                $this->db->delete($table_name);
        }
    }    
    
    function findEmptyKeys($post,$keys,$row_num){
        $result=false;
        for ($x = 0; $x < sizeof($keys); $x++) {
            $keyname="p_" . $keys[$x];            
            if(isset($post[$keyname][$row_num])){
                if($post[$keyname][$row_num]=='') {
                    $result=true;
                    break;
                }
            }
            else{
                 show_error("Wrong spelling wrong dyud na., klaroha imong parameter nga - " . $keys[$x]);
            }
        }    
        return $result;
    }    

    
    //------[ how to use : example ] ----------------/
    /*
    function update($post){    
        
        $params=array(
             'post'=>$post
            //,'pk'=> array('uiKey'=>'bank_ref_id','dbKey'=>'bank_ref_id')
            ,'pk'=> 'bank_ref_id'
            ,'dbKeys'=> array('bank_acctno','bank_acctname','bank_name','depo_pct_share','active')
            //,'uiKeys'=> array('bank_acctno','bank_acctname','bank_name','depo_pct_share','active')
            ,'mustNotEmptyKeys'=> array('bank_acctno')
            ,'mustNotEmptyOnInsert'=> array('bank_acctname')
            ,'table'=>'bank_ref'
        );
        $this->load->model('common_model'); 
        $this->common_model->update($params); 
    }        
    */
    
    function update($params){

        if(isset($params["post"])){   
            if(!isset($params["uiKeys"])) $params["uiKeys"] = $params["dbKeys"];  
            if(!is_array($params["pk"]))  $params["pk"]= array('uiKey'=>$params["pk"], 'dbKey'=>$params["pk"]);
                    
            for ($x = 0; $x < sizeof($params["post"]['p_'. $params["uiKeys"][0]]); $x++) {
                
                $id = $params["post"]['p_' . $params["pk"]["uiKey"]][$x]; 
                
                $isFoundEmptyKeys = $this->findEmptyKeys($params["post"],$params["mustNotEmptyKeys"],$x);
                if($isFoundEmptyKeys==false) {   
                     
                    $data = array();
                    for ($i = 0; $i < sizeof($params["uiKeys"]); $i++) {
                        $data[$params["dbKeys"][$i]] = $params["post"]['p_'. $params["uiKeys"][$i]][$x];
                    }
                    if($id==''){
                        //insert 
                        $isFoundEmptyKeys=false;
                        if(isset($params["mustNotEmptyOnInsert"])) 
                            $isFoundEmptyKeys = $this->findEmptyKeys($params["post"],$params["mustNotEmptyOnInsert"],$x);                        
                        if($isFoundEmptyKeys==false) {                             
                            $data['created_by'] =current_user()->empl_id;
                            $this->db->set('created_date', 'NOW()', FALSE);
                            $this->db->insert($params["table"], $data);
                        }

                    }else{
                        //update                    
                        $data['updated_by'] =current_user()->empl_id;
                        $this->db->set('updated_date', 'NOW()', FALSE);
                        $this->db->where( $params["pk"]["dbKey"], $id);
                        $this->db->update($params["table"], $data);
                    } 

                }//end of - if(isFoundEmptyKeys)

            } //end of loop
        }//end of - if post is set
        
       // exit;
    }
    


}
?>