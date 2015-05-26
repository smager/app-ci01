<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Snippet:List</title>
<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>   
<script src="<?php echo base_url('assets/js/handlebars-v3.0.0.js');?>"></script>   
<script src="<?php echo base_url('assets/js/zsi.bswriter.js');?>"></script>   
    

    
<link href="<?php echo base_url('assets/css/bss.bootstrap.min.css');?>" rel="stylesheet">
    
    
</head>
<body>

<div id="container">
	 <div class="bswform"></div>
</div>
    


<script>
var w = new zsi.bsWriter({
         hasNoConfigFile:false
	     ,url:"../assets/templates/config.txt"
		//,url:"template?"
		//,url:"template?p_typename=bootstrap"
		,targetClass:"bswform"
		,SizeType:"xs"
});

w.write(function(){	
	this.div({class:"form-horizontal"})
		.div({class:"form-group"})
			.bsLabelInput({labelsize:1,caption:"Last Name",inputsize:2,name:"p_lastName"})
			.bsLabelInput({labelsize:1,caption:"First Name",inputsize:2,name:"p_FirstName"})
		.div({class:"form-group",parentClass:"form-horizontal"})
			.bsLabelInput({labelsize:1,caption:"Department",inputsize:2,name:"p_department"})
			.bsLabelInput({labelsize:1,caption:"Section",inputsize:2,name:"p_Section"})		
		.div({class:"form-group",parentClass:"form-horizontal"})
			.bsLabelInput({labelsize:1,caption:"Region",inputsize:2,name:"p_region"})
			.bsLabelInput({labelsize:1,caption:"Branch",inputsize:2,name:"p_branch"})	
		.div({class:"col-xs-12 buttonGroup",parentClass:"form-horizontal"})
            .bsButton({id:"btnSave", type:"button", class:"btn-primary btn-sm",caption:"Save",classicon:"glyphicon-floppy-disk" })	
            .bsButton({id:"btnClose", type:"button", class:"btn-primary btn-sm",caption:"Close",classicon:"glyphicon-off" })	
    

	.end();	

});
		 
 

</script>    
    

<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>     
</body>
</html>