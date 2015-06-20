<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Purchase Order</title>
<?php
    includeHeader(array("datePicker"=>true));    
?>
<style>
.poLeftBox {    
    margin-top: 10px;
}
.poLeftBox .panel-body{
    height: 400px;
    overflow:auto;
}
    
</style>    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('purchase_order/update');?>" method="post" >
    

<div >
    <div class="form-horizontal ">
        <?php 

            hiddenBox( array( 'name'=>'po_id'));         
            openFormGroup();
            inputTextBox( array( 'labelName'=>'P.O. #' , 'name'=>'po_no', 'labelSize'=>1, 'inputSize'=>2)); 
            inputTextBox( array( 'labelName'=>'Date' , 'name'=>'po_date', 'labelSize'=>1, 'inputSize'=>2,'value'=>date('m/d/Y') )); 
            selectBox( array( 'labelName'=>'Supplier' , 'name'=>'supplier_id', 'labelSize'=>1, 'selectSize'=>2));      
            selectBox( array( 'labelName'=>'Location' , 'name'=>'loc_id', 'labelSize'=>1, 'selectSize'=>2));      
            closeFormGroup();

        ?> 
    </div>
</div>    
    
<div class="col-xs-2 poLeftBox">

<div class="panel panel-default">
  <div class="panel-heading">Unposted P.O #</div>
  <div class="panel-body">

        <div class="list-group">
 
           
        </div>
    
   </div>
</div>
    
</div>
<div class="col-xs-10">    
<table id="grid" class="table">
    <thead>
        <tr>
            <th></th>
            <th>Item</th>
            <th>Unit</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Total</th>

        </tr>
    </thead>        
</table>    
<div class="buttonGroup">
<?php 
Button(array('name'=>'New','type'=>'button'));    
Button(array('name'=>'Save','type'=>'submit'));    
Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("purchase_order/delete")  . "');"));        
?>    
</div>
</div>


</form>    
    
</div>  
    
<?php includePageJS(); ?>     
<?php includeFooter(); ?> 
</body>
</html>