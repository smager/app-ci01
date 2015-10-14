var bs          = zsi.bs.ctrl;
var proc_url    = base_url + "common/executeproc/";
var tblName     = "tblProdSupp";

function displayClear(v){
    var r='';
    if(v!==null){
        if(parseInt(v)!==0) r=v;
    }
    return r;
}

$("#frm").submit(function(){ this.action = controller_url + "update"; });

function manageItems(p_id){
    
    $("input[name='p_loc_id']").val(p_id);
    $('#modalWindow').modal("show");
    $("#p_store_loc_id").val("");
   clearGrid();
    
}
function clearGrid(){
    $("#" + tblName).clearGrid();
}

$(document).ready(function(){

    displayRecords();

    //get dialog template
    $.get(base_url + "assets/templates/bsDialogBox.txt",function(d){
        var template = Handlebars.compile(d);     
        
        var context = { id:"modalWindow"
                        , title: "Add/Remove Supply"
                        , footer:   '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
                                  + '<button type="button" onclick="submitSelectedItems();" class="btn btn-primary">Save</button>'
                        , body: 
                        
                        '<div class="form-group  ">'  
                            + '<label class=" col-xs-1 control-label">Store</label>'
                            + '<div class=" col-xs-6"> '
                            +     '<select name="p_store_loc_id" id="p_store_loc_id" class="form-control input-sm"> </select>'
                            + '</div>'
                        + '</div><br />'
                        +'<table id="' + tblName + '" class="table row">'
                                + '<thead>'
                                    + '<tr><th width="20"></th><th>Names</th><th>Unit</th><th>Re-order Qty</th><th>Max Qty</th></tr>'
                                + '</thead>'
                                + '</table>'
                      };
        var html    = template(context);     
        $("body").append(html);
        $(".modal-body").append('<input type="hidden" name="p_loc_id">');
        $("#p_store_loc_id").change(function(){
            
            if( this.value==="") {
                clearGrid();
                return false;
            }
            zsi.form.displayLOV({
                 table  : "#" + tblName
                ,url   :  proc_url +  "getStoreLocSuppliesByStorex?p=" + "0" + $("input[name='p_loc_id']").val() + "," + this.value
                ,params : ["loc_supply_id","supply_id"] 
                ,column_data: [
                     function(d){ return d.supply_code; }
                    , function(d){ return d.unit_desc; } 
                    ,function(d){ 
                        return bs({name:"reorder_level[]",value: displayClear(d.reorder_level)}); 
                    }
                    ,function(d){ 
                        return bs({name:"max_level[]",value: displayClear(d.max_level)}); 
                    }  
                ]
                ,onComplete:function(){
                    $('#modalWindow').modal("show");
                }
            });
    
        }).dataBind(base_url + "select_options/code/stores");
        
    });
});

 
function displayRecords(){       
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : controller_url +  "getdata"
        ,td_body: [ 
            function(d){
                return     bs({name:"loc_id[]",type:"hidden",value: d.loc_id})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return bs({name:"location[]",value: d.location}); }
            ,function(d){ return '<a href="javascript:manageItems('+ d.loc_id +');">Manage Items</a>'; }
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
                return     bs({name:"loc_id[]",type:"hidden"})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return bs({name:"location[]"}); }
            ,function(d){ return ""; }
        ]
    });    
}



function submitSelectedItems(){
    var data = $("#frm_modalWindow").serializeArray();
    $('#modalWindow').modal("hide");
    $.post(base_url + "loc_supplies/update",data,function(d){});
}


function checkDelete() {
   var l_stmt=[], l_count;
    
   var data = zsi.table.getCheckBoxesValues("input[name='p_cb[]']:checked");
    for(var x=0;x<data.length; x++){
        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); 
    }
   if (l_stmt.length > 0) {
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
