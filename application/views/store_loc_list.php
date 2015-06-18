<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Store Locations</title>
<?php
    includeHeader();    
?> 
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('store_loc/update');?>" method="post" >
<table class="table">    
    <tr>
        <th></th>
        <th>Store Type</th>
        <th>Location</th>
        <th>Area</th>       
        <th>Active?</th>
        <th>Daily Stocks Ref.</th>
        
    </tr>
<?php

 $q=$this->store_loc_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_store_loc_id[]" value="<?php echo $d[$x]->store_loc_id; ?>">
                <?php checkbox( array( 'name'=>'cb[]','value'=>$d[$x]->store_loc_id  )); ?> </td>
            <td><?php selectBox( array( 'name'=>'store_id[]','value'=>$d[$x]->store_id,'selectedValue'=>$d[$x]->store_id   )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"store_loc[]",'value'=>$d[$x]->store_loc  )); ?> </td>
            <td><?php selectBox( array( 'name'=>'loc_id[]','value'=>$d[$x]->store_id,'selectedValue'=>$d[$x]->loc_id   )); ?> </td>
            <td><?php yes_no(array('name'=>'active[]','mandatory'=>'N','value'=>$d[$x]->active )); ?> </td>
            <td><a href="javascript:manageItems(<?php echo $d[$x]->store_loc_id; ?>);">Manage Items</a></td>
    </tr>        

<?php    
}

for ($x = 0; $x < 5; $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_store_loc_id[]">
                <?php checkbox( array( 'name'=>'select[]')); ?> </td>
            <td><?php selectBox( array( 'name'=>'store_id[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"store_loc[]")); ?> </td>
            <td><?php selectBox( array( 'name'=>'loc_id[]')); ?> </td>
            <td><?php yes_no(array('name'=>'active[]','mandatory'=>'N')); ?> </td>
            <td></td>
    </tr>
    
    
<?php                               
} 
?>
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("store_loc/delete")  . "');"));        
?>    
</div>

</form>    
    
</div>    
<?php includePageJS(); ?>     
<?php includeFooter(); ?> 
</body>
</html>