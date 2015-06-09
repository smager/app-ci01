<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Units</title>
<?php
    includeHeader();    
?> 
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('units/update');?>" method="post" >
<table class="table">    
    <tr>
        <th></th>
        <th>Code</th>
        <th>Description</th>
    </tr>
<?php

 $q=$this->units_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_unit_id[]" value="<?php echo $d[$x]->unit_id; ?>">
                <?php checkbox( array( 'name'=>'cb[]','value'=>$d[$x]->unit_id  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"unit_sdesc[]",'value'=>$d[$x]->unit_sdesc  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"unit_desc[]",'value'=>$d[$x]->unit_desc  )); ?> </td>
    </tr>        

<?php    
}

for ($x = 0; $x < 5; $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_unit_id[]">
                <?php checkbox( array( 'name'=>'select[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"unit_sdesc[]")); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"unit_desc[]")); ?> </td>
            </td>
    </tr>
    
    
<?php                               
} 
?>
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("units/delete")  . "');"));        
?>    
</div>

</form>    
    
</div>
    
<?php includePageJS(); ?>     

<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>     
</body>
</html>