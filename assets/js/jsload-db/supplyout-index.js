var bs = zsi.bs.ctrl;
var action_url = base_url + "supply_out";
var tblPopup = "tblStoreLocSupp";
setInputs();
$(document).ready(function(){
    $("#p_store_loc_id").dataBind(base_url + "select_options/code/store_locs");
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
                 "names" : ["p_store_loc_id","p_is_date"]
                ,"type":"S"
            }             
            
      ]      
      ,"groupTitles":[ {"titles" :["Location","Date"]}]
   });
   
}
 
function setInputs(){
    store_loc_id = $("#p_store_loc_id");
    is_no = $("#p_is_no");
    l_date = $("#p_date");
    posted = $("#p_posted");
}

store_loc_id.change(function(){
    if (this.value==="") {
        $("#grid").clearGrid();
        return;
    }
});

$("#btnGo").click(function(){
    if(store_loc_id.val() ==="") {
        alert("Select Store.");
        return;
    }
    var aRight ="style='text-align:right;'";
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : action_url + "/getdetail?p_store_loc_id=" + store_loc_id.val() + "&p_date=" + l_date.val() + "&p_posted=0"  
        ,td_body: [ 
             function(d){return  bs({name:"store_loc_supply_daily_id[]",type:"hidden", value: d.store_loc_supply_daily_id})
                                + bs({name:"end_qty[]",type:"hidden", value: d.end_qty})
                                + d.supply_code;
             }     
            ,function(d){ return d.unit_desc; }
            ,function(d){ return d.remaining_qty; }
            ,function(d){ return d.is_qty;} 
            ,function(d){ return d.beg_qty;} 
            ,function(d){ return bs({name:"out_qty[]",value: (parseInt(d.out_qty)===0?"":d.out_qty), class:"form-control numeric" });} 
            ,function(d){ return bs({name:"returned_qty[]",value: (parseInt(d.returned_qty)===0?"":d.returned_qty), class:"form-control numeric" });} 
            ,function(d){ return d.end_qty.toMoney();} 
        ]
        ,td_properties: ["","",aRight,aRight,aRight + "id='tdBeg_qty'","","",aRight+ "id='tdEnd_qty'"]
        
        ,onComplete: function(){
            
            zsi.initInputTypesAndFormats();
             
            $("input[name='p_out_qty[]']").keyup(function(){
                var tr = $(this.parentNode.parentNode);
                var retQty = tr.find("input[name='p_returned_qty[]']");
                computeBalance(this,$(this), retQty);
            });
           
            $("input[name='p_returned_qty[]']").keyup(function(){
                var tr = $(this.parentNode.parentNode);
                var outQty = tr.find("input[name='p_out_qty[]']");
                computeBalance(this,outQty, $(this));
            });           
           
           function computeBalance(input,outQty,retQty){
               var tr = $(input.parentNode.parentNode);
               var begQtyVal = tr.find("#tdBeg_qty").html(); 
               var endQty = tr.find("input[name='p_end_qty[]']");
               var tdEndQty =  tr.find("#tdEnd_qty"); 
                var l_outqty =  (outQty.val() !==""?  (isNaN(outQty.val())!==true?outQty.val():0) : 0);
                var l_retQty =  (retQty.val() !==""?  (isNaN(retQty.val())!==true?retQty.val():0) : 0);
                var r = parseFloat(begQtyVal) - ( parseFloat(l_outqty) + parseFloat(l_retQty) );
               if( r < 0 ){
                    if( r < 0 ) input.value = parseFloat(input.value) + r ;
                    tdEndQty.html("0.00");
                    endQty.val(0);
               }
               else{
                    tdEndQty.html(r.toMoney());
                    endQty.val(r);
               }
               return r;
               
           }

        }

    });           
});

 
 
