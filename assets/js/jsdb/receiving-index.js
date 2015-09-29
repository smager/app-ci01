var po_info;
var supply_brands_info;
var g_isNew = true;

$("#frm").submit(function(){ this.action = controller_url + "update"; });

$(document).ready(function(){
    $("#p_po_filter").dataBind(base_url + "select_options/code/po_with_bal");
    initInputs();    
    getUnpostedDR();
    markMandatory();
    setPOInfo();
    setSupplyBrandsInfo();
});
$("form[id=frm]").submit(function(){
     if( zsi.form.checkMandatory()!==true) return false;
 }); 
 
 $("#btnNew").click(function(){
    $("#grid").clearGrid();
    receiving_id.val('');
    po_filter.val('');
    markMandatory();
 });

function setPOInfo(){
  $.getJSON(base_url + "purchase_order/powith_bal", function(d){
         po_info=d;
    });
}

function setSupplyBrandsInfo(){
  $.getJSON(base_url + "supply_brands/getsupply_brands_podtls_json", function(d){
         supply_brands_info=d;
    });
}


function markMandatoryDR(){
    zsi.form.markMandatory({       
      "groupNames":[
            {
                 "names" : ["p_dr_no","p_dr_date"]
                ,"type":"S"
            }             
             
            ,{
                 "names" : ["p_po_dtl_id[]","p_dr_qty[]"]
                ,"type":"M"
                ,"required_one":"Y"            
            }
             
      ]      
      ,"groupTitles":[ 
             {"titles" :["DR No","date"]}
            ,{"titles" :["Supply","Quantity"]}
      ]
   });
}


function markMandatory(){
    zsi.form.markMandatory({       
      "groupNames":[
            {
                 "names" : ["p_po_filter","p_dr_no","p_dr_date"]
                ,"type":"S"
            }             
             
            ,{
                 "names" : ["p_po_dtl_id[]","p_dr_qty[]"]
                ,"type":"M"
                ,"required_one":"Y"            
            }
             
      ]      
      ,"groupTitles":[ 
             {"titles" :["P.O No.","DR No","date"]}
            ,{"titles" :["Supply","Quantity"]}
      ]
   });
}


function getUnpostedDR(){
    
    $.getJSON(base_url + "receiving/get_unposted_dr",function(data){
        $.each(data,function(){
            var params = {
                 receiving_id: this.receiving_id
                ,po_id: this.po_id
                ,dr_no: this.dr_no
                ,dr_date: this.dr_date
                ,loc_id: this.loc_id
            };
            var removeicon = "<a class='glyphicon glyphicon-remove-sign itemRemove' onclick='removeDR(" + this.receiving_id  + ");' href='javascript:void(0);'></a>";
            $(".list-group").append("<a href='javascript:void(0);' onclick='displayDetails("   + JSON.stringify(params) +  ");' class='list-group-item' >" + this.dr_no + " - (P.O. #: " +this.po_no + ") </a>" + removeicon);
        });
        
    });

}

function removeDR(id){
      if(confirm("Are you sure you want to delete selected items?")) {
      $.post( base_url + "receiving/delete/" + id , function(d){
            window.location.reload();
         }).fail(function(d) {
            alert("Sorry, the curent transaction is not successfull.");
        });
      }
}

function loadSelectOptions(po_id){
    var obj = $("select[name='p_po_dtl_id[]']").dataBind({
         url             : base_url + "select_options/code/po_dtlswithbal?where=po_id=" + po_id
        ,onEachComplete  : function(){
            var selVal = this.value;
            var supply_brand = $(this.parentNode).next().children("select[name='p_supply_brand_id[]']");
             $.each(supply_brands_info,function(){
                if(selVal==this.po_dtl_id){
                    var l_option = new Option(unescape(this.brand_name+ " / " +this.cu_desc ), this.supply_brand_id);
                    supply_brand[0].add(l_option, null);
                }
             });
             var attrSelVal ="selectedvalue";
             supply_brand.val(supply_brand.attr(attrSelVal));
             supply_brand.removeAttr(attrSelVal);            
        }
        ,onAllComplete  : function(){
            if(g_isNew===true) markMandatory(); else markMandatoryDR();
            this.change();
           setDRQtyEvent();
        }
    });

}

function initInputs(){
    receiving_id = $("#p_receiving_id");
    po_id = $("#p_po_id");
    po_filter = $("#p_po_filter");
    dr_no = $("#p_dr_no");
    dr_date = $("#p_dr_date");
    loc_id = $("#p_loc_id");
    supplier_name= $("#p_supplier_name");

    po_filter.change(function(){
        if(this.value==="") return false;
        po_id.val(this.value);
        receiving_id.val('');
        dr_no.val('');
        supplier_name.html('N/A');
        loc_id.html('N/A');
        displayBlankRows(true);
        getPOInfo(this.value);
        loadSelectOptions(this.value);
        markMandatory();
    });    
}
function getPOInfo(PO_id){
    $.each(po_info,function(){
      if(PO_id == this.po_id){              
        supplier_name.html(this.supplier);
        loc_id.html(this.location);
        return;
      }
    });
}

