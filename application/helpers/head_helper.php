<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ( ! function_exists('headerInclude')){    
function headerInclude($p_dlayout='N',$p_dwin ='N', $p_dgrid ='N'){    
   $l_dhtmlx_path =  base_url('assets/dhtmlx3.6');

?>
<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>   
<script src="<?php echo base_url('assets/js/handlebars-v3.0.0.js');?>"></script>   
<script src="<?php echo base_url('assets/js/zsi.bswriter.js');?>"></script>   
<script src="<?php echo base_url('assets/js/zsi.lib.js');?>"></script>   
<link href="<?php echo base_url('assets/css/bss.bootstrap.min.css');?>" rel="stylesheet">
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

?>