<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ( ! function_exists('includeHeader')){    
function includeHeader($p_dlayout='N',$p_dwin ='N', $p_dgrid ='N'){    
   $l_dhtmlx_path =  base_url('assets/dhtmlx36');

?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>   
<script src="<?php echo base_url('assets/js/handlebars-v3.0.0.js');?>"></script>   
<script src="<?php echo base_url('assets/js/zsi.bswriter.js');?>"></script>   
<script src="<?php echo base_url('assets/js/zsi.lib.js');?>"></script>   
<link href="<?php echo base_url('assets/css/bootstrap.css');?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap-theme.min.css');?>" rel="stylesheet">



<link href="<?php echo base_url('assets/css/zsi_style.css');?>" rel="stylesheet">
<?php

    
   if (strtoupper($p_dlayout) == 'Y') {
?>
<link rel="stylesheet" type="text/css" href="<?php echo $l_dhtmlx_path; ?>/dhtmlxLayout/codebase/dhtmlxlayout.css">
<link rel="stylesheet" type="text/css" href="<?php echo $l_dhtmlx_path; ?>/dhtmlxLayout/codebase/skins/dhtmlxlayout_dhx_skyblue.css">
<?php
}

if (strtoupper($p_dgrid) == 'Y') {

?>
<link rel="stylesheet" type="text/css" href="<?php echo $l_dhtmlx_path; ?>/dhtmlxGrid/codebase/dhtmlxgrid.css">
<link rel="stylesheet" type="text/css" href="<?php echo $l_dhtmlx_path; ?>/dhtmlxGrid/codebase/skins/dhtmlxgrid_dhx_skyblue.css">
<style>
    div.gridbox_light table.obj tr.rowselected td.cellselected, div.gridbox table.obj td.cellselected {
        background-color:#ACCADD;
    }
</style>
<?php
}

   if (strtoupper($p_dwin) == 'Y') {
?>
<link rel="stylesheet" type="text/css" href="<?php echo $l_dhtmlx_path; ?>/dhtmlxWindows/codebase/dhtmlxwindows.css">
<link rel="stylesheet" type="text/css" href="<?php echo $l_dhtmlx_path; ?>/dhtmlxWindows/codebase/skins/dhtmlxwindows_dhx_skyblue.css">
<?php } ?>

<?php
   if ( strtoupper($p_dgrid) == 'Y' AND strtoupper($p_dwin) == 'N' AND strtoupper($p_dlayout) == 'N') {
?>
<script type="text/javascript" src="<?php echo $l_dhtmlx_path; ?>/dhtmlxGrid/codebase/dhtmlxcommon.js"></script>
<?php
   }
   else if (strtoupper($p_dgrid) == 'N' AND strtoupper($p_dwin) == 'Y' AND strtoupper($p_dlayout) == 'N') {
?>
<script type="text/javascript" src="<?php echo $l_dhtmlx_path; ?>/dhtmlxLayout/codebase/dhtmlxcommon.js"></script>
<?php
   }
   else if (strtoupper($p_dgrid) == 'N' AND strtoupper($p_dwin) == 'N' AND strtoupper($p_dlayout) == 'Y') {
?>
<script type="text/javascript" src="<?php echo $l_dhtmlx_path; ?>/dhtmlxWindows/codebase/dhtmlxcommon.js"></script>
<?php
   }
?>

<?php
   if (strtoupper($p_dlayout) == 'Y') {
?>
<script type="text/javascript" src="<?php echo $l_dhtmlx_path; ?>/dhtmlxLayout/codebase/dhtmlxlayout.js"></script>
<script type="text/javascript" src="<?php echo $l_dhtmlx_path; ?>/dhtmlxLayout/codebase/dhtmlxcontainer.js"></script>
<?php
   }

   if (strtoupper($p_dgrid) == 'Y') {
?>
<script type="text/javascript" src="<?php echo $l_dhtmlx_path; ?>/dhtmlxGrid/codebase/dhtmlxgrid.js"></script>
<script type="text/javascript" src="<?php echo $l_dhtmlx_path; ?>/dhtmlxGrid/codebase/dhtmlxgridcell.js"></script>
<script type="text/javascript" src="<?php echo $l_dhtmlx_path; ?>/dhtmlxGrid/codebase/ext/dhtmlxgrid_start.js"></script>
<script type="text/javascript" src="<?php echo $l_dhtmlx_path; ?>/dhtmlxGrid/codebase/ext/dhtmlxgrid_srnd.js"></script>
<script type="text/javascript" src="<?php echo $l_dhtmlx_path; ?>/dhtmlxGrid/codebase/ext/dhtmlxgrid_filter.js"></script>
<?php
}

   if (strtoupper($p_dwin) == 'Y') {
?>
<script type="text/javascript" src="<?php echo $l_dhtmlx_path; ?>/dhtmlxWindows/codebase/dhtmlxwindows.js"></script>
<script type="text/javascript" src="<?php echo $l_dhtmlx_path; ?>/dhtmlxWindows/codebase/dhtmlxcontainer.js"></script>
<?php
}
    
    

}}




if ( ! function_exists('menu')){    
function menu(){    
?>

<div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="../" class="navbar-brand">LynCor.biz</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Manage <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a href="#">Menu Item</a></li>
                <li><a href="#">Menu Item</a></li>
                <li><a href="#">Menu Item</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Trasactions <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="download">
                <li><a href="#">Menu Item</a></li>
                <li><a href="#">Menu Item</a></li>
                <li><a href="#">Menu Item</a></li>
              </ul>
            </li>
          </ul>


        </div>
      </div>
</div>

<?php

}}

?>