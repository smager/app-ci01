<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Conversion per Unit</title>
<?php
    includeHeader();    
?> 
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('conv_units/update');?>" method="post" >
<table class="zTable fullWidth">    
    <tr>
        <th style="width: 25px"></th>
        <th>Convert From</th>
        <th>Convert To</th>      
        <th>Convert Qty</th>
        
    </tr>
<?php

 $q=$this->conv_units_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_conv_id[]" value="<?php echo $d[$x]->conv_id; ?>">
                <?php checkbox( array( 'name'=>'cb[]','value'=>$d[$x]->conv_id  )); ?> </td>
            <td><?php selectBox( array( 'name'=>'from_unit_id[]','value'=>$d[$x]->from_unit_id,'selectedValue'=>$d[$x]->from_unit_id   )); ?> </td>
            <td><?php selectBox( array( 'name'=>'conv_unit_id[]','value'=>$d[$x]->conv_unit_id,'selectedValue'=>$d[$x]->conv_unit_id   )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"conv_unit_qty[]",'value'=>$d[$x]->conv_unit_qty  )); ?> </td>
   </tr>        

<?php    
}

for ($x = 0; $x < 5; $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_conv_id[]">
                <?php checkbox( array( 'name'=>'select[]')); ?> </td>
            <td><?php selectBox( array( 'name'=>'from_unit_id[]')); ?> </td>
            <td><?php selectBox( array( 'name'=>'conv_unit_id[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"conv_unit_qty[]")); ?> </td>
    
    
<?php                               
} 
?>
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("conv_units/delete")  . "');"));        
?>    
</div>

</form>    
    
</div>    
<?php includePageJS(); ?>  
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>     
</body>
</html>