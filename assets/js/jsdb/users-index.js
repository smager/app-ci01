var bs = zsi.bs.ctrl;  
    
$(document).ready(function(){
    $("#frm").attr("action",base_url + "users/update").attr("method","post");
    
    displayRecords();
    
    //get dialog template
    $.get(base_url + "assets/templates/bsDialogBox.txt",function(d){
        var template = Handlebars.compile(d);     
        
        var context = { id:"modalWindow"
                        , title: "Add/Remove Supply"
                        , footer:   '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
                                  + '<button type="button" onclick="submitSelectedItems();" class="btn btn-primary">Save</button>'
                        , body: '<table id="tblPopup" class="table row">'
                                + '<thead>'
                                    + '<tr><th width="20"></th><th>Location</th></tr>'
                                + '</thead>'
                                + '</table>'
                      };
        var html    = template(context);     
        $("body").append(html);
        $(".modal-body").append('<input type="hidden" name="p_user_id">');
        
    });    
});

function displayRecords(){       
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : base_url + "users/getdata_json/"
        ,td_body: [ 
            function(d){
                return     bs({name:"user_id[]",type:"hidden",value: d.user_id})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return bs({name:"empl_id[]",type:"select",value: d.empl_id}); }
            ,function(d){ return bs({name:"user_name[]",value: d.user_name}); }
            ,function(d){ return bs({name:"role_id[]",type:"select",value: d.role_id}); }
            ,function(d){ return bs({name:"active[]",type:"yesno",value: d.active}); }
            ,function(d){ return '<a href="javascript:manageItems('+ d.user_id +');">Location Access</a>'; }
        ]
        ,onComplete : function(){
            displayBlankRows();
        }
    });    
}
function manageItems(p_id){
    $("input[name='p_user_id']").val(p_id);
    zsi.form.displayLOV({
         table  : "#tblPopup"
        ,url   : base_url + "user_locations/getdata_json/" + p_id
        ,params : ["user_loc_id","loc_id"] 
        ,column_data: [
             function(d){ return d.location; }
 
        ]
        ,onComplete:function(){
            $('#modalWindow').modal("show");
        }
    });
    
}



function displayBlankRows(){       
    var inputCls = "form-control input-sm";
    zsi.json.loadGrid({
         table  : "#grid"
        ,td_body: [ 
            function(d){
                return     bs({name:"user_id[]",type:"hidden"})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return bs({name:"empl_id[]",type:"select"}); }
            ,function(d){ return bs({name:"user_name[]"}); }
            ,function(d){ return bs({name:"role_id[]",type:"select"}); }
            ,function(d){ return bs({name:"active[]",type:"yesno",value:0}); }
            ,function(d){ return "";}
        ]
        ,onComplete : function(){
            $("select[name='p_empl_id[]']").dataBind( base_url + "select_options/code/employees");
            $("select[name='p_role_id[]']").dataBind( base_url + "select_options/code/roles"); 

        }
    });    
}

function submitSelectedItems(){
    var data = $("#frm_modalWindow").serializeArray();
    $('#modalWindow').modal("hide");
    $.post(base_url + "user_locations/update",data,function(d){});
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



 
