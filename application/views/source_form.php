<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<form id="frmWindow" >
<div class="container-fluid">
<div class="form-horizontal">
    
<?php 
    hiddenBox( array( 'name'=>'codepath', 'value'=>$_GET["p_codepath"]));  
    hiddenBox( array( 'name'=>'filename', 'value'=>$_GET["p_filename"]));  
    hiddenBox( array( 'name'=>'content'));  

    echo "<label>File Name: " . $_GET["p_filename"] . "</label><br />";
?>       
   <pre id="editor"></pre>
<?php
    closeFormGroup();
?>     
    
</div>
</div>

<div class="col-xs-12 buttonGroup">
<button id="btnSubmit" class="btn btn-primary btn-sm" type="button">
<span class="glyphicon glyphicon-floppy-disk"></span> Save
</button>

   <button type="button" id="btnCloseWindow" class="btn btn-primary"><span class=" glyphicon glyphicon-off"></span> Close</button>

</div>
</form>
<div class="alert alert-success">
   <p>Data has been saved.</p>
</div>


