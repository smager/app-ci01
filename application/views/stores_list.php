<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>store:List</title>
<?php
    includeHeader();    
?> 
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('stores/update');?>" method="post" >
<table class="table">    
    <tr>
        <th></th>
        <th>Store Name</th>
        <th>Products/Supplies</th>
    </tr>
<?php

 $q=$this->stores_model->getdata();
 $d=$q->result();


for ($x = 0; $x < $q->num_rows(); $x++) {
    $ssq=$this->store_supplies_model->getdata($d[$x]->store_id);
    $ssd=$ssq->result();  

    $l_supplies = '';  
    $l_br = '<br />';
    for ($y = 0; $y < $ssq->num_rows(); $y++) { 
        $l_supplies = $l_supplies . $l_br . $ssd[$y]->supply_code;
        $l_br = '<br />';
    }
?>
    <tr>
        
            <td><input type="hidden" name="p_store_id[]" value="<?php echo $d[$x]->store_id; ?>">
                <?php checkbox( array( 'name'=>'cb[]','value'=>$d[$x]->store_id  )); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"store_name[]",'value'=>$d[$x]->store_name  )); ?> </td>
            <td><a href>Add/Remove Supplies</a><?php echo $l_supplies; ?></td>
        
    </tr>        

<?php    
}

for ($x = 0; $x < 5; $x++) {
?>
    <tr>
        
            <td><input type="hidden" name="p_store_id[]">
                <?php checkbox( array( 'name'=>'select[]')); ?> </td>
            <td><?php inputTextBox( array( 'name'=>"store_name[]")); ?> </td>
            <td></td>
    </tr>
    
    
<?php                               
} 
?>
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("store/delete")  . "');"));        
?>    
</div>

</form>    
    
</div>
    

<script type="text/javascript">

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
<?php includeFooter(); ?> 
</body>
</html>