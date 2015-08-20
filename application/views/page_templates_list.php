<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Page Templates </title>
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
    
    
    
    
</style>    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<?php if($this->input->get("page_url")==''){ ?>             
    <form id="frm" action="<?php echo base_url('page_templates/update');?>" method="post" >        
        <div class="form-horizontal ">
            <div class="form-group  ">  
                <div class="col-xs-12">
                    <label class=" col-xs-1 control-label">Page Url:</label>
                    <div class=" col-xs-2">
                        <input type="text" name="p_filter_url" id="p_filter_url" class="form-control input-sm ">
                    </div>  

                    <label class=" col-xs-1 control-label">Content:</label>
                    <div class=" col-xs-2">
                        <input type="text" name="p_filter_content" id="p_filter_content" class="form-control input-sm ">
                    </div>                  

                    <button type="button"  class="btn btn-primary btn-sm" id="btnSearch">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </div>    
            </div> 
        </div>
        
    <table id="grid" class="zTable fullWidth">  
        <thead>
        <tr>
            <th style="width: 25px"></th>
            <th>Page URL</th>
            <th>Updated By</th>
            <th>Updated Date</th>        
        </tr>
        </thead>    
    </table>    

    <div class="buttonGroup">
    <?php 
        Button(array('name'=>'New', 'type'=>'button'));             
        Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("page_templates/delete")  . "');"));        
    ?>    
    </div>

    </form>    
<?php } ?>      
</div>    
<script src="<?php echo base_url("assets/ace/src-noconflict/ace.js"); ?>"></script>
<script src="<?php echo base_url("assets/ace/src-noconflict/ext-language_tools.js"); ?>"></script>
    
<script>
 var defaultUrl= base_url + "page_templates/getdata_json";
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
 
$(document).ready(function(){
    displayDataToGrid(defaultUrl);
});
    
    
function initAceEditor(){

    ace.require("ace/ext/language_tools");
    editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");   
    editor.session.setMode("ace/mode/html");
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
    
function displayDataToGrid(p_url){ 
    
    zsi.json.loadGrid({
         table  : "#grid"
        ,url    :p_url
        ,td_body: [ 
            function(d){
                return '<input id="p_cb[]" name="p_cb[]" class="" type="checkbox">'
                + '<input id="p_hid_cb[]" name="p_hid_cb[]" value="' +  d.page_template_id + '" type="hidden">' 
            }
            ,function(d){ return '<a href="javascript:getInfo(' + d.page_template_id  + ');" >' + d.page_url + '</a>'; }
            ,function(d){ return   d.updated_by; }
            ,function(d){ return   d.updated_date; }
        ]

    });
}

function getInfo(p_id){
    $.getJSON(base_url + "page_templates/getdata_json/" + p_id
       ,function(data){
            var d = data[0];
            
            showWindow(function(){
        
                $("#p_page_template_id").val(d.page_template_id);
                $("#p_page_url").val(d.page_url);
                editor.getSession().setValue(unescape(d.content)); 
            });
        }
    );
   
}   
    
$("#btnNew").click(function(){        
    showWindow();
});
    
function showWindow(onComplete){
    $.get(base_url + "page_templates/form",function(html_data){
            w1=createDhtmlxWindow({
                 name : "w1"
                ,title: "New Item"
                ,parent: document.body
                ,imgUrl: base_url + "assets/dhtmlx36/dhtmlxWindows/codebase/imgs/"    
                ,html : html_data
                ,maximize:true
            });
            initAceEditor();
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
    
    
$("#btnSearch").click(function(){     
   var params  = "?p_url=" + $("#p_filter_url").val() + "&p_content=" +  $("#p_filter_content").val();    
   displayDataToGrid( base_url + "page_templates/search" + params );
});    


    
function submit(p_IsHide){
    $("#p_content").val(editor.getSession().getValue());            
    var data = $("#frmWindow").serializeArray();
    if(p_IsHide==true) w1.close();        
    $.post(base_url + "page_templates/update",data,function(d){   
        zsi.form.showAlert("alert");
        displayDataToGrid(defaultUrl);
    });    
}    
    
    
function checkDelete(l_cmd) {
   var l_stmt=[], l_count;
    
   var data = zsi.table.getCheckBoxesValues("input[name='p_cb[]']:checked");
    for(var x=0;x<data.length; x++){
        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); 
    }
   if (l_stmt!="") {
      if(confirm("Are you sure you want to delete selected items?")) {
      $.post( l_cmd , l_stmt, function(d){
            displayDataToGrid(defaultUrl);
         }).fail(function(d) {
            alert("Sorry, the curent transaction is not successfull.");
        });
      }
   }
return false;
}   
    
</script>    
<?php 
    
    $page_url=$this->input->get("page_url");
    if($page_url!=''){ 
        $page_url = strtolower($page_url);
        $where ="where page_url='$page_url'";        
        $query = $this->db->query("SELECT * FROM page_templates $where");        
        if($query->num_rows()>0){
            echo "<script>";
            echo "getInfo(" . $query->result()[0]->page_template_id . ");";
            echo "</script>";
        }

    }        
?>    
<?php includeFooter(); ?> 
</body>
</html>