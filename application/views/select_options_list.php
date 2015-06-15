<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Select Options</title>
<?php
    includeHeader();    
?> 
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<form id="frm" action="<?php echo base_url('select_options/update');?>" method="post" >
<table id="grid" class="table">    
    <thead>
    <tr>
        <th></th>
        <th>Code</th>
        <th>Table</th>
        <th>Text</th>
        <th>Value</th>
        <th>Condition</th>
        <th>Created By</th>
        <th>Created Date</th>
        <th>Updated By</th>
        <th>Updated Date</th>
    </tr>
        </thead>
</table>    

<div class="buttonGroup">
<?php 
    Button(array('name'=>'Save','type'=>'submit'));    
    Button(array('name'=>'Delete','onclick'=>"return checkDelete('" . base_url("select_options/delete")  . "');"));        
?>    
</div>

</form>    
    
</div>
<?php includePageJS(); ?>    
<?php includeFooter(); ?> 
</body>
</html>