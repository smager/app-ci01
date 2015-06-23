<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Store Daily Cash : Returns </title>
<?php
    includeHeader(array("datePicker"=>true));      
?>
    
<style>
table tr#total td{
    font-size:13px;
}
table tr#total td#totalTitle{
    font-weight: bold;
    text-align:right;
    padding-right:10px;
}

.tblStoreDailyCash tr#total {
    background-color: #dfecfa;
}    
  
    
    
</style>    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" >
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
    <div class="form-horizontal ">
        <?php 
            hiddenBox( array( 'name'=>'store_daily_cash_id'));         
            hiddenBox( array( 'name'=>'tran_type','value'=>"cashsales"));         
            openFormGroup();
            selectBox( array( 'labelName'=>'Location' , 'name'=>'store_loc_id', 'labelSize'=>1, 'selectSize'=>3));      
            inputTextBox( array( 'labelName'=>'Date' , 'name'=>'tran_date', 'labelSize'=>1, 'inputSize'=>3,'value'=>date('m/d/Y') )); 
            yes_no( array( 'labelName'=>'Posted' , 'name'=>'posted', 'labelSize'=>1, 'selectSize'=>3));      
            closeFormGroup();

        ?> 
    </div>
</div>    
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">    
<table class="tblStoreDailyCash table row" >    
    <thead>
        <tr>
            <th width="40" >Denomination</th>    
            <th  >Qty</th>    
            <th  >Amount</th>    
        </tr>  
    </thead>        

</table>
<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'button'));    
?>    
</div>    
    
</div>
</form>    
    
</div>    
<?php includePageJS(); ?>        
<?php includeFooter(); ?>    
</body>
</html>