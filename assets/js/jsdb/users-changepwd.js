$(document).ready(function(){
    init();
    
});

function init(){
    frm         = $("#frm");
    currentPwd  = $("#p_current_pwd");
    newPwd      = $("#p_new_pwd");
    confirmPwd  =  $("#p_confirm_pwd");
}

function clear(){
    currentPwd.val("");   
    newPwd.val("");       
    confirmPwd.val("");   
}


$("#frm").submit(function(){
    if(currentPwd.val ==="" || newPwd.val() ==="" || confirmPwd.val() ==="") return false;

    if( newPwd.val() !==confirmPwd.val() ){
        alert("New password and Confirm password mismatch.");
        return false;
    }
    
    if(newPwd.val().length < 6 || confirmPwd.val().length < 6 ) {
        alert("Password must at least 6 or more characters length.");
        return false;        
    }   

    $.post(controller_url + "updatepwd",$(this).serializeArray()
        ,function(d){
            if(d.status===1){
                clear();
                alert("Password has been changed.");
            }else
                alert("Your current password is invalid. Try again.");
        } 
    );
    
    return false;
});


