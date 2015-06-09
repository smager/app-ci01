<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Suppliers</title>
<?php
    includeHeader();    
?> 
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('suppliers/update');?>" method="post" >
<table class="table">    
    <tr>
        <th></th>
        <th>Supplier Name</th>
        <th>Active</th>
    </tr>
<?php

 $q=$this->suppliers_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_supplier_id[]" value="<?php echo $d[$x]->supplier_id; ?>">
                <?php checkbox( array( 'name'=>'cb[]','value'=>$d[$x]->supplier_id  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"supplier_name[]",'value'=>$d[$x]->supplier_name  )); ?> </td>
            <td><?php yes_no(array('name'=>'active[]','mandatory'=>'N','value'=>$d[$x]->active )); ?> </td>
    </tr>        

<?php    
}

for ($x = 0; $x < 5; $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_supplier_id[]">
                <?php checkbox( array( 'name'=>'select[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"supplier_name[]")); ?> </td>
            <td><?php yes_no(array('name'=>'active[]','mandatory'=>'N')); ?> </td>
    </tr>
    
    
<?php                               
} 
?>
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("supplier/delete")  . "');"));        
?>    
</div>

</form>    
    
</div>
<?php includePageJS(); ?> 
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>     
</body>
</html>