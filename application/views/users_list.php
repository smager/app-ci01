<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>user:List</title>
<?php
    includeHeader();    
?> 
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('users/update');?>" method="post" >
<table class="table">    
    <tr>
        <th></th>
        <th>Employee</th>
        <th>User Name</th>
        <th>Password</th>
        <th>Role</th>
        <th>Area</th>
        <th>Active?</th>
    </tr>
<?php

 $q=$this->users_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_user_id[]" value="<?php echo $d[$x]->user_id; ?>">
                <?php checkbox( array( 'name'=>'cb[]','value'=>$d[$x]->user_id  )); ?> </td>
            <td><?php selectBox( array( 'name'=>'empl_id[]','value'=>$d[$x]->empl_id,'selectedValue'=>$d[$x]->empl_id  )); ?> </td>    
            <td><?php inputTextBox( array( 'name'=>"user_name[]",'value'=>$d[$x]->user_name  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"user_password[]",'value'=>$d[$x]->user_password  )); ?> </td>
            <td><?php selectBox( array( 'name'=>'role_id[]','value'=>$d[$x]->role_id,'selectedValue'=>$d[$x]->role_id  )); ?> </td> 
            <td><?php selectBox( array( 'name'=>'loc_id[]','value'=>$d[$x]->loc_id,'selectedValue'=>$d[$x]->loc_id  )); ?> </td>         
            <td><?php yes_no(array('name'=>'active[]','mandatory'=>'N','value'=>$d[$x]->active )); ?> </td>
        
    </tr>        

<?php    
}

for ($x = 0; $x < 5; $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_user_id[]">
                <?php checkbox( array( 'name'=>'select[]')); ?> </td>
            <td><?php selectBox( array( 'name'=>'empl_id[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"user_name[]")); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"user_password[]")); ?> </td>
            <td><?php selectBox( array( 'name'=>'role_id[]')); ?> </td>
            <td><?php selectBox( array( 'name'=>'loc_id[]')); ?> </td>
            <td><?php yes_no(array('name'=>'active[]','mandatory'=>'N')); ?> </td>
    </tr>
    
    
<?php                               
} 
?>
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("users/delete")  . "');"));        
?>    
</div>

</form>    
    
</div>
<?php includePageJS(); ?>      
<?php includeFooter(); ?>     
</body>
</html>