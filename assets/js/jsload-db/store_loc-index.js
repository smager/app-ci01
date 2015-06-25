var ctrlSel = zsi.control.SelectList;  
var bs = zsi.bs.ctrl;
var tblPopup = "tblStoreLocSupp";
function manageItems(p_id){
    $("input[name='p_store_loc_id']").val(p_id);
    zsi.form.displayLOV({
         table  : "#" + tblPopup
        ,url   : base_url + "store_loc_supplies/getdata_json/" + p_id
        ,show_checkbox: false
        ,params : ["store_loc_supply_id","supply_id"] 
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
    
  ctrlSel( base_url + "select_options/code/stores","select[name='p_store_id[]']","","N");
  ctrlSel( base_url + "select_options/code/locations","select[name='p_loc_id[]']","","N");
});    
    
function submitSelectedItems(){
        var data = $("#frm_modalWindow").serializeArray();
       $.post(base_url + "store_loc_supplies/update",data,function(d){
            $('#modalWindow').modal("hide");
           // window.location.reload();
       });
}    
    
function checkDelete(l_cmd) {
   var l_stmt=[], l_count;
    
   var data = zsi.table.getCheckBoxesValues("input[name='p_cb[]']:checked");
    for(var x=0;x<data.length; x++){
        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); 
    }
   if (l_stmt!=="") {
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
