<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Test</title>
<?php
    includeHeader();    
?>     
</head>
<body>
<?php 
//menu(); 
?> 
    
<div class="container page">
<?php includePageTemplate(); ?>  
    
<form id="frm" action="<?php echo base_url($this->router->fetch_class().'/update');?>" method="post" >    
    
<div >
    <div class="form-horizontal ">
        <?php 

            hiddenBox( array( 'name'=>'empl_id'));         
            openFormGroup();
            inputTextBox( array( 'labelName'=>'Employee #' , 'name'=>'empl_no', 'labelSize'=>1, 'inputSize'=>2)); 
            inputTextBox( array( 'labelName'=>'Name' , 'name'=>'empl_name', 'labelSize'=>1, 'inputSize'=>2 )); 
            inputTextBox( array( 'labelName'=>'Address' , 'name'=>'empl_add', 'labelSize'=>1, 'inputSize'=>2 )); 
            closeFormGroup();

        ?> 
    </div>
</div>  
    
<table class="table">    
    <tr>
        <th></th>
        <th>Acct. No</th>
        <th>Acct. Name</th>
        <th>Bank Name</th>
        <th>% Deposit Share</th>
        <th>Active?</th>
        
    </tr>
<?php
for ($x = 0; $x < 5; $x++) {
?>
    <tr>
        
            <td><input type="hidden" name="p_bank_ref_id[]">
                <?php checkbox( array( 'name'=>'cb[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"bank_acctno[]")); ?> </td>
            <td><?php inputTextBox( array( 'name'=>'bank_acctname[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>'bank_name[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>'depo_pct_share[]')); ?> </td>
            <td><?php yes_no(array('name'=>'active[]','mandatory'=>'N')); ?> </td>
    </tr>
    
    
<?php                               
} 
?>
</table>        
    
  
<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
?>    
</div>

</form>    
    
</div>
    
<?php includePageJS(); ?>  
<?php includeFooter(); ?> 
</body>
</html>