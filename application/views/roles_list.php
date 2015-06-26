<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Roles</title>
<?php
    includeHeader();    
?> 
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('roles/update');?>" method="post" >
<table class="table">    
    <tr>
        <th style="width:30px;"></th>
        <th style="width:80px;">Code</th>        
        <th>Role</th>
    </tr>
<?php

 $q=$this->roles_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
?>
    <tr>
        
            <td style="text-align:center" ><input type="hidden" name="p_role_id[]" value="<?php echo $d[$x]->role_id; ?>">
                <?php checkbox( array( 'name'=>'cb[]','value'=>$d[$x]->role_id  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"role_code[]",'value'=>$d[$x]->role_code  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"role_desc[]",'value'=>$d[$x]->role_desc  )); ?> </td>
    </tr>        

<?php    
}

for ($x = 0; $x < 5; $x++) {
?>
    <tr>
        
            <td ><input type="hidden" name="p_role_id[]">
                <?php checkbox( array( 'name'=>'select[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"role_code[]")); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"role_desc[]")); ?> </td>
    </tr>
    
    
<?php                               
} 
?>
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("role/delete")  . "');"));        
?>    
</div>

</form>    
    
</div>
    
<?php includePageJS(); ?>     
<?php includeFooter(); ?>    
</body>
</html>