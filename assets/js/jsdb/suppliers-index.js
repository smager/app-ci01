var bs = zsi.bs.ctrl;

$("#frm").attr("action",controller_url + "update").attr("method","post");

$(document).ready(function(){
    displayRecords();
});
    
function displayRecords(){   
    var rownum=0;
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : controller_url +  "getdata"
        ,td_body: [ 
            function(d){
                return     bs({name:"supplier_id[]",type:"hidden",value: d.supplier_id})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return bs({name:"supplier_name[]",value: d.supplier_name}); }
            ,function(d){ return bs({name:"contact_name[]",value: d.contact_name}); }
            ,function(d){ return bs({name:"contact_no[]",value: d.contact_no}); }
            ,function(d){ return bs({name:"active[]",value: d.active,type:"yesno"}); }

        ]
        ,onComplete : function(){
            displayBlankRows();
        }
    });    
}

function displayBlankRows(){       
    var inputCls = "form-control input-sm";
    zsi.json.loadGrid({
         table  : "#grid"
        ,td_body: [ 
            function(d){
                return     bs({name:"supplier_id[]",type:"hidden"})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return bs({name:"supplier_name[]"}); }
            ,function(d){ return bs({name:"contact_name[]"}); }
            ,function(d){ return bs({name:"contact_no[]"}); }
            ,function(d){ return bs({name:"active[]", type:"yesno"}); }
        ]
    });    
}
    
 
 

function checkDelete() {
   var l_stmt=[], l_count;
    
   var data = zsi.table.getCheckBoxesValues("input[name='p_cb[]']:checked");
    for(var x=0;x<data.length; x++){
        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); 
    }
   if (l_stmt.length > 0) {
      if(confirm("Are you sure you want to delete selected items?")) {
      $.post( controller_url + "delete", l_stmt, function(d){
            window.location.reload();
         }).fail(function(d) {
            alert("Sorry, the curent transaction is not successfull.");
        });
      }
   }
return false;
}   
