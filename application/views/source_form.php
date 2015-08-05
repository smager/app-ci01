<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<form id="frmWindow" >
<div class="container-fluid">
<div class="form-horizontal">
    
<?php 
    hiddenBox( array( 'name'=>'code_path'));  
    hiddenBox( array( 'name'=>'file_name'));  
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


