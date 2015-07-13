var supply;
$(document).ready(function(){
    $("#p_supplier_id").dataBind( base_url + "select_options/code/suppliers");
    $("#p_loc_id").dataBind( base_url + "select_options/code/locations");
    initInputs();
    onLocationChange();
    displayBlankRows(true);
    getUnpostedPO();
    markMandatory();
    setSupply();
});
$("form[id=frm]").submit(function(){
     if( zsi.form.checkMandatory()!==true) return false;
     
     $.post(base_url + "purchase_order/update",$(this).serializeArray()
        ,function(d){
            
           if(posted.val()===0) 
                displayRecords(d.po_id);
            else
                newBlankEntry();
           
            po_id.val(d.po_id);
            getUnpostedPO();
            markMandatory();
        } 
     );
     
     
     return false;
 }); 
 
 $("#btnNew").click(function(){
    if(loc_id.val()==='') { alert("Enter Location"); return false; }
    newBlankEntry();
 });
 
 function newBlankEntry(){
    displayBlankRows(true);
    ClearHeader();
 }
 
 function ClearHeader(){
    po_id.val('').change();
    po_no.val('').change();
    po_date.val('').change();
    loc_id.val('').change();
    supplier_id.val('').change();    
    posted.val(0);
 }
 

function setSupply(){
  $.getJSON(base_url + "supplies/getdata_json", function(d){
        supply = d;
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
                 "names" : ["p_po_qty[]","p_supply_id[]"]
                ,"type":"M"
                ,"required_one":"Y"            
            }
      ]      
      ,"groupTitles":[ 
             {"titles" :["P.O No","Date","Supplier","Location"]}
            ,{"titles" :["Quantity","Supply"]}
      ]
   });
   
}
function getUnpostedPO(){
     $(".list-group").html('');
    $.getJSON(base_url + "purchase_order/getdata_json/",function(data){
        $.each(data,function(){
            var params = {
                 po_id: this.po_id
                ,po_no: this.po_no
                ,po_date: this.po_date
                ,loc_id: this.loc_id
                ,supplier_id:this.supplier_id
            };
            var removeicon = "<a class='glyphicon glyphicon-remove-sign poRemove' onclick='removePO(" + this.po_id  + ");' href='javascript:void(0);'></a>";
            $(".list-group").append("<a href='javascript:void(0);' onclick='displayDetails("   + JSON.stringify(params) +  ");' class='list-group-item' >" + this.po_no + "</a>" + removeicon);
        });
        
    });

}

function removePO(id){
      if(confirm("Are you sure you want to delete selected items?")) {
        ClearHeader();  
        $.post( base_url + "purchase_order/delete/" + id , function(d){
                getUnpostedPO();
                displayBlankRows(true);
            }).fail(function(d) {
                alert("Sorry, the curent transaction is not successfull.");
            });
        }
}

function initInputs(){
    po_id = $("#p_po_id");
    po_no = $("#p_po_no");
    po_date = $("#p_po_date");
    loc_id = $("#p_loc_id");
    supplier_id = $("#p_supplier_id");    
    posted = $("#p_posted");    
}

function displayDetails(p){
    po_id.val(p.po_id).change();
    po_no.val(p.po_no).change();
    po_date.val(p.po_date).change();
    loc_id.val(p.loc_id);//.change();
    supplier_id.val(p.supplier_id).change();

    displayRecords(p.po_id);
}

function displayRecords(id){       
    var bs = zsi.bs.ctrl;    
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : base_url + "purchase_order/getdata_dtls_json/" + id
        ,td_body: [ 
            function(d){
                return     bs({name:"po_dtl_id[]",type:"hidden",value: d.po_dtl_id})
                        +  bs({name:"cb[]",type:"checkbox"});

            }            
            ,function(d){ return bs({name:"supply_id[]",type:"select",value:d.supply_id}); }
            ,function(d){ return d.unit_desc; }
            ,function(d){ return bs({name:"po_qty[]",value:d.po_qty,class:"form-control numeric"}); }
        ]
        ,onComplete : function(){
            onSupplyChange();
            
            $("select[name='p_supply_id[]']").dataBind(base_url + "select_options/code/po_details?where=po_id=" +  id, function(){
                displayBlankRows(false);
                loc_id.change();
            });
           

            
        }
    });    
}

function onSupplyChange(){
    
    $("select[name='p_supply_id[]']").change(function(){
        var tdUnit = $(this.parentNode).next();
        var selVal = this.value;
        $.each(supply,function(){
            if (this.supply_id == selVal){
                tdUnit.html(this.unit_desc);
                return;
            }
        });

    });
    
}
function onLocationChange(){
    loc_id.change(function(){
        if(this.value==='') return false;
        $("select[name='p_supply_id[]'].new").dataBind({ 
             url: base_url + "select_options/code/loc_supplies?where=loc_id=" + this.value
            ,isUniqueOptions:true
        });
    });
}

function displayBlankRows(p_isNew){       
    var bs = zsi.bs.ctrl;    
    zsi.json.loadGrid({
         table  : "#grid"
        ,isNew  : p_isNew
        ,limit: 15
        ,td_body: [ 
            function(d){
                return     bs({name:"po_dtl_id[]",type:"hidden"})
                        +  bs({name:"select[]",type:"checkbox"});

            }            
            ,function(d){ return bs({name:"supply_id[]",type:"select", class:"form-control new"}); }
            ,function(d){ return ""; }
            ,function(d){ return bs({name:"po_qty[]",class:"form-control numeric"}); }
        ]
        ,onComplete : function(){
            onSupplyChange();
            markMandatory();
            $("input[name='p_po_qty[]'],input[name='p_unit_price[]']").change();
            zsi.initInputTypesAndFormats();
        }
    });    
}


function checkDelete(l_cmd) {
   var l_stmt=[], l_count;
    
   var data = zsi.table.getCheckBoxesValues("input[name='p_cb[]']:checked");
    for(var x=0;x<data.length; x++){
        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); 
    }
   if (l_stmt!=="") {
      if(confirm("Are you sure you want to delete selected items?")) {
      $.post( l_cmd , l_stmt, function(d){
            displayRecords(po_id.val());
         }).fail(function(d) {
            alert("Sorry, the curent transaction is not successfull.");
        });
      }
   }
return false;
}   



