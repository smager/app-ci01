var supply;
var timer;
$(document).ready(function(){
    initInputs();
    onLocationChange();
    getUnpostedItems();
    markMandatory();
    
    loc_id.dataBind( base_url + "select_options/code/locations");
});
$("form[id=frm]").submit(function(){
     if( zsi.form.checkMandatory()!==true) return false;
     
     $.post(controller_url + "update",$(this).serializeArray()
        ,function(d){
            ClearHeader();
            getUnpostedItems();
            
        } 
        
     );
     
     
     return false;
 }); 
 
 $("#btnNew").click(function(){
    ClearHeader();
 });
 

 function ClearHeader(){
    stock_adjmt_id.val('');
    stock_adjmt_no.val('');
    adjmt_date.val('');
    loc_id.val('');
    store_loc_id.val('');
    store_loc_id.removeAttr("selectedvalue");
    adjmt_qty.val('');
    loc_supply_brand_id.val('');
    store_loc_supply_daily_id.val('');
    posted.val(0);
 }
 

function markMandatory(){
    zsi.form.markMandatory({       
      "groupNames":[
            {
                 "names" : ["p_stock_adjmt_no","p_adjmt_date","p_loc_id"]
                ,"type":"S"
            }             
      ]      
      ,"groupTitles":[ 
             {"titles" :["P.C No","Date","Location"]}
      ]
   });
   
}
function getUnpostedItems(){
     $(".list-group").html('');
    $.getJSON(controller_url + "getunposteditems",function(data){
        $.each(data,function(){
            var params = {
                 stock_adjmt_id             : this.stock_adjmt_id
                ,stock_adjmt_no             : this.stock_adjmt_no
                ,adjmt_date                 : this.adjmt_date
                ,loc_id                     : this.loc_id
                ,store_loc_id               : this.store_loc_id
                ,adjmt_qty                  : this.adjmt_qty
                ,posted                     : this.posted
                ,loc_supply_brand_id        : this.loc_supply_brand_id
                ,store_loc_supply_daily_id  : this.store_loc_supply_daily_id
                
            };
            var removeicon = "<a class='glyphicon glyphicon-remove-sign itemRemove' onclick='removeItems(" + this.stock_adjmt_id  + ");' href='javascript:void(0);'></a>";
            $(".list-group").append("<a href='javascript:void(0);' onclick='displayData("   + JSON.stringify(params) +  ");' class='list-group-item' >" + this.stock_adjmt_no + "</a>" + removeicon);
        });
        
    });

}

function removeItems(id){
      if(confirm("Are you sure you want to delete selected items?")) {
        ClearHeader();  
        $.post( controller_url + "delete/" + id , function(d){
                getUnpostedItems();
            }).fail(function(d) {
                alert("Sorry, the curent transaction is not successfull.");
            });
        }
}

function initInputs(){
    stock_adjmt_id = $("#p_stock_adjmt_id");
    stock_adjmt_no = $("#p_stock_adjmt_no");
    adjmt_qty = $("#p_adjmt_qty");
    adjmt_date = $("#p_adjmt_date");
    loc_id = $("#p_loc_id");
    store_loc_id = $("#p_store_loc_id");
    loc_supply_brand_id = $("#p_loc_supply_brand_id");
    store_loc_supply_daily_id = $("#p_store_loc_supply_daily_id");
    posted = $("#p_posted");


    store_loc_id.change(function(){
        ShowHideSupplyItems( loc_id.val(), this.value);
    });

    adjmt_date.change(function(){
        //timer : prevent bubbles event. 
        if(timer) clearTimeout(timer);
        timer=setTimeout(function(){
            store_loc_id.change();
        },1); 
    });

    
}

function displayData(p){
    stock_adjmt_id.val(p.stock_adjmt_id);
    stock_adjmt_no.val(p.stock_adjmt_no);
    adjmt_date.val(p.adjmt_date.toDateFormat());
    loc_id.val(p.loc_id);
    adjmt_qty.val(p.adjmt_qty);
    store_loc_id.attr("selectedvalue",p.store_loc_id);
    posted.val(p.posted);
    
    displayStoreLocation(p.loc_id);
    var selVal = (p.loc_supply_brand_id>0?p.loc_supply_brand_id:p.store_loc_supply_daily_id);
 
    ShowHideSupplyItems(p.loc_id, p.store_loc_id, selVal);

 }

 
function onLocationChange(){
    loc_id.change(function(){
        ShowHideSupplyItems(this.value,0);
        store_loc_id.clearSelect();
        if(this.value===''){  
            $("#grid").clearGrid(); 
            return false;
        }
        displayStoreLocation(this.value);
    });
    
    store_loc_id.change(function(){ $("#grid").clearGrid(); });
}

function ShowHideSupplyItems(loc_id,storeLocId,_selectedValue){
    var l_loc_id = parseInt("0" + loc_id );
    var l_store_loc_id = parseInt("0" + storeLocId );
    
    loc_supply_brand_id.val("");
    store_loc_supply_daily_id.val("");
    
   if (l_loc_id !== 0 && l_store_loc_id===0){
        loc_supply_brand_id.dataBind({ 
             url:base_url + "select_options/code/loc_supply_brands_bycode?p=loc_id=" + l_loc_id
            ,selectedValue :   _selectedValue
        });
      
       $("#supply1").css("display","block");
       $("#supply2").css("display","none");

   }else if  (l_loc_id !== 0 && l_store_loc_id!==0){
       if(adjmt_date.val()===""){
           store_loc_id.val("");
           alert("Please enter date");
           adjmt_date.focus();
       }
       else{
            store_loc_supply_daily_id.dataBind({ 
                 url: base_url + "select_options/code/store_loc_supply_daily?p=store_loc_id=" + l_store_loc_id 
                               + ' and stock_date=str_to_date("' + adjmt_date.val() + '","%m/%d/%Y")' 
                ,selectedValue :   _selectedValue
            });
        
           $("#supply2").css("display","block");
           $("#supply1").css("display","none");
       }
   }else{
       $("#supply1").css("display","none");
       $("#supply2").css("display","none");
   }
}


function displayStoreLocation(id){
        store_loc_id.dataBind( base_url + "select_options/code/store_locs?p=loc_id=" + id);
}



