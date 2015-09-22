var tbl="#tableResult"; 

setInputs();
$(document).ready(function(){
    p_loc_id.dataBind(base_url + "select_options/code/locations");
    p_store_id.dataBind(base_url + "select_options/code/stores");
    p_month.dataBind(base_url + "select_options/code/months_full");
    p_year.val( new Date().getFullYear() );

});   


function setInputs(){
    p_loc_id = $("#p_loc_id");
    p_store_id = $("#p_store_id");
    p_month = $("#p_month");
    p_year = $("#p_year");
}


$("#btnGo").click(function(){
    /*if(store_loc_id.val()==="") {
        alert("Please select Store.");
        store_loc_id.focus(); 
        return;
    }

    DisplayReport();
    */
});   




function DisplayReport(){
    $(tbl).html(""); 

    $.post(controller_url + "sales_loc_inq_data" ,data,function(d){
        if (d.length===0) {
            $(tbl).html("No Result."); 
            return;
        }
        var hInfo =  d[0];
        var keys = Object.keys(hInfo);
        var colsLength =keys.length;
        
        var h="<table class='zTable fullWidth'><thead><tr>";
        for(var i=0;i< colsLength;i++){                
            h+="<th>" + keys[i] + "</th>";
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
                var new_val = $('<div/>').text(val).html();
                 h+="<td>"+ new_val +"</td>";
            }
            h+="</tr>";
            $(".zTable").append(h);
        }
        
    }).fail(function(data) {
        result =  data.responseText.replace(/^\s+/,"");
        $(tbl).html(result);
    })   
} 