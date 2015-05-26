<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Snippet: Form</title>
<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>   
<script src="<?php echo base_url('assets/js/handlebars-v3.0.0.js');?>"></script>   
<script src="<?php echo base_url('assets/js/zsi.bswriter.js');?>"></script>   
<link href="<?php echo base_url('assets/css/bss.bootstrap.min.css');?>" rel="stylesheet">        
</head>
<body>

<div id="container">
    <form action="update" method="post"  class="bswform"></form>
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
			.bsLabelInput({labelsize:2,caption:"Snippet Name",inputsize:3,name:"p_snippet_name"})
		.div({class:"form-group",parentClass:"form-horizontal"})
			.bsLabelInput({labelsize:2,caption:"Snippet Content",inputsize:3,name:"p_snippet_content"})
		.div({class:"col-xs-12 buttonGroup",parentClass:"form-horizontal"})
            .bsButton({id:"btnSave", type:"submit", class:"btn-primary btn-sm",caption:"Save",classicon:"glyphicon-floppy-disk" })	
            .bsButton({id:"btnClose", type:"button", class:"btn-primary btn-sm",caption:"Close",classicon:"glyphicon-off" })	
    
	.end();	

});
		 
 

</script>    
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>     
</body>
</html>