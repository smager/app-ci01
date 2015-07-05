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
.itemLeftBox {    
    margin-top: 10px;
}
.itemLeftBox .panel-body{
    height: 400px;
    overflow:auto;
}
a.itemRemove{
    color: #3071a8;
    float: right;
    font-size: 20pt;
    margin-right: 10px;
    text-decoration: none;
    top: -31px;
}
    
a.itemRemove:hover{
    color:red;
    text-decoration:none;
}    
    
</style>    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url($this->router->fetch_class()) . '/update';?>" method="post" >
    

<div >
    <div class="form-horizontal ">
        <?php 

            hiddenBox( array( 'name'=>'receiving_id'));        
            hiddenBox( array( 'name'=>'po_id'));    
            openFormGroup();
                selectBox( array( 'labelName'=>'P.O. #' , 'name'=>'po_filter', 'labelSize'=>1, 'selectSize'=>2));  
                inputTextBox( array( 'labelName'=>'Supplier' , 'name'=>'supplier_name', 'labelSize'=>1, 'inputSize'=>2)); 
                inputTextBox( array( 'labelName'=>'Location' , 'name'=>'loc_id', 'labelSize'=>1, 'inputSize'=>2));      
            closeFormGroup();
            openFormGroup();
                inputTextBox( array( 'labelName'=>'D.R#' , 'name'=>'dr_no', 'labelSize'=>1, 'inputSize'=>2)); 
                inputTextBox( array( 'labelName'=>'Date' , 'name'=>'dr_date', 'labelSize'=>1, 'inputSize'=>2,'value'=>date('m/d/Y') )); 
            closeFormGroup();

        ?> 
    </div>
</div>    
    
<div class="col-xs-3 itemLeftBox">

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
            <th>Supply</th>
            <th>Brand/Unit</th>
            <th>Qty</th>
            <th style="text-align:center;">Current Bal.</th>
            <th style="text-align:center;">Ending Bal.</th>
        </tr>
    </thead>        
</table>    
<div class="buttonGroup">
<?php   
Button(array('name'=>'New','type'=>'button'));    
Button(array('name'=>'Save','type'=>'submit'));    
Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url($this->router->fetch_class()) . "/delete_dtls');"));        
?>    
</div>
</div>


</form>    
    
</div>  
    
<?php includePageJS(); ?>     
<?php includeFooter(); ?> 
</body>
</html>