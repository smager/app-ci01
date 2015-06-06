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
<table class="tblStoreDailyCash table row" >    
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
var ctrlSel = zsi.control.SelectList;
    
var p_store_daily_cash_id = $("#p_store_daily_cash_id");
var p_store_loc_id        = $("#p_store_loc_id");
var p_tran_date           = $("#p_tran_date"); 
var l_timer;    


function setChangeEvent(){   
    //add tr for summary total
    var l_summaryTR = "<tr id='total'><td id='totalTitle' colspan='2'>Total = </td><td style='text-align: right;padding-right: 10px'><label id='lblSum'>0.00</label></td></tr>";
     $(".tblStoreDailyCash").append(l_summaryTR);
    computeTotal();

    //allow only numirec input
    zsi.initInputTypesAndFormats();
    
    //set input change event
    $("input[name='p_denomination_qty[]']").keyup(function(){
        
        var l_denomination = $(this.parentNode).prev().children("input[name='p_denomination[]']");
        var l_tdAmount =$(this.parentNode).next();     
        var l_amount = l_tdAmount.children("input[name='p_cash_amount[]']");
        var l_lblamount = l_tdAmount.children("label");
        var l_result =  this.value * l_denomination.val();
        l_amount.val(0);
        l_lblamount.text('');
        if( l_result > 0){
            l_amount.val(l_result);
            l_lblamount.text(l_result.toFixed(2));
        }
        computeTotal();
    });
}
    
function computeTotal(){
    var l_total=0;
    $("input[name='p_cash_amount[]']").each(function(){
        if(this.value) l_total  = (l_total + parseFloat(this.value)); 
    });
    
    $("#lblSum").text(l_total.toFixed(2));
}    
    

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
    zsi.json.loadGrid({
         table  : ".tblStoreDailyCash"
        ,url    : base_url + "denomination_ref/get_json"
        ,td_body: [ 
            function(d){
                return '<input name="p_store_daily_cash_dtl_id[]" type="hidden">' 
                + '<input name="p_denomination[]" value="' + d.denomination + '" type="hidden">' 
                +  d.denomination;                         
            }
            ,function(d){
                return '<input type="text" name="p_denomination_qty[]"  class="form-control input-sm numeric">';
            }
            ,function(d){
                return '<input type="hidden" name="p_cash_amount[]" class="form-control input-sm "><label class="lblAmt"></label>';                         
                
            }
        ]
        ,td_properties:[
            "style='text-align: right;padding-right: 5px'"   
            ,""   
            ,"style='text-align: right;padding-right: 10px'"               
        ]   
        ,onComplete : function(){
            setChangeEvent(); 
        }
    });
}
    
 
function getStoreDailyCashDetailData(){    
    zsi.json.loadGrid({
         table  :".tblStoreDailyCash"
        ,url    :base_url + "store_daily_cash/get_detail_json/" + p_store_daily_cash_id.val()
        ,td_body:[ 
            function(d){
                return '<input name="p_store_daily_cash_dtl_id[]" value="' + d.store_daily_cash_dtl_id + '" type="hidden">'
                + '<input name="p_denomination[]" value="' + d.denomination + '" type="hidden">'                          
                +  d.denomination;                
            }
            ,function(d){
                return '<input type="text" name="p_denomination_qty[]" value="' + (parseFloat(d.denomination_qty) > 0 ? d.denomination_qty : '') + '" class="form-control input-sm numeric">';                                                    
            }
            ,function(d){                
                return '<input type="hidden" name="p_cash_amount[]"  value="' + d.cash_amount + '" class="form-control input-sm" >'                                                    
                +  '<label class="lblAmt">' + (parseFloat(d.cash_amount) > 0 ? d.cash_amount : '') + '</label>';                         
            }
        ]
        ,td_properties:[
            "style='text-align: right;padding-right: 5px'"   
            ,""   
            ,"style='text-align: right;padding-right: 10px'"   
        ]
        ,onComplete : function(){
            setChangeEvent(); 
        }
                 
    });    
}
    
    
$(document).ready(function(){
 ctrlSel( base_url + "common/get_select_data","select[name='p_store_loc_id']","","N","store_loc","store_loc_id","store_loc","");
});    
     
</script>    
<script type="text/javascript" src="/assets/js/bootstrap-datepicker.js"></script>    
<?php includeFooter(); ?>    
</body>
</html>