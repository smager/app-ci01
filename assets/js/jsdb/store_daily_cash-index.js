var ctrlSel = zsi.control.SelectList;
    
var p_store_daily_cash_id = $("#p_store_daily_cash_id");
var p_store_loc_id        = $("#p_store_loc_id");
var p_tran_date           = $("#p_tran_date"); 
var p_posted              = $("#p_posted"); 
var l_timer;    


$("#btnSave").click(function(){
  $.post (
          base_url + "store_daily_cash/update"
        , $("#frm").serializeArray()
        , function(d){
            p_posted.val(0);
            getStoreDailyCashData();
        }
    );
});    
    

function setChangeEvent(){   
    //add tr for summary total
    var l_summaryTR = "<tr class='total'><td id='totalTitle' colspan='2'>Total</td><td style='text-align: right;padding-right: 10px'><label id='lblSum'>0.00</label></td></tr>";
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
            l_lblamount.text(l_result.toMoney());
        }
        computeTotal();
    });
}
    
function computeTotal(){
    var l_total=0;
    $("input[name='p_cash_amount[]']").each(function(){
        if(this.value) l_total  = (l_total + parseFloat(this.value)); 
    });
    
    $("#lblSum").text(l_total.toMoney());
}    

    
function getStoreDailyCashData(){  
    var l_data  = { 'store_loc_id' : p_store_loc_id.val(), 'tran_date': p_tran_date.val() }; 
    $.getJSON(base_url + "store_daily_cash/get_json",l_data
       ,function(d){
              if(d.length > 0 ) {
                  info=d[0];
                  if(info.posted_dcash!=1){
                      p_store_daily_cash_id.val(info.store_daily_cash_id);
                      p_posted.val(info.posted_dcash);
                      getStoreDailyCashDetailData();
                  }else{
                      p_posted.val(0);
                      $(".tblStoreDailyCash").clearGrid();
                      alert("Record for this date is already posted.");
                  }
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
   ctrlSel( base_url + "select_options/code/store_locs","select[name='p_store_loc_id']","","N");
});    
     
     
     
$("#btnGo").click(function(){
    if(p_store_loc_id.val()!=='' && new Date(p_tran_date.val()).isValid()){    
        getStoreDailyCashData();
    }   
});     
     