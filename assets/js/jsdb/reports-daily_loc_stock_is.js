var tbl="#tableResult"; 
var proc_url = base_url + "common/executeproc/";

setInputs();
$(document).ready(function(){
    p_loc_id.dataBind(base_url + "select_options/code/locations");
    p_store_id.dataBind(base_url + "select_options/code/stores");
    p_is_date.val( new Date().toShortDate() );

});   


function setInputs(){
    p_loc_id = $("#p_loc_id");
    p_store_id = $("#p_store_id");
    p_is_date = $("#p_is_date");
}


$("#btnGo").click(function(){
    DisplayReport();
});   




function DisplayReport(){
    $(tbl).html(""); 

    $.post(proc_url +  "repLocDailyIssuance?p=" + p_loc_id.val() +"," + p_store_id.val() + ",'"+ p_is_date.val() + "'" ,function(d){
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
        h+="<th class='align-c'>Total</th>";
        h+="</tr></thead></table>"        
        $(tbl).html(h);
        
        var aColTotal=[];
        var trCls="odd";

        for(var y=0;y< d.length;y++){
            var totalX=0;
            h="<tr class='" + trCls + "'>";
            if(trCls=="odd") trCls="even"; else trCls ="odd";     
            for(var x=0;x< colsLength;x++){
                var info = d[y];
                var val = info[keys[x]];
                var new_val = $('<div/>').text(  (isNaN(val)===false?val.toMoney() : val) ).html();
                 
                h+="<td " + (isNaN(val)===false?"class='align-r'": "") + ">"+ new_val + "</td>";

                var val2 =  (isNaN(val)===false ? val:0);

                if( typeof aColTotal[x] ==="undefined") aColTotal[x]=0;
                if(x===1){
                    aColTotal[x] =  parseFloat(val2);
                    totalX = (x>0? parseFloat(val2):0);
                }else{
                    aColTotal[x] -=  parseFloat(val2);
                    totalX -= (x>0? parseFloat(val2):0);
                }
            }
            h+="<td  class='align-r'>" + totalX.toMoney() + "</td>";
            h+="</tr>";
            $(".zTable").append(h);
        }
        
        
    }).fail(function(data) {
        result =  data.responseText.replace(/^\s+/,"");
        $(tbl).html(result);
    })   
} 