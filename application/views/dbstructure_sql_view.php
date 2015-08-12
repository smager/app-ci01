<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>SQL Console</title>
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
        min-height: 200px !important;
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
    
    #tableResult{
        height: 400px;
        min-width: 110px;
        overflow-x: auto;
        overflow-y: auto;        
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
    hiddenBox( array( 'name'=>'sql'));      
    openFormGroup();
?>    
   <pre id="editor"></pre>
<?php
    closeFormGroup();
?>     
    
</div>
</div>  

    
<div class="col-xs-12 buttonGroup">
    <button id="btnRun" class="btn btn-primary btn-sm" type="button">
    <span class="glyphicon glyphicon-play"></span> Run
    </button> 
</div>    
</form>
    
<div id="tableResult" class="col-xs-12"></div>    

    
</div>    
  
<script src="<?php echo base_url("assets/ace/src-noconflict/ace.js"); ?>"></script>
<script src="<?php echo base_url("assets/ace/src-noconflict/ext-language_tools.js"); ?>"></script>
    
<script>    
 var tbl="#tableResult";    
 var defaultUrl='<?php echo base_url() . $this->router->fetch_class();?>/';    
 var editor =null;  
 var w1=null;
    
 
    


    
$(window).bind('keydown', function(e) {
    var isCtrlS = (e.ctrlKey && e.which == 82);
    if(isCtrlS){
        runSQL();
        e.preventDefault();
        return false;
    }    
});   
    
 $(document).ready(function(){
     initAceEditor();
     var dbName ="<?php echo $this->db->database;?>";
     var commentText ="# show tables; show full tables where Table_Type = 'BASE TABLE'; show full tables where Table_Type = 'VIEW';";
         commentText +="\r\n# show procedure status where db='" + dbName + "'; show function status where db='" + dbName + "';";
         commentText +="\r\nselect * from tablename;\r\n";
     editor.getSession().setValue(commentText); 
 });

$("#btnRun").click(function(){
    runSQL();
});  
    
 
 function runSQL(){
    $(tbl).html(""); 
    var text = editor.getSelectedText();
    if(text==="") text = editor.getSession().getValue();

    $("#p_sql").val(text);            
    var data = $("#frm").serializeArray();
     
    zsi.excludeUrl ="runsql";
     
    $.post(defaultUrl + zsi.excludeUrl ,data,function(d){
        if (d.length==0) {
            $(tbl).html("No Result."); 
            return;
        }
        var hInfo =  d[0];
        var keys = Object.keys(hInfo);
        var colsLength =keys.length;
        
        var h="<table class='zTable fullWidth'><thead><tr>";
        for(var i=0;i< colsLength;i++){                
            h+="<th>" + keys[i] + "</th>";
        }
        h+="</tr></thead></table>"        
        $(tbl).html(h);
        
        var trCls="odd";
        for(var y=0;y< d.length;y++){
            
            h="<tr class='" + trCls + "'>";
            if(trCls=="odd") trCls="even"; else trCls ="odd";     
            
            for(var x=0;x< colsLength;x++){                
                var info = d[y];
                var val = info[keys[x]];
                var new_val = $('<div/>').text(val).html();
                 h+="<td>"+ new_val +"</td>";
            }
            h+="</tr>";
            $(".zTable").append(h);
        }
       // zsi.form.showAlert("alert");
        
    }).fail(function(data) {
        result =  data.responseText.replace(/^\s+/,"");
        $(tbl).html(result);
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