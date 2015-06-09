<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Menus</title>
<?php
    includeHeader();    
?> 
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('menu/update');?>" method="post" >
<table class="table">    
    <tr>
        <th></th>
        <th>Seq#</th>
        <th>Menu</th>
        <th>URL</th>
        <th>Type</th>  
        <th>System</th>
    </tr>
<?php

 $q=$this->menu_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
?>
    <tr>
        
            <td><input type="hidden" name="p_menu_id[]" value="<?php echo $d[$x]->menu_id; ?>">
                <?php checkbox( array( 'name'=>'cb[]','value'=>$d[$x]->menu_id  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"seq_no[]",'value'=>$d[$x]->seq_no  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"menu_name[]",'value'=>$d[$x]->menu_name  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"menu_url[]",'value'=>$d[$x]->menu_url  )); ?> </td>
            <td><?php selectBox( array( 'name'=>'menu_type_id[]','value'=>$d[$x]->menu_type_id,'selectedValue'=>$d[$x]->menu_type_id  )); ?> </td>
            <td><?php selectBox( array( 'name'=>'system_id[]','value'=>$d[$x]->system_id,'selectedValue'=>$d[$x]->system_id  )); ?> </td>
            
    </tr>        

<?php    
}

for ($x = 0; $x < 5; $x++) {
?>
    <tr>
        
            <td><input type="hidden" name="p_menu_id[]">
                <?php checkbox( array( 'name'=>'select[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"seq_no[]")); ?> </td>
            <td><?php inputTextBox( array( 'name'=>'menu_name[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>'menu_url[]')); ?> </td>
            <td><?php selectBox( array( 'name'=>'menu_type_id[]')); ?> </td>
            <td><?php selectBox( array( 'name'=>'system_id[]')); ?> </td>
            
    </tr>
    
    
<?php                               
} 
?>
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("menu/delete")  . "');"));        
?>    
</div>

</form>    
    
</div>
<?php includePageJS(); ?>       
<?php includeFooter(); ?>  
</body>
</html>