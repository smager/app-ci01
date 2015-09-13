var supply;
$(document).ready(function(){
    initInputs();
    onLocationChange();
    getUnpostedPC();
    markMandatory();
    
    loc_id.dataBind( base_url + "select_options/code/locations");
});
$("form[id=frm]").submit(function(){
     this.action = controller_url + "/update"; 
     if( zsi.form.checkMandatory()!==true) return false;
     
     $.post(base_url + "loc_pc/update",$(this).serializeArray()
        ,function(d){
            if(posted.val()===0){
                 displayRecords( d.loc_id + "/"+  d.store_loc_id +  "/" + d.stock_adjmt_id );
                 stock_adjmt_id.val(d.stock_adjmt_id);
            }else{
                 ClearHeader();
                 $("#grid").clearGrid();
            }
            getUnpostedPC();
            
        } 
        
     );
     
     
     return false;
 }); 
 
 $("#btnNew").click(function(){
    ClearHeader();
    $("#grid").clearGrid();
 });
 

 function ClearHeader(){
    stock_adjmt_id.val('').change();
    stock_adjmt_no.val('').change();
    pc_date.val('').change();
    loc_id.val('').change();
    posted.val(0);
 }
 

 

function markMandatory(){
    zsi.form.markMandatory({       
      "groupNames":[
            {
                 "names" : ["p_stock_adjmt_no","p_pc_date","p_loc_id"]
                ,"type":"S"
            }             
            ,{
                 "names" : ["p_pc_qty[]"]
                ,"type":"M"
                ,"required_one":"Y"            
            }
      ]      
      ,"groupTitles":[ 
             {"titles" :["P.C No","Date","Location"]}
            ,{"titles" :["Quantity"]}
      ]
   });
   
}
function getUnpostedPC(){
     $(".list-group").html('');
    $.getJSON(base_url + "loc_pc/getunpostedpc/",function(data){
        $.each(data,function(){
            var params = {
                 stock_adjmt_id: this.stock_adjmt_id
                ,stock_adjmt_no:     this.stock_adjmt_no
                ,pc_date:   this.pc_date
                ,loc_id:    this.loc_id
                ,store_loc_id: this.store_loc_id
            };
            var removeicon = "<a class='glyphicon glyphicon-remove-sign itemRemove' onclick='removeloc_pc(" + this.stock_adjmt_id  + ");' href='javascript:void(0);'></a>";
            $(".list-group").append("<a href='javascript:void(0);' onclick='displayDetails("   + JSON.stringify(params) +  ");' class='list-group-item' >" + this.stock_adjmt_no + "</a>" + removeicon);
        });
        
    });

}

function removeloc_pc(id){
      if(confirm("Are you sure you want to delete selected items?")) {
        ClearHeader();  
        $.post( base_url + "loc_pc/delete/" + id , function(d){
                getUnpostedPC();
            }).fail(function(d) {
                alert("Sorry, the curent transaction is not successfull.");
            });
        }
}

function initInputs(){
    stock_adjmt_id = $("#p_stock_adjmt_id");
    stock_adjmt_no = $("#p_stock_adjmt_no");
    pc_date = $("#p_pc_date");
    loc_id = $("#p_loc_id");
    store_loc_id = $("#p_store_loc_id");
    loc_supply_brand_id = $("#p_loc_supply_brand_id");
    store_loc_supply_id = $("#p_store_loc_supply_id");
    posted = $("#p_posted");


    store_loc_id.change(function(){
        ShowHideSupplyItems( loc_id.val(), this.value);
    });
}

function displayDetails(p){
  //  stock_adjmt_id.val(p.stock_adjmt_id).change();
    stock_adjmt_no.val(p.stock_adjmt_no).change();
    pc_date.val(p.pc_date.toDateFormat()).change();
    loc_id.val(p.loc_id);//.change();
    store_loc_id.attr("selectedvalue",p.store_loc_id);
    displayStoreLocation(p.loc_id);
 
    displayRecords( p.loc_id + "/"+  p.store_loc_id +  "/" + p.stock_adjmt_id );
}

 

function displayRecords(params){       
    var bs = zsi.bs.ctrl;    
    zsi.json.loadGrid({
         table  : "#grid"
        ,url   : base_url + "loc_pc/get_loc_pc/" + params
        ,td_body: [ 
            function(d){
                return     bs({name:"loc_pc_dtl_id[]",type:"hidden",value: d.loc_pc_dtl_id})
                        +  bs({name:"loc_supply_brand_id[]",type:"hidden",value: d.loc_supply_brand_id})
                        +  bs({name:"store_loc_supply_id[]",type:"hidden",value: d.store_loc_supply_id})
            }            
            ,function(d){ return d.supply_code;  }
            ,function(d){ 
                var r = d.brand_name + ' ' + d.cu_desc; 
                if(d.store_loc_id!=null && d.store_loc_id!=0 ) r = d.unit_desc;
                return r;
            }
            ,function(d){ return bs({name:"pc_qty[]",value:d.pc_qty,class:"form-control numeric"}); }
        ]
        ,onComplete : function(){ 
            zsi.initInputTypesAndFormats();
            markMandatory();    
        }
    });    
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

function ShowHideSupplyItems(loc_id,store_loc_id){
    var l_loc_id = parseInt("0" + loc_id );
    var l_store_loc_id = parseInt("0" + store_loc_id );
    
    loc_supply_brand_id.val("");
    store_loc_supply_id.val("");
    
   if (l_loc_id !== 0 && l_store_loc_id===0){
      loc_supply_brand_id.dataBind( base_url + "select_options/code/loc_supply_brands_bycode?where=loc_id=" + l_loc_id);
       $("#supply1").css("display","block");
       $("#supply2").css("display","none");

   }else if  (l_loc_id !== 0 && l_store_loc_id!==0){
       store_loc_supply_id.dataBind( base_url + "select_options/code/store_loc_supplies?where=store_loc_id=" + l_store_loc_id );
       $("#supply2").css("display","block");
       $("#supply1").css("display","none");
   }else{
       $("#supply1").css("display","none");
       $("#supply2").css("display","none");
   }
}

$("#btnGo").click(function(){ 
     if(loc_id.val()!==''){
         var params="";
         params = loc_id.val();
         if(store_loc_id.val()!==''){
             params += "/" + store_loc_id.val();
         }
        displayRecords(params);
     }
});

function displayStoreLocation(id){
        store_loc_id.dataBind( base_url + "select_options/code/store_locs?where=loc_id=" + id);
}



