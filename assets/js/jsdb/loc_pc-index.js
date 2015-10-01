var supply;
var action_url = base_url + "loc_pc";
$(document).ready(function(){
    $("#p_loc_id").dataBind( base_url + "select_options/code/locations");
    $("#p_store_id").dataBind( base_url + "select_options/code/stores");
    initInputs();
    onLocationChange();
    markMandatory();
});
$("form[id=frm]").submit(function(){
     this.action = action_url + "/update"; 
     if( zsi.form.checkMandatory()!==true) return false;
     
     $.post(base_url + "loc_pc/update",$(this).serializeArray()
        ,function(d){
            if(posted.val()===0){
                 displayRecords( d.loc_id + "/"+  d.store_id + "/"+ d.loc_pc_id );
                 loc_pc_id.val(d.loc_pc_id);
            }else{
                 ClearHeader();
                 $("#grid").clearGrid();
            }
            getUnpostedPC(d.loc_id);
            
        } 
        
     );
     
     
     return false;
 }); 
 
 $("#btnNew").click(function(){
    ClearHeader();
    $("#grid").clearGrid();
 });
 

 function ClearHeader(){
    loc_pc_id.val('').change();
    pc_no.val('').change();
    pc_date.val('').change();
    loc_id.val('').change();
    posted.val(0);
 }
 

 

function markMandatory(){
    zsi.form.markMandatory({       
      "groupNames":[
            {
                 "names" : ["p_pc_no","p_pc_date","p_loc_id","p_store_id"]
                ,"type":"S"
            }             
            ,{
                 "names" : ["p_pc_qty[]"]
                ,"type":"M"
                ,"required_one":"Y"            
            }
      ]      
      ,"groupTitles":[ 
             {"titles" :["P.C No","Date","Location","Store Franchise"]}
            ,{"titles" :["Quantity"]}
      ]
   });
   
}
function getUnpostedPC(){
     $(".list-group").html('');
    $.getJSON(base_url + "loc_pc/getunpostedpc/" + loc_id.val(),function(data){
        $.each(data,function(){
            var params = {
                 loc_pc_id: this.loc_pc_id
                ,pc_no:     this.pc_no
                ,pc_date:   this.pc_date
                ,loc_id:    this.loc_id
                ,store_id: this.store_id
            };
            var removeicon = "<a class='glyphicon glyphicon-remove-sign itemRemove' onclick='removeloc_pc(" + this.loc_pc_id  + ");' href='javascript:void(0);'></a>";
            $(".list-group").append("<a href='javascript:void(0);' onclick='displayDetails("   + JSON.stringify(params) +  ");' class='list-group-item' >" + this.pc_no + "</a>" + removeicon);
        });
        
    });

}

function removeloc_pc(id){
      if(confirm("Are you sure you want to delete selected items?")) {
        ClearHeader();  
        $.post( base_url + "loc_pc/delete/" + id , function(d){
                getUnpostedPC(loc_id.val());
            }).fail(function(d) {
                alert("Sorry, the curent transaction is not successfull.");
            });
        }
}

function initInputs(){
    loc_pc_id = $("#p_loc_pc_id");
    pc_no = $("#p_pc_no");
    pc_date = $("#p_pc_date");
    loc_id = $("#p_loc_id");
    store_id = $("#p_store_id");
    posted = $("#p_posted");
}

function displayDetails(p){
    loc_pc_id.val(p.loc_pc_id).change();
    pc_no.val(p.pc_no).change();
    pc_date.val(p.pc_date.toDateFormat()).change();
    loc_id.val(p.loc_id);//.change();
    store_id.val(p.store_id);
    displayRecords( p.loc_id + "/"+  p.store_id + "/"+  p.loc_pc_id );
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
            }            
            ,function(d){ return d.supply_code;  }
            ,function(d){ return d.brand_name + ' ' + d.cu_desc; }
            ,function(d){ return bs({name:"pc_qty[]",value:d.stock_qty,class:"form-control numeric"}); }
        ]
        ,onComplete : function(){ 
            zsi.initInputTypesAndFormats();
            markMandatory();    
        }
    });    
}

function onLocationChange(){
    loc_id.change(function(){
        if(this.value===''){  
            $("#grid").clearGrid(); 
            return false;
        }
        getUnpostedPC(this.value);
    });   
} 

$("#btnGo").click(function(){ 
     if(loc_id.val()!==''){
         var params="";
         params = loc_id.val();
         if(store_id.val()!==''){
             params += "/" + store_id.val();
         }
        displayRecords(params);
     }
});



