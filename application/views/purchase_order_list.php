<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Purchase Order</title>
<?php
    includeHeader();    
?>     
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" >
    

<div >
    <div class="form-horizontal ">
        <?php 

            //hiddenBox( array( 'name'=>'store_daily_cash_id'));         
            openFormGroup();
            inputTextBox( array( 'labelName'=>'P.O. #' , 'name'=>'po_no', 'labelSize'=>1, 'inputSize'=>2)); 
            inputTextBox( array( 'labelName'=>'Date' , 'name'=>'po_date', 'labelSize'=>1, 'inputSize'=>2,'value'=>date('m/d/Y') )); 
            selectBox( array( 'labelName'=>'Supplier' , 'name'=>'supplier_id', 'labelSize'=>1, 'selectSize'=>2));      
            selectBox( array( 'labelName'=>'Location' , 'name'=>'loc_id', 'labelSize'=>1, 'selectSize'=>2));      
            closeFormGroup();

        ?> 
    </div>
</div>    
    

    
<table id="grid" class="table">
    <thead>
        <tr>
            <th></th>
            <th>Qty</th>
            <th>Unit</th>
            <th>Item</th>
            <th>Unit Price</th>

        </tr>
    </thead>        
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("purchase_order/delete")  . "');"));        
?>    
</div>

</form>    
    
</div>  
    
<?php includePageJS(); ?> 
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap-datepicker.js"); ?>"></script>       
<?php includeFooter(); ?> 
</body>
</html>