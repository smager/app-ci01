var bs = zsi.bs.ctrl;
var action_url = base_url + "bank_deposits";
var tblPopup = "tblStoreLocSupp";
var depoAmt =0;

setInputs();
$(document).ready(function(){
    $("#p_store_loc_id").dataBind(base_url + "select_options/code/user_store_locations?p=user_id=" + userInfo.user_id);
    markMandatory();
    //act_depo_date.val( new Date().toShortDate() );
    
    
    store_loc_id.change(function(){ 
        if(this.value!==''){
             depo_by_empl_id.dataBind( base_url + "select_options/code/sales_staffs?p=store_loc_id=" + this.value);
        }
    });    

});   

$("form[id=frm]").submit(function(){
     if( zsi.form.checkMandatory()!==true) return false;
     
     $.post(controller_url + "update",$(this).serializeArray()
        ,function(d){
            displayRecords();
        } 
        
     );
     return false;
 }); 
 

function setInputs(){
    store_loc_id = $("#p_store_loc_id");
    depo_date = $("#p_depo_date");
    posted = $("#p_posted");
    depo_by_empl_id= $("#p_depo_by_empl_id");
    depo_amount = $("#depo_amount");
    act_depo_date = $("#p_act_depo_date");
    store_bank_depo_id= $("#p_store_bank_depo_id");
}

function markMandatory(){
    zsi.form.markMandatory({       
      "groupNames":[
            {
                 "names" : ["p_store_loc_id","p_depo_date","p_act_depo_date"]
                ,"type":"S"
            }             
      ]      
      ,"groupTitles":[ 
             {"titles" :["Store Location","Deposit Date","Actual Deposit Date"]}
      ]
   });
   
}

store_loc_id.change(function(){
    $(".table").clearGrid();

});

$("#btnGo").click(function(){ 
    displayRecords();
});


function displayRecords(){
    depo_by_empl_id.val("");
    $.getJSON(controller_url + "get_store_banks_depo_info?p_store_loc_id="+ store_loc_id.val() +"&p_tran_date=" + depo_date.val()
        ,function(data){
            if(data.length>0){
               displayStoreBanksDepo(data[0]);
            }
        }
    );    
}


function displayStoreBanksDepo(info){
    depo_amount.html(info.depo_amt.toMoney());
    store_bank_depo_id.val(info.store_bank_depo_id);
    if(info.act_depo_date!==null) act_depo_date.val(info.act_depo_date.toDateFormat());
    if(info.depo_by_empl_id!==null) depo_by_empl_id.val(info.depo_by_empl_id);

    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : controller_url + "get_store_banks_depo/"+ info.store_bank_depo_id + "/" + info.depo_amt  
        ,td_body: [ 
             function(d){ return  d.bank_name;}
            ,function(d){ return d.depo_pct_share; }
            ,function(d){ return d.depo_amount; } 
        ]
    });          

}

