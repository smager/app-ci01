var p_store_daily_cash_id = $("#p_store_daily_cash_id");
var p_store_loc_id        = $("#p_store_loc_id");
var p_empl_id             = $("#p_empl_id");
var p_tran_date           = $("#p_tran_date"); 
var p_posted              = $("#p_posted"); 
var p_event_id            = $("#p_event_id");
var l_timer;    

$(document).ready(function(){
    p_store_loc_id.dataBind( base_url + "select_options/code/store_locs");
    p_event_id.dataBind( base_url + "select_options/code/events");
    p_tran_date.val( new Date().toShortDate() );
});    

$("#btnGo").click(function(){
    if(p_store_loc_id.val()!=='' && new Date(p_tran_date.val()).isValid()){    
        getStoreDailyCashData();
    }      
});    


$("#btnSave").click(function(){
  $.post (base_url + "store_daily_cash/update", $("#frm").serializeArray(), function(d){
        getStoreDailyCashData();
  });
    
});    
    

function setChangeEvent(){   
    //allow only numirec input
    zsi.initInputTypesAndFormats();

    //set input change event
    $("input[name='p_denomination_qty[]']").keyup(function(){
        var l_denomination = $(this.parentNode).prev().children("label");
        var l_tdAmount =$(this.parentNode).next();     
        var l_lblamount = l_tdAmount.children("label");
        var l_amount = l_tdAmount.children("input[name='p_return_amount[]']");
        var l_result =  this.value * l_denomination.text();
        l_lblamount.text('');
        l_amount.val(0);
        if( l_result > 0){
            l_lblamount.text(l_result.toFixed(2));
            l_amount.val(l_result);
        }
    });
    
}


p_store_loc_id.change(function(){ 
    if(this.value!==''){
         p_empl_id.dataBind( base_url + "select_options/code/sales_staffs?where=store_loc_id=" + this.value);
    }
    
    /*if(this.value!=='' && new Date(p_tran_date.val()).isValid()){    
        getStoreDailyCashData();
    } 
    */
});    

function getStoreDailyCashData(){  
    var l_data  = { 'store_loc_id' : p_store_loc_id.val(), 'tran_date': p_tran_date.val() }; 
    $.getJSON(base_url + "store_daily_cash/get_json",l_data
       ,function(d){
              if(d.length > 0 ) {
                  var info =d[0];
                  p_store_daily_cash_id.val(info.store_daily_cash_id);
                  p_posted.val(info.posted_dsales);
                  p_empl_id.val(info.empl_id);
                  getStoreDailyCashDetailData();
              } 
        }
    );
        
}

function getStoreDailyCashDetailData(){   
    var totalAmt=0;
    var bs = zsi.bs.ctrl;    
    var tblClassId = "#tblStoreDailyCash";
    zsi.json.loadGrid({
         table  : tblClassId
        ,url    : base_url + "store_daily_cash/get_detail_json/" + p_store_daily_cash_id.val()
        ,td_body: [ 
            function(d){
                return bs({name:"store_daily_cash_dtl_id[]",type:"hidden",value: d.store_daily_cash_dtl_id })
                +  '<label>' + d.denomination + '</label>';                
            }
            ,function(d){
                return  bs({name:"denomination_qty[]",value: (d.return_denomination_qty!==null?d.return_denomination_qty:''),class:"form-control numeric"});  
            }   
            ,function(d){       
                totalAmt += parseFloat(d.return_amount);
                return bs({name:"return_amount[]",type:"hidden",value: d.return_amount,class:"form-control numeric"}) 
                +  '<label class="lblAmt">' + (parseFloat(d.return_amount) > 0 ? d.return_amount.toMoney() : '') + '</label>';  
            }                      
        ]
        ,td_properties:[
            "style='text-align: right;padding-right: 5px'"   
            ,""   
            ,"style='text-align: right;padding-right: 10px'"   
        ]
        ,onComplete : function(){
            setChangeEvent(); 
            $(tblClassId).append(""
                + "<tr class='total'>"
                    + "<td></td>"
                    + "<td></td>"
                    + "<td class='align-r'>"+ totalAmt.toMoney() +"</td>"
                + "</tr>"
            )
        }
                 
    });    
}
    
    
     