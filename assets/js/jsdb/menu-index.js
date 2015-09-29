var bs = zsi.bs.ctrl;

$("#frm").submit(function(){ this.action = controller_url + "update"; });

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
                return     bs({name:"menu_id[]",type:"hidden",value: d.menu_id})
                        +  bs({name:"cb[]",type:"checkbox"});
            }
            ,function(d){ return bs({name:"seq_no[]",value: d.seq_no}); }
            ,function(d){ return bs({name:"menu_name[]",value: d.menu_name}); }
            ,function(d){ return bs({name:"menu_url[]",value: d.menu_url}); }
            ,function(d){ return bs({name:"menu_type_id[]",value: d.menu_type_id, type:"select"}); }
            ,function(d){ return bs({name:"system_id[]",value: d.system_id, type:"select"}); }

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
                return     bs({name:"menu_id[]",type:"hidden"})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return bs({name:"seq_no[]"}); }
            ,function(d){ return bs({name:"menu_name[]"}); }
            ,function(d){ return bs({name:"menu_url[]"}); }
            ,function(d){ return bs({name:"menu_type_id[]",type:"select"}); }
            ,function(d){ return bs({name:"system_id[]",type:"select"}); }
        ]
    });
    
    $("select[name='p_menu_type_id[]']").dataBind( base_url + "select_options/code/menu_types");
    $("select[name='p_system_id[]']").dataBind( base_url + "select_options/code/systems");    

}

function checkDelete() {
   var l_stmt=[], l_count;
    
   var data = zsi.table.getCheckBoxesValues("input[name='p_cb[]']:checked");
    for(var x=0;x<data.length; x++){
        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); 
    }
   if (l_stmt.length >0) {
      if(confirm("Are you sure you want to delete selected items?")) {
      $.post( controller_url + "delete" , l_stmt, function(d){
            window.location.reload();
         }).fail(function(d) {
            alert("Sorry, the curent transaction is not successfull.");
        });
      }
   }
return false;
} 
