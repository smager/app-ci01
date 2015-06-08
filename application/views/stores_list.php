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
            <td><a href="javascript:AddRemoveSupplies(<?php echo $d[$x]->store_id; ?>)">Add/Remove Supplies</a><?php echo $l_supplies; ?></td>
        
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

    

</div> <!---end of container-page-->
 

<?php includeHandleBars(); ?>    
<script type="text/javascript">

    
function AddRemoveSupplies(p_id){
    zsi.json.loadGrid({
         table  : "#tblProdSupp"
        ,url    : base_url + "store_supplies/getdata_json/" + p_id
        ,td_body: [ 
            function(d){
                return '<input type="hidden" name="store_supply_id[]">'
                    + '<input id="p_cb[]" class="" type="checkbox" name="p_cb[]">'
                    + '<input id="p_hid_cb[]" type="hidden" value="1" name="p_hid_cb[]">';    
            }            
            ,function(d){
                return d.supply_code;                         
            }
        ]
        //,td_properties:[]   
        ,onComplete : function(){
             $('#modalWindow').modal("show");
        }
    });    
}    
    
    
$(document).ready(function(){

    //get dialog template
    $.get(base_url + "assets/templates/bsDialogBox.txt",function(d){
        var template = Handlebars.compile(d);     
        
        var context = { id:"modalWindow"
                        , title: "Add/Remove Supply"
                        , footer:   '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
                                  + '<button type="button" class="btn btn-primary">Save</button>'
                        , body: '<table id="tblProdSupp" class="table row">'
                                + '<thead>'
                                    + '<tr><th width="20"></th><th>Names</th></tr>'
                                + '</thead>'
                                + '</table>'
                      };
        var html    = template(context);     
        $("body").append(html);
    });
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
<?php includeFooter(); ?> 
</body>
</html>