<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Lyncor</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
  var base_url ="<?php echo "http://" . $_SERVER['SERVER_NAME'] . "/"; ?>";
</script>   
<script src="assets/js/jquery-1.11.3.min.js"></script>   
<script src="javascripts/source?p_url=zsi_lib&p_revision=133"></script>
<link href="assets/css/bootstrap.css" rel="stylesheet">
<link href="assets/css/bootstrap-theme.min.css" rel="stylesheet">
<link href="assets/css/zsi_style.css" rel="stylesheet">
</head>
<body>
<div class="progressWindow">
    <div class="loadingImg"></div> 
    <div class="loadingText">Loading...Please wait</div>
</div>
<div class="errorWindow">
    Some processe(s) encountered a problem. 
    <br> Please Contact System Administrator.
</div>

<div class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <a href="../" class="navbar-brand">LynCor</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
        </div>
      </div>
</div>

<script src="javascripts/source?p_url=zsi_init&p_revision=1"></script>

<div class="container page">
    <div class="login-panel col-md-12">
        <h1><?php echo $heading; ?></h1>
        <h2><?php echo $message; ?></h2>
        
    </div>
</div>
<script src="assets/js/bootstrap.min.js"></script>    
</body>
</html>