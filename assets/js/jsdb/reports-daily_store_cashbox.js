var bs = zsi.bs.ctrl;
var  aRight = " style='text-align:right'";
var  aCenter = " style='text-align:center'";
var  aLeft = " style='text-align:left'";
var proc_url = base_url + "common/executeproc/";

//public computation:
var tYesterdayAmt=0;
var ttodayAmt=0;
var tCRAmt=0;
var tSalesExpAmt = 0;
var tExpAmt = 0;
var currDate ="";


setInputs();
$(document).ready(function(){
    $("#p_store_loc_id").dataBind(base_url + "select_options/code/store_locs");
    is_date.val( new Date().toShortDate() );

    
});   

$("#btnGo").click(function(){
    if(store_loc_id.val()==="") {
        alert("Please select Store.");
        store_loc_id.focus(); 
        return;
    }
    if(is_date.val()==="") {
        alert("Please select Date.");
        is_date.focus(); 
        return;
    }    
    clearTotals();
    
    setYesterdayAndToday();    
    displayHeaderInfo();
    displayBankDepo();
    displayCashBoxRecords();

    
}); 

$("#btnPrint").click(function(){
    window.print();
});    

function clearTotals(){
    tYesterdayAmt       = 0;
    tCRAmt              = 0;
    tSalesExpAmt        = 0;
    ttl_stock_sales_amt = 0; 
    ttodayAmt           = 0;
    tExpAmt             = 0;
    
    $("#cashreport").clearGrid();
}

function displayHeaderInfo(){
    $.getJSON(base_url + "store_daily_cash/get_storedailycash?store_loc_id=" + store_loc_id.val()  + "&tran_date=" + is_date.val()
        , function(data){
            if(data.length > 0){
                var info = data[0];
                $(".emplname").html(info.empl_name);
                $(".eventdesc").html(info.event_desc);
            }
        }
    );    
}

function setYesterdayAndToday(){
    var yesterdayDate = new Date(is_date.val());
    var todayDate = new Date(is_date.val());
    yesterdayDate.setDate(yesterdayDate.getDate());  
    todayDate.setDate(todayDate.getDate() + 2);  

    $(".yesterday").html(yesterdayDate.toShortDate());
    $(".today").html(todayDate.toShortDate());
}
 
function setInputs(){
    store_loc_id = $("#p_store_loc_id");
    is_date = $("#p_is_date");
    
}
   
function displayCashBoxRecords(){
    var tableName ="#cashbox";
    var pf = parseFloat;
        zsi.json.loadGrid({
         table  : tableName
        ,url   : base_url + "reports/get_dailycash_inq?p_store_loc_id=" + store_loc_id.val()  + "&p_is_date=" + is_date.val()
        ,td_body: [ 
             function(d){   
                ttodayAmt+=pf(d.today_qty) * pf(d.denomination);
                tYesterdayAmt +=pf(d.cash_amount);                
                tCRAmt +=pf(d.return_amount===null?0:d.return_amount)
               return d.denomination;
             }     
            ,function(d){ return d.denomination_qty;} 
            ,function(d){ return pf(d.cash_amount).toMoney();}
            ,function(d){ return d.today_qty; }
            ,function(d){ return (pf(d.today_qty) * pf(d.denomination)).toMoney(); }
            ,function(d){ return (d.return_denomination_qty===null?0:d.return_denomination_qty);}
            ,function(d){ return pf(d.return_amount===null?0:d.return_amount).toMoney();  }
        ]
        ,td_properties: [
             aRight,aCenter,aRight,aCenter,aRight,aCenter,aRight
        ]
        ,onComplete: function(){
            var r  = "<tr class='total '>"
                    +  "<td></td><td></td>"
                    +  "<td" + aRight + ">" + tYesterdayAmt.toMoney() + "</td>"
                    +  "<td></td>"
                    +  "<td" + aRight + ">" + ttodayAmt.toMoney() + "</td>"
                    +  "<td></td>"
                    +  "<td" + aRight + ">" + tCRAmt.toMoney() + "</td>"
                    +  "</tr>";
            
            $(tableName).append(r);
            displaySalesExpeseRecords();
            
        }
        
    });       
}
 
function displaySalesExpeseRecords(){
    var tableName ="#salseexpense";
    var pf = parseFloat;
        zsi.json.loadGrid({
         table  : tableName
        ,url   : base_url + "reports/get_store_loc_sales_exp_inq?p_store_loc_id=" + store_loc_id.val()  + "&p_is_date=" + is_date.val()
        ,td_body: [ 
             function(d){  return d.exp_desc;}     
            ,function(d){ 
                tSalesExpAmt += pf(d.exp_amt);
                return pf(d.exp_amt).toMoney();
                
            }
        ]
        ,td_properties: [
             aLeft,aRight
        ]
        ,onComplete: function(){
            var r  = "<tr class='total '>"
                   +  "<td> Total</td>"
                    +  "<td" + aRight + ">" + tSalesExpAmt.toMoney() + "</td>"
                    +  "</tr>";
            $(tableName).append(r);
            displayExpeseRecords();

        }
        
    });       
} 
   
