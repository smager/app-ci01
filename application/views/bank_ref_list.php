<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>bank_ref:List</title>
<?php
    includeHeader();    
?>     
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('bank_ref/update');?>" method="post" >
<table class="table">    
    <tr>
        <th></th>
        <th>Acct. No</th>
        <th>Acct. Name</th>
        <th>Bank Name</th>
        <th>Active?</th>
        
    </tr>
<?php

 $q=$this->bank_ref_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
?>
    <tr>
        
            <td><input type="hidden" name="p_bank_ref_id[]" value="<?php echo $d[$x]->bank_ref_id; ?>">
                <?php checkbox( array( 'name'=>'cb[]','value'=>$d[$x]->bank_ref_id  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"bank_acctno[]",'value'=>$d[$x]->bank_acctno  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>'bank_acctname[]','value'=>$d[$x]->bank_acctname  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>'bank_name[]','value'=>$d[$x]->bank_name  )); ?> </td>
            <td><?php yes_no(array('name'=>'active[]','mandatory'=>'N','value'=>$d[$x]->active )); ?> </td>
    </tr>        

<?php    
}

for ($x = 0; $x < 5; $x++) {
?>
    <tr>
        
            <td><input type="hidden" name="p_bank_ref_id[]">
                <?php checkbox( array( 'name'=>'select[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"bank_acctno[]")); ?> </td>
            <td><?php inputTextBox( array( 'name'=>'bank_acctname[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>'bank_name[]')); ?> </td>
            <td><?php yes_no(array('name'=>'active[]','mandatory'=>'N')); ?> </td>
    </tr>
    
    
<?php                               
} 
?>
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("bank_ref/delete")  . "');"));        
?>    
</div>

</form>    
    
</div>
    
<?php includePageJS(); ?>  
<?php includeFooter(); ?> 
</body>
</html>