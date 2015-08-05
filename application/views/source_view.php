<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Source</title> 
<?php
    includeHeader(array('window'=>true) );    
?>
<style>
    
.modal-dialog {
    width: 95%;
}
    
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
    
.filesPane .filegroup{
    border:1pt solid #E5E5E5;
    float: left;
    margin-right: 10px;
    min-width: 220px;
}
.filesPane div ul{
    padding-left:10px;
}
    
.filesPane .title{
    text-align:center;
}    

</style>
</head>
<body>
<?php menu(); ?>     
<div class="container page">
<?php 
    echo "\r\n<div class='filesPane'>";
        echo "\r\n<div class='filegroup controller'>";
        echo "\r\n<div class='title'>Controllers</div>";
        echo "\r\n<ul class='files'>";
        foreach ($controllers as &$c) {
            echo "\r\n<li><a href=\"javascript:getInfo(" . "'c','" . $c . "');\">$c</a></li>";
        }
        echo "\r\n</ul>";
        echo "\r\n</div>";

        echo "\r\n<div class='filegroup model'>";
        echo "\r\n<div class='title'>Models</div>";
        echo "\r\n<ul class='files'>";
        foreach ($models as &$m) {
            echo "\r\n<li><a href=\"javascript:getInfo(" . "'m','" . $m . "');\">$m</a></li>";
        }
        echo "\r\n</ul>";
        echo "\r\n</div>";
 

        echo "\r\n<div class='filegroup view'>";
        echo "\r\n<div class='title'>Views</div>";
        echo "\r\n<ul class='files'>";
        foreach ($views as &$v) {
            if(is_string($v)){
                echo "\r\n<li><a href=\"javascript:getInfo(" . "'v','" . $v . "');\">$v</a></li>";
            }
        }
        echo "\r\n</ul>";
        echo "\r\n</div>";

        echo "\r\n<div class='filegroup view'>";
        echo "\r\n<div class='title'>CSS</div>";
        echo "\r\n<ul class='files'>";
        foreach ($css as &$c) {
                echo "\r\n<li><a href=\"javascript:getInfo(" . "'css','" . $c . "');\">$c</a></li>";
        }
        echo "\r\n</ul>";
        echo "\r\n</div>";

    echo "\r\n</div>";
 
?>       
</div>    
  
    
<script src="<?php echo base_url("assets/ace/src-noconflict/ace.js"); ?>"></script>
<script src="<?php echo base_url("assets/ace/src-noconflict/ext-language_tools.js"); ?>"></script>
    
<script>    
 
 var defaultUrl= base_url + "source/";    
 var editor =null;  
 var w1=null;

$(window).bind('keydown', function(e) {
    var isCtrlS = (e.ctrlKey && e.which == 83);
    if(isCtrlS){
        submit(false);
        e.preventDefault();
        return false;
    }
    
});    
 
function initAceEditor(lang){

    ace.require("ace/ext/language_tools");
    editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");   
    editor.session.setMode("ace/mode/" + lang);
    editor.setAutoScrollEditorIntoView(true);
   
    editor.setOptions({
           enableBasicAutocompletion: true,
           enableSnippets: true,
           enableLiveAutocompletion: false,
           maxLines: 100,
           fontSize: "10pt"
    });    

}    

function createDhtmlxWindow(p){
    if(typeof dhxWins === 'undefined') {
        dhxWins = new dhtmlXWindows();
        dhxWins.enableAutoViewport(false);
    }        
    dhxWins.attachViewportTo(p.parent);
    dhxWins.setImagePath(p.imgUrl);    
    if(typeof p.position === 'undefined') p.position = {x1:100,y1:50,x2:500,y2:1000};
    w = dhxWins.createWindow(p.name, p.position.x1, p.position.y1, p.position.y2,p.position.x2);
    w.setText(p.title);
    if(typeof p.maximize !== 'undefined') { if (p.maximize==true) w.maximize(); }
    if(typeof p.html !== 'undefined')  w.attachHTMLString(p.html);
   
    return w;
}
    
function getInfo(p_path,p_filename){
    $.get(defaultUrl +  "get_content/" + p_path + "/" + p_filename
       ,function(data){
            data= data.replace(/^\s+/,""); //ltrim
            showWindow(p_path,p_filename,function(){
                $("#p_filename").val(p_filename);
                editor.getSession().setValue(unescape(data)); 
            });
        }
    );
   
}   
    
function showWindow(codePath,p_filename,onComplete){
    $.get(base_url + "source/form?p_codepath="+ codePath + "&p_filename=" + p_filename,function(html_data){           
            w1=createDhtmlxWindow({
                 name : "w1"
                ,title: "Source"
                ,parent: document.body
                ,imgUrl: base_url + "assets/dhtmlx36/dhtmlxWindows/codebase/imgs/"    
                ,html : html_data
                ,maximize:true
            });
            var lang ="php";
            if(codePath.indexOf("css") > -1) lang="css"; 
            initAceEditor(lang);        
            if(onComplete) onComplete();
            
            //initiate window buttons.
            $("#btnSubmit").click(function(){
                submit(true);
            });    

            $("#btnCloseWindow").click(function(){
                w1.close();     
            });                
        
    });
}    

    
function submit(p_IsHide){
    $("#p_content").val(editor.getSession().getValue());            
    var data = $("#frmWindow").serializeArray();
    if(p_IsHide==true) w1.close();
    $.post(base_url + "source/update",data,function(d){   
        zsi.form.showAlert("alert");
    });    
}    
      
</script>    
  
<?php includeFooter(); ?> 
</body>
</html>