function displayExpeseRecords(){
    var tableName ="#expense";
    var pf = parseFloat;
    tExpAmt=0;
        zsi.json.loadGrid({
         table  : tableName
        ,url   : base_url + "reports/get_store_loc_exp_inq?p_store_loc_id=" + store_loc_id.val()  + "&p_is_date=" + is_date.val()
        ,td_body: [ 
             function(d){  return d.exp_desc;}     
            ,function(d){ 
                tExpAmt += pf(d.exp_amt);
                return pf(d.exp_amt).toMoney();
                
            }
        ]
        ,td_properties: [
             aLeft,aRight
        ]
        ,onComplete: function(){
            var r  = "<tr class='total '>"
                   +  "<td> Total</td>"
                    +  "<td" + aRight + ">" + tExpAmt.toMoney() + "</td>"
                    +  "</tr>";
            $(tableName).append(r);
            displayCashReportRecords();
        }
      
    }); 
} 

function displayCashReportRecords(){
    $.getJSON(base_url + "store_daily_cash/get_json?store_loc_id=" + store_loc_id.val() + "&tran_date=" + is_date.val() 
        , function(data){
            d=data[0];
            if(typeof d==="undefined") return;
            var tableName ="#cashreport";
            $(tableName).clearGrid();
            
            var sales_amt   = (d.ttl_stock_sales_amt===null?0:d.ttl_stock_sales_amt );
            
            var r  = "<tr>"
            +  "<td" + aCenter + ">" + tYesterdayAmt.toMoney() + "</td>"
            +  "<td" + aCenter + ">" + (tCRAmt - tYesterdayAmt).toMoney() + "</td>"
            +  "<td" + aCenter + ">" + tSalesExpAmt.toMoney() + "</td>"
            +  "<td" + aCenter + ">" + (tCRAmt - tYesterdayAmt + tSalesExpAmt).toMoney()  + "</td>"
            +  "<td" + aCenter + ">" + sales_amt.toMoney() + "</td>"
            +  "<td" + aCenter + ">" + ((tCRAmt - tYesterdayAmt + tSalesExpAmt)- sales_amt).toMoney() +"</td>"
            +  "<td" + aCenter + "></td>"
            +  "<td" + aCenter + ">" + ttodayAmt.toMoney() + "</td>"
            +  "<td" + aCenter + ">" + tExpAmt.toMoney() + "</td>"
            +  "<td" + aCenter + ">" + (tCRAmt - ttodayAmt - tExpAmt).toMoney()  + "</td>"
            +  "</tr>";
            $(tableName).append(r);
        }
    );
} 
 
function displayBankDepo(){
    var tbl="#tableBankDepo"; 
    $(tbl).html(""); 
    $.post( proc_url + "repStoreDailyBankDepo?p=" + "''" + ","+ "''" +"," + store_loc_id.val() + ",'" + is_date.val()+"'",function(d){
        if (d.length===0) {
            $(tbl).html("No Result."); 
            return;
        }
        var hInfo =  d[0];
        var keys = Object.keys(hInfo);
        var colsLength =keys.length;
        
        var h="<table class='zTable fullWidth'><thead><tr><th colspan='12' class='title1 align-c' style=''>Bank Deposits</th></tr><tr>";
        for(var i=0;i< colsLength;i++){                
            h+="<th class='align-c'>" + keys[i] + "</th>";
        }
        h+="</tr></thead></table>"        
        $(tbl).html(h);
        
        var trCls="odd";
        for(var y=0;y< d.length;y++){
             h="<tr class='" + trCls + "'>";
            if(trCls=="odd") trCls="even"; else trCls ="odd";     
            for(var x=0;x< colsLength;x++){
                var info = d[y];
                var val = info[keys[x]];
                var new_val = $('<div/>').text(  (isNaN(val)===false?val.toMoney() : val) ).html();
                h+="<td " + (isNaN(val)===false?"class='align-r'": "") + ">"+ new_val + "</td>";
                var val2 =  (isNaN(val)===false ? val:0);
            }
            h+="</tr>";
            $(".zTable").append(h);
        }

    }).fail(function(data) {
        result =  data.responseText.replace(/^\s+/,"");
        $(tbl).html(result);
    })   
}  
