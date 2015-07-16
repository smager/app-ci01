<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Stock Transfer</title>
<?php
    includeHeader(array("datePicker"=>true));    
?>
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('stock_transfer/update');?>" method="post" >
    

<div >
    <div class="form-horizontal ">
        <?php 

            hiddenBox( array( 'name'=>'st_id'));         
            openFormGroup();
            inputTextBox( array( 'labelName'=>'S.T #' , 'name'=>'st_no', 'labelSize'=>1, 'inputSize'=>1)); 
            inputTextBox( array( 'labelName'=>'Date' , 'name'=>'st_date', 'labelSize'=>1, 'inputSize'=>1,'value'=>date('m/d/Y') )); 
            selectBox( array( 'labelName'=>'Loc. From' , 'name'=>'loc_id', 'labelSize'=>1, 'selectSize'=>2));  
            selectBox( array( 'labelName'=>'Loc. To' , 'name'=>'loc_id_to', 'labelSize'=>1, 'selectSize'=>2));  
            yes_no( array( 'labelName'=>'Posted' , 'name'=>'posted', 'labelSize'=>1, 'selectSize'=>1));      
            closeFormGroup();

        ?> 
    </div>
</div>    
    
<div class="col-xs-3 itemLeftBox">
    <div class="panel panel-default">
      <div class="panel-heading">Unposted Stock Transer(s)</div>
      <div class="panel-body">
            <div class="list-group"></div>    
       </div>
    </div>    
</div>
<div class="col-xs-9">    
    <table id="grid" class="table">
        <thead>
            <tr>
                <th></th>
                <th>Item</th>
                <th>Qty</th>

            </tr>
        </thead>        
    </table>    
    <div class="buttonGroup">
        <?php 
        Button(array('name'=>'New','type'=>'button'));    
        Button(array('name'=>'Save','type'=>'submit'));    
        Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("stock_transfer/delete_dtls")  . "');"));        
        ?>    
    </div>
</div>


</form>    
    
</div>  
    
<?php includePageJS(); ?>     
<?php includeFooter(); ?> 
</body>
</html>