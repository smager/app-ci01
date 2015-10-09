var bs = zsi.bs.ctrl;
var action_url = base_url + "supply_is";

var tblPopup = "tblStoreLocSupp";
setInputs();
$(document).ready(function(){
    $("#p_store_loc_id").dataBind(base_url + "select_options/code/user_store_locations?p=user_id=" + userInfo.user_id);
    markMandatory();
});   

$("form[id=frm]").submit(function(){
    this.action = action_url + "/update"; 
     if( zsi.form.checkMandatory()!==true) return false;
 }); 
 
 function markMandatory(){
    zsi.form.markMandatory({       
      "groupNames":[
            {
                 "names" : ["p_store_loc_id","p_is_no","p_is_date"]
                ,"type":"S"
            }             
            
      ]      
      ,"groupTitles":[ {"titles" :["Location","Issuance No","Date"]}]
   });
   
}
 
function setInputs(){
    store_loc_id = $("#p_store_loc_id");
    is_no = $("#p_is_no");
    is_date = $("#p_is_date");
    posted = $("#p_posted");
    supply_is_id = $("#p_supply_is_id");
}

store_loc_id.change(function(){
    $("#grid").clearGrid();
    if (this.value==="") return;
    
    $.getJSON(base_url + "supply_is/get_is_info/" + store_loc_id.val(), function(info){
        if(info.supply_is_id){
            supply_is_id.val(info.supply_is_id);
            is_no.val( info.is_no );
            is_date.val( info.is_date.toDateFormat() );
        }
    });
    
});

$("#btnGo").click(function(){ 
    supply_is_id.val('');
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : base_url + "supply_is/get_detail_json/" + store_loc_id.val() 
        ,td_body: [ 
             function(d){return    "";}     
            ,function(d){ return d.supply_code; }
            ,function(d){ return d.unit_desc; }
            ,function(d){ return d.prev_qty;} 
            ,function(d){ return d.prev_qty;} 
        ]
        ,td_properties: ["","","","id='tdRemQty'","id='tdTotal'"] 
        ,onEachComplete : function(tr,data,callBackDone){
            var rowData =data;
            var qty= tr.children("td")[0];
            qty.innerHTML= "<img src='"+ base_url + "assets/images/loading.gif" +"' width='20px'> loading...";
            var onEC = this;
            $.getJSON(base_url + "supply_is/get_is_detail/" + data.store_loc_id + "/" + data.loc_supply_id, function(data){
                var t="<table class='subTable'>";
                $.each(data,function(){
                    if(supply_is_id.val()===''){
                            supply_is_id.val(this.supply_is_id);
                    }

                    t +="<tr>";
                        t +="<td>" 
                            +  bs({name:"loc_supply_brand_id[]",type:"hidden",value: this.loc_supply_brand_id})
                            +  bs({name:"supply_is_dtl_id[]",type:"hidden",value: this.supply_is_dtl_id})
                            +  bs({name:"stock_qty[]",type:"hidden",value: this.stock_qty})
                            +  bs({name:"prev_qty[]",type:"hidden",value: rowData.store_stocks})
                            +  bs({name:"unit_price[]",type:"hidden",value: rowData.unit_price})
                            +  bs({name:"supply_is_qty[]",value: this.supply_is_qty,class:"form-control numeric"})
                        t +="</td>";
                        t +="<td>&nbsp;&nbsp;" + this.stock_qty.toMoney()  + " " + this.brand_name + " " + this.cu_desc  + "</td>";                    
                    t +="</tr>";
                });
                t +="</table>";
                qty.innerHTML = t;
               callBackDone();
            });

        }
        ,onComplete : function(){
            var supply_is_qty = $("input[name='p_supply_is_qty[]']");
            
            supply_is_qty.keyup(function(){
                var tr = $(this).closest("table.subTable")[0].parentNode.parentNode;
                var tdTotal = $(tr).find("#tdTotal");
                var RemQty = $(tr).find("#tdRemQty").html();
                var isQty =  (this.value !==""?  (isNaN(this.value)!==true?this.value:0) : 0);
                
                tdTotal.html( (parseFloat(RemQty) +  parseFloat(isQty)).toMoney() ); 
                
                var stock_qty = $(this.parentNode).children("input[name='p_stock_qty[]']");    
                var prev_qty = $(this.parentNode).children("input[name='p_prev_qty[]']");    
                if(parseInt(this.value) > parseInt(stock_qty.val())) {
                    this.value =  parseInt(stock_qty.val());
                }
            });
            zsi.initInputTypesAndFormats();
            
        }
    });       

});





 
 
