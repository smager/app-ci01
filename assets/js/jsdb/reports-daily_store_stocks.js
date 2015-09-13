var bs = zsi.bs.ctrl;
setInputs();

$(document).ready(function(){
    $("#p_store_loc_id").dataBind(base_url + "select_options/code/store_locs");
    stock_date.val( new Date().toShortDate() );
});   

$("#btnGo").click(function(){
    displayRecords();
});   
 
function setInputs(){
    store_loc_id = $("#p_store_loc_id");
    stock_date = $("#p_stock_date");
    
}
   
function displayRecords(){
    var tSalesAmt=0;
    var tCostAmt=0;
    var tableName="#grid";
    var pf = parseFloat;
    var  aRight = " style='text-align:right'";
        zsi.json.loadGrid({
         table  : tableName
        ,url   : base_url + "reports/getstorelocsupplydaily?p_store_loc_id=" + store_loc_id.val()  + "&p_date=" + stock_date.val()
        ,td_body: [ 
             function(d){
                tSalesAmt += parseFloat(d.sales_amount);
                tCostAmt += parseFloat(d.cost_amount);
                return  d.supply_code + " (" +  d.unit_desc + ")";
             }     
            ,function(d){ return pf(d.remaining_qty).toMoney(); }
            ,function(d){ return pf(d.is_qty).toMoney(); }
            ,function(d){ return pf(d.beg_qty).toMoney();} 
            ,function(d){ return pf(d.end_qty).toMoney();}
            ,function(d){ return pf(d.out_qty).toMoney();}
            
            ,function(d){ return pf(d.unit_price).toMoney();}
            ,function(d){ return pf(d.sales_amount).toMoney();}
            ,function(d){ return pf(d.unit_cost).toMoney();}
            ,function(d){ return pf(d.cost_amount).toMoney();}
            
        ]
        ,td_properties: [
             "",aRight,aRight,aRight,aRight,aRight
             ,aRight,aRight,aRight,aRight
        ]
        ,onComplete: function(){
            var r  = "<tr class='total '>"
                    +  "<td></td><td></td><td></td><td></td><td></td><td></td>"
                    +  "<td></td>"
                    +  "<td" + aRight + ">" + tSalesAmt.toMoney() + "</td>"
                    +  "<td></td>"
                    +  "<td" + aRight + ">" + tCostAmt.toMoney() + "</td>"

                    +  "</tr>";
            
            $(tableName).append(r);
            
        }
        
    });       
}
 
 
