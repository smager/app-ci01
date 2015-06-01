<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>store_loc:List</title>
<?php
    includeHeader();    
?> 
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('store_loc/update');?>" method="post" >
<table class="table">    
    <tr>
        <th></th>
        <th>Store Branch Location</th>
        <th>Store Type</th>
        <th>Active?</th>
        
    </tr>
<?php

 $q=$this->store_loc_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
?>
    <tr>
        
            <td><input type="hidden" name="p_store_loc_id[]" value="<?php echo $d[$x]->store_loc_id; ?>">
                <?php checkbox( array( 'name'=>'cb[]','value'=>$d[$x]->store_loc_id  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"store_loc[]",'value'=>$d[$x]->store_loc  )); ?> </td>
            <td><?php selectBox( array( 'name'=>'store_id[]','value'=>$d[$x]->store_id,'selectedValue'=>$d[$x]->store_id   )); ?> </td>
            <td><?php yes_no(array('name'=>'active[]','mandatory'=>'N','value'=>$d[$x]->active )); ?> </td>
            </td>
    </tr>        

<?php    
}

for ($x = 0; $x < 5; $x++) {
?>
    <tr>
        
            <td><input type="hidden" name="p_store_loc_id[]">
                <?php checkbox( array( 'name'=>'select[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"store_loc[]")); ?> </td>
            <td><?php selectBox( array( 'name'=>'store_id[]')); ?> </td>
            <td><?php yes_no(array('name'=>'active[]','mandatory'=>'N')); ?> </td>
            </td>
    </tr>
    
    
<?php                               
} 
?>
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("store_loc/delete")  . "');"));        
?>    
</div>

</form>    
    
</div>
    

<script type="text/javascript">
var ctrlSel = zsi.control.SelectList;  
    
$(document).ready(function(){
    
 ctrlSel( base_url + "common/get_select_data","select[name='p_store_id[]']","","N","stores","store_id","store_name","");

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

    

<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>     
</body>
</html>