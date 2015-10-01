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
                return     bs({name:"empl_id[]",type:"hidden",value: d.empl_id})
                        +  bs({name:"cb[]",type:"checkbox"});
            }
            ,function(d){ return bs({name:"empl_idno[]",value: d.empl_idno}); }
            ,function(d){ return bs({name:"empl_name[]",value: d.empl_name}); }
            ,function(d){ return bs({name:"position_id[]",value: d.position_id, type:"select"}); }
            ,function(d){ return bs({name:"daily_rate[]",value: d.daily_rate}); }
            ,function(d){ return bs({name:"loc_id[]",value: d.loc_id, type:"select"}); }
            ,function(d){ return bs({name:"store_loc_id[]",value: d.store_loc_id, type:"select"}); }
            ,function(d){ return bs({name:"active[]",value: d.active, type:"yesno"}); }

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
                return     bs({name:"empl_id[]",type:"hidden"})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return bs({name:"empl_idno[]"}); }
            ,function(d){ return bs({name:"empl_name[]"}); }
            ,function(d){ return bs({name:"position_id[]", type:"select"}); }
            ,function(d){ return bs({name:"daily_rate[]"}); }
            ,function(d){ return bs({name:"loc_id[]", type:"select"}); }
            ,function(d){ return bs({name:"store_loc_id[]", type:"select"}); }
            ,function(d){ return bs({name:"active[]", type:"yesno"}); }
        ]
    });

  $("select[name='p_position_id[]']").dataBind(base_url + "select_options/code/positions");
  $("select[name='p_loc_id[]']").dataBind( base_url + "select_options/code/locations");
  $("select[name='p_store_loc_id[]']").dataBind( base_url + "select_options/code/store_locs");
}

    
    
function checkDelete(l_cmd) {
   var l_stmt=[], l_count;
    
   var data = zsi.table.getCheckBoxesValues("input[name='p_cb[]']:checked");
    for(var x=0;x<data.length; x++){
        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); 
    }
   if (l_stmt.length > 0) {
      if(confirm("Are you sure you want to delete selected items?")) {
      $.post( l_cmd , l_stmt, function(d){
            window.store_location.reload();
            //console.log(d);
         }).fail(function(d) {
            alert("Sorry, the curent transaction is not successfull.");
        });
      }
   }
return false;
}   
