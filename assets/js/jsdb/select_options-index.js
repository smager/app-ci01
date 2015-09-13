
$(document).ready(function(){
    $("#frm").attr("action",base_url + "select_options/update").attr("method","post");
    
    var bsButton = zsi.bs.button;
    $(".buttonGroup").append( 
          bsButton({name:"Save",type:"submit"})
        + bsButton({name:'Delete',onclick:"checkDelete('"  +  base_url  + "select_options/delete');"}) 
    );

    displayRecords();
});

function displayRecords(){       
    var bs = zsi.bs.ctrl;    
    //var inputCls = "form-control input-sm";
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : base_url + "select_options/getdata_json/"
        ,td_body: [ 
            function(d){
                return     bs({name:"select_id[]",type:"hidden",value: d.select_id})
                        +  bs({name:"cb[]",type:"checkbox"});

            }            
            ,function(d){ return bs({name:"code[]",value: d.code}); }
            ,function(d){ return bs({name:"table_name[]",value: d.table_name}); }
            ,function(d){ return bs({name:"text[]",value: d.text}); }
            ,function(d){ return bs({name:"value[]",value: d.value}); }
            ,function(d){ return bs({name:"condition_text[]",value: d.condition_text}); }
        ]
        ,onComplete : function(){
            displayBlankRows();
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
                return     bs({name:"select_id[]",type:"hidden"})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return bs({name:"code[]",class:inputCls}); }
            ,function(d){ return bs({name:"table_name[]",class:inputCls}); }
            ,function(d){ return bs({name:"text[]",class:inputCls}); }
            ,function(d){ return bs({name:"value[]",class:inputCls}); }
            ,function(d){ return bs({name:"condition_text[]",class:inputCls}); }
        ]
        ,onComplete : function(){
            //console.log("display done.");
        }
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
         }).fail(function(d) {
            alert("Sorry, the curent transaction is not successfull.");
        });
      }
   }
return false;
}   


function toDate(value){
    var result='';
    if(value!==null){
        var _d = new Date(value.replace(/-/g,"/"));
        result =  (_d.getMonth() + 1) + "/" + _d.getDate() + "/" + _d.getFullYear();
    }
    return result;
}

 
