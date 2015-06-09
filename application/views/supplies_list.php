<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Supplies</title>
<?php
    includeHeader();    
?> 
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('supplies/update');?>" method="post" >
<table class="table">    
    <tr>
        <th></th>
        <th>Code</th>
        <th>Description</th>
        <th>Type</th>   
        <th align="right">Unit Cost</th>
        <th align="right">Unit Price</th>
        
    </tr>
<?php

 $q=$this->supplies_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_supply_id[]" value="<?php echo $d[$x]->supply_id; ?>">
                <?php checkbox( array( 'name'=>'cb[]','value'=>$d[$x]->supply_id  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"supply_code[]",'value'=>$d[$x]->supply_code  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"supply_desc[]",'value'=>$d[$x]->supply_desc  )); ?> </td>
            <td><?php selectBox( array( 'name'=>'supply_type_id[]','value'=>$d[$x]->supply_type_id,'selectedValue'=>$d[$x]->supply_type_id   )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"supply_cost[]",'value'=>$d[$x]->supply_cost  )); ?> </td>    
            <td><?php inputTextBox( array( 'name'=>"supply_srp[]",'value'=>$d[$x]->supply_srp  )); ?> </td>
    </tr>        

<?php    
}

for ($x = 0; $x < 5; $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_supply_id[]">
                <?php checkbox( array( 'name'=>'select[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"supply_code[]")); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"supply_desc[]")); ?> </td>
            <td><?php selectBox( array( 'name'=>'supply_type_id[]')); ?> </td>
            <td align="right"><?php inputTextBox( array( 'name'=>"supply_cost[]")); ?> </td>
            <td align="right"><?php inputTextBox( array( 'name'=>"supply_srp[]")); ?> </td>
    </tr>
    
    
<?php                               
} 
?>
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("supplies/delete")  . "');"));        
?>    
</div>

</form>    
    
</div>
<?php includePageJS(); ?> 
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>     
</body>
</html>