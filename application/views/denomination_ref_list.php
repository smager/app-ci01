<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Denomination Reference</title>
<?php
    includeHeader();    
?> 
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('denomination_ref/update');?>" method="post" >
<table class="zTable fullWidth">    
    <tr>
        <th></th>
        <th>Denomination</th>    
    </tr>
<?php

 $q=$this->denomination_ref_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
?>
    <tr>
        
            <td><input type="hidden" name="p_denomination_ref_id[]" value="<?php echo $d[$x]->denomination; ?>">
                <?php checkbox( array( 'name'=>'cb[]','value'=>$d[$x]->denomination  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"denomination[]",'value'=>$d[$x]->denomination  )); ?> </td>
    </tr>        

<?php    
}

for ($x = 0; $x < 5; $x++) {
?>
    <tr>
        
            <td><input type="hidden" name="p_denomination_ref_id[]">
                <?php checkbox( array( 'name'=>'select[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"denomination[]")); ?> </td>
    </tr>
    
    
<?php                               
} 
?>
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("denomination_ref/delete")  . "');"));        
?>    
</div>

</form>    
    
</div>
    
<?php includePageJS(); ?>      
<?php includeFooter(); ?>
</body>
</html>