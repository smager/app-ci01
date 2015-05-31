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

<table class="table">    
    <tr>
        <th></th>
        <th>Acct. No</th>
        <th>Acct. Name</th>
        <th>Bank Name</th>
        <th>Active?</th>
        
    </tr>
<?php
for ($x = 0; $x < 5; $x++) {
?>
    <tr>
        
            <td><?php checkbox( array( 'name'=>'select')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>'bank_acctno')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>'bank_acctname')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>'bank_name')); ?> </td>
            <td><?php yes_no(array('name'=>'active','mandatory'=>'N')); ?> </td>
            </td>
    </tr>
    
    
<?php                               
} 
?>
</table>    
    
    
</div>
    

<script type="text/javascript">
    

</script>    

    

<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>     
</body>
</html>