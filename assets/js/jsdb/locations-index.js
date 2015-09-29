var bs = zsi.bs.ctrl;

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
    zsi.form.displayLOV({
         table  : "#tblProdSupp"
        ,url   : base_url + "loc_supplies/getdata_json/" + p_id
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
    
}

$(document).ready(function(){

    //displayRecords();

    //get dialog template
    $.get(base_url + "assets/templates/bsDialogBox.txt",function(d){
        var template = Handlebars.compile(d);     
        
        var context = { id:"modalWindow"
                        , title: "Add/Remove Supply"
                        , footer:   '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
                                  + '<button type="button" onclick="submitSelectedItems();" class="btn btn-primary">Save</button>'
                        , body: '<table id="tblProdSupp" class="table row">'
                                + '<thead>'
                                    + '<tr><th width="20"></th><th>Names</th><th>Unit</th><th>Re-order Qty</th><th>Max Qty</th></tr>'
                                + '</thead>'
                                + '</table>'
                      };
        var html    = template(context);     
        $("body").append(html);
        $(".modal-body").append('<input type="hidden" name="p_loc_id">');
        
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
   if (l_stmt!=="") {
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
