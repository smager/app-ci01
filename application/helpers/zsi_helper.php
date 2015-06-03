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

if ( ! function_exists('hiddenBox'))
{    
    function hiddenBox($p){
        $l_value = '';
        if(isset($p["value"])) $l_value =' value="' . $p["value"] . '"'; 
        echo '<input type="hidden" id="p_' . $p["name"] . '" name="p_' . $p["name"] . '" ' . $l_value . '>';        
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

        if (isset($p["value"]) )  $l_inputValue =' value="' . $p["value"] . '"';

        if (isset($p["type"]) ) $l_type =' type="' . $p["type"] . '"';
        
        if (isset($p["inputclass"]) )  $l_inputclass=$p["inputclass"];        
        
        if (isset($p["placeholder"]))  $l_placeholder =' placeholder="' . $p["placeholder"] . '"';

        if (isset($p["attributes"] ) )  $l_attributes =' ' . $p["attributes"];

        if (isset($p["labelName"])) $l_label='  <label class="' . $l_labelSize .' control-label" >' . $p["labelName"] . '</label>';

        echo $l_label;
        if(isset($p["labelName"])) echo "<div  class='$l_inputSize'>";        
        echo '<input ' . $l_type . ' class="form-control input-sm ' .  $l_inputclass .  '" id="p_' . $p["name"] . '" name="p_' . $p["name"] . '" ' . $l_inputValue . $l_placeholder . $l_attributes . '>';        
        if(isset($p["labelName"])) echo "</div>";
    
    }
}


if ( ! function_exists('OpenFormGroup'))
{    
    function OpenFormGroup($p_additional_class=''   ){
      $l_additional_class ='';
      if(isset($p_additional_class)) $l_additional_class = ' ' . $p_additional_class;
      echo "<div class='form-group $l_additional_class'>";            
    }
}

if ( ! function_exists('CloseFormGroup'))
{    
    function CloseFormGroup(){
       echo '</div>';            
    }
}





if ( ! function_exists('selectBox'))
{    
    function selectBox($p){
   	 /*
       labelName, Name, labelSize , selectSize 
       , $p["attributes  
       */

    $default_label_size_type  ='xs';
    $default_label_size       ='2';
    $default_input_size       ='10';
    $default_button_size      ='sm';
        
    $l_selectSize=' col-' . $default_label_size_type . '-' . $default_label_size;
    $l_labelSize =' col-' . $default_label_size_type . '-' . $default_input_size;
    $l_attributes='';            
    $l_label='';    
    $l_selectedValue='';
        

    if(isset($p["selectSize"])) $l_selectSize =' col-' . $default_label_size_type . '-' . $p["selectSize"];

    if(isset($p["labelSize"]))  $l_labelSize =' col-' . $default_label_size_type . '-' . $p["labelSize"];

    if(isset($p["attributes"]))  $l_attributes =' ' . $p["attributes"];

    if(isset($p["labelName"]))  $l_label='  <label class="' . $l_labelSize .' control-label" >' . $p["labelName"] . '</label>';

    if(isset($p["selectedValue"])) $l_selectedValue=' selectedvalue="' . $p["selectedValue"] . '"';
    echo $l_label;
        
    if(isset($p["labelName"])) echo "<div  class='$l_selectSize'>";
    
    echo ' <select  class="form-control input-sm" id="p_' . $p["name"] . '" name="p_' . $p["name"] . '" ' . $l_selectedValue . ' ' . $l_attributes . '></select>';
    
    if(isset($p["labelName"])) echo '</div >';    
            
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
       
        
        if(isset($p["label_size"]) ) $l_label_size =' col-' . $l_default_label_size_type . '-' . p_label_size;
        if(isset($p["select_size"]) ) $l_select_size ='col-' . $l_default_label_size_type . '-' . p_select_size;
        if(isset($p["label_name"]) ) $l_label ='<label class="' . $l_label_size .' control-label" >' . p_label_name . '</label>';

        $l_name = $p["name"];
        if(isset($p["attributes"]) )    $l_attributes   =$p["attributes"];

                    
        if(isset($p["labelName"]))  echo '<label class="' . $l_label_size .' control-label" >' . $p["labelName"] . '</label>';

        if(isset($p["labelName"])) echo "<div class='$l_select_size'>";
      
        echo '<select class="form-control input-sm" id="p_' . $l_name . '" name="p_' . $l_name . '" ' . $l_attributes . '>';
        
        if(isset($p["mandatory"]) ){
            if( $p["mandatory"]=='N' ) echo '<option value=""></option>';
        }

        if(isset($p["value"])){
            if($p["value"]=="1"){
                echo '<option value="1" selected>Yes</option>';
                echo '<option value="0">No</option>';
            }else{
                echo '<option value="0" selected>No</option>';
                echo '<option value="1">Yes</option>';
            }
        }else{
            echo '<option value="0">No</option>';
            echo '<option value="1">Yes</option>';
        }

        echo '</SELECT>';
        if(isset($p["labelName"])) echo "</div>";

            
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



if ( ! function_exists('Button'))
{    

  function Button($p){
      
      /*
      parameters:
        name,type,onclick,data_toggle,data_target       
      */
      
    $default_button_size      ='sm';

    $l_onclick = '';
    $l_data_toggle   = '';
    $l_data_target   = '';
    $l_text   	      = $p["name"];
    $l_type          ='';

    if(isset($p["type"]) ) $l_type = ' type="' . $p['type'] . '"';


    if(isset($p["onclick"]) )  $l_onclick = ' onclick="' . $p['onclick'] . '"';

    if(isset($p["data_toggle"]) ) $l_data_toggle = ' data-toggle="' . $p['data_toggle'] . '"';

    if(isset($p["data_target"]) ) $l_data_target = ' data-target="' . $p['data_target'] . '"';


    echo '<button id="btn' . $p['name'] . '" class="btn btn-primary btn-'. $default_button_size .'"' . $l_type . $l_onclick . $l_data_toggle . $l_data_target . '  >';
    echo GetIcon($p['name']) . $p['name'];
    echo '</button>';

   }
   
    
}





if ( ! function_exists('GetIcon'))
{    
   function GetIcon($name){
      $l_icon 	='<span class="glyphicon glyphicon-';
      $l_text 	='';

      if( strtoupper($name)=='SEARCH' ){
            $l_text= $l_icon .  'search"></span> ';
      }
      if( strtoupper($name)=='ADD' ){
            $l_text= $l_icon .  'plus-sign"></span> ';
      }
      if( strtoupper($name)=='DELETE' ){
            $l_text= $l_icon .  'trash"></span> ';
      }
      if( strtoupper($name)=='CLOSE' ){
            $l_text= $l_icon .  'off"></span> ';
      }
      if( strtoupper($name)=='SAVE' ){
            $l_text= $l_icon .  'floppy-disk"></span> ';
          
      }
      if( strtoupper($name)=='RESET' ){
            $l_text= $l_icon .  'retweet"></span> ';
      }

      return $l_text;

   }
}
