<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>javascripts </title>
<?php
    includeHeader();    
?>
<style>
    
.modal-dialog {
    width: 95%;
}
#p_content{
    min-height:400px;
}    
    
</style>    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('javascripts/update');?>" method="post" >
<table id="grid" class="table">  
    <thead>
    <tr>
        <th></th>
        <th>Page URL</th>
        <th>Version Id</th>
        <th>Create By</th>
        <th>Created Date</th>        
        <th>Updated By</th>
        <th>Updated Date</th>        
    </tr>
    </thead>    
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'New', 'type'=>'button'));             
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("javascripts/delete")  . "');"));        
?>    
</div>

</form>    
    
</div>
 <div class="modal fade" id="modalWindow" tabindex="-1" role="dialog" aria-labelledby="modalWindowLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form id="frm_modalWindow" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalWindowLabel">Add New Item</h4>
      </div>
      <div class="modal-body form-horizontal">

<?php 
    hiddenBox( array( 'name'=>'js_id'));     
    openFormGroup();
        inputTextBox( array( 'name'=>"page_url",'labelName'=>"Page URL",'labelSize'=>1,'inputSize'=>3)); 
    closeFormGroup();
    openFormGroup();
        inputTextBox( array( 'name'=>"content",'labelName'=>"Content",'labelSize'=>1,'inputSize'=>11,'type'=>'textarea')); 
    closeFormGroup();

?> 
          
          
      </div>
      <div class="modal-footer">
<?php
        Button(array('name'=>'Save','type'=>'button'));  
?>
      </div>
    </form>                
    </div>
  </div>
</div>    

    
    

<script type="text/javascript">

$(document).ready(function(){

    displayDataToGrid();
});

function displayDataToGrid(){ 
    
    zsi.json.loadGrid({
         table  : "#grid"
        ,url    : base_url + "javascripts/getdata_json"
        ,td_body: [ 
            function(d){
                return '<input id="p_cb[]" name="p_cb[]" class="" type="checkbox">'
                + '<input id="p_hid_cb[]" name="p_hid_cb[]" value="' +  d.js_id + '" type="hidden">' 
            }
            ,function(d){ return '<a href="javascript:getInfo(' + d.js_id  + ');" >' + d.page_url + '</a>'; }
            ,function(d){ return   d.version_id; }
            ,function(d){ return   d.created_by; }
            ,function(d){ return   d.created_date; }
            ,function(d){ return   d.updated_by; }
            ,function(d){ return   d.updated_date; }
        ]

    });
}

function getInfo(p_id){
    $.getJSON(base_url + "javascripts/getdata_json/" + p_id
       ,function(data){
            var d = data[0];
            $("#p_js_id").val(d.js_id);
            $("#p_page_url").val(d.page_url);
            $("#p_content").val(d.content);
            $("#modalWindow").modal("show");
        }
    );
   
}   
    
$("#btnNew").click(function(){       
    $("#p_js_id").val('');
    $("#p_page_url").val('');
    $("#p_content").val('');    
    $("#modalWindow").modal("show");
});  

$("#btnSave").click(function(){
$("#modalWindow").modal("hide");
    var data = $("#frm_modalWindow").serializeArray();
    $.post(base_url + "javascripts/update",data,function(d){   
        displayDataToGrid();
    });
});    
    
    
function checkDelete(l_cmd) {
   var l_stmt=[], l_count;
    
   var data = zsi.table.getCheckBoxesValues("input[name='p_cb[]']:checked");
    for(var x=0;x<data.length; x++){
        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); 
    }
   if (l_stmt!="") {
      if(confirm("Are you sure you want to delete selected items?")) {
      $.post( l_cmd , l_stmt, function(d){
            displayDataToGrid();
         }).fail(function(d) {
            alert("Sorry, the curent transaction is not successfull.");
        });
      }
   }
return false;
}   
    
</script>    

<?php includeFooter(); ?> 
</body>
</html>