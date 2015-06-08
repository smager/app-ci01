<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ( ! function_exists('includeHeader')){    
function includeHeader($p_dlayout='N',$p_dwin ='N', $p_dgrid ='N'){    
   $l_dhtmlx_path =  base_url('assets/dhtmlx36');

?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
  var base_url ="<?php echo base_url('');?>";
</script>   
<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>   
<script src="<?php echo base_url('assets/js/zsi.lib.js?v=1');?>"></script>   
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
?>


<?php
if ( ! function_exists('includeFooter')){    
function includeFooter(){    
?>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>   <?php   
}}
?>


<?php
if ( ! function_exists('includeBSWriter')){    
function includeBSWriter(){    
?>
<script src="<?php echo base_url('assets/js/handlebars-v3.0.0.js');?>"></script>   
<script src="<?php echo base_url('assets/js/zsi.bswriter.js');?>"></script>   
<?php   
}}
?>


<?php
if ( ! function_exists('includeHandleBars')){    
function includeHandleBars(){    
?>
<script src="<?php echo base_url('assets/js/handlebars-v3.0.0.js');?>"></script>   
<?php   
}}
?>



<?php
if ( ! function_exists('menu')){    
function menu(){    
    $ci =& get_instance();
    $ci->load->model('menu_model');
    $ci->load->model('menu_types_model');
    $ci->load->library('session');
    
?>

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
<?php 
 if( isset( $ci->session->userdata['current_user'] ) ==true ){    
    
        $q=$ci->menu_types_model->getdata();
        $d=$q->result();
        echo '<ul class="nav navbar-nav">'; 
        foreach($d as $i){
            
             $q_mi=$ci->menu_model->getSubMenuItem($i->menu_type_id);            
            if($q_mi->num_rows() > 0){
                echo  '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $i->menu_type . ' <span class="caret"></span></a>';            
            }else{
                echo  '<li class="dropdown"><a href="#">' . $i->menu_type . '</a>';                        
            }
            
            if($q_mi->num_rows() > 0){
                echo '<ul class="dropdown-menu">'; 
                foreach($q_mi->result() as $subM){                    
                     echo '<li><a href="'. $subM->menu_url. '">' . $subM->menu_name . '</a></li>';
                }
                echo '</ul>';              
             }


            echo '</li>'; 

        }
        echo '</ul>';                 
 }
?>
        </div>
      </div>
</div>
<?php
}}
?>