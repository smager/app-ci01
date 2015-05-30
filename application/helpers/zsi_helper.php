<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if ( ! function_exists('get_dhtmlx_path'))
{   function get_dhtmlx_path(){
          return base_url('assets/dhtmlx36'); 
    }
}


if ( ! function_exists('getRowItems'))
{

        function getRowItems($row){
            
            $data = array();
            foreach($row as $item)
            {
                array_push($data,$item);

            }
            return $data;
        }                     

}
if ( ! function_exists('toDHTMLXData'))
{
        function toDHTMLXData($query){
            $data = array();
            $ctrl =0;
            foreach ($query->result() as $row)
            {
                $data[$ctrl]['id'] = $ctrl;                 
                $data[$ctrl]['data'] = getRowItems($row); 
                $ctrl++;
            }
            return array("rows"=> $data);
        }
}

if ( ! function_exists('inputTextBox'))
{    
    function inputTextBox($p){
        /*
            properties:        
                 labelName, name, inputValue, labelSize, inputSize, type='text' 
                 ,placeholder, inputclass,$attributes
        */     
    
        $default_label_size_type  ='xs';
        $default_label_size       ='2';
        $default_input_size       ='10';
        $default_button_size      ='sm';

        $l_placeholder='';
        $l_attributes='';
        $l_label='';
        $l_inputValue='';
        $l_inputclass='';
        
        $l_labelSize=' col-' . $default_label_size_type . '-' . $default_label_size;
        $l_inputSize=' col-' . $default_label_size_type . '-' . $default_input_size;
        $l_type=' type="text"';
        
        
        if (isset($p["labelSize"]) ) $l_labelSize=' col-' . $default_label_size_type . '-' . $p["labelSize"];

        if (isset($p["inputSize"]) ) $l_inputSize =' col-' . $default_label_size_type . '-' . $p["inputSize"];

        if (isset($p["inputValue"]) )  $l_inputValue =' value="' . $p["inputValue"] . '"';

        if (isset($p["type"]) ) $l_type =' type="' . $p["type"] . '"';
        
        if (isset($p["inputclass"]) )  $l_inputclass=$p["inputclass"];        
        
        if (isset($p["placeholder"]))  $l_placeholder =' placeholder="' . $p["placeholder"] . '"';

        if (isset($p["attributes"] ) )  $l_attributes =' ' . $p["attributes"];

        if (isset($p["labelName"])) 
            $l_label='  <label class="' . $p["labelSize"] .' control-label" >' . $p["labelName"] . '</label>';

        echo '<input ' . $l_type . ' class="form-control input-sm ' .  $l_inputclass .  '" id="p_' . $p["name"] . '" name="p_' . $p["name"] . '" ' . $l_inputValue . $l_placeholder . $l_attributes . '>';


            
    }
}


if ( ! function_exists('yes_no'))
{    
    function yes_no($p=null){
        /*
            properties:        
        */    
        $default_label_size_type  ='xs';
        $default_label_size       ='2';
        $default_input_size       ='10';
        $default_button_size      ='sm';
    
        $l_openGroup   ='';
        $l_closeGroup  ='';
        $l_label_size  =' col-' . $default_label_size_type . '-' . $default_label_size;
        $l_select_size =' yesno-td';
        $l_label       ='';
        $l_name = '';
        $l_attributes ='';

        if(isset($p)==false ){
            echo "no parameter supplied";
            exit;
        }else{
        
            if(isset($p["name"]) ==false ){
                echo "parameter name not supplied";
                exit;            
            }
        }
       
        
        //if(isset($p["label_size"]) ) $l_label_size =' col-' . $l_default_label_size_type . '-' . p_label_size;
        //if(isset($p["select_size"]) ) $l_select_size ='col-' . $l_default_label_size_type . '-' . p_select_size;
        //if(isset($p["label_name"]) ) $l_label ='<label class="' . $l_label_size .' control-label" >' . p_label_name . '</label>';

        $l_name = $p["name"];
        if(isset($p["attributes"]) )    $l_attributes   =$p["attributes"];

        
        echo '<select class="form-control input-sm" id="p_' . $l_name . '" name="p_' . $l_name . '" ' . $l_attributes . '>';

        
        
        if(isset($p["mandatory"]) ){
            if( $p["mandatory"]=='N' ) echo '<option value=""></option>';
        }

        if(isset($p["value"])){
            if($p["value"]=="1"){
                echo '<option value="1" selected>Yes</option>';
                echo '<option value="0">No</option>';
            }else{
                echo '<option value="1">Yes</option>';
                echo '<option value="0" selected>No</option>';
            }
        }else{
            echo '<option value="1">Yes</option>';
            echo '<option value="0">No</option>';
        }

        echo '</SELECT>';
       
            
    }
}


if ( ! function_exists('checkbox'))
{    
    function checkbox($p=null){
        /*
            properties:        
        */    
     
        $l_name = '';
        $l_attributes ='';
        $l_class ='';        
        $l_value ='';

        if(isset($p)==false ){
            echo "no parameter supplied";
            exit;
        }else{
        
            if(isset($p["name"]) ==false ){
                echo "parameter name not supplied";
                exit;            
            }
        }
       
        
        $l_name = $p["name"];
        if(isset($p["attributes"]) )    $l_attributes = $p["attributes"];        
        if(isset($p["value"]) )         $l_value = $p["value"];
        if(isset($p["class"]) )         $l_class = $p["class"];

        
        echo '<input type="checkbox" id="p_' . $l_name . '" name="p_' . $l_name . '" class="'. $l_class .'" ' . $l_attributes . '>';
        echo '<input type="hidden" id="p_hid_' . $l_name . '" name="p_hid_' . $l_name . '" value="' . $l_value  . '">';

            
    }
}
