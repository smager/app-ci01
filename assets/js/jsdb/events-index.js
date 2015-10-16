$(document).ready(function(){
    markMandatory();    
    displayRecords();
});

function displayRecords(){       
    var bs = zsi.bs.ctrl;    
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : controller_url + "getdata" 
        ,td_body: [ 
            function(d){
                return     bs({name:"event_id[]",type:"hidden",value: d.event_id})
                        +  bs({name:"cb[]",type:"checkbox"});

            }            
            ,function(d){ return bs({name:"event_desc[]",value:d.event_desc}); }
        ]
        ,td_properties: ["","","align='center'"] 
        ,onComplete : function(){
            displayBlankRows(false);
            zsi.json.checkValueExist(base_url + "common/checkdataexist", "input[name='p_event_desc[]']","events","event_desc"); 
        }
    });    
}

function displayBlankRows(p_isNew){       
    var bs = zsi.bs.ctrl;    
    zsi.json.loadGrid({
         table  : "#grid"
        ,isNew  : p_isNew
        ,limit: 15
        ,td_body: [ 
            function(d){
                return     bs({name:"event_id[]",type:"hidden"})
                        +  bs({name:"cb[]",type:"checkbox"});

            }    
            ,function(d){ return bs({name:"event_desc[]"}); }

        ]
        ,td_properties: ["","","align='center'"] 
        ,onComplete : function(){
             markMandatory();
        }
    });    
}

$("form[id=frm]").submit(function(){
     if( zsi.form.checkMandatory()!==true) return false;
     
     $.post(base_url + "events/update",$(this).serializeArray()
        ,function(d){
            markMandatory();
        } 
     );
     
     
     return false;
 });
 
function markMandatory(){
    zsi.form.markMandatory({       
      "groupNames":[
            {
                 "names" : ["p_event_desc[]"]
                ,"type":"M"
                ,"required_one":"Y"            
            }
      ]      
      ,"groupTitles":[ 
            {"titles" :["Event Name"]}
      ]
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