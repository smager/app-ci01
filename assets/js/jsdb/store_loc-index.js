var bs = zsi.bs.ctrl;
var tblPopup = "tblStoreLocSupp";


$("#frm").submit(function(){ this.action = controller_url + "update"; });

function manageItems(p_id){
    $("input[name='p_store_loc_id']").val(p_id);
    zsi.form.displayLOV({
         table  : "#" + tblPopup
        ,url   : base_url + "store_loc_supplies/getdata_json/" + p_id
        ,show_checkbox: false
        ,params : ["store_loc_supply_id","loc_supply_id"] 
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
    
$(document).ready(function(){
    
    displayRecords();
    
    $.get(base_url + "assets/templates/bsDialogBox.txt",function(d){
        var template = Handlebars.compile(d);     
        
        var context = { id:"modalWindow"
                        , title: "Supply Stock Reference"
                        , footer:   '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
                                  + '<button type="button" onclick="submitSelectedItems();" class="btn btn-primary">Save</button>'
                        , body: '<table id="'+ tblPopup  +'" class="table row">'
                                + '<thead>'
                                    + '<tr><th width="1"></th><th>Supply</th>'
                                    + '<th>Unit of Measure</th>'
                                    + '<th>Daily Qty</th>'
                                + '</thead>'
                                + '</table>'
                      };
        var html    = template(context);     
        $("body").append(html);
        $(".modal-body").append('<input type="hidden" name="p_store_loc_id">');
        
    });    

});    


function displayRecords(){   
    var rownum=0;
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : controller_url +  "getdata"
        ,td_body: [ 
            function(d){
                return     bs({name:"store_loc_id[]",type:"hidden",value: d.store_loc_id})
                        +  bs({name:"cb[]",type:"checkbox"});
            }
            
            ,function(d){ return bs({name:"store_id[]",value: d.store_id, type:"select"}); }
            ,function(d){ return bs({name:"store_loc[]",value: d.store_loc}); }
            ,function(d){ return bs({name:"loc_id[]",value: d.loc_id, type:"select"}); }
            ,function(d){ return bs({name:"active[]",value: d.active, type:"yesno"}); }
            
            ,function(d){ return '<a href="javascript:manageItems( ' + d.store_loc_id+ ');">Manage Items</a>'; }

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
                return     bs({name:"store_loc_id[]",type:"hidden"})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return bs({name:"store_id[]",type:"select"}); }
            ,function(d){ return bs({name:"store_loc[]"}); }
            ,function(d){ return bs({name:"loc_id[]",type:"select"}); }
            ,function(d){ return bs({name:"active[]",type:"yesno"}); }
            ,function(d){ return '';}
        ]
    });
    
    $("select[name='p_store_id[]']").dataBind( base_url + "select_options/code/stores");
    $("select[name='p_loc_id[]']").dataBind( base_url + "select_options/code/locations");
}
    
        
function submitSelectedItems(){
        var data = $("#frm_modalWindow").serializeArray();
       $.post(base_url + "store_loc_supplies/update",data,function(d){
            $('#modalWindow').modal("hide");
       });
}    
    
function checkDelete() {
   var l_stmt=[], l_count;
    
   var data = zsi.table.getCheckBoxesValues("input[name='p_cb[]']:checked");
    for(var x=0;x<data.length; x++){
        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); 
    }
   if (l_stmt.length >0) {
      if(confirm("Are you sure you want to delete selected items?")) {
      $.post( controller_url  + "delete", l_stmt, function(d){
            window.location.reload();
            //console.log(d);
         }).fail(function(d) {
            alert("Sorry, the curent transaction is not successfull.");
        });
      }
   }
return false;
}     
