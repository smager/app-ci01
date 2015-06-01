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
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">

	<h1>Welcome to Sales Inventory Monitoring System</h1>

    <div class="bswform">  </div>
    
</div>
<script>
var w = new zsi.bsWriter({
         hasNoConfigFile:false
	     ,url:"../assets/templates/config.txt"
		,targetClass:"bswform"
		,SizeType:"xs"
});

w.write(function(){	
	this.div({class:"form-horizontal"})
		.div({class:"form-group"})
			.bsLabelInput({labelsize:2,caption:"Login Name",inputsize:3,name:"p_name"})
		.div({class:"form-group",parentClass:"form-horizontal"})
			.bsLabelInput({labelsize:2,caption:"Password",inputsize:3,name:"p_pwd",type:"password"})
		.div({class:"col-xs-12 buttonGroup",parentClass:"form-horizontal"})
            .bsButton({id:"btnSave", type:"submit", class:"btn-primary btn-sm",caption:"Save",classicon:"glyphicon-floppy-disk" })	
            .bsButton({id:"btnClose", type:"button", class:"btn-primary btn-sm",caption:"Close",classicon:"glyphicon-off" })	
    
	.end();	

});
		 
 

function test(){
    
console.log( zsi.bsWriter); 
 
}    
    
</script>        
 
 <input type="button" onclick="test();" value="test" >   

 <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>     
</body>
</html>