var bs = zsi.bs.ctrl;
setInputs();
$(document).ready(function(){
    $("#p_store_loc_id").dataBind(base_url + "select_options/code/user_store_locations?p=user_id=" + userInfo.user_id);
    displayBlankRows(true);
    $("#p_exp_date").val( new Date().toShortDate() );
});   

$("form[id=frm]").submit(function(){
     if( zsi.form.checkMandatory()!==true) return false;
     
     $.post(base_url + "store_daily_expenses/update",$(this).serializeArray()
        ,function(d){
            $("#btnGo").click();
        } 
     );
     
     
     return false;
 }); 
 
$("#btnGo").click(function(){
    if(store_loc_id.val()==="") {
        store_loc_exp_id.val('');
        $("#grid").clearGrid();
        return;
    }
    if(exp_date.val()==="") return;
    $.getJSON(base_url + "store_daily_expenses/getinfo?p_store_loc_id=" + store_loc_id.val() + "&p_exp_date=" + exp_date.val() ,function(data){
       if(data.length>0){
            var d=data[0];
            store_loc_exp_id.val(d.store_loc_exp_id);
            exp_date.val(d.exp_date.toDateFormat());
            displayRecords(d.store_loc_exp_id);
       }else{
           displayBlankRows(true);
       }
    });
});

 function markMandatory(){
    zsi.form.markMandatory({       
      "groupNames":[
            {
                 "names" : ["p_store_loc_id","p_date","p_posted"]
                ,"type":"S"
            }             
            ,{
                 "names" : ["p_fr_sales[]","p_exp_desc[]","p_exp_amt[]"]
                ,"type":"M"
                ,"required_one":"Y" 
            }              
      ]      
      ,"groupTitles":[ 
           {"titles" :["Location","Date","Posted"]}
          ,{"titles" :["From Sales","Description","Amount"]}
      ]
   });
   
}
 
function setInputs(){
    store_loc_exp_id = $("#p_store_loc_exp_id");
    store_loc_id = $("#p_store_loc_id");
    exp_date = $("#p_exp_date");
    posted = $("#p_posted");
}

 

function displayRecords(id){       
    var bs = zsi.bs.ctrl;    
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : base_url + "store_daily_expenses/getdetail/" + id
        ,td_body: [ 
            function(d){
                return  bs({name:"store_loc_exp_dtl_id[]",type:"hidden",value: d.store_loc_exp_dtl_id})
                        +  bs({name:"select[]",type:"checkbox"});
            }
            ,function(d){ return bs({name:"fr_sales[]",type:"select", class:"form-control",value: d.fr_sales}); }
            ,function(d){ return bs({name:"or_no[]",type:"input", class:"form-control",value: d.or_no}); }
            ,function(d){ return bs({name:"exp_desc[]",type:"input", class:"form-control",value: d.exp_desc}); }
            ,function(d){ return bs({name:"exp_amt[]",type:"input", class:"form-control numeric",value: d.exp_amt}); }
        ]
        ,onComplete : function(){
           displayBlankRows(false);
            $("select[name='p_fr_sales[]']").change();
            $("input[name='p_or_no[]']").change();
            $("input[name='p_exp_desc[]']").change();
            $("input[name='p_exp_amt[]']").change();
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
                return  bs({name:"store_loc_exp_dtl_id[]",type:"hidden"})
                        +  bs({name:"select[]",type:"checkbox"});
            }            
            ,function(d){ return bs({name:"fr_sales[]",type:"select", class:"form-control"}); }
            ,function(d){ return bs({name:"or_no[]",type:"input", class:"form-control"}); }
            ,function(d){ return bs({name:"exp_desc[]",type:"input", class:"form-control"}); }
            ,function(d){ return bs({name:"exp_amt[]",type:"input", class:"form-control numeric"}); }
        ]
        ,onComplete : function(){
            zsi.initInputTypesAndFormats();
            markMandatory();
            var params = {
                 data : [{text:"No",value:0},{text:"Yes",value:1}]
            };
            $("select[name='p_fr_sales[]']").fillSelect(params);

        }
    });    
}

$("#btnDelete").click(function(){
    var params=[];
    var url = base_url + "store_daily_expenses/delete_dtls";
    var data = zsi.table.getCheckBoxesValues("input[type='checkbox']:checked");
    for(var x=0;x<data.length; x++){
        params.push( { name:"p_del_id[]",value : data[x] }  ); 
    }
    if (params.length>0) {
      if(confirm("Are you sure you want to delete selected items?")) {
      $.post( url, params, function(d){
            displayRecords(store_loc_exp_id.val());
         }).fail(function(d) {
            alert("Sorry, the curent transaction is not successfull.");
        });
      }
    }
    return false;    
    
});



 
