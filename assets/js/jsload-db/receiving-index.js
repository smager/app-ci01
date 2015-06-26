var ctrlSel = zsi.control.SelectList;  
var po_info;
$(document).ready(function(){
    ctrlSel( base_url + "select_options/code/locations","#p_loc_id","","N");
    ctrlSel( base_url + "select_options/code/po_with_bal","#p_po_filter","","N");
    initInputs();    
    getUnpostedDR();
    markMandatory();
    setPOInfo();
});
$("form[id=frm]").submit(function(){
     if( zsi.form.checkMandatory()!==true) return false;
 }); 
 
 $("#btnNew").click(function(){
    $("#grid").clearGrid();
    receiving_id.val('');
    po_filter.val('').change();
    markMandatory();
 });
 


function setPOInfo(){
  $.getJSON(base_url + "purchase_order/powith_bal", function(d){
         po_info=d;
    });
}


function markMandatory(){
    zsi.form.markMandatory({       
      "groupNames":[
            {
                 "names" : ["p_po_filter","p_dr_no","p_dr_date","p_loc_id"]
                ,"type":"S"
            }             
             
            ,{
                 "names" : ["p_dr_qty[]"]
                ,"type":"M"
                ,"required_one":"Y"            
            }
             
      ]      
      ,"groupTitles":[ 
             {"titles" :["P.O No.","DR No","date","Location"]}
            ,{"titles" :["Quantity"]}
      ]
   });
}


function markMandatoryDR(){
    zsi.form.markMandatory({       
      "groupNames":[
            {
                 "names" : ["p_dr_no","p_dr_date","p_loc_id"]
                ,"type":"S"
            }             
            ,{
                 "names" : ["p_dr_qty[]"]
                ,"type":"M"
                ,"required_one":"Y"            
            }
      ]      
      ,"groupTitles":[ 
             {"titles" :["DR No","date","Location"]}
            ,{"titles" :["Quantity"]}
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
            $(".list-group").append("<a href='javascript:void(0);' onclick='displayDetails("   + JSON.stringify(params) +  ");' class='list-group-item' >" + this.dr_no + "</a>" + removeicon);
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

function initInputs(){
    receiving_id = $("#p_receiving_id");
    po_id = $("#p_po_id");
    po_filter = $("#p_po_filter");
    dr_no = $("#p_dr_no");
    dr_date = $("#p_dr_date");
    loc_id = $("#p_loc_id");
    supplier_name= $("#p_supplier_name");

    po_filter.change(function(){
        var selVal = this.value;
        
        po_id.val(selVal);
        receiving_id.val('');
        dr_no.val('');
        supplier_name.val('');
        
        displayPO_dtls(selVal);
        
        $.each(po_info,function(){
          if(selVal == this.po_id){              
            supplier_name.val(this.supplier);
            return;
          }
        });
    });    
}

function displayDetails(p){
    markMandatoryDR();
    receiving_id.val(p.receiving_id);
    po_id.val(p.po_id);
    dr_no.val(p.dr_no).change();
    dr_date.val(p.dr_date).change();
    loc_id.val(p.loc_id).change();
    displayRecords(p.receiving_id);
}

function displayRecords(id){       
    var bs = zsi.bs.ctrl;    
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : base_url + "receiving/get_unposted_dr_dtls/" + id
        ,td_body: [ 
            function(d){
                return     bs({name:"receiving_dtl_id[]",type:"hidden",value: d.receiving_dtl_id})
                        +  bs({name:"po_dtl_id[]",type:"hidden",value: d.po_dtl_id})
                        +  bs({name:"cb[]",type:"checkbox"});

            }            
            ,function(d){ return d.bal_qty;}
            ,function(d){ return bs({name:"dr_qty[]",value:d.dr_qty}); }
            ,function(d){ return d.cu_desc; }
            ,function(d){ return d.supply;  }
        ]
        ,onComplete : function(){
             setDRQtyEvent();
        }
    });    
}

function displayPO_dtls(id){
    if(id==='') return;
    var bs = zsi.bs.ctrl;    
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : base_url + "purchase_order/getdata_dtls_json/" + id + "/y"
        ,td_body: [ 
            function(d){
                return     bs({name:"receiving_dtl_id[]",type:"hidden",value: d.receiving_dtl_id})
                        +  bs({name:"po_dtl_id[]",type:"hidden",value: d.po_dtl_id})
                        +  bs({name:"cb[]",type:"checkbox"});

            }            
            ,function(d){ return d.bal_qty;}
            ,function(d){ return bs({name:"dr_qty[]",value:d.dr_qty}); }
            ,function(d){ return d.cu_desc; }
            ,function(d){ return d.supply;  }
        ]
        ,onComplete : function(){
          setDRQtyEvent();
        }
    });    
}
 
function setDRQtyEvent(){
    $("input[name='p_dr_qty[]']").change();
}

function checkDelete(l_cmd) {
   var l_stmt=[], l_count;
    
   var data = zsi.table.getCheckBoxesValues("input[name='p_cb[]']:checked");
    for(var x=0;x<data.length; x++){
        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); 
    }
   if (l_stmt!="") {
      if(confirm("Are you sure you want to delete selected items?")) {
      $.post( l_cmd , l_stmt, function(d){
            window.location.reload();
            //console.log(d);
         }).fail(function(d) {
            alert("Sorry, the curent transaction is not successfull.");
        });
      }
   }
return false;
}   

