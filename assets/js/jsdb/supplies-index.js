var ctrlSel = zsi.control.SelectList;  
var bsButton = zsi.bs.button;
var bs = zsi.bs.ctrl;    
var g_supply_id;
$(document).ready(function(){
     
    $("#frm").attr("action",base_url + "supplies/update").attr("method","post");
    
   
    $(".buttonGroup").append( 
          bsButton({name:"Save",type:"submit"})
        + bsButton({name:'Delete',onclick:"checkDelete('"  +  base_url  + "supplies/delete',false);"}) 
    );

    displayRecords();
    
    //get dialog template
    $.get(base_url + "assets/templates/bsDialogBox.txt",function(d){
        var template = Handlebars.compile(d);     
        
        var context = { id:"modalWindow"
                        , title: "Manage Supply Brand(s)/Unit and Cost"
                        , footer:   '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
                                  +  bsButton({name:'Delete',onclick:"checkDelete('"  +  base_url  + "supply_brands/delete',true);"})
                                  +  bsButton({name:'Save',onclick:"submitSelectedItems();"}) 
                        , body: '<table id="tblPopup" class="table row">'
                                + '<thead>'
                                    + '<tr>'
                                    + '<th width="20"></th>'
                                    + '<th>Brands</th>'
                                    + '<th>Unit</th>'
                                    + '<th>Unit Cost</th>'
                                    + '</tr>'
                                + '</thead>'
                                + '</table>'
                      };
        var html    = template(context);     
        $("body").append(html);
        $(".modal-body").append('<input type="hidden" name="p_supply_id">');
        
    });    
});

function displayRecords(){       
    var bs = zsi.bs.ctrl;    
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : base_url + "supplies/getdata_json/"
        ,td_body: [ 
            function(d){
                return     bs({name:"supply_id[]",type:"hidden",value: d.supply_id})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return bs({name:"seq_no[]",value: d.seq_no}); }
            ,function(d){ return bs({name:"supply_code[]",value: d.supply_code}); }
            ,function(d){ return bs({name:"supply_desc[]",value: d.supply_desc}); }
            ,function(d){ return bs({name:"unit_id[]",type:"select",value: d.unit_id}); }
            ,function(d){ return bs({name:"supply_srp[]",value: d.supply_srp}); }
            ,function(d){ return bs({name:"supply_cost[]",value: d.supply_cost}); }
            ,function(d){ return bs({name:"weight_serve[]",value: d.weight_serve}); }
            ,function(d){ return bs({name:"supply_type_id[]",type:"select",value: d.supply_type_id}); }
            ,function(d){ return '<a href="javascript:manageItems('+ d.supply_id +');">Manage</a>'; }
        ]
        ,onComplete : function(){
            displayBlankRows();
        }
    });    
}
function manageItems(p_id){
    g_supply_id=p_id;
    $("input[name='p_supply_id']").val(p_id);

  zsi.json.loadGrid({
         table  : "#tblPopup"
        ,url   : base_url + "supply_brands/getdata_json/" + p_id
        ,td_body: [ 
            function(d){
                return     bs({name:"supply_brand_id[]",type:"hidden",value: d.supply_brand_id})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return  bs({name:"brand_id[]", type:"select",value:d.brand_id});}
            ,function(d){ return bs({name:"conv_id[]", type:"select",value:d.conv_id}); }
            ,function(d){ return bs({name:"supply_cost[]",value:d.supply_cost}); }
        ]
        ,onComplete:function(){
            $('#modalWindow').modal("show");
            popUpBlankRows();
            
        }
    });
    
    
}

function popUpBlankRows(){
     zsi.json.loadGrid({
         table  : "#tblPopup"
        ,limit : 10
        ,td_body: [ 
            function(d){
                return     bs({name:"supply_brand_id[]",type:"hidden"})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return  bs({name:"brand_id[]", type:"select"});}
            ,function(d){ return bs({name:"conv_id[]", type:"select"}); }
            ,function(d){ return bs({name:"supply_cost[]"}); }
        ]
        ,onComplete:function(){
            $("select[name='p_brand_id[]']").dataBind(base_url + "select_options/code/brands");
            $("select[name='p_conv_id[]']").dataBind(base_url + "select_options/code/conv_units");
            
        }
    });
}


function displayBlankRows(){       
    var bs = zsi.bs.ctrl;    
    var inputCls = "form-control input-sm";
    zsi.json.loadGrid({
         table  : "#grid"
        ,td_body: [ 
            function(d){
                return     bs({name:"supply_id[]",type:"hidden"})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return bs({name:"seq_no[]"}); }
            ,function(d){ return bs({name:"supply_code[]"}); }
            ,function(d){ return bs({name:"supply_desc[]"}); }
            ,function(d){ return bs({name:"unit_id[]",type:"select"}); }
            ,function(d){ return bs({name:"supply_srp[]"}); }
            ,function(d){ return bs({name:"supply_cost[]"}); }
            ,function(d){ return bs({name:"weight_serve[]"}); }
            ,function(d){ return bs({name:"supply_type_id[]",type:"select"}); }
            ,function(d){ return ""; }
        ]
        ,onComplete : function(){
             ctrlSel( base_url + "select_options/code/supply_types","select[name='p_supply_type_id[]']","","N");
             ctrlSel( base_url + "select_options/code/units","select[name='p_unit_id[]']","","N");

        }
    });    
}

function submitSelectedItems(){
    var data = $("#frm_modalWindow").serializeArray();
    $('#modalWindow').modal("hide");
    $.post(base_url + "supply_brands/update",data,function(d){});
}
    
function checkDelete(l_cmd,isPopUp) {
   var l_stmt=[], l_count;
    
   var data = zsi.table.getCheckBoxesValues("input[name='p_cb[]']:checked");
    for(var x=0;x<data.length; x++){
        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); 
    }
   if (l_stmt!="") {
      if(confirm("Are you sure you want to delete selected items?")) {
      $.post( l_cmd , l_stmt, function(d){
            //window.location.reload();
            //console.log(d);
            if(isPopUp)  manageItems(g_supply_id); else displayRecords();
            
         }).fail(function(d) {
            alert("Sorry, the curent transaction is not successfull.");
        });
      }
   }
return false;
}   