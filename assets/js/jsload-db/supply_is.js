var bs = zsi.bs.ctrl;
var tblPopup = "tblStoreLocSupp";
setInputs();
$(document).ready(function(){
    $("#p_store_loc_id").dataBind(base_url + "select_options/code/store_locs");
    
    $.get(base_url + "assets/templates/bsDialogBox.txt",function(d){
        var template = Handlebars.compile(d);     
        
        var context = { id:"modalWindow"
                        , title: "Supply Stock Reference"
                        , footer:   '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
                                  + '<button type="button" onclick="submitSelectedItems();" class="btn btn-primary">Save</button>'
                        , body: '<table id="'+ tblPopup  +'" class="table row">'
                                + '<thead>'
                                    + '<tr><th width="1"></th><th>Brand/Unit</th>'
                                    + '<th>Avail. Stocks</th>'
                                    + '<th>I.S. Qty.</th>'
                                + '</thead>'
                                + '</table>'
                      };
        var html    = template(context);     
        $("body").append(html);
        $(".modal-body").append('<input type="hidden" name="p_supply_is_id">');
        
    });        
    
    markMandatory();
});   

$("form[id=frm]").submit(function(){
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
    posted_is = $("#p_posted");
    supply_is_id = $("#p_supply_is_id");
}

store_loc_id.change(function(){
    if (this.value==="") return;
    $.getJSON(base_url + "supply_is/get_is_info/" + store_loc_id.val(), function(info){
        supply_is_id.val(info.supply_is_id);
        is_no.val( info.is_no );
        is_date.val( info.is_date );
    });
    
    supply_is_id.val('');
    zsi.json.loadGrid({
         table  : ".table"
        ,url   : base_url + "supply_is/get_detail_json/" + store_loc_id.val() 
        ,td_body: [ 
             function(d){return    "";}            
            ,function(d){ return d.supply_code; }
            ,function(d){ return d.unit_desc; }
            ,function(d){ return d.stock_daily_qty;} 
            ,function(d){ return d.store_stocks;}
            ,function(d){ return d.ttl_stocks;}
            ,function(d){ return "";}
        ]
        ,onEachComplete : function(tr,data,callBackDone){
            var qty= tr.children("td")[6];
            qty.innerHTML="loading...";
            var onEC = this;
            $.getJSON(base_url + "supply_is/get_is_detail/" + data.store_loc_id + "/" + data.loc_supply_id, function(data){
                var t="<table>";
                $.each(data,function(){
                    if(supply_is_id.val()===''){
                            supply_is_id.val(this.supply_is_id);
                    }
                    t +="<tr>";
                        t +="<td>" 
                            +  bs({name:"loc_supply_brand_id[]",type:"hidden",value: this.loc_supply_brand_id})
                            +  bs({name:"supply_is_dtl_id[]",type:"hidden",value: this.supply_is_dtl_id})
                            +  bs({name:"stock_qty[]",type:"hidden",value: this.stock_qty})
                            +  bs({name:"supply_is_qty[]",value: this.supply_is_qty,class:"form-control numeric"})
                        t +="</td>";
                        t +="<td>&nbsp;&nbsp;" + this.stock_qty  + " " + this.brand_name + " " + this.cu_desc  + "</td>";                    
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
                var stock_qty = $(this.parentNode).children("input[name='p_stock_qty[]']");    
                if(parseInt(this.value) <= parseInt(stock_qty.val())) 
                    this.value =  parseInt(stock_qty.val()) - parseInt(this.value);
                else
                    this.value = parseInt(stock_qty.val());
            });
            zsi.initInputTypesAndFormats();
            
        }
    });       

});

function manageItem(supply_is_id,loc_supply_id){
    $("input[name='p_supply_is_id']").val(supply_is_id);
    zsi.form.displayLOV({
         table  : "#" + tblPopup
        ,url   : base_url + "loc_supplies/get_loc_supply_brands/" + loc_supply_id
        ,show_checkbox: false
        ,params : ["store_loc_supply_id","supply_id"] 
        ,column_data: [
             function(d){return d.supply_code;}
            ,function(d){ return (d.unit_desc!==null?d.unit_desc:"");}
            ,function(d){ return bs({name:"stock_daily_qty[]",value:d.stock_daily_qty!==null?d.stock_daily_qty:""}); }
        ]
        ,td_properties: ["","nowrap"]
        ,onComplete:function(){
            $('#modalWindow').modal("show");
        }
    });
    
    
}

 
 
