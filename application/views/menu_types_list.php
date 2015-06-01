<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Menu Types:List</title>
<?php
    includeHeader();    
?> 
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('menu_types/update');?>" method="post" >
<table class="table">    
    <tr>
        <th></th>
        <th>Seq#</th>
        <th>Menu Type</th>
    </tr>
<?php

 $q=$this->menu_types_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
?>
    <tr>
        
            <td><input type="hidden" name="p_menu_type_id[]" value="<?php echo $d[$x]->menu_type_id; ?>">
                <?php checkbox( array( 'name'=>'cb[]','value'=>$d[$x]->menu_type_id  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"seq_no[]",'value'=>$d[$x]->seq_no  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"menu_type[]",'value'=>$d[$x]->menu_type  )); ?> </td>
           </td>
    </tr>        

<?php    
}

for ($x = 0; $x < 5; $x++) {
?>
    <tr>
        
            <td><input type="hidden" name="p_menu_type_id[]">
                <?php checkbox( array( 'name'=>'select[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"seq_no[]")); ?> </td>
            <td><?php inputTextBox( array( 'name'=>'menu_type[]')); ?> </td>
            </td>
    </tr>
    
    
<?php                               
} 
?>
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("menu_types/delete")  . "');"));        
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