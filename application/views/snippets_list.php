<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Snippet:List</title>
<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>   
<script src="<?php echo base_url('assets/js/handlebars-v3.0.0.js');?>"></script>   
<script src="<?php echo base_url('assets/js/zsi.bswriter.js');?>"></script>   
<script src="<?php echo base_url('assets/js/zsi.lib.js');?>"></script>   

<link href="<?php echo base_url('assets/css/bss.bootstrap.min.css');?>" rel="stylesheet">
    

<?php
    headerInclude($p_dlayout='Y',$p_dwin ='Y', $p_dgrid ='Y');
    $l_dhtmlx_sort="na,int,str,str";

    
?> 
    
</head>
<body>

<div id="container">

<table class="dhtmlxGrid" gridWidth="99.5%" gridHeight="500px" id="gridbox1">
    <tr valign="bottom">
        <th align="center" width="34px"><input type="checkbox" /> </th>
        <th nowrap align="center" width="80px">Snippet Id</th>
        <th nowrap width="100px">Snippet Name</th>
        <th nowrap width="500px">Content</th>
    </tr>
</table>
    
    
</div>
    

<script type="text/javascript">
//on window resize
$(window).resize(function(){
   zsi.table.dhtmlx.ResizeGrid(window,mygrid);
});
function SearchData(){
   var l_params="";
   l_params += '?p_snippet_id=' + $("#p_snippet_id").val();
   l_params += '&p_snippet_name=' + $("#p_snippet_name").val();
   l_params += '&p_content=' + $("#p_content").val();
   LoadData(l_params);
}
function checkDelete(l_cmd) {
   var l_stmt, l_count
   l_stmt = zsi.table.getCheckBoxesValues("input[name=p_cb]:checked","p_del_s=","&");
   
   if (l_stmt!="") {
      if(confirm("Are you sure you want to delete ALL SELECTED Snippets?")) {
      $.post( l_cmd + "&" + l_stmt, function(d){
         window.location.reload();
         }).fail(function(d) {
         alert("Sorry, the curent transaction is not successfull.");
      });
      }
   }
}

function gotoPage(p_this){
var l_params = "?p_page_no=" + p_this.value;
LoadData(l_params);
};
var mygrid = dhtmlXGridFromTable("gridbox1");
mygrid.setSkin("light");
mygrid.setImagePath("<?php echo get_dhtmlx_path(); ?>/dhtmlxGrid/codebase/imgs/");
mygrid.setEditable(false);
mygrid.lockRow(0, true);
mygrid.enableLightMouseNavigation(true);
mygrid.setColSorting("<?php echo $l_dhtmlx_sort; ?>");
mygrid.sortImg.src=mygrid.imgURL+"sort_desc.gif";
LoadData('');
zsi.table.dhtmlx.ResizeGrid(window, mygrid);

/*Load and Reload*/
function LoadData(p_params){
   var l_params=p_params; 
   $.getJSON("<?php echo base_url(); ?>snippets/getjson" + l_params,onLoadComplete);       
}

function onLoadComplete(data){
   mygrid.clearAll();
   zsi.table.dhtmlx.Unescape(data,2);
   mygrid.parse(data, "json");        
   zsi.page.DisplayRecordPage(data.page_no,data.page_rows,data.row_count);
   $("#modalWindow").modal('hide');    
}


function attachURL(winURL,winTitle,winWidth,winHeight) {
   
   if(typeof dhtmlxWin === 'undefined') {
      dhtmlxWin = new dhtmlXWindows();
      dhtmlxWin.setImagePath("<?php echo get_dhtmlx_path(); ?>dhtmlxWindows/codebase/imgs/");
   }
   
   if (dhtmlxWin.isWindow("w1")) w1.close();
   var w = $(document).width();
   var x = (w - winWidth) / 2;
   var h = $(document).height();
   var y = (h - winHeight) / 2;
   w1 = dhtmlxWin.createWindow("w1", x, y, winWidth, winHeight); // x,y,width,height
   w1.setModal(true);
   w1.button("close").enable();
   w1.button("minmax1").enable();
   w1.button("minmax2").enable();
   w1.button("park").hide();
   w1.setText(winTitle);
   w1.attachURL(winURL);
}

</script>    

    

<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>     
</body>
</html>