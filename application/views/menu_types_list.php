<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Menu Types</title>
<?php
    includeHeader();    
?> 
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('menu_types/update');?>" method="post" >
<table class="zTable fullWidth">    
    <tr>
        <th style="width: 25px"></th>
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
<?php includePageJS(); ?>    
<?php includeFooter(); ?>   
</body>
</html>