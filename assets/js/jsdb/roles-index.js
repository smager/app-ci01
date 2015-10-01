var bs = zsi.bs.ctrl;
var proc_url = base_url + "common/executeproc/";

$("#frm").submit(function(){ this.action = controller_url + "update"; });

$(document).ready(function(){
    displayRecords();
    getDialogTemplate();
    
});

function getDialogTemplate(){
    //get dialog template
    $.get(base_url + "assets/templates/bsDialogBox.txt",function(d){
        var template = Handlebars.compile(d);     
        
        var context = { id:"modalWindow"
                        , title: "Add/Remove Supply"
                        , footer:   '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
                                  + '<button type="button" onclick="submitSelectedItems();" class="btn btn-primary">Save</button>'
                        , body: '<table id="tblPopup" class="table row">'
                                + '<thead>'
                                    + '<tr><th width="20"></th><th>Menu Items</th></tr>'
                                + '</thead>'
                                + '</table>'
                      };
        var html    = template(context);     
        $("body").append(html);
        $(".modal-body").append('<input type="hidden" name="p_role_id">');
        
    });        
}

function displayRecords(){   
    var rownum=0;
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : controller_url +  "getdata"
        ,td_body: [ 
            function(d){
                return     bs({name:"role_id[]",type:"hidden",value: d.role_id})
                        +  bs({name:"cb[]",type:"checkbox"});
            }
            ,function(d){ return bs({name:"role_code[]",value: d.role_code}); }
            ,function(d){ return bs({name:"role_desc[]",value: d.role_desc}); }
            ,function(d){ return '<a href="javascript:manageItems('+ d.role_id +');">Menu Access</a>'; }
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
                return     bs({name:"role_id[]",type:"hidden"})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return bs({name:"role_code[]"}); }
            ,function(d){ return bs({name:"role_desc[]"}); }
            ,function(d){ return ""; }
        ]
    });

}

function manageItems(p_id){
    $("input[name='p_role_id']").val(p_id);
    
    zsi.form.displayLOV({
         table  : "#tblPopup"
        ,url   : proc_url +  "role_menus?p=" + p_id 
        ,params : ["role_menu_id","menu_id"] 
        ,column_data: [
             function(d){ return d.menu_name; }
 
        ]
        ,onComplete:function(){
            $('#modalWindow').modal("show");
        }
    });
    
}
function submitSelectedItems(){
    var data = $("#frm_modalWindow").serializeArray();
    $('#modalWindow').modal("hide");
    $.post(controller_url + "role_menu_update",data,function(d){});
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