function displayDetails(p){
    getPOInfo(p.po_id);
    receiving_id.val(p.receiving_id);
    po_id.val(p.po_id);
    dr_no.val(p.dr_no).change();
    dr_date.val(p.dr_date.toDateFormat()).change();
    displayRecords(p.receiving_id);
    

}

function displayRecords(receiving_id){       
    var bs = zsi.bs.ctrl;    
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : base_url + "receiving/get_unposted_dr_dtls/" + receiving_id
        ,td_body: [ 
            function(d){
                return     bs({name:"receiving_dtl_id[]",type:"hidden",value: d.receiving_dtl_id})
                        +  bs({name:"bal_qty[]",type:"hidden",value: d.bal_qty})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return bs({name:"po_dtl_id[]",type:"select",value:d.po_dtl_id}) }
            ,function(d){ return bs({name:"supply_brand_id[]",type:"select",value:d.supply_brand_id}) }
            ,function(d){ return bs({name:"dr_qty[]",class:"form-control numeric",value:d.dr_qty}); }
            ,function(d){ return d.bal_qty;}
            ,function(d){ return d.bal_qty - d.dr_qty;}
        ]        
        ,td_properties: [
            "","","","","style='text-align:center;'","style='text-align:center;'"
        ]
        ,onComplete : function(){
        displayBlankRows(false);
        loadSelectOptions(po_id.val());
        setSupplyChangeEvent();
        setQtyKeyupEvent();            
        }
    });    
}

function displayBlankRows(isNew){
    g_isNew = isNew
    var bs = zsi.bs.ctrl;    
    zsi.json.loadGrid({
         table  : "#grid"
        ,isNew  : isNew 
        ,limit: 15
        ,td_body: [ 
            function(d){
                return     bs({name:"receiving_dtl_id[]",type:"hidden"})
                        +  bs({name:"bal_qty[]",type:"hidden"})
                        +  bs({name:"cb[]",type:"checkbox"});

            }            
            ,function(d){ return bs({name:"po_dtl_id[]",type:"select"}) }
            ,function(d){ return bs({name:"supply_brand_id[]",type:"select"}) }
            ,function(d){ return bs({name:"dr_qty[]",class:"form-control numeric"}); }
            ,function(d){ return '';}
            ,function(d){ return '';}
        ]
        ,td_properties: [
            "","","","","style='text-align:center;'","style='text-align:center;'"
        ]
        ,onComplete : function(){
          setDRQtyEvent();
          setSupplyChangeEvent();
          setQtyKeyupEvent();
        }
    });    
}

function setQtyKeyupEvent(){
    
     $("input[name='p_dr_qty[]']").keyup(function(){
            var currBal = parseInt("0"  + $(this.parentNode).next().html());
            var endBal = $(this.parentNode).next().next();
            var total=currBal;
            if(this.value==="") {
                endBal.html(total);
                return;
            }
            
            if(this.value <= currBal) 
                total =  currBal - this.value;
            else
                this.value = currBal;
            endBal.html(total);
     });
     zsi.initInputTypesAndFormats();
}

function setSupplyChangeEvent(){
     $("select[name='p_po_dtl_id[]']").change(function(){
        var selVal = this.value;
        var jObj = $(this.parentNode).next().children("select[name='p_supply_brand_id[]']");
        var bal_qty = $(this.parentNode).prev().children("input[name='p_bal_qty[]']");
        var dr_qty = $(this.parentNode).next().next().children("input[name='p_dr_qty[]']");
        var tdCurrBal = $(this.parentNode).next().next().next();
        var tdEndBal = $(this.parentNode).next().next().next().next();
        jObj.html('');
        //dr_qty.val('');
        tdEndBal.html('');

        var supply_brand = jObj[0]
        var ctr=0;
         $.each(supply_brands_info,function(){
            if(selVal==this.po_dtl_id){
                var l_option = new Option(unescape(this.brand_name+ " / " +this.cu_desc ), this.supply_brand_id);
                 supply_brand.add(l_option, null);
                 if(ctr===0) {
                    tdCurrBal.html(this.bal_qty);
                    bal_qty.val(this.bal_qty);
                    ctr++;
                 }
            }
            
         });
         
         
     });
   // 
}


 
function setDRQtyEvent(){
    $("input[name='p_dr_qty[]']").change();
}

function checkDelete() {
   var l_stmt=[], l_count;
    
   var data = zsi.table.getCheckBoxesValues("input[name='p_cb[]']:checked");
    for(var x=0;x<data.length; x++){
        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); 
    }
   if (l_stmt.length > 0) {
      if(confirm("Are you sure you want to delete selected items?")) {
      $.post( controller_url + "delete_dtls" , l_stmt, function(d){
            window.location.reload();
            //console.log(d);
         }).fail(function(d) {
            alert("Sorry, the curent transaction is not successfull.");
        });
      }
   }
return false;
}   


