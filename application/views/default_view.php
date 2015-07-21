<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php getPageTitle(); ?></title>
<?php
    includeHeader(array("datePicker"=>true));    
?>    
</head>
<body>
<?php menu(); ?>     
<div class="container page">
<?php includePageTemplate(); ?>         
</div>    
<?php includePageJS(); ?>        
<?php includeFooter(); ?>     
</body>
</html>