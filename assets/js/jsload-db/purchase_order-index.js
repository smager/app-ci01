var ctrlSel = zsi.control.SelectList;  
var supply_brands;
$(document).ready(function(){
    
    ctrlSel( base_url + "select_options/code/suppliers","#p_supplier_id","","N");
    ctrlSel( base_url + "select_options/code/locations","#p_loc_id","","N");

    displayBlankRows();
    getUnpostedPO();
    initInputs();    
    markMandatory();
    setSupplyBrands();
});
$("form[id=frm]").submit(function(){
     if( zsi.form.checkMandatory()!==true) return false;
 }); 
 
 $("#btnNew").click(function(){
    $("#grid").children('tbody').html('');  
    displayBlankRows();
    //clear data
    po_id.val('');
    po_no.val('');
 });
 
 
function setTotalEvent(){
    
       $("input[name='p_po_qty[]']").keyup(function(){
            var p_unit_price = $(this.parentNode).next().children("input[name='p_unit_price[]']");
            var p_total = $(this.parentNode).next().next().children("input[name='p_total[]']");
            if(p_unit_price.val()!==""){
                p_total.val(parseFloat(this.value  *  p_unit_price.val()).toFixed(2) );
            }
       });
       

       $("input[name='p_unit_price[]']").keyup(function(){
            var p_po_qty = $(this.parentNode).prev().children("input[name='p_po_qty[]']");
            var p_total = $(this.parentNode).next().children("input[name='p_total[]']");
            if(p_po_qty.val()!==""){
                p_total.val(parseFloat(this.value  *  p_po_qty.val()).toFixed(2) );
            }
       });
    
} 

function setSupplyBrands(){
  $.getJSON(base_url + "supply_brands/getdata_supply_brands_json", function(d){
        supply_brands = d;
    });
}

function displayUnitDescriptions(){
    $("select[name='p_supply_brand_id[]']").each(function(){
        var td = $(this.parentNode).next();
        var input =  td.children("input[name='p_unit_conv_id[]']");
        var val = $(this).attr("selectedvalue");
        $.each(supply_brands,function(){
            if (this.supply_brand_id == val){
                input.val(this.cu_desc);
                return;
            }
        });
    });
}

function markMandatory(){
    zsi.form.markMandatory({       
      "groupNames":[
            {
                 "names" : ["p_po_no","p_po_date","p_supplier_id","p_loc_id"]
                ,"type":"S"
            }             
            ,{
                 "names" : ["p_po_qty[]","p_supply_brand_id[]","p_unit_price[]"]
                ,"type":"M"
                ,"required_one":"Y"            
            }
      ]      
      ,"groupTitles":[ 
             {"titles" :["P.O No.","Date","Supplier","Location"]}
            ,{"titles" :["Quantity","Supply","Unit Price"]}
      ]
   });
   
}
function getUnpostedPO(){
    
    $.getJSON(base_url + "purchase_order/getdata_json/",function(data){
        $.each(data,function(){
            var params = {
                 po_id: this.po_id
                ,po_no: this.po_no
                ,po_date: this.po_date
                ,loc_id: this.loc_id
                ,supplier_id:this.supplier_id
            };
            $(".list-group").append("<a href='javascript:void(0);' onclick='displayDetails("   + JSON.stringify(params) +  ");' class='list-group-item' >" + this.po_no + "</a>");
        });
        
    });

}

function initInputs(){
    po_id = $("#p_po_id");
    po_no = $("#p_po_no");
    po_date = $("#p_po_date");
    loc_id = $("#p_loc_id");
    supplier_id = $("#p_supplier_id");    
}

function displayDetails(p){
    po_id.val(p.po_id).change();
    po_no.val(p.po_no).change();
    po_date.val(p.po_date).change();
    loc_id.val(p.loc_id).change();
    supplier_id.val(p.supplier_id).change();

    displayRecords(p.po_id);
}

function displayRecords(id){       
    var bs = zsi.bs.ctrl;    
    //var inputCls = "form-control input-sm";
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : base_url + "purchase_order/getdata_dtls_json/" + id
        ,td_body: [ 
            function(d){
                return     bs({name:"po_dtls_id[]",type:"hidden",value: d.po_dtls_id})
                        +  bs({name:"cb[]",type:"checkbox"});

            }            
            ,function(d){ return bs({name:"supply_brand_id[]",type:"select",value:d.supply_brand_id}); }
            ,function(d){ return bs({name:"unit_conv_id[]"}); }
            ,function(d){ return bs({name:"po_qty[]",value:d.po_qty,class:"form-control numeric"}); }
            ,function(d){ return bs({name:"unit_price[]",value:d.unit_price,class:"form-control numeric"});  }
            ,function(d){
                var total = (d.unit_price!==null?d.unit_price:0 )  * (d.po_qty!==null?d.po_qty:0)
                return bs({name:"total[]",value:total.toFixed(2)});  
                
            }
        ]
        ,onComplete : function(){
            displayUnitDescriptions();
            displayBlankRows();
        }
    });    
}

function onSupplyBrandChange(){
    
    $("select[name='p_supply_brand_id[]']").change(function(){
        var td = $(this.parentNode).next();
        var input =  td.children("input[name='p_unit_conv_id[]']");
        var selVal = this.value;
        
        $.each(supply_brands,function(){
            if (this.supply_brand_id == selVal){
                input.val(this.cu_desc);
                return;
            }
        });

    });
    
}

function displayBlankRows(){       
    var bs = zsi.bs.ctrl;    
    //var inputCls = "form-control input-sm";
    zsi.json.loadGrid({
         table  : "#grid"
        ,td_body: [ 
            function(d){
                return     bs({name:"po_dtls_id[]",type:"hidden"})
                        +  bs({name:"select[]",type:"checkbox"});

            }            
            ,function(d){ return bs({name:"supply_brand_id[]",type:"select"}); }
            ,function(d){ return bs({name:"unit_conv_id[]"}); }
            ,function(d){ return bs({name:"po_qty[]",class:"form-control numeric"}); }
            ,function(d){ return bs({name:"unit_price[]",class:"form-control numeric"});  }
            ,function(d){ return bs({name:"total[]"});  }
        ]
        ,onComplete : function(){
            ctrlSel( base_url + "select_options/code/supply_brands","select[name='p_supply_brand_id[]']","","N");
            onSupplyBrandChange();
            markMandatory();
            $("input[name='p_po_qty[]'],input[name='p_unit_price[]']").change();
            setTotalEvent();
            zsi.initInputTypesAndFormats();
        }
    });    
}


