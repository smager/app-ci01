<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Lyncor</title>
<?php
    includeHeader();    
?> 
<style>
.login-panel h1,.login-panel h2{
      text-align: center;color: #3273AB    
}    
.login-panel h2{
    font-size:14px;
}    
.login-form{
    background-color: #f5f6f6;
    border: 1pt solid #3071a8;
    margin: 30px auto 0;
    min-height: 127px;
    padding-top: 19px;
    width: 300px;
}    
</style>    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
    <div class="login-panel col-md-12">
        <h1>LynCor  </h1>
        <h2>Sales Inventory Monitoring System</h2>
        <form class="login-form">  
            <div class="form-horizontal">
                <?php 
                    openFormGroup(); 
                       inputTextBox( array( 'labelName'=>'Login Name' , 'name'=>'login', 'labelSize'=>4, 'inputSize'=>7)); 
                    closeFormGroup(); 
                    openFormGroup(); 
                       inputTextBox( array( 'labelName'=>'Password' , 'name'=>'pwd', 'labelSize'=>4, 'inputSize'=>7, 'type'=>'password')); 
                    closeFormGroup(); 
                ?>
                <div class="buttonGroup col-xs-offset-4">
                <?php 
                    Button(array('name'=>'Login','type'=>'button'));    
                ?>    
                </div>            
            </div>
        
        </form>
    </div>
</div>
<script>

$("#btnLogin").click(function(){
    var param = $(".login-form").serializeArray();
  
    $.post("users/login" , param, function(d){
       console.log(d);
    }).fail(function(d) {
       alert("Sorry, login is not successfull.");
    });
      
                     
    
});    
    
</script>        
 
<?php includeFooter(); ?> 
</body>
</html>