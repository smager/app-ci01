<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Employees:List</title>
<?php
    includeHeader();    
?> 
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('employees/update');?>" method="post" >
<table class="table">    
    <tr>
        <th></th>
        <th>Employee</th>
        <th>Position</th>
        <th>Store Location</th>
        <th>Active?</th>
    </tr>
<?php

 $q=$this->employees_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_empl_id[]" value="<?php echo $d[$x]->empl_id; ?>">
                <?php checkbox( array( 'name'=>'cb[]','value'=>$d[$x]->empl_id  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"empl_name[]",'value'=>$d[$x]->empl_name  )); ?> </td>
            <td><?php selectBox( array( 'name'=>'position_id[]','value'=>$d[$x]->position_id,'selectedValue'=>$d[$x]->position_id  )); ?> </td> 
            <td><?php selectBox( array( 'name'=>'store_loc_id[]','value'=>$d[$x]->store_loc_id,'selectedValue'=>$d[$x]->store_loc_id  )); ?> </td>         
            <td><?php yes_no(array('name'=>'active[]','mandatory'=>'N','value'=>$d[$x]->active )); ?> </td>
        
    </tr>        

<?php    
}

for ($x = 0; $x < 5; $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_empl_id[]">
                <?php checkbox( array( 'name'=>'select[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"empl_name[]")); ?> </td>
            <td><?php selectBox( array( 'name'=>'position_id[]')); ?> </td>
            <td><?php selectBox( array( 'name'=>'store_loc_id[]')); ?> </td>
            <td><?php yes_no(array('name'=>'active[]','mandatory'=>'N')); ?> </td>
    </tr>
    
    
<?php                               
} 
?>
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("employees/delete")  . "');"));        
?>    
</div>

</form>    
    
</div>
    

<script type="text/javascript">

var ctrlSel = zsi.control.SelectList;  
    
$(document).ready(function(){
 ctrlSel( base_url + "common/get_select_data","select[name='p_position_id[]']","","N","positions","position_id","position_desc","");
 ctrlSel( base_url + "common/get_select_data","select[name='p_store_loc_id[]']","","N","store_loc","store_loc_id","store_loc","");
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
            window.store_location.reload();
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