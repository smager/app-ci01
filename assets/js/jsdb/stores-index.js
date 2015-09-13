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

$(document).ready(function(){

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
    
function submitSelectedItems(){
        var data = $("#frm_modalWindow").serializeArray();
       $.post(base_url + "store_supplies/update",data,function(d){
            $('#modalWindow').modal("hide");
            window.location.reload();
       });
}

function checkDelete(l_cmd) {
   var l_stmt=[], l_count;
    
   var data = zsi.table.getCheckBoxesValues("input[name='p_cb[]']:checked");
    for(var x=0;x<data.length; x++){
        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); 
    }
   if (l_stmt!="") {
      if(confirm("Are you sure you want to delete selected items?")) {
      $.post( l_cmd , l_stmt, function(d){
            window.location.reload();
            //console.log(d);
         }).fail(function(d) {
            alert("Sorry, the curent transaction is not successfull.");
        });
      }
   }
return false;
}   
