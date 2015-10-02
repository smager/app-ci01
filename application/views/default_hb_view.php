<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $pTitle=getPageTitle(); ?></title>
<?php
    includeHeader();    
?> 
    
</head>
<body>
<?php menu(); ?> 
    
<div class="container page">
<div class="pageTitle"><?php echo $pTitle; ?></div>
<?php includePageTemplate(); ?>             
</div>
<?php includeHandleBars(); ?>  
<?php includePageJS(); ?>      
<?php includeFooter(); ?>     
</body>
</html>