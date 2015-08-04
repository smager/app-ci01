<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Source</title> 
<?php
    includeHeader(array('window'=>true) );    
?>
<style>
    
.modal-dialog {
    width: 95%;
}
    
.alert{
   position:absolute;
   top:0px;
   display:none; 
   z-index:10000;
 } 
 
  
.ace_editor {
    min-height: 400px !important;
}   
    
.ace_search.right {
    position: fixed !important;
}
.ace_search_field {
    color:#000 !important;
    background-color:#fff !important;
}    
    
.dhtmlx_wins_body_inner > div[ida='dhxMainCont']{
    overflow:auto !important;
}
    
.filesPane .filegroup{
    border:1pt solid #E5E5E5;
    float: left;
    margin-right: 10px;
    min-width: 220px;
}
.filesPane div ul{
    padding-left:10px;
}
    
.filesPane .title{
    text-align:center;
}    

</style>
</head>
<body>
<?php menu(); ?>     
<div class="container page">
<?php 
    echo "\r\n<div class='filesPane'>";
        echo "\r\n<div class='filegroup controller'>";
        echo "\r\n<div class='title'>Controllers</div>";
        echo "\r\n<ul class='files'>";
        foreach ($controllers as &$c) {
            echo "\r\n<li><a href='#'>$c</a></li>";
        }
        echo "\r\n</ul>";
        echo "\r\n</div>";

        echo "\r\n<div class='filegroup model'>";
        echo "\r\n<div class='title'>Models</div>";
        echo "\r\n<ul class='files'>";
        foreach ($models as &$m) {
            echo "\r\n<li><a href='#'>$m</a></li>";
        }
        echo "\r\n</ul>";
        echo "\r\n</div>";
 

        echo "\r\n<div class='filegroup view'>";
        echo "\r\n<div class='title'>Views</div>";
        echo "\r\n<ul class='files'>";
        foreach ($views as &$v) {
            if(is_string($v)){
                echo "\r\n<li><a href='#'>$v</a></li>";
            }
        }
        echo "\r\n</ul>";
        echo "\r\n</div>";

        echo "\r\n<div class='filegroup view'>";
        echo "\r\n<div class='title'>CSS</div>";
        echo "\r\n<ul class='files'>";
        foreach ($css as &$c) {
                echo "\r\n<li><a href='#'>$c</a></li>";
        }
        echo "\r\n</ul>";
        echo "\r\n</div>";

    echo "\r\n</div>";
 
?>       
</div>    
<?php includePageJS(); ?>        
<?php includeFooter(); ?>     
</body>
</html>