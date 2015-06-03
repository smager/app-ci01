<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Units:List</title>
<?php
    includeHeader();    
?> 
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('units/update');?>" method="post" >
<table class="table">    
    <tr>
        <th></th>
        <th>Code</th>
        <th>Description</th>
    </tr>
<?php

 $q=$this->units_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_unit_id[]" value="<?php echo $d[$x]->unit_id; ?>">
                <?php checkbox( array( 'name'=>'cb[]','value'=>$d[$x]->unit_id  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"unit_sdesc[]",'value'=>$d[$x]->unit_sdesc  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"unit_desc[]",'value'=>$d[$x]->unit_desc  )); ?> </td>
    </tr>        

<?php    
}

for ($x = 0; $x < 5; $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_unit_id[]">
                <?php checkbox( array( 'name'=>'select[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"unit_sdesc[]")); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"unit_desc[]")); ?> </td>
            </td>
    </tr>
    
    
<?php                               
} 
?>
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("units/delete")  . "');"));        
?>    
</div>

</form>    
    
</div>
    

<script type="text/javascript">

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