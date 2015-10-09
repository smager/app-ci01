var supplyBrands;

$(document).ready(function(){
    $("#p_loc_id").dataBind( base_url + "select_options/code/user_locations?p=user_id=" + userInfo.user_id);
    initInputs();
    onLocationChange();
    displayBlankRows(true);
    getUnpostedST();
    setSupplyBrands();
    markMandatory();
});

$("form[id=frm]").submit(function(){
     if( zsi.form.checkMandatory()!==true) return false;
     
     $.post(controller_url + "update",$(this).serializeArray()
        ,function(d){
            
           if(posted.val()===0) 
                displayRecords(d.st_id);
            else
                newBlankEntry();
           
            st_id.val(d.st_id);
            getUnpostedST();
        } 
     );
     
     
     return false;
 }); 
 
 $("#btnNew").click(function(){
    if(loc_id.val()==='') { alert("Enter Location"); return false; }
    newBlankEntry();
 });
 
 function newBlankEntry(){
    displayBlankRows(true);
    ClearHeader();
    markMandatory();
 }
 
 function ClearHeader(){
    st_id.val('').change();
    st_no.val('').change();
    st_date.val('').change();
    loc_id.val('').change();
    loc_id_to.val('');
    posted.val(0);
 }
 

function setSupplyBrands(){
  $.getJSON(base_url + "loc_supplies/supply_brands", function(d){
        supplyBrands = d;
    });
}

function markMandatory(){
    zsi.form.markMandatory({       
      "groupNames":[
            {
                 "names" : ["p_st_no","p_st_date","p_loc_id","p_loc_id_to"]
                ,"type":"S"
            }             
            ,{
                 "names" : ["p_loc_supply_brand_id[]","p_st_qty[]"]
                ,"type":"M"
                ,"required_one":"Y"            
            }
      ]      
      ,"groupTitles":[ 
             {"titles" :["P.O No","Date","Location(From)","Location(To)"]}
            ,{"titles" :["Supply/Brand","Quantity"]}
      ]
   });
   
}
function getUnpostedST(){
     $(".list-group").html('');
    $.getJSON(base_url + "stock_transfer/getUnpostedST/",function(data){
        $.each(data,function(){
            var params = {
                 st_id: this.st_id
                ,st_no: this.st_no
                ,st_date: this.st_date
                ,loc_id: this.loc_id
                ,loc_id_to:this.loc_id_to
            };
            var removeicon = "<a class='glyphicon glyphicon-remove-sign itemRemove' onclick='removeST(" + this.st_id  + ");' href='javascript:void(0);'></a>";
            $(".list-group").append("<a href='javascript:void(0);' onclick='displayDetails("   + JSON.stringify(params) +  ");' class='list-group-item' >" + this.st_no + "</a>" + removeicon);
        });
        
    });

}

function removeST(id){
      if(confirm("Are you sure you want to delete selected items?")) {
        ClearHeader();  
        $.post( base_url + "stock_transfer/delete/" + id , function(d){
                getUnpostedST();
                displayBlankRows(true);
            }).fail(function(d) {
                alert("Sorry, the curent transaction is not successfull.");
            });
        }
}

function initInputs(){
    st_id = $("#p_st_id");
    st_no = $("#p_st_no");
    st_date = $("#p_st_date");
    loc_id = $("#p_loc_id");
    loc_id_to = $("#p_loc_id_to");
    posted = $("#p_posted");    
}

function displayDetails(p){
    st_id.val(p.st_id).change();
    st_no.val(p.st_no).change();
    st_date.val(p.st_date).change();
    loc_id.val(p.loc_id);//.change();
    loc_id_to.val(p.loc_id_to);
    displayRecords(p.st_id);
}

function displayRecords(id){       
    var bs = zsi.bs.ctrl;    
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : base_url + "stock_transfer/getdata_dtls_json/" + id
        ,td_body: [ 
            function(d){
                return     bs({name:"st_dtl_id[]",type:"hidden",value: d.st_dtl_id})
                        +  bs({name:"stock_qty[]",type:"hidden",value:0})
                        +  bs({name:"cb[]",type:"checkbox"});

            }            
            ,function(d){ return bs({name:"loc_supply_brand_id[]",type:"select",value:d.loc_supply_brand_id}); }
            ,function(d){ return bs({name:"st_qty[]",value:d.st_qty,class:"form-control numeric"}); }
        ]
        ,onComplete : function(){
            displayBlankRows(false);
            loc_id.change();
            setStockQtyEvent();
        }
    });    
}

function onSupplyBrandChange(){
    
    $("select[name='p_loc_supply_brand_id[]']").change(function(){
        var stock_qty = $(this.parentNode.parentNode).find("input[name='p_stock_qty[]']");
        var st_qty = $(this.parentNode.parentNode).find("input[name='p_st_qty[]']");
        if(this.value ==="") st_qty.val('');
        var selVal = this.value;
        $.each(supplyBrands,function(){
            if (this.loc_supply_brand_id == selVal){
                stock_qty.val(this.stock_qty);
                return;
            }
        });

    });
    
}
function onLocationChange(){
    loc_id.change(function(){
        if(this.value==='') return false;
        
        
        $("#p_loc_id_to").dataBind( base_url + "select_options/code/user_locations?p=user_id=" + userInfo.user_id + ",loc_id<>" + this.value);

        $("select[name='p_loc_supply_brand_id[]']").dataBind({ 
             url: base_url + "select_options/code/loc_supply_brands_bycode?p=loc_id=" + this.value + ",stock_qty>0"
            ,isUniqueOptions:true
            ,onAllComplete: function(){
                   onSupplyBrandChange();
                    markMandatory();
                   $("select[name='p_loc_supply_brand_id[]']").change();
                   $("input[name='p_st_qty[]']").change();
            }
        });
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
                return     bs({name:"st_dtl_id[]",type:"hidden"})
                        +  bs({name:"stock_qty[]",type:"hidden",value:0})
                        +  bs({name:"select[]",type:"checkbox"});

            }            
            ,function(d){ return bs({name:"loc_supply_brand_id[]",type:"select", class:"form-control new"}); }
            ,function(d){ return bs({name:"st_qty[]",class:"form-control numeric"}); }
        ]
        ,onComplete : function(){
            onSupplyBrandChange();
            setStockQtyEvent();
            zsi.initInputTypesAndFormats();
        }
    });    
}

function setStockQtyEvent(){
    var st_qty = $("input[name='p_st_qty[]']");
    st_qty.keyup(function(){
        var  stock_qty= $(this.parentNode).prev().prev().children("input[name='p_stock_qty[]']");    
        if(parseInt(this.value) > parseInt(stock_qty.val())) {
            this.value =  parseInt(stock_qty.val());
        }
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
      $.post( controller_url + "delete_dtls" , l_stmt, function(d){
            displayRecords(st_id.val());
         }).fail(function(d) {
            alert("Sorry, the curent transaction is not successfull.");
        });
      }
   }
return false;
}   



