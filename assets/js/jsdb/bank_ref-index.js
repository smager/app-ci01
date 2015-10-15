var bs = zsi.bs.ctrl;
$("#frm").submit(function(){ this.action = controller_url + "update"; });
$(document).ready(function(){
    displayRecords();
});

function displayRecords(){   
    var rownum=0;
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : controller_url +  "getdata"
        ,td_body: [ 
            function(d){
                return     bs({name:"bank_ref_id[]",type:"hidden",value: d.bank_ref_id})
                        +  bs({name:"cb[]",type:"checkbox"});
            }
            ,function(d){ return bs({name:"bank_acctno[]",value: d.bank_acctno}); }
            ,function(d){ return bs({name:"bank_acctname[]",value: d.bank_acctname}); }
            ,function(d){ return bs({name:"bank_name[]",value: d.bank_name}); }
            ,function(d){ return bs({name:"depo_pct_share[]",value: d.depo_pct_share}); }
            ,function(d){ return bs({name:"priority_no[]",value: d.priority_no}); }
            ,function(d){ return bs({name:"active[]",value: d.active, type:"yesno"}); }

        ]
        ,onComplete : function(){
            displayBlankRows();
            zsi.json.checkValueExist(base_url + "common/checkdataexist", "input[name='p_bank_acctno[]']","bank_ref","bank_acctno"); 
        }
    });    
}

function displayBlankRows(){       
    var inputCls = "form-control input-sm";
    zsi.json.loadGrid({
         table  : "#grid"
        ,td_body: [ 
            function(d){
                return     bs({name:"bank_ref_id[]",type:"hidden"})
                        +  bs({name:"cb[]",type:"checkbox"});
            }            
            ,function(d){ return bs({name:"bank_acctno[]"}); }
            ,function(d){ return bs({name:"bank_acctname[]"}); }
            ,function(d){ return bs({name:"bank_name[]"}); }
            ,function(d){ return bs({name:"depo_pct_share[]"}); }
            ,function(d){ return bs({name:"priority_no[]"}); }
            ,function(d){ return bs({name:"active[]",type:"yesno"}); }
        ]
    });

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