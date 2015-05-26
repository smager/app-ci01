<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Snippet: Form</title>
	
</head>
<body>

<div id="container">
    
    
<form action="update" method="post">
    <div class="form-group">
      <label class=" col-xs-1 control-label">Snippet Name</label>
      <div class=" col-xs-4">
        <input type="text" name="p_snippet_name" id="p_snippet_name" class="form-control input-sm ">
      </div>
    </div>


    <div class="form-group">
      <label class=" col-xs-1 control-label">Snippet Content</label>
      <div class=" col-xs-4">
        <input type="text" name="p_snippet_content" id="p_snippet_content" class="form-control input-sm ">
      </div>
    </div>

    <button type="submit" class="btn btn-primary btn-sm" id="btnSubmit">
    <span class="glyphicon glyphicon-floppy-disk"></span> Save
    </button>    

</form>
    
</div>

</body>
</html>