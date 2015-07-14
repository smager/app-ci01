var bs = zsi.bs.ctrl;
var tblPopup = "tblStoreLocSupp";

$(document).ready(function(){
    setInputs();
    supply_is_id.dataBind(base_url + "select_options/code/store_loc_usage");
    markMandatory();
});   

function clear(){
     $(".table").clearGrid();
    supply_is_id.val('');
    is_no.val('');
    is_date.val('');
    posted_is.val(0);
}

$("form[id=frm]").submit(function(){
     if( zsi.form.checkMandatory()!==true) return false;
 }); 
 
 function markMandatory(){
    zsi.form.markMandatory({       
      "groupNames":[
            {
                 "names" : ["p_supply_is_id"]
                ,"type":"S"
            }             
            
      ]      
      ,"groupTitles":[ {"titles" :["Location"]}]
   });
   
}
 
function setInputs(){
    supply_is_id = $("#p_supply_is_id");
    is_no = $("#p_is_no");
    is_date = $("#p_is_date");
    posted_is = $("#p_posted");
    
    supply_is_id.change(function(){
        if (this.value==="") {
           clear();
            return;
        }
        
        $.getJSON(base_url + "supply_is/get_is_usage_info/" + this.value, function(info){
            is_no.val( info.is_no );
            is_date.val( info.is_date );
        });
        
        zsi.json.loadGrid({
             table  : ".table"
            ,url   : base_url + "supply_is/get_usage_detail/" + this.value 
            ,td_body: [ 
                 function(d){return  bs({name:"supply_is_dtl_id[]",type:"hidden",value: d.supply_is_dtl_id});}            
                ,function(d){ return d.supply_code; }
                ,function(d){ return d.brand_name  + " " + d.cu_desc; }
                ,function(d){ return d.beg_qty;} 
                ,function(d){ return bs({name:"used_qty[]",value: (d.used_qty==0?"":d.used_qty) }); }
                ,function(d){ return bs({name:"returned_qty[]",value: (d.returned_qty==0?"":d.returned_qty) });}
            ]

        });       
    
    });    
}

