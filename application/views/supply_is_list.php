<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Store Daily Stocks</title>
<?php
    includeHeader();    
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

.tblStoreDailyStocks tr#total {
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
            hiddenBox( array( 'name'=>'supply_is_id'));         
            openFormGroup();
            selectBox( array( 'labelName'=>'Location' , 'name'=>'store_loc_id', 'labelSize'=>1, 'selectSize'=>3));      
            inputTextBox( array( 'labelName'=>'IS#' , 'name'=>'is_no', 'labelSize'=>1, 'inputSize'=>2 )); 
            inputTextBox( array( 'labelName'=>'Date' , 'name'=>'is_date', 'labelSize'=>1, 'inputSize'=>2,'value'=>date('m/d/Y') )); 
            yes_no( array( 'labelName'=>'Posted' , 'name'=>'posted', 'labelSize'=>1, 'selectSize'=>1));      
            closeFormGroup();

        ?> 
    </div>
</div>    
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">    
<table class="tblStoreDailyStocks table row" >    
    <thead>
        <tr>
            <th width="40" >Items</th>    
            <th>Qty</th>                  
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
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap-datepicker.js"); ?>"></script>    
<?php includeFooter(); ?>    
</body>
</html>