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
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('javascripts/update');?>" method="post" >
<table class="table">    
    <tr>
        <th></th>
        <th>JS Id</th>
        <th>Version Id</th>
        <th>Page URL</th>
        <th>Create By</th>
        <th>Created Date</th>        
        <th>Updated By</th>
        <th>Updated Date</th>        
    </tr>
<?php

 $q=$this->javascripts_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
?>
    <tr>
        
            <td><input type="hidden" name="p_js_id[]" value="<?php echo $d[$x]->js_id; ?>">
                <?php checkbox( array( 'name'=>'cb[]','value'=>$d[$x]->js_id  )); ?> </td>
            <td><?php echo $d[$x]->js_id; ?> </td>
            <td><?php echo $d[$x]->version_id; ?> </td>
            <td><?php echo $d[$x]->page_url; ?> </td>
            <td><?php echo $d[$x]->created_by; ?> </td>
            <td><?php echo $d[$x]->created_date; ?> </td>
            <td><?php echo $d[$x]->updated_by; ?> </td>
            <td><?php echo $d[$x]->updated_date; ?> </td>
    </tr>        

<?php    
}


?>
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
        inputTextBox( array( 'name'=>"page_url",'labelName'=>"Page URL",'labelSize'=>2,'inputSize'=>9)); 
    closeFormGroup();
    openFormGroup();
        inputTextBox( array( 'name'=>"content",'labelName'=>"Content",'labelSize'=>2,'inputSize'=>9,'type'=>'textarea')); 
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
    
$("#btnNew").click(function(){    
    
/*    $.getJSON(base_url + "javascripts/get_json"
       ,function(d){
       
        }
    );
*/    
    
    $("#modalWindow").modal("show");
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
            window.location.reload();
            //console.log(d);
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