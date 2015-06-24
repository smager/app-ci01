<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Receiving</title>
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
a.poRemove{
    color: #3071a8;
    float: right;
    font-size: 20pt;
    margin-right: 10px;
    text-decoration: none;
    top: -31px;
}
    
a.poRemove:hover{
    color:red;
    text-decoration:none;
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

            hiddenBox( array( 'name'=>'receiving_id'));        
            openFormGroup();
                selectBox( array( 'labelName'=>'P.O. #' , 'name'=>'po_id', 'labelSize'=>1, 'selectSize'=>2));  
                inputTextBox( array( 'labelName'=>'Supplier' , 'name'=>'supplier_name', 'labelSize'=>1, 'inputSize'=>2)); 
            closeFormGroup();
            openFormGroup();
                inputTextBox( array( 'labelName'=>'D.R#' , 'name'=>'dr_no', 'labelSize'=>1, 'inputSize'=>2)); 
                inputTextBox( array( 'labelName'=>'Date' , 'name'=>'dr_date', 'labelSize'=>1, 'inputSize'=>2,'value'=>date('m/d/Y') )); 
                selectBox( array( 'labelName'=>'Location' , 'name'=>'loc_id', 'labelSize'=>1, 'selectSize'=>2));      
            closeFormGroup();

        ?> 
    </div>
</div>    
    
<div class="col-xs-3 poLeftBox">

<div class="panel panel-default">
  <div class="panel-heading">Unposted DR(s)</div>
  <div class="panel-body">

        <div class="list-group">
 
           
        </div>
    
   </div>
</div>
    
</div>
<div class="col-xs-9">    
<table id="grid" class="table">
    <thead>
        <tr>
            <th></th>
            <th>Balance</th>
            <th>Qty</th>
            <th>Unit</th>
            <th>Item</th>
        </tr>
    </thead>        
</table>    
<div class="buttonGroup">
<?php   
Button(array('name'=>'New','type'=>'button'));    
Button(array('name'=>'Save','type'=>'submit'));    
Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url($this->router->fetch_class()) . "delete');"));        
?>    
</div>
</div>


</form>    
    
</div>  
    
<?php includePageJS(); ?>     
<?php includeFooter(); ?> 
</body>
</html>