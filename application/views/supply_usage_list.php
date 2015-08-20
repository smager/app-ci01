<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Store Daily Stocks</title>
<?php
    includeHeader(array("datePicker"=>true));    
?>
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm"  action="<?php echo base_url( $this->router->fetch_class() .'/usage_update');?>" method="post">
<div class="col-xs-10 ">
    <div class="form-horizontal ">
        <?php 
            openFormGroup();
            selectBox( array( 'labelName'=>'Store' , 'name'=>'supply_is_id', 'labelSize'=>1, 'selectSize'=>3));      
            inputTextBox( array( 'labelName'=>'IS#' , 'name'=>'is_no', 'labelSize'=>1, 'inputSize'=>2 )); 
            inputTextBox( array( 'labelName'=>'Date' , 'name'=>'is_date', 'labelSize'=>1, 'inputSize'=>2 )); 
            yes_no( array( 'labelName'=>'Posted' , 'name'=>'posted_used', 'labelSize'=>1, 'selectSize'=>1));                  

            closeFormGroup();

        ?> 
    </div>
</div>    
 
<div class="col-xs-10">   
<table class="zTable fullWidth" >    
    <thead>
        <tr>
            <th width="40" ></th>    
            <th>Items</th>  
            <th>Brand/Unit</th> 
            <th>Beg. Qty</th> 
            <th>Used Qty</th>
            <th>Returned Qty</th> 
        </tr>  
    </thead>        

</table>
<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
?>    
</div>    
    
</div>
</form>    
    
</div>    
<?php includePageJS(); ?>        
<?php includeFooter(); ?>    
</body>
</html>