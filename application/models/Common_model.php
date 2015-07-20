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
        $msg = "Wrong spelling wrong dyud na., klaroha imong parameter nga - ";
        $result=false;
        for ($x = 0; $x < sizeof($keys); $x++) {
            $keyname="p_" . $keys[$x];                 
            if(!isset($post[$keyname])) show_error($msg . $keys[$x]);
            if(is_array($post[$keyname])){
                //multiple
                if(isset($post[$keyname][$row_num])){
                    if($post[$keyname][$row_num]=='') {
                        $result=true;
                        break;
                    }
                }
                else{
                     show_error( $msg . $keys[$x]);
                }
            }
            else{
                //single
                if(isset($post[$keyname])){
                    if($post[$keyname]=='') {
                        $result=true;
                        break;
                    }
                }
                else{
                     show_error($msg . $keys[$x]);
                }                
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
    
    function update($post,$params){       
        $returnid=0;
        if( isset($params["parent"])){            
            try {
                $this->db->trans_begin();
                //transform parameters
                //parent and details insert/update            
                $parent = $params["parent"];

                //parent:
                if(isset($parent["table"])){    
                    $parentParams =  array(
                         'pk'=> $parent['pk']
                        ,'dbKeys'=> $parent['dbKeys'] 
                        ,'table'=>$parent['table']                        
                    );
                    if(isset($parent['uiKeys']))  $parentParams['uiKeys'] = $parent['uiKeys']; 
                    if(isset($parent['mustNotEmptyKeys']))  $parentParams['mustNotEmptyKeys'] = $parent['mustNotEmptyKeys']; 
                    if(isset($parent['mustNotEmptyOnInsert']))  $parentParams['mustNotEmptyOnInsert'] = $parent['mustNotEmptyOnInsert']; 
                    if(isset($parent['onBeforeInsertUpdate']))  $parentParams['onBeforeInsertUpdate'] = $parent['onBeforeInsertUpdate']; 
                    if(isset($parent['onInsertUpdate']))  $parentParams['onInsertUpdate'] = $parent['onInsertUpdate']; 
                    
                    if(isset($parent['allowNull']))  $parentParams['allowNull'] = $parent['allowNull']; 

                    $parentId = $this->processInsertUpdate($post,$parentParams);
                }
                else{
                    $parentId = $post["p_" . $parent["pk"]];
                }
                
                //details:  
                if(!isset($params["details"]))  show_error("Wala man kay detail array(), pero naa kay parent array(), <br />klaroha kuno para dili ko maglibog.");
                $detail = $params["details"];

                //parent:
                $detailParams =  array(
                     'pk'=> $detail['pk']
                    ,'dbKeys'=> $detail['dbKeys'] 
                    ,'table'=>$detail['table']                        
                );
                if(isset($detail['uiKeys']))  $detailParams['uiKeys'] = $detail['uiKeys']; 
                if(isset($detail['mustNotEmptyKeys']))  $detailParams['mustNotEmptyKeys'] = $detail['mustNotEmptyKeys']; 
                if(isset($detail['mustNotEmptyOnInsert']))  $detailParams['mustNotEmptyOnInsert'] = $detail['mustNotEmptyOnInsert']; 
                if(isset($detail['onBeforeInsertUpdate']))  $detailParams['onBeforeInsertUpdate'] = $detail['onBeforeInsertUpdate']; 
                if(isset($detail['onInsertUpdate']))  $detailParams['onInsertUpdate'] = $detail['onInsertUpdate']; 
                    
                $parentKeyValue = array(
                    'key' => $parent['pk']
                    ,'value' => $parentId
                );
                $returnId=$parentId;
                $this->processInsertUpdate($post,$detailParams,$parentKeyValue);                                
                $this->db->trans_commit();
            }            
            catch (Exception $e) {
                $this->db->trans_rollback();
            }            
            
        }else{
            //single and multiple insert
            $returnId = $this->processInsertUpdate($post,$params);
        }

        return $returnId;
    }
     
    function verifyValue($p_name,$value){
        $result=$value;
        if( strpos(strtolower($p_name), "date") > 0 ) $result = date('Y-m-d', strtotime($value));
        return $result;
    }
    
    function processInsertUpdate($post,$params,$parentKeyValue=null){    
        $returnId=0;
        if(isset($post)){  
            $p = $post;
            if(!isset($params["uiKeys"])) $params["uiKeys"] = $params["dbKeys"];  
            if(!is_array($params["pk"]))  $params["pk"]= array('uiKey'=>$params["pk"], 'dbKey'=>$params["pk"]);
                    
            for ($x = 0; $x < sizeof($p['p_'. $params["uiKeys"][0]]); $x++) {                
                    
                $keyname =  'p_' . $params["pk"]["uiKey"];
                
                
                if(!isset($p[$keyname])) show_error("Naa diay ni siya nga parameter sa imong form? $keyname");
                
                if(is_array($p[$keyname]))                 
                    $id = $p[$keyname][$x];
                else
                    $id = $p[$keyname];                    
                
                $isFoundEmptyKeys=false;
                if(isset($params["mustNotEmptyKeys"]))    
                    $isFoundEmptyKeys = $this->findEmptyKeys($p,$params["mustNotEmptyKeys"],$x);
                
                if($isFoundEmptyKeys==false) {   
                     
                    $data = array();
                    for ($i = 0; $i < sizeof($params["uiKeys"]); $i++) {
                        $p_uiName = 'p_' . $params["uiKeys"][$i];
                        
                        if(!isset($p[$p_uiName]) ){
                            if( !isset($params['allowNull'])  || $params['allowNull']==false ) {   
                                show_error("Wala may parameter nga " . $p_uiName . " brad!");
                            }                            
                        }
                        else{// if set
                            $p_uiKey = $p[$p_uiName];
                            if(is_array($p_uiKey))
                                $data[$params["dbKeys"][$i]] = $this->verifyValue($p_uiName,$p_uiKey[$x]);
                            else 
                                $data[$params["dbKeys"][$i]] = $this->verifyValue($p_uiName,$p_uiKey); 
                        }
                        
                    }
                                        
                    if($id==''){
                        //insert 
                        if($parentKeyValue!=null){
                            $data[$parentKeyValue["key"]]=$parentKeyValue["value"]; 
                        }
                        
                        $isFoundEmptyKeys=false;
                        if(isset($params["mustNotEmptyOnInsert"])) 
                            $isFoundEmptyKeys = $this->findEmptyKeys($p,$params["mustNotEmptyOnInsert"],$x);   
                        
                        if($isFoundEmptyKeys==false) {                                
                            if(isset($params['onBeforeInsertUpdate'])){
                                $obj = $params['onBeforeInsertUpdate'];
                                if(method_exists($obj,"onBeforeInsert")) $obj->onBeforeInsert($post,$data,$x);
                            }                                                        
                            $data['created_by'] =current_user()->empl_id;
                            $this->db->set('created_date', 'NOW()', FALSE);
                            $this->db->insert($params["table"], $data);
                            $returnId = $this->db->insert_id();
                            //trigger invoked insert event
                            if(isset($params['onInsertUpdate'])){
                                $obj = $params['onInsertUpdate'];
                                if(method_exists($obj,"onInsert")) $obj->onInsert($returnId,$post,$data,$x);
                            }
                                            
                        }

                    }else{
                        //update    
                        $returnId = $id;
                        if(isset($params['onBeforeInsertUpdate'])){
                            $obj = $params['onBeforeInsertUpdate'];
                            if(method_exists($obj,"onBeforeUpdate")) $obj->onBeforeUpdate($post,$data,$x);
                        }                         
                        $data['updated_by'] =current_user()->empl_id;
                        $this->db->set('updated_date', 'NOW()', FALSE);
                        $this->db->where( $params["pk"]["dbKey"], $id);
                        $this->db->update($params["table"], $data);
                        //trigger invoked insert event
                        if(isset($params['onInsertUpdate'])){
                            $obj = $params['onInsertUpdate'];
                            if(method_exists($obj,"onUpdate")) $obj->onUpdate($returnId,$post,$data,$x);
                        }
                        
                    } 

                }//end of - if(isFoundEmptyKeys)

            } //end of loop
        }//end of - if post is set        
        
        return $returnId;
    }
    
    
    
    


}
?>