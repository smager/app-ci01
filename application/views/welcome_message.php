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
        <div class="login-form">  </div>
    </div>
</div>
<?php includeBSWriter(); ?>    
<script>
var w = new zsi.bsWriter({
         hasNoConfigFile:false
	     ,url:"<?php echo base_url("config"); ?>"
		,targetClass:"login-form"
		,SizeType:"xs"
});

w.write(function(){	
	this.div({class:"form-horizontal"})
		.div({class:"form-group"})
			.bsLabelInput({labelsize:4,caption:"Login Name",inputsize:7,name:"user_name"})
		.div({class:"form-group",parentClass:"form-horizontal"})
			.bsLabelInput({labelsize:4,caption:"Password",inputsize:7,name:"password",type:"password"})
		.div({class:"buttonGroup col-xs-offset-4",parentClass:"form-horizontal"})
            .bsButton({id:"btnLogin", type:"submit", class:"btn-primary btn-sm",caption:"Login",classicon:"glyphicon glyphicon-log-in" })	
    
	.end();	

});
 
</script>        
 
<?php includeFooter(); ?> 
</body>
</html>