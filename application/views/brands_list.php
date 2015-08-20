<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>brand Reference</title>
<?php
    includeHeader();    
?>     
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('brands/update');?>" method="post" >
<table class="zTable fullWidth">    
    <tr>
        <th></th>
        <th>Brand Name</th>
    </tr>
<?php

 $q=$this->brands_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_brand_id[]" value="<?php echo $d[$x]->brand_id; ?>">
                <?php checkbox( array( 'name'=>'cb[]','value'=>$d[$x]->brand_id  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>'brand_name[]','value'=>$d[$x]->brand_name  )); ?> </td>
    </tr>        

<?php    
}

for ($x = 0; $x < 5; $x++) {
?>
    <tr>
        
            <td align="right"><input type="hidden" name="p_brand_id[]">
                <?php checkbox( array( 'name'=>'select[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>'brand_name[]')); ?> </td>
    </tr>
    
    
<?php                               
} 
?>
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("brands/delete")  . "');"));        
?>    
</div>

</form>    
    
</div>
    
<?php includePageJS(); ?>  
<?php includeFooter(); ?> 
</body>
</html>