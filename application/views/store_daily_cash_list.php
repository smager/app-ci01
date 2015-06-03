<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Store Daily Cash </title>
<?php
    includeHeader();    
?>     
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('store_daily_cash/update');?>" method="post" >
<div class="col-xs-8">
    <div class="form-horizontal ">
        <?php 
            selectBox( array( 'labelName'=>'Location' , 'name'=>'store_loc_id', 'labelSize'=>1, 'selectSize'=>3));      
            inputTextBox( array( 'labelName'=>'Date' , 'name'=>'date', 'labelSize'=>1, 'inputSize'=>3)); 
            yes_no( array( 'labelName'=>'Posted' , 'name'=>'posted', 'labelSize'=>1, 'selectSize'=>3));      
        ?> 
    </div>
</div>    
<div class="col-xs-8">    
<table class="table row" >    
    <tr>
        <th width="40" >Denomination</th>    
        <th  >Qty</th>    
        <th  >Amount</th>    
    </tr>    
<?php

 $q=$this->denomination_ref_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
?>
    <tr>
        <td style="text-align: right;padding-right: 5px"><?php echo $d[$x]->denomination; ?> </td>
        <td ><?php inputTextBox( array( 'name'=>"qty[]")); ?> </td>      
        <td ><?php inputTextBox( array( 'name'=>"amt[]")); ?> </td>    
    </tr>        

<?php    
}
?>
</table>       
</div>
</form>    
    
</div>
    
<script type="text/javascript">
var ctrlSel = zsi.control.SelectList;  
    
$(document).ready(function(){
 ctrlSel( base_url + "common/get_select_data","select[name='p_store_loc_id']","","N","store_loc","store_loc_id","store_loc","");
});    
     
function checkDelete(l_cmd) {
   var l_stmt=[], l_count;
    
   var data = zsi.table.getCheckBoxesValues("input[name='p_cb[]']:checked");
    for(var x=0;x<data.length; x++){
        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); 
    }
   if (l_stmt!="") {
      if(confirm("Are you sure you want to delete selected items?")) {
      $.post( l_cmd , l_stmt, function(d){
            window.location.reload();
            //console.log(d);
         }).fail(function(d) {
            alert("Sorry, the curent transaction is not successfull.");
        });
      }
   }
return false;
}   
    
</script>    
<script type="text/javascript" src="/assets/js/bootstrap-datepicker.js"></script>    
<?php includeFooter(); ?>    
</body>
</html>