var ctrlSel = zsi.control.SelectList;  
    
$(document).ready(function(){
  ctrlSel( base_url + "select_options/code/positions","select[name='p_position_id[]']","","N");
  ctrlSel( base_url + "select_options/code/locations","select[name='p_loc_id[]']","","N");
  ctrlSel( base_url + "select_options/code/store_locs","select[name='p_store_loc_id[]']","","N");
});    

    
    
function checkDelete(l_cmd) {
   var l_stmt=[], l_count;
    
   var data = zsi.table.getCheckBoxesValues("input[name='p_cb[]']:checked");
    for(var x=0;x<data.length; x++){
        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); 
    }
   if (l_stmt!="") {
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
