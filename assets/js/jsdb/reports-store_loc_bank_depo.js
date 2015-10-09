var tbl="#tableResult"; 
var proc_url = base_url + "common/executeproc/";
setInputs();
$(document).ready(function(){
    p_store_loc_id.dataBind(base_url + "select_options/code/store_locs");
    p_month.dataBind(base_url + "select_options/code/months_full");
    p_year.val( new Date().getFullYear() );

});   


function setInputs(){
    p_store_loc_id = $("#p_store_loc_id");
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

    $.post( proc_url + "repStoreDailyBankDepo?p=" + p_month.val() + ","+ p_year.val() +"," + p_store_loc_id.val() + "," +"''",function(d){
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
        var totalXY=0;
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
                aColTotal[x] +=  parseFloat(val2);
                totalX += (x>0? parseFloat(val2):0);
                totalXY +=parseFloat(val2);
            }
            h+="<td  class='align-r'>" + totalX.toMoney() + "</td>";
            h+="</tr>";

            $(".zTable").append(h);
        }
        var hTotal="<tr class='total'>";
         for(var t=0;t< aColTotal.length;t++){
             var result = (t===0?"Total" : aColTotal[t].toMoney() );
             hTotal += "<td class='align-r'>" + result + "</td>";
         }
        hTotal += "<td class='align-r'>" + totalXY.toMoney() + "</td>";
        hTotal+="</tr>";
        $(".zTable").append(hTotal);
        
    }).fail(function(data) {
        result =  data.responseText.replace(/^\s+/,"");
        $(tbl).html(result);
    })   
} 

