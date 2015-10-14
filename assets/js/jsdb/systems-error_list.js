var bs          = zsi.bs.ctrl;
var proc_url    = base_url + "common/executeproc/";
 
 
$(document).ready(function(){

    displayRecords();
});

 
function displayRecords(){       
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : proc_url +  "getErrors"
        ,td_body: [ 
            function(d){
                return     bs({name:"error_no[]",type:"hidden",value: d.error_no})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return "<a target='_blank' href='" + d.url + "'>"  + d.url.replace(base_url,"") + "</a>" ; }
            ,function(d){ return d.error_type; }
            ,function(d){ return d.error_message; }
            ,function(d){ return d.occurence; }
        ]
    });    
}







function checkDelete() {
   var l_stmt=[], l_count;
    
   var data = zsi.table.getCheckBoxesValues("input[name='p_cb[]']:checked");
    for(var x=0;x<data.length; x++){
        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); 
    }
   if (l_stmt.length > 0) {
      if(confirm("Are you sure you want to delete selected items?")) {
      $.post( controller_url + "errors_delete" , l_stmt, function(d){
             displayRecords();
         }).fail(function(d) {
            alert("Sorry, the curent transaction is not successfull.");
        });
      }
   }
return false;
}   
