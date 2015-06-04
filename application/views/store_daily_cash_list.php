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
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
    <div class="form-horizontal ">
        <?php 

            hiddenBox( array( 'name'=>'store_daily_cash_id'));         
            openFormGroup();
            selectBox( array( 'labelName'=>'Location' , 'name'=>'store_loc_id', 'labelSize'=>1, 'selectSize'=>3));      
            inputTextBox( array( 'labelName'=>'Date' , 'name'=>'tran_date', 'labelSize'=>1, 'inputSize'=>3)); 
            yes_no( array( 'labelName'=>'Posted' , 'name'=>'posted', 'labelSize'=>1, 'selectSize'=>3));      
            closeFormGroup();

        ?> 
    </div>
</div>    
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">    
<table id="tblStoreDailyCash" class="table row" >    
    <tr>
        <th width="40" >Denomination</th>    
        <th  >Qty</th>    
        <th  >Amount</th>    
    </tr>    

</table>
<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
?>    
</div>    
    
</div>
</form>    
    
</div>    
<script type="text/javascript">

var p_store_daily_cash_id = $("#p_store_daily_cash_id");
var p_store_loc_id        = $("#p_store_loc_id");
var p_tran_date           = $("#p_tran_date"); 
var l_timer;    
    
    
p_store_loc_id.change(function(){    
    if(this.value!='' && new Date(p_tran_date.val()).isValid()){    
        getStoreDailyCashData();
    }                        
});    
    
    
p_tran_date.keyup(function(e) {     
    switch(e.keyCode){
        case  9:break;//alt+tab
        case 17:break;//ctrl
        case 18:break;//alt
        case 39:break;//Right
        case 37:break;//Left
        case 40:break;//Down
        case 38:break;//Up            
        case 13:break;//enter
        default:
            clearTimeout(l_timer);
            var l_value=this.value;
            l_timer = setTimeout(function(){       
                if(p_store_loc_id.val()!='' && new Date(l_value).isValid()){    
                    getStoreDailyCashData();
                }                    
            }, 500);
            break;
    }
});    

    
p_tran_date.change(function() { 
    if(p_store_loc_id.val()!='' && new Date(this.value).isValid()){    
        getStoreDailyCashData();
    }
});      
    
    
    
function getStoreDailyCashData(){  
    var l_data  = { 'store_loc_id' : p_store_loc_id.val(), 'tran_date': p_tran_date.val() }; 
    $.getJSON(base_url + "store_daily_cash/get_json",l_data
       ,function(d){
              if(d.length > 0 ) {
                  p_store_daily_cash_id.val(d[0].store_daily_cash_id);
                  getStoreDailyCashDetailData();
              }else{
                  getDenominationData();
              }
        }
    );
        
}
    
    
function getDenominationData(){        
        p_store_daily_cash_id.val('');
        var jsonGrid = $("#tblStoreDailyCash");
        jsonGrid.clearGrid();        
        $.getJSON(base_url + "denomination_ref/get_json"
               ,function(d){
                     $.each(d, function () {
                        var r = ""
                        r +="<tr>";
                            r +="<td style='text-align: right;padding-right: 5px'>";
                         
                                r +='<input name="p_store_daily_cash_dtl_id[]" type="hidden">';
                                r +='<input name="p_denomination[]" value="' + this.denomination + '" type="hidden">';                          
                                r +="" +  this.denomination;
                            r +="</td>";
                            r +="<td >";
                                r +='<input type="text" name="p_denomination_qty[]"  class="form-control input-sm ">';                                    
                            r +="</td>";
                            r +="<td >";
                                r +='<input type="text" name="p_cash_amount[]" class="form-control input-sm ">';                                    
                            r +="</td>";
                        r +="</tr>";                         
                     
                         jsonGrid.append(r);
                     });
                         
                }
        );
}
    

    
function getStoreDailyCashDetailData(){        
        var jsonGrid = $("#tblStoreDailyCash");
        jsonGrid.clearGrid();
    
        $.getJSON(base_url + "store_daily_cash/get_detail_json/" + p_store_daily_cash_id.val()
               ,function(d){
                     $.each(d, function () {
                        var r = ""
                        r +="<tr>";
                            r +="<td style='text-align: right;padding-right: 5px'>";
                         
                                r +='<input name="p_store_daily_cash_dtl_id[]" value="' + this.store_daily_cash_dtl_id + '" type="hidden">';
                                r +='<input name="p_denomination[]" value="' + this.denomination + '" type="hidden">';                          
                                r +="" +  this.denomination;
                            r +="</td>";
                            r +="<td >";
                                r +='<input type="text" name="p_denomination_qty[]"   value="' + this.denomination_qty + '" class="form-control input-sm ">';                                    
                            r +="</td>";
                            r +="<td >";
                                r +='<input type="text" name="p_cash_amount[]"  value="' + this.cash_amount + '" class="form-control input-sm ">';                                    
                            r +="</td>";
                        r +="</tr>";
                         
                         jsonGrid.append(r);
                     });
                         
                }
        );
}
    

var ctrlSel = zsi.control.SelectList;  
    
    
    
$(document).ready(function(){
 ctrlSel( base_url + "common/get_select_data","select[name='p_store_loc_id']","","N","store_loc","store_loc_id","store_loc","");
});    
     
</script>    
<script type="text/javascript" src="/assets/js/bootstrap-datepicker.js"></script>    
<?php includeFooter(); ?>    
</body>
</html>