var tbl="#tableResult"; 
var proc_url = base_url + "common/executeproc/";

setInputs();
$(document).ready(function(){
    p_loc_id.dataBind(base_url + "select_options/code/user_locations?p=user_id=" + userInfo.user_id);
    p_supplier_id.dataBind(base_url + "select_options/code/suppliers");
    p_month.dataBind(base_url + "select_options/code/months_full");
    p_year.val( new Date().getFullYear() );

});   


function setInputs(){
    p_loc_id = $("#p_loc_id");
    p_supplier_id = $("#p_supplier_id");
    p_month = $("#p_month");
    p_year = $("#p_year");
}


$("#btnGo").click(function(){
    DisplayReport();
});   

$("#btnPrint").click(function(){
    window.print();
});  


function DisplayReport(){
    $(tbl).html(""); 
    var status_code = ( p_status_code.val()===""?"null": p_status_code.val()) ;
    $.post(proc_url +  "repreceivingsummary?p=0" + p_loc_id.val() + ",0" + p_supplier_id.val() +  ",0" + p_month.val() + ",0"+ p_year.val(),function(d){
        if (d.length===0) {
            $(tbl).html("No Result."); 
            return;
        }
        var hInfo =  d[0];
        var keys = Object.keys(hInfo);
        var colsLength =keys.length;
        
        var h="<table class='zTable fullWidth'><thead><tr>";
        for(var i=0;i< colsLength;i++){                
            h+="<th class='align-c'>" + keys[i] + "</th>";
        }
        h+="</tr></thead></table>"        
        $(tbl).html(h);
        
        var trCls="odd";
        for(var y=0;y< d.length;y++){
            h="<tr class='" + trCls + "'>";
            if(trCls=="odd") trCls="even"; else trCls ="odd";     
            for(var x=0;x< colsLength;x++){
                var info = d[y];
                var val = info[keys[x]];
                //var new_val = $('<div/>').text(  (isNaN(val)===false?val.toMoney() : val) ).html();
                var new_val = $('<div/>').text(val).html();
                 
                h+="<td " + (isNaN(val)===false?"class='align-r'": "") + ">"+ new_val + "</td>";

            }
            h+="</tr>";

            $(".zTable").append(h);
        }

    }).fail(function(data) {
        result =  data.responseText.replace(/^\s+/,"");
        $(tbl).html(result);
    })   
} 