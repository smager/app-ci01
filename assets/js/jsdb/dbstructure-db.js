var ctrlSel = zsi.control.SelectList;  
var bsButton = zsi.bs.button;
var bs = zsi.bs.ctrl;    
var g_supply_id;
$(document).ready(function(){
    $("#frm").attr("action",controller_url + "dbupdate").attr("method","post");
    $(".buttonGroup").append( 
          bsButton({name:"Save",type:"submit"})
        + bsButton({name:'Delete',onclick:"checkDelete('"  +  controller_url  + "dbdelete',false);"}) 
        + bsButton({name:"GenerateSQL",onclick:"generateSQL();"}) 
    );
    displayRecords();
    
});

function generateSQL(){
    alert("generate sql");
}

function getParam(){
    var _r="";
    var _complete_url = window.location.href;
    var _base_url = controller_url + "db/";
    var i = _complete_url.indexOf(_base_url);
    if(i >-1){
        _r = _complete_url.substr(_base_url.length);
    }    
    return _r;    
}

$("form[id=frm]").submit(function(){
     $.post(controller_url + "dbupdate",$(this).serializeArray()
        ,function(d){
            displayRecords();
        } 
        
     );
     return false;
 }); 

$("btnGenerateSQL").click(function(){
     $.get(controller_url + "db_generate_sql"
        ,function(d){
        } 
     );
     return false;
 }); 


function displayRecords(){       
    var bs = zsi.bs.ctrl;    
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : controller_url + "getdata/" + getParam()
        ,td_body: [ 
            function(d){
                return     bs({name:"dbstruct_id[]",type:"hidden",value: d.dbstruct_id})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return "<a target='_blank' href='"+ controller_url + "edit/" +  d.object_name + "/" + d.object_type + "'>" + d.object_name + "</a>"; }
            ,function(d){ return bs({name:"seq_no[]",value: (d.seq_no===null?"":d.seq_no) }); }
            ,function(d){ return  d.object_type; }
            	

        ]
        ,onComplete : function(){
        }
    });    
}


function checkDelete(l_cmd,isPopUp) {
   var l_stmt=[], l_count;
    
   var data = zsi.table.getCheckBoxesValues("input[name='p_cb[]']:checked");
    for(var x=0;x<data.length; x++){
        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); 
    }
   if (l_stmt!=="") {
      if(confirm("Are you sure you want to delete selected items?")) {
      $.post( l_cmd , l_stmt, function(d){
             displayRecords();
            
         }).fail(function(d) {
            alert("Sorry, the curent transaction is not successfull.");
        });
      }
   }
return false;
}   