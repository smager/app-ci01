<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Database Structure</title>
<?php
    includeHeader();    
?>    
<style>
    .dbStruct{
        float:left;
        width:250px;
        border:1pt solid #979797;
        margin-right:5px;
        margin-bottom:5px;
        padding:5px;  
        min-height:336px;
    }
    .dbStruct > ul { padding-left: 5px;}
</style>    
</head>
<body>
<?php menu(); ?>     
<div class="container page">
<div class="pageTitle">Database Structure </div>
<?php

    echo "<a href='". base_url() . $this->router->fetch_class() . "'>Tables & Views</a>"; 
    echo " | <a href='". base_url() . $this->router->fetch_class() . "/tables'>Tables Only</a>"; 
    echo " | <a href='". base_url() . $this->router->fetch_class() . "/views'>Views Only</a>"; 
    echo " | <a href='". base_url() . $this->router->fetch_class() . "/procs_funcs'>Procedures & Functions</a>"; 
    echo " | <a href='". base_url() . $this->router->fetch_class() . "/procedures'>Procedures Only</a>"; 
    echo " | <a href='". base_url() . $this->router->fetch_class() . "/functions'>Functions Only</a>"; 
    echo " | <a href='". base_url() . $this->router->fetch_class() . "/db'>Manage Objects</a>"; 
    
        echo "<h4>List of Objects:</h4>";

        $ctr=0;
        foreach($tables as $key=>$value){
            $v=array_values($tables[$key])[0];
            $type=array_values($tables[$key])[1];
            if(strrpos(strtolower($type),'table')>-1)
                $type='table';
            else
                $type=strtolower($type);                
            
            if($ctr==0) echo "\r\n<div class='dbStruct'><ul>";
            
            $ddl =  "<a href='" . base_url() . $this->router->fetch_class() . "/getddl/$v/$type' target='_blank'>DDL</a>";
            $edit =  "<a href='" . base_url() . $this->router->fetch_class() . "/edit/$v/$type' target='_blank'>Edit</a>";
            echo "<li>$v :$ddl, $edit</li>";
            $ctr+=1;
            
            if($ctr==20) { 
                echo "\r\n</ul></div>";
                $ctr=0;
            }
        }
        if($ctr!=0) echo "</div>";
?>    
    
</div>          
<?php includeFooter(); ?>     
</body>
</html>