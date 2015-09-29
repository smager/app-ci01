var bs = zsi.bs.ctrl;
var store_supplies_data=null;

function collapseList(o,target){
    $(o).text(function(i,v) {
           return v === 'Show' ? 'Hide' : 'Show';
     });
        
    $('#' + target).slideToggle();
}

function manageItems(p_id){
    $("input[name='p_store_id']").val(p_id);
    zsi.form.displayLOV({
         table  : "#tblProdSupp"
        ,url   : base_url + "store_supplies/getdata_json/" + p_id
        ,params : ["store_supply_id","supply_id"] 
        ,column_data: [
             function(d){ return d.supply_code; }
        ]
        ,onComplete:function(){
            $('#modalWindow').modal("show");
        }
    });
    
}

function getInitialsValues(){
    //getStoreSuppliesData
    $.getJSON(base_url + "store_supplies/get_store_supplies",function(data){
        store_supplies_data=data;
        
        displayRecords()
    })
}

$("#frm").attr("action",controller_url + "update").attr("method","post");

$(document).ready(function(){
    getInitialsValues();

    //get dialog template
    $.get(base_url + "assets/templates/bsDialogBox.txt",function(d){
        var template = Handlebars.compile(d);     
        
        var context = { id:"modalWindow"
                        , title: "Add/Remove Supply"
                        , footer:   '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
                                  + '<button type="button" onclick="submitSelectedItems();" class="btn btn-primary">Save</button>'
                        , body: '<table id="tblProdSupp" class="table row">'
                                + '<thead>'
                                    + '<tr><th width="20"></th><th>Names</th></tr>'
                                + '</thead>'
                                + '</table>'
                      };
        var html    = template(context);     
        $("body").append(html);
        $(".modal-body").append('<input type="hidden" name="p_store_id">');
        
    });

});
    
function displayRecords(){   
    var rownum=0;
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : controller_url +  "getdata"
        ,td_body: [ 
            function(d){
                return     bs({name:"store_id[]",type:"hidden",value: d.store_id})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return bs({name:"store_name[]",value: d.store_name}); }
            ,function(d){ return bs({name:"supplier_id[]",value: d.supplier_id, type:"select"}); }
            ,function(d){ 
                rownum++;
                var h = "";
                
                $.each(store_supplies_data,function(){
                    if(this.store_id === d.store_id ) {
                       if (h!=="") h +="<br />";
                        h +=this.supply_code;
                    }
                })
                
                return '<a href="javascript:manageItems('+ d.store_id +');">Manage Items</a>'
                  + ' | <a href="javascript:void(0)" onclick="collapseList(this,\'prodlist' + rownum + '\');">Show</a>'
                  + '<div style="display: none;" id="prodlist'+ rownum + '">' + h +'</div>';
            }
        ]
        ,onComplete : function(){
            displayBlankRows();
            $("select[name='p_supplier_id[]']").dataBind( base_url + "select_options/code/suppliers");
        }
    });    
}

function displayBlankRows(){       
    var inputCls = "form-control input-sm";
    zsi.json.loadGrid({
         table  : "#grid"
        ,td_body: [ 
            function(d){
                return     bs({name:"store_id[]",type:"hidden"})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return bs({name:"store_name[]"}); }
            ,function(d){ return bs({name:"supplier_id[]",type:"select"}); }
            ,function(d){ return ""; }
        ]
    });    
}
    
function submitSelectedItems(){
        var data = $("#frm_modalWindow").serializeArray();
       $.post(base_url + "store_supplies/update",data,function(d){
            $('#modalWindow').modal("hide");
            window.location.reload();
       });
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
