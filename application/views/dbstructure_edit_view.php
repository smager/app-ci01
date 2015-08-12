<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Database Structure: Edit</title>
<?php
    includeHeader();    
?>    
<style>
    .alert{
       position:absolute;
       top:0px;
       display:none; 
       z-index:10000;
     } 

    
    .ace_editor {
        min-height: 400px !important;
    }   

    .ace_search.right {
        position: fixed !important;
    }
    .ace_search_field {
        color:#000 !important;
        background-color:#fff !important;
    }    

    .dhtmlx_wins_body_inner > div[ida='dhxMainCont']{
        overflow:auto !important;
    }    
</style>    
</head>
<body>
<?php menu(); ?>     
<div class="container page">
<form id="frm" action="<?php echo base_url() . $this->router->fetch_class() . '/update';?>" method="post" >    
<div class="container-fluid">    
<div class="form-horizontal">
    
<?php 
    openFormGroup();
        hiddenBox( array( 'name'=>'content'));  
        inputTextBox( array( 'name'=>"object_name",'labelName'=>"Object Name",'labelSize'=>1,'inputSize'=>3,'value'=>$object_name)); 
        selectBox( array( 'name'=>"object_type",'labelName'=>"Type", 'type'=>'select', 'labelSize'=>1,'selectSize'=>3)); 
        selectBox( array( 'name'=>"overwrite",'labelName'=>"Overwrite", 'type'=>'select', 'labelSize'=>1,'selectSize'=>3)); 
    
    closeFormGroup();
    openFormGroup();
?>
   <div class="form-group">
     <label class="col-xs-1 control-label">Code:</label>
   </div>      
   <pre id="editor"></pre>
<?php
    closeFormGroup();
?>     
    
</div>
</div>  
<div class="col-xs-12 buttonGroup">
    <button id="btnSubmit" class="btn btn-primary btn-sm" type="button">
    <span class="glyphicon glyphicon-floppy-disk"></span> Save
    </button> 
</div>    
</form>
</div>    
  
<script src="<?php echo base_url("assets/ace/src-noconflict/ace.js"); ?>"></script>
<script src="<?php echo base_url("assets/ace/src-noconflict/ext-language_tools.js"); ?>"></script>
    
<script>    
 var defaultUrl='<?php echo base_url() . $this->router->fetch_class();?>/';    
 var editor =null;  
 var w1=null;
 var obj_name ="<?php echo $object_name;?>";
 var obj_type ="<?php echo $object_type;?>";
   
$(window).bind('keydown', function(e) {
    var isCtrlS = (e.ctrlKey && e.which == 83);
    if(isCtrlS){
        submit();
        e.preventDefault();
        return false;
    }    
});   
    
$(document).ready(function(){
    zsi.excludeUrl ="dbstructure";
    initAceEditor();
    getInfo(obj_name);
});

$("#btnSubmit").click(function(){
    submit();
});  
    
function getInfo(p_name){
    if(p_name==="") return;
    $.get(defaultUrl + "getcode/" +  p_name + "/" + obj_type
       ,function(data){
            editor.getSession().setValue(unescape(data.replace(/^\s+/,"")));
        
            var params = {
                 data : [
                      {text:"Table",value:"table"}
                     ,{text:"View",value:"view"}
                     ,{text:"Procedure",value:"procedure"}
                     ,{text:"Function",value:"function"}
                 ]
                ,selectedValue: obj_type
            };
        
    
        
            $("select[name='p_object_type']").fillSelect(params);
            $("select[name='p_overwrite']").fillSelect({
                 data : [ {text:"No",value:0},{text:"Yes",value:1}]
                ,isRequired:true
            });
        }
    );
   
}   
 function submit(){
    $("#p_content").val(editor.getSession().getValue());            
    var data = $("#frm").serializeArray();
     
    $.post(defaultUrl + "update",data,function(d){   
        zsi.form.showAlert("alert");
        
    }).fail(function(data) {
        alert(data.responseText.replace(/^\s+/,""));
    })   
}  

    
function initAceEditor(){

    ace.require("ace/ext/language_tools");
    editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");   
    editor.session.setMode("ace/mode/mysql");
    editor.setAutoScrollEditorIntoView(true);
   
    editor.setOptions({
           enableBasicAutocompletion: true,
           enableSnippets: true,
           enableLiveAutocompletion: false,
           maxLines: 100,
           fontSize: "10pt"
    });    

}    
 
</script>    

<div class="alert alert-success">
   <p>Data has been saved.</p>
</div>    
<?php includeFooter(); ?>         
</body>
</html>