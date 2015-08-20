<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Locations</title>
<?php
    includeHeader();    
?> 
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('locations/update');?>" method="post" >
<table class="zTable fullWidth">    
    <tr>
        <th></th>
        <th>Area/Location</th>
        <th>Stocks</th>
    </tr>
<?php

 $q=$this->locations_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_loc_id[]" value="<?php echo $d[$x]->loc_id; ?>">
                <?php checkbox( array( 'name'=>'cb[]','value'=>$d[$x]->loc_id  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"location[]",'value'=>$d[$x]->location  )); ?> </td>
            <td><a href="javascript:manageItems(<?php echo $d[$x]->loc_id; ?>);">Manage Items</a></td>
    </tr>        

<?php    
}

for ($x = 0; $x < 5; $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_loc_id[]">
                <?php checkbox( array( 'name'=>'select[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"location[]")); ?> </td>
            <td></td>
    </tr>
    
    
<?php                               
} 
?>
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("location/delete")  . "');"));        
?>    
</div>

</form>    
    
</div>
<?php includeHandleBars(); ?>       
<?php includePageJS(); ?>    
<?php includeFooter(); ?>  
</body>
</html>