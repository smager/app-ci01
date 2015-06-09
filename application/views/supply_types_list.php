<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Supply Types:List</title>
<?php
    includeHeader();    
?> 
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('supply_types/update');?>" method="post" >
<table class="table">    
    <tr>
        <th></th>
        <th>Supply Type</th>
    </tr>
<?php

 $q=$this->supply_types_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_supply_type_id[]" value="<?php echo $d[$x]->supply_type_id; ?>">
                <?php checkbox( array( 'name'=>'cb[]','value'=>$d[$x]->supply_type_id  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"supply_type[]",'value'=>$d[$x]->supply_type  )); ?> </td>
    </tr>        

<?php    
}

for ($x = 0; $x < 5; $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_supply_type_id[]">
                <?php checkbox( array( 'name'=>'select[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"supply_type[]")); ?> </td>
            </td>
    </tr>
    
    
<?php                               
} 
?>
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("supply_types/delete")  . "');"));        
?>    
</div>

</form>    
    
</div>    
<?php includePageJS(); ?>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>     
</body>
</html>