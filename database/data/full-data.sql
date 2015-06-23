-- phpMyAdmin SQL Dump
-- version 4.4.6
-- http://www.phpmyadmin.net
--
-- Host: oracleexpertscebu.com
-- Generation Time: Jun 23, 2015 at 07:01 PM
-- Server version: 5.5.41-cll-lve
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zsi_sims`
--

--
-- Truncate table before insert `adj_types`
--

TRUNCATE TABLE `adj_types`;
--
-- Truncate table before insert `bank_ref`
--

TRUNCATE TABLE `bank_ref`;
--
-- Truncate table before insert `brands`
--

TRUNCATE TABLE `brands`;
--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'No Brand', 2, '2015-06-15 15:26:15', 2, '2015-06-17 08:09:37'),
(2, 'Brand1', 2, '2015-06-15 15:26:15', 2, '2015-06-17 08:09:37'),
(3, 'Brand2', 2, '2015-06-17 08:09:37', NULL, NULL);

--
-- Truncate table before insert `conv_units`
--

TRUNCATE TABLE `conv_units`;
--
-- Dumping data for table `conv_units`
--

INSERT INTO `conv_units` (`conv_id`, `from_unit_id`, `conv_unit_id`, `conv_unit_qty`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, '2', '3', '2.50', 1, '2015-06-03 01:06:32', 1, '2015-06-09 07:44:30'),
(2, '2', '3', '3.00', 1, '2015-06-03 01:07:31', 1, '2015-06-09 07:44:30'),
(3, '2', '2', '1.00', 1, '2015-06-09 07:44:13', 1, '2015-06-09 07:44:30'),
(4, '1', '1', '1.00', 1, '2015-06-09 07:44:22', 1, '2015-06-09 07:44:30'),
(5, '3', '3', '1.00', 1, '2015-06-09 07:44:30', NULL, NULL);

--
-- Truncate table before insert `denomination_ref`
--

TRUNCATE TABLE `denomination_ref`;
--
-- Dumping data for table `denomination_ref`
--

INSERT INTO `denomination_ref` (`denomination`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
('0.05', 1, '2015-06-01 12:01:57', 1, '2015-06-01 12:15:51'),
('0.10', 1, '2015-06-01 12:01:57', 1, '2015-06-01 12:15:51'),
('0.25', 1, '2015-06-01 12:01:57', 1, '2015-06-01 12:15:51'),
('1.00', 1, '2015-06-01 12:01:57', 1, '2015-06-01 12:15:52'),
('5.00', 1, '2015-06-01 12:01:58', 1, '2015-06-01 12:15:52'),
('10.00', 1, '2015-06-01 12:13:42', 1, '2015-06-01 12:15:52'),
('20.00', 1, '2015-06-01 12:13:43', 1, '2015-06-01 12:15:52'),
('50.00', 1, '2015-06-01 12:13:43', 1, '2015-06-01 12:15:53'),
('100.00', 1, '2015-06-01 12:13:43', 1, '2015-06-01 12:15:53'),
('200.00', 1, '2015-06-01 12:13:43', 1, '2015-06-01 12:15:53'),
('500.00', 1, '2015-06-01 12:13:56', 1, '2015-06-01 12:15:53'),
('1000.00', 1, '2015-06-01 12:15:53', NULL, NULL);

--
-- Truncate table before insert `employees`
--

TRUNCATE TABLE `employees`;
--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`empl_id`, `empl_name`, `store_loc_id`, `position_id`, `active`, `created_by`, `created_date`, `updated_by`, `updated_date`, `daily_rate`, `loc_id`) VALUES
(1, 'Gaudencio O. Tabinas Jr.', 1, 2, 1, 1, '2015-06-02 21:11:09', 1, '2015-06-10 07:27:44', '200.00', 1),
(2, 'German Fuentes', 2, 2, 1, 1, '2015-06-02 21:11:09', 1, '2015-06-10 07:27:44', '250.00', 1),
(3, 'Lyndon Mancio', 0, 1, 1, 1, '2015-06-08 03:17:17', 1, '2015-06-10 07:27:44', '0.00', 0),
(4, 'Cora Tan', 0, 1, 1, 1, '2015-06-08 03:17:17', 1, '2015-06-10 07:27:44', '0.00', 0);

--
-- Truncate table before insert `inv_summ`
--

TRUNCATE TABLE `inv_summ`;
--
-- Truncate table before insert `javascripts`
--

TRUNCATE TABLE `javascripts`;
--
-- Dumping data for table `javascripts`
--

INSERT INTO `javascripts` (`js_id`, `version_id`, `page_url`, `content`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 7, 'store_daily_cash/index', 'var ctrlSel = zsi.control.SelectList;\r\n    \r\nvar p_store_daily_cash_id = $("#p_store_daily_cash_id");\r\nvar p_store_loc_id        = $("#p_store_loc_id");\r\nvar p_tran_date           = $("#p_tran_date"); \r\nvar l_timer;    \r\n\r\n\r\n$("#btnSave").click(function(){\r\n  $.post (base_url + "store_daily_cash/update", $("#frm").serializeArray(), function(d){\r\n        getStoreDailyCashData();\r\n  });\r\n    \r\n});    \r\n    \r\n\r\nfunction setChangeEvent(){   \r\n    //add tr for summary total\r\n    var l_summaryTR = "<tr id=''total''><td id=''totalTitle'' colspan=''2''>Total = </td><td style=''text-align: right;padding-right: 10px''><label id=''lblSum''>0.00</label></td></tr>";\r\n     $(".tblStoreDailyCash").append(l_summaryTR);\r\n    computeTotal();\r\n\r\n    //allow only numirec input\r\n    zsi.initInputTypesAndFormats();\r\n    \r\n    //set input change event\r\n    $("input[name=''p_denomination_qty[]'']").keyup(function(){\r\n        \r\n        var l_denomination = $(this.parentNode).prev().children("input[name=''p_denomination[]'']");\r\n        var l_tdAmount =$(this.parentNode).next();     \r\n        var l_amount = l_tdAmount.children("input[name=''p_cash_amount[]'']");\r\n        var l_lblamount = l_tdAmount.children("label");\r\n        var l_result =  this.value * l_denomination.val();\r\n        l_amount.val(0);\r\n        l_lblamount.text('''');\r\n        if( l_result > 0){\r\n            l_amount.val(l_result);\r\n            l_lblamount.text(l_result.toFixed(2));\r\n        }\r\n        computeTotal();\r\n    });\r\n}\r\n    \r\nfunction computeTotal(){\r\n    var l_total=0;\r\n    $("input[name=''p_cash_amount[]'']").each(function(){\r\n        if(this.value) l_total  = (l_total + parseFloat(this.value)); \r\n    });\r\n    \r\n    $("#lblSum").text(l_total.toFixed(2));\r\n}    \r\n    \r\n\r\np_store_loc_id.change(function(){    \r\n    if(this.value!='''' && new Date(p_tran_date.val()).isValid()){    \r\n        getStoreDailyCashData();\r\n    }                        \r\n});    \r\n    \r\n    \r\np_tran_date.keyup(function(e) {     \r\n    switch(e.keyCode){\r\n        case  9:break;//alt+tab\r\n        case 17:break;//ctrl\r\n        case 18:break;//alt\r\n        case 39:break;//Right\r\n        case 37:break;//Left\r\n        case 40:break;//Down\r\n        case 38:break;//Up            \r\n        case 13:break;//enter\r\n        default:\r\n            clearTimeout(l_timer);\r\n            var l_value=this.value;\r\n            l_timer = setTimeout(function(){       \r\n                if(p_store_loc_id.val()!='''' && new Date(l_value).isValid()){    \r\n                    getStoreDailyCashData();\r\n                }                    \r\n            }, 500);\r\n            break;\r\n    }\r\n});    \r\n\r\n    \r\np_tran_date.change(function() { \r\n    if(p_store_loc_id.val()!='''' && new Date(this.value).isValid()){    \r\n        getStoreDailyCashData();\r\n    }\r\n});      \r\n    \r\n    \r\n    \r\nfunction getStoreDailyCashData(){  \r\n    var l_data  = { ''store_loc_id'' : p_store_loc_id.val(), ''tran_date'': p_tran_date.val() }; \r\n    $.getJSON(base_url + "store_daily_cash/get_json",l_data\r\n       ,function(d){\r\n              if(d.length > 0 ) {\r\n                  p_store_daily_cash_id.val(d[0].store_daily_cash_id);\r\n                  getStoreDailyCashDetailData();\r\n              }else{\r\n                  getDenominationData();\r\n              }\r\n        }\r\n    );\r\n        \r\n}\r\n\r\n    \r\nfunction getDenominationData(){ \r\n    p_store_daily_cash_id.val('''');    \r\n    \r\n    zsi.json.loadGrid({\r\n         table  : ".tblStoreDailyCash"\r\n        ,url    : base_url + "denomination_ref/get_json"\r\n        ,td_body: [ \r\n            function(d){\r\n                return ''<input name="p_store_daily_cash_dtl_id[]" type="hidden">'' \r\n                + ''<input name="p_denomination[]" value="'' + d.denomination + ''" type="hidden">'' \r\n                +  d.denomination;                         \r\n            }\r\n            ,function(d){\r\n                return ''<input type="text" name="p_denomination_qty[]"  class="form-control input-sm numeric">'';\r\n            }\r\n            ,function(d){\r\n                return ''<input type="hidden" name="p_cash_amount[]" class="form-control input-sm "><label class="lblAmt"></label>'';                         \r\n                \r\n            }\r\n        ]\r\n        ,td_properties:[\r\n            "style=''text-align: right;padding-right: 5px''"   \r\n            ,""   \r\n            ,"style=''text-align: right;padding-right: 10px''"               \r\n        ]   \r\n        ,onComplete : function(){\r\n            setChangeEvent(); \r\n        }\r\n    });\r\n}\r\n    \r\n \r\nfunction getStoreDailyCashDetailData(){    \r\n    zsi.json.loadGrid({\r\n         table  :".tblStoreDailyCash"\r\n        ,url    :base_url + "store_daily_cash/get_detail_json/" + p_store_daily_cash_id.val()\r\n        ,td_body:[ \r\n            function(d){\r\n                return ''<input name="p_store_daily_cash_dtl_id[]" value="'' + d.store_daily_cash_dtl_id + ''" type="hidden">''\r\n                + ''<input name="p_denomination[]" value="'' + d.denomination + ''" type="hidden">''                          \r\n                +  d.denomination;                \r\n            }\r\n            ,function(d){\r\n                return ''<input type="text" name="p_denomination_qty[]" value="'' + (parseFloat(d.denomination_qty) > 0 ? d.denomination_qty : '''') + ''" class="form-control input-sm numeric">'';                                                    \r\n            }\r\n            ,function(d){                \r\n                return ''<input type="hidden" name="p_cash_amount[]"  value="'' + d.cash_amount + ''" class="form-control input-sm" >''                                                    \r\n                +  ''<label class="lblAmt">'' + (parseFloat(d.cash_amount) > 0 ? d.cash_amount : '''') + ''</label>'';                         \r\n            }\r\n        ]\r\n        ,td_properties:[\r\n            "style=''text-align: right;padding-right: 5px''"   \r\n            ,""   \r\n            ,"style=''text-align: right;padding-right: 10px''"   \r\n        ]\r\n        ,onComplete : function(){\r\n            setChangeEvent(); \r\n        }\r\n                 \r\n    });    \r\n}\r\n    \r\n    \r\n$(document).ready(function(){\r\n   ctrlSel( base_url + "select_options/code/store_locs","select[name=''p_store_loc_id'']","","N");\r\n});    \r\n     ', NULL, '2015-06-09 05:43:24', 2, '2015-06-15 09:20:07'),
(4, 3, 'bank_ref/index', ' zsi.json.checkValueExist(base_url + "common/checkdataexist", "input[name=''p_bank_acctno[]'']","bank_ref","bank_acctno"); \r\n  //smager2  \r\n    \r\nfunction checkDelete(l_cmd) {\r\n   var l_stmt=[], l_count;\r\n    \r\n   var data = zsi.table.getCheckBoxesValues("input[name=''p_cb[]'']:checked");\r\n    for(var x=0;x<data.length; x++){\r\n        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); \r\n    }\r\n   if (l_stmt!="") {\r\n      if(confirm("Are you sure you want to delete selected items?")) {\r\n      $.post( l_cmd , l_stmt, function(d){\r\n            window.location.reload();\r\n            //console.log(d);\r\n         }).fail(function(d) {\r\n            alert("Sorry, the curent transaction is not successfull.");\r\n        });\r\n      }\r\n   }\r\nreturn false;\r\n}   ', NULL, '2015-06-09 06:09:59', 1, '2015-06-09 07:58:21'),
(5, 4, 'conv_units/index', '//conv_units/index\r\nvar ctrlSel = zsi.control.SelectList;  \r\n    \r\n$(document).ready(function(){\r\n  ctrlSel( base_url + "select_options/code/units","select[name=''p_from_unit_id[]'']","","N");\r\n  ctrlSel( base_url + "select_options/code/units","select[name=''p_conv_unit_id[]'']","","N");\r\n});    \r\n    \r\nfunction checkDelete(l_cmd) {\r\n   var l_stmt=[], l_count;\r\n    \r\n   var data = zsi.table.getCheckBoxesValues("input[name=''p_cb[]'']:checked");\r\n    for(var x=0;x<data.length; x++){\r\n        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); \r\n    }\r\n   if (l_stmt!="") {\r\n      if(confirm("Are you sure you want to delete selected items?")) {\r\n      $.post( l_cmd , l_stmt, function(d){\r\n            window.location.reload();\r\n            //console.log(d);\r\n         }).fail(function(d) {\r\n            alert("Sorry, the curent transaction is not successfull.");\r\n        });\r\n      }\r\n   }\r\nreturn false;\r\n}   ', NULL, '2015-06-09 06:13:24', 2, '2015-06-15 09:23:29'),
(6, 3, 'denomination_ref/index', 'function checkDelete(l_cmd) {\r\n   var l_stmt=[], l_count;\r\n    \r\n   var data = zsi.table.getCheckBoxesValues("input[name=''p_cb[]'']:checked");\r\n    for(var x=0;x<data.length; x++){\r\n        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); \r\n    }\r\n   if (l_stmt!="") {\r\n      if(confirm("Are you sure you want to delete selected items?")) {\r\n      $.post( l_cmd , l_stmt, function(d){\r\n            window.location.reload();\r\n            //console.log(d);\r\n         }).fail(function(d) {\r\n            alert("Sorry, the curent transaction is not successfull.");\r\n        });\r\n      }\r\n   }\r\nreturn false;\r\n}   \r\n', NULL, '2015-06-09 06:15:07', 1, '2015-06-09 06:45:00'),
(7, 5, 'employees/index', 'var ctrlSel = zsi.control.SelectList;  \r\n    \r\n$(document).ready(function(){\r\n  ctrlSel( base_url + "select_options/code/positions","select[name=''p_position_id[]'']","","N");\r\n  ctrlSel( base_url + "select_options/code/locations","select[name=''p_loc_id[]'']","","N");\r\n  ctrlSel( base_url + "select_options/code/store_locs","select[name=''p_store_loc_id[]'']","","N");\r\n});    \r\n\r\n    \r\n    \r\nfunction checkDelete(l_cmd) {\r\n   var l_stmt=[], l_count;\r\n    \r\n   var data = zsi.table.getCheckBoxesValues("input[name=''p_cb[]'']:checked");\r\n    for(var x=0;x<data.length; x++){\r\n        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); \r\n    }\r\n   if (l_stmt!="") {\r\n      if(confirm("Are you sure you want to delete selected items?")) {\r\n      $.post( l_cmd , l_stmt, function(d){\r\n            window.store_location.reload();\r\n            //console.log(d);\r\n         }).fail(function(d) {\r\n            alert("Sorry, the curent transaction is not successfull.");\r\n        });\r\n      }\r\n   }\r\nreturn false;\r\n}   \r\n', NULL, '2015-06-09 06:16:41', 2, '2015-06-15 09:26:04'),
(8, 30, 'locations/index', 'function displayClear(v){\r\n    var r='''';\r\n    if(v!==null){\r\n        if(parseInt(v)!==0) r=v;\r\n    }\r\n    return r;\r\n}\r\n\r\nfunction manageItems(p_id){\r\n    var bs = zsi.bs.ctrl;\r\n    $("input[name=''p_loc_id'']").val(p_id);\r\n    zsi.form.displayLOV({\r\n         table  : "#tblProdSupp"\r\n        ,url   : base_url + "loc_supplies/getdata_json/" + p_id\r\n        ,params : ["loc_supply_id","supply_id"] \r\n        ,column_data: [\r\n             function(d){ return d.supply_code; }\r\n            ,function(d){ \r\n                return bs({name:"reorder_level[]",value: displayClear(d.reorder_level)}); \r\n            }\r\n            ,function(d){ \r\n                return bs({name:"max_level[]",value: displayClear(d.max_level)}); \r\n            }  \r\n        ]\r\n        ,onComplete:function(){\r\n            $(''#modalWindow'').modal("show");\r\n        }\r\n    });\r\n    \r\n}\r\n\r\n$(document).ready(function(){\r\n\r\n    //get dialog template\r\n    $.get(base_url + "assets/templates/bsDialogBox.txt",function(d){\r\n        var template = Handlebars.compile(d);     \r\n        \r\n        var context = { id:"modalWindow"\r\n                        , title: "Add/Remove Supply"\r\n                        , footer:   ''<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>''\r\n                                  + ''<button type="button" onclick="submitSelectedItems();" class="btn btn-primary">Save</button>''\r\n                        , body: ''<table id="tblProdSupp" class="table row">''\r\n                                + ''<thead>''\r\n                                    + ''<tr><th width="20"></th><th>Names</th><th>Re-order Qty</th><th>Max Qty</th></tr>''\r\n                                + ''</thead>''\r\n                                + ''</table>''\r\n                      };\r\n        var html    = template(context);     \r\n        $("body").append(html);\r\n        $(".modal-body").append(''<input type="hidden" name="p_loc_id">'');\r\n        \r\n    });\r\n});\r\n    \r\nfunction submitSelectedItems(){\r\n    var data = $("#frm_modalWindow").serializeArray();\r\n    $(''#modalWindow'').modal("hide");\r\n    $.post(base_url + "loc_supplies/update",data,function(d){});\r\n}\r\n\r\n\r\nfunction checkDelete(l_cmd) {\r\n   var l_stmt=[], l_count;\r\n    \r\n   var data = zsi.table.getCheckBoxesValues("input[name=''p_cb[]'']:checked");\r\n    for(var x=0;x<data.length; x++){\r\n        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); \r\n    }\r\n   if (l_stmt!="") {\r\n      if(confirm("Are you sure you want to delete selected items?")) {\r\n      $.post( l_cmd , l_stmt, function(d){\r\n            window.location.reload();\r\n            //console.log(d);\r\n         }).fail(function(d) {\r\n            alert("Sorry, the curent transaction is not successfull.");\r\n        });\r\n      }\r\n   }\r\nreturn false;\r\n}   \r\n', NULL, '2015-06-09 06:18:03', 2, '2015-06-16 08:52:08'),
(9, 5, 'menu/index', 'var ctrlSel = zsi.control.SelectList;  \r\n    \r\n$(document).ready(function(){\r\n  ctrlSel( base_url + "select_options/code/menu_types","select[name=''p_menu_type_id[]'']","","N");\r\n  ctrlSel( base_url + "select_options/code/systems","select[name=''p_system_id[]'']","","N");\r\n});    \r\n\r\nfunction checkDelete(l_cmd) {\r\n   var l_stmt=[], l_count;\r\n    \r\n   var data = zsi.table.getCheckBoxesValues("input[name=''p_cb[]'']:checked");\r\n    for(var x=0;x<data.length; x++){\r\n        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); \r\n    }\r\n   if (l_stmt!="") {\r\n      if(confirm("Are you sure you want to delete selected items?")) {\r\n      $.post( l_cmd , l_stmt, function(d){\r\n            window.location.reload();\r\n            //console.log(d);\r\n         }).fail(function(d) {\r\n            alert("Sorry, the curent transaction is not successfull.");\r\n        });\r\n      }\r\n   }\r\nreturn false;\r\n}   \r\n', NULL, '2015-06-09 06:19:23', 2, '2015-06-15 09:27:14'),
(10, 1, 'menu_types/index', 'function checkDelete(l_cmd) {\r\n   var l_stmt=[], l_count;\r\n    \r\n   var data = zsi.table.getCheckBoxesValues("input[name=''p_cb[]'']:checked");\r\n    for(var x=0;x<data.length; x++){\r\n        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); \r\n    }\r\n   if (l_stmt!="") {\r\n      if(confirm("Are you sure you want to delete selected items?")) {\r\n      $.post( l_cmd , l_stmt, function(d){\r\n            window.location.reload();\r\n            //console.log(d);\r\n         }).fail(function(d) {\r\n            alert("Sorry, the curent transaction is not successfull.");\r\n        });\r\n      }\r\n   }\r\nreturn false;\r\n}   \r\n', NULL, '2015-06-09 06:21:21', 1, '2015-06-09 06:21:37'),
(11, 1, 'positions/index', 'function checkDelete(l_cmd) {\r\n   var l_stmt=[], l_count;\r\n    \r\n   var data = zsi.table.getCheckBoxesValues("input[name=''p_cb[]'']:checked");\r\n    for(var x=0;x<data.length; x++){\r\n        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); \r\n    }\r\n   if (l_stmt!="") {\r\n      if(confirm("Are you sure you want to delete selected items?")) {\r\n      $.post( l_cmd , l_stmt, function(d){\r\n            window.location.reload();\r\n            //console.log(d);\r\n         }).fail(function(d) {\r\n            alert("Sorry, the curent transaction is not successfull.");\r\n        });\r\n      }\r\n   }\r\nreturn false;\r\n}   \r\n', NULL, '2015-06-09 06:22:49', 1, '2015-06-09 06:23:09'),
(12, 1, 'roles/index', 'function checkDelete(l_cmd) {\r\n   var l_stmt=[], l_count;\r\n    \r\n   var data = zsi.table.getCheckBoxesValues("input[name=''p_cb[]'']:checked");\r\n    for(var x=0;x<data.length; x++){\r\n        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); \r\n    }\r\n   if (l_stmt!="") {\r\n      if(confirm("Are you sure you want to delete selected items?")) {\r\n      $.post( l_cmd , l_stmt, function(d){\r\n            window.location.reload();\r\n            //console.log(d);\r\n         }).fail(function(d) {\r\n            alert("Sorry, the curent transaction is not successfull.");\r\n        });\r\n      }\r\n   }\r\nreturn false;\r\n}   \r\n', NULL, '2015-06-09 06:24:22', 1, '2015-06-09 06:24:36'),
(13, 44, 'store_loc/index', 'var ctrlSel = zsi.control.SelectList;  \r\nvar bs = zsi.bs.ctrl;\r\nvar tblPopup = "tblStoreLocSupp";\r\nfunction manageItems(p_id){\r\n    $("input[name=''p_store_loc_id'']").val(p_id);\r\n    zsi.form.displayLOV({\r\n         table  : "#" + tblPopup\r\n        ,url   : base_url + "store_loc_supplies/getdata_json/" + p_id\r\n        ,show_checkbox: false\r\n        ,params : ["store_loc_supply_id","supply_brand_id"] \r\n        ,column_data: [\r\n             function(d){return d.supply;}\r\n            ,function(d){ return (d.cu_desc!=null?d.cu_desc:"");}\r\n            ,function(d){return d.supply_srp;}\r\n            ,function(d){ return bs({name:"stock_daily_qty[]",value:d.stock_daily_qty!=null?d.stock_daily_qty:""}); }\r\n            ,function(d){ return (d.stock_curr_qty!=null?d.stock_curr_qty:"");}\r\n            ,function(d){ return (d.rep_qty!=null?d.rep_qty:"");}\r\n        ]\r\n        ,td_properties: ["","nowrap"]\r\n        ,onComplete:function(){\r\n            $(''#modalWindow'').modal("show");\r\n        }\r\n    });\r\n    \r\n}\r\n    \r\n$(document).ready(function(){\r\n    \r\n    $.get(base_url + "assets/templates/bsDialogBox.txt",function(d){\r\n        var template = Handlebars.compile(d);     \r\n        \r\n        var context = { id:"modalWindow"\r\n                        , title: "Supply Stock Reference"\r\n                        , footer:   ''<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>''\r\n                                  + ''<button type="button" onclick="submitSelectedItems();" class="btn btn-primary">Save</button>''\r\n                        , body: ''<table id="''+ tblPopup  +''" class="table row">''\r\n                                + ''<thead>''\r\n                                    + ''<tr><th width="1"></th><th>Supply</th>''\r\n                                    + ''<th>Unit of Measure</th>''\r\n                                    + ''<th>Unit Price</th>''\r\n                                    + ''<th>Daily Qty</th>''\r\n                                    + ''<th>Current Qty</th>''\r\n                                    + ''<th>Replenish Qty</th></tr>''\r\n                                + ''</thead>''\r\n                                + ''</table>''\r\n                      };\r\n        var html    = template(context);     \r\n        $("body").append(html);\r\n        $(".modal-body").append(''<input type="hidden" name="p_store_loc_id">'');\r\n        \r\n    });    \r\n    \r\n  ctrlSel( base_url + "select_options/code/stores","select[name=''p_store_id[]'']","","N");\r\n  ctrlSel( base_url + "select_options/code/locations","select[name=''p_loc_id[]'']","","N");\r\n});    \r\n    \r\nfunction submitSelectedItems(){\r\n        var data = $("#frm_modalWindow").serializeArray();\r\n       $.post(base_url + "store_loc_supplies/update",data,function(d){\r\n            $(''#modalWindow'').modal("hide");\r\n            window.location.reload();\r\n       });\r\n}    \r\n    \r\nfunction checkDelete(l_cmd) {\r\n   var l_stmt=[], l_count;\r\n    \r\n   var data = zsi.table.getCheckBoxesValues("input[name=''p_cb[]'']:checked");\r\n    for(var x=0;x<data.length; x++){\r\n        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); \r\n    }\r\n   if (l_stmt!="") {\r\n      if(confirm("Are you sure you want to delete selected items?")) {\r\n      $.post( l_cmd , l_stmt, function(d){\r\n            window.location.reload();\r\n            //console.log(d);\r\n         }).fail(function(d) {\r\n            alert("Sorry, the curent transaction is not successfull.");\r\n        });\r\n      }\r\n   }\r\nreturn false;\r\n}     \r\n', NULL, '2015-06-09 06:26:34', 2, '2015-06-20 06:57:46'),
(14, 38, 'stores/index', 'function collapseList(o,target){\r\n    $(o).text(function(i,v) {\r\n           return v === ''Show'' ? ''Hide'' : ''Show'';\r\n     });\r\n        \r\n    $(''#'' + target).slideToggle();\r\n}\r\n\r\nfunction manageItems(p_id){\r\n    $("input[name=''p_store_id'']").val(p_id);\r\n    zsi.form.displayLOV({\r\n         table  : "#tblProdSupp"\r\n        ,url   : base_url + "store_supplies/getdata_json/" + p_id\r\n        ,params : ["store_supply_id","supply_id"] \r\n        ,column_data: [\r\n             function(d){ return d.supply_code; }\r\n        ]\r\n        ,onComplete:function(){\r\n            $(''#modalWindow'').modal("show");\r\n        }\r\n    });\r\n    \r\n}\r\n\r\n$(document).ready(function(){\r\n\r\n    //get dialog template\r\n    $.get(base_url + "assets/templates/bsDialogBox.txt",function(d){\r\n        var template = Handlebars.compile(d);     \r\n        \r\n        var context = { id:"modalWindow"\r\n                        , title: "Add/Remove Supply"\r\n                        , footer:   ''<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>''\r\n                                  + ''<button type="button" onclick="submitSelectedItems();" class="btn btn-primary">Save</button>''\r\n                        , body: ''<table id="tblProdSupp" class="table row">''\r\n                                + ''<thead>''\r\n                                    + ''<tr><th width="20"></th><th>Names</th></tr>''\r\n                                + ''</thead>''\r\n                                + ''</table>''\r\n                      };\r\n        var html    = template(context);     \r\n        $("body").append(html);\r\n        $(".modal-body").append(''<input type="hidden" name="p_store_id">'');\r\n        \r\n    });\r\n});\r\n    \r\nfunction submitSelectedItems(){\r\n        var data = $("#frm_modalWindow").serializeArray();\r\n       $.post(base_url + "store_supplies/update",data,function(d){\r\n            $(''#modalWindow'').modal("hide");\r\n            window.location.reload();\r\n       });\r\n}\r\n\r\nfunction checkDelete(l_cmd) {\r\n   var l_stmt=[], l_count;\r\n    \r\n   var data = zsi.table.getCheckBoxesValues("input[name=''p_cb[]'']:checked");\r\n    for(var x=0;x<data.length; x++){\r\n        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); \r\n    }\r\n   if (l_stmt!="") {\r\n      if(confirm("Are you sure you want to delete selected items?")) {\r\n      $.post( l_cmd , l_stmt, function(d){\r\n            window.location.reload();\r\n            //console.log(d);\r\n         }).fail(function(d) {\r\n            alert("Sorry, the curent transaction is not successfull.");\r\n        });\r\n      }\r\n   }\r\nreturn false;\r\n}   \r\n', NULL, '2015-06-09 06:27:58', 2, '2015-06-12 09:26:07'),
(15, 1, 'suppliers/index', 'function checkDelete(l_cmd) {\r\n   var l_stmt=[], l_count;\r\n    \r\n   var data = zsi.table.getCheckBoxesValues("input[name=''p_cb[]'']:checked");\r\n    for(var x=0;x<data.length; x++){\r\n        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); \r\n    }\r\n   if (l_stmt!="") {\r\n      if(confirm("Are you sure you want to delete selected items?")) {\r\n      $.post( l_cmd , l_stmt, function(d){\r\n            window.location.reload();\r\n            //console.log(d);\r\n         }).fail(function(d) {\r\n            alert("Sorry, the curent transaction is not successfull.");\r\n        });\r\n      }\r\n   }\r\nreturn false;\r\n}   \r\n', NULL, '2015-06-09 06:30:05', 1, '2015-06-09 06:30:23'),
(16, 20, 'supplies/index', 'var ctrlSel = zsi.control.SelectList;  \r\n    \r\n$(document).ready(function(){\r\n     \r\n    $("#frm").attr("action",base_url + "supplies/update").attr("method","post");\r\n    \r\n    var bsButton = zsi.bs.button;\r\n    $(".buttonGroup").append( \r\n          bsButton({name:"Save",type:"submit"})\r\n        + bsButton({name:''Delete'',onclick:"checkDelete(''"  +  base_url  + "supplies/delete'');"}) \r\n    );\r\n\r\n    displayRecords();\r\n    \r\n    //get dialog template\r\n    $.get(base_url + "assets/templates/bsDialogBox.txt",function(d){\r\n        var template = Handlebars.compile(d);     \r\n        \r\n        var context = { id:"modalWindow"\r\n                        , title: "Add/Remove Supply"\r\n                        , footer:   ''<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>''\r\n                                  + ''<button type="button" onclick="submitSelectedItems();" class="btn btn-primary">Save</button>''\r\n                        , body: ''<table id="tblPopup" class="table row">''\r\n                                + ''<thead>''\r\n                                    + ''<tr>''\r\n                                    + ''<th width="20"></th>''\r\n                                    + ''<th>Brands</th>''\r\n                                    + ''<th>Unit</th>''\r\n                                    + ''<th>Unit Cost</th>''\r\n                                    + ''<th>Unit Price</th>''\r\n                                    + ''</tr>''\r\n                                + ''</thead>''\r\n                                + ''</table>''\r\n                      };\r\n        var html    = template(context);     \r\n        $("body").append(html);\r\n        $(".modal-body").append(''<input type="hidden" name="p_supply_id">'');\r\n        \r\n    });    \r\n});\r\n\r\nfunction displayRecords(){       \r\n    var bs = zsi.bs.ctrl;    \r\n    //var inputCls = "form-control input-sm";\r\n    zsi.json.loadGrid({\r\n         table  : "#grid"\r\n        ,url   : base_url + "supplies/getdata_json/"\r\n        ,td_body: [ \r\n            function(d){\r\n                return     bs({name:"supply_id[]",type:"hidden",value: d.supply_id})\r\n                        +  bs({name:"cb[]",type:"checkbox"});\r\n            }            \r\n            ,function(d){ return bs({name:"supply_code[]",value: d.supply_code}); }\r\n            ,function(d){ return bs({name:"supply_desc[]",value: d.supply_desc}); }\r\n            ,function(d){ return bs({name:"supply_type_id[]",type:"select",value: d.supply_type_id}); }\r\n            ,function(d){ return ''<a href="javascript:manageItems(''+ d.supply_id +'');">Manage</a>''; }\r\n        ]\r\n        ,onComplete : function(){\r\n            displayBlankRows();\r\n        }\r\n    });    \r\n}\r\nfunction manageItems(p_id){\r\n    var bs = zsi.bs.ctrl;\r\n    $("input[name=''p_supply_id'']").val(p_id);\r\n    zsi.form.displayLOV({\r\n         table  : "#tblPopup"\r\n        ,url   : base_url + "supply_brands/getdata_json/" + p_id\r\n        ,params : ["supply_brand_id","brand_id"] \r\n        ,column_data: [\r\n             function(d){ return d.brand_name; }\r\n            , function(d){ return bs({name:"conv_id[]", type:"select",value:d.conv_id}) }\r\n            , function(d){ return bs({name:"supply_cost[]",value:d.supply_cost}) }\r\n            , function(d){ return bs({name:"supply_srp[]",value:d.supply_srp}) }\r\n \r\n \r\n        ]\r\n        ,onComplete:function(){\r\n            $(''#modalWindow'').modal("show");\r\n            ctrlSel( base_url + "select_options/code/conv_units","select[name=''p_conv_id[]'']","","N");\r\n        }\r\n    });\r\n    \r\n}\r\n\r\nfunction displayBlankRows(){       \r\n    var bs = zsi.bs.ctrl;    \r\n    var inputCls = "form-control input-sm";\r\n    zsi.json.loadGrid({\r\n         table  : "#grid"\r\n        ,td_body: [ \r\n            function(d){\r\n                return     bs({name:"supply_id[]",type:"hidden"})\r\n                        +  bs({name:"cb[]",type:"checkbox"});\r\n            }            \r\n            ,function(d){ return bs({name:"supply_code[]"}); }\r\n            ,function(d){ return bs({name:"supply_desc[]"}); }\r\n            ,function(d){ return bs({name:"supply_type_id[]",type:"select"}); }\r\n            ,function(d){ return ""; }\r\n        ]\r\n        ,onComplete : function(){\r\n             ctrlSel( base_url + "select_options/code/supply_types","select[name=''p_supply_type_id[]'']","","N");\r\n\r\n        }\r\n    });    \r\n}\r\n\r\nfunction submitSelectedItems(){\r\n    var data = $("#frm_modalWindow").serializeArray();\r\n    $(''#modalWindow'').modal("hide");\r\n    $.post(base_url + "supply_brands/update",data,function(d){});\r\n}\r\n    \r\nfunction checkDelete(l_cmd) {\r\n   var l_stmt=[], l_count;\r\n    \r\n   var data = zsi.table.getCheckBoxesValues("input[name=''p_cb[]'']:checked");\r\n    for(var x=0;x<data.length; x++){\r\n        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); \r\n    }\r\n   if (l_stmt!="") {\r\n      if(confirm("Are you sure you want to delete selected items?")) {\r\n      $.post( l_cmd , l_stmt, function(d){\r\n            window.location.reload();\r\n            //console.log(d);\r\n         }).fail(function(d) {\r\n            alert("Sorry, the curent transaction is not successfull.");\r\n        });\r\n      }\r\n   }\r\nreturn false;\r\n}   ', NULL, '2015-06-09 06:31:33', 2, '2015-06-18 10:04:50'),
(17, 1, 'supply_types/index', 'function checkDelete(l_cmd) {\r\n   var l_stmt=[], l_count;\r\n    \r\n   var data = zsi.table.getCheckBoxesValues("input[name=''p_cb[]'']:checked");\r\n    for(var x=0;x<data.length; x++){\r\n        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); \r\n    }\r\n   if (l_stmt!="") {\r\n      if(confirm("Are you sure you want to delete selected items?")) {\r\n      $.post( l_cmd , l_stmt, function(d){\r\n            window.location.reload();\r\n            //console.log(d);\r\n         }).fail(function(d) {\r\n            alert("Sorry, the curent transaction is not successfull.");\r\n        });\r\n      }\r\n   }\r\nreturn false;\r\n}   \r\n', NULL, '2015-06-09 06:33:16', 1, '2015-06-09 06:33:33'),
(18, 1, 'systems/index', 'function checkDelete(l_cmd) {\r\n   var l_stmt=[], l_count;\r\n    \r\n   var data = zsi.table.getCheckBoxesValues("input[name=''p_cb[]'']:checked");\r\n    for(var x=0;x<data.length; x++){\r\n        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); \r\n    }\r\n   if (l_stmt!="") {\r\n      if(confirm("Are you sure you want to delete selected items?")) {\r\n      $.post( l_cmd , l_stmt, function(d){\r\n            window.location.reload();\r\n            //console.log(d);\r\n         }).fail(function(d) {\r\n            alert("Sorry, the curent transaction is not successfull.");\r\n        });\r\n      }\r\n   }\r\nreturn false;\r\n}   \r\n', NULL, '2015-06-09 06:34:59', 1, '2015-06-09 06:35:18'),
(19, 1, 'units/index', 'function checkDelete(l_cmd) {\r\n   var l_stmt=[], l_count;\r\n    \r\n   var data = zsi.table.getCheckBoxesValues("input[name=''p_cb[]'']:checked");\r\n    for(var x=0;x<data.length; x++){\r\n        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); \r\n    }\r\n   if (l_stmt!="") {\r\n      if(confirm("Are you sure you want to delete selected items?")) {\r\n      $.post( l_cmd , l_stmt, function(d){\r\n            window.location.reload();\r\n            //console.log(d);\r\n         }).fail(function(d) {\r\n            alert("Sorry, the curent transaction is not successfull.");\r\n        });\r\n      }\r\n   }\r\nreturn false;\r\n}   \r\n', NULL, '2015-06-09 06:36:25', 1, '2015-06-09 06:36:48'),
(20, 26, 'users/index', '\r\nvar ctrlSel = zsi.control.SelectList;\r\n\r\n$(document).ready(function(){\r\n    $("#frm").attr("action",base_url + "users/update").attr("method","post");\r\n    \r\n    var bsButton = zsi.bs.button;\r\n    $(".buttonGroup").append( \r\n          bsButton({name:"Save",type:"submit"})\r\n        + bsButton({name:''Delete'',onclick:"checkDelete(''"  +  base_url  + "users/delete'');"}) \r\n    );\r\n\r\n    displayRecords();\r\n    \r\n    //get dialog template\r\n    $.get(base_url + "assets/templates/bsDialogBox.txt",function(d){\r\n        var template = Handlebars.compile(d);     \r\n        \r\n        var context = { id:"modalWindow"\r\n                        , title: "Add/Remove Supply"\r\n                        , footer:   ''<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>''\r\n                                  + ''<button type="button" onclick="submitSelectedItems();" class="btn btn-primary">Save</button>''\r\n                        , body: ''<table id="tblPopup" class="table row">''\r\n                                + ''<thead>''\r\n                                    + ''<tr><th width="20"></th><th>Location</th></tr>''\r\n                                + ''</thead>''\r\n                                + ''</table>''\r\n                      };\r\n        var html    = template(context);     \r\n        $("body").append(html);\r\n        $(".modal-body").append(''<input type="hidden" name="p_user_id">'');\r\n        \r\n    });    \r\n});\r\n\r\nfunction displayRecords(){       \r\n    var bs = zsi.bs.ctrl;    \r\n    //var inputCls = "form-control input-sm";\r\n    zsi.json.loadGrid({\r\n         table  : "#grid"\r\n        ,url   : base_url + "users/getdata_json/"\r\n        ,td_body: [ \r\n            function(d){\r\n                return     bs({name:"user_id[]",type:"hidden",value: d.user_id})\r\n                        +  bs({name:"cb[]",type:"checkbox"});\r\n            }            \r\n            ,function(d){ return bs({name:"empl_id[]",type:"select",value: d.empl_id}); }\r\n            ,function(d){ return bs({name:"user_name[]",value: d.user_name}); }\r\n            ,function(d){ return bs({name:"user_password[]",value: d.user_password}); }\r\n            ,function(d){ return bs({name:"role_id[]",type:"select",value: d.role_id}); }\r\n            ,function(d){ return bs({name:"active[]",type:"yesno",value: d.active}); }\r\n            ,function(d){ return ''<a href="javascript:manageItems(''+ d.user_id +'');">Location Access</a>''; }\r\n        ]\r\n        ,onComplete : function(){\r\n            displayBlankRows();\r\n        }\r\n    });    \r\n}\r\nfunction manageItems(p_id){\r\n    var bs = zsi.bs.ctrl;\r\n    $("input[name=''p_user_id'']").val(p_id);\r\n    zsi.form.displayLOV({\r\n         table  : "#tblPopup"\r\n        ,url   : base_url + "user_locations/getdata_json/" + p_id\r\n        ,params : ["user_loc_id","loc_id"] \r\n        ,column_data: [\r\n             function(d){ return d.location; }\r\n \r\n        ]\r\n        ,onComplete:function(){\r\n            $(''#modalWindow'').modal("show");\r\n        }\r\n    });\r\n    \r\n}\r\n\r\n\r\n\r\nfunction displayBlankRows(){       \r\n    var bs = zsi.bs.ctrl;    \r\n    var inputCls = "form-control input-sm";\r\n    zsi.json.loadGrid({\r\n         table  : "#grid"\r\n        ,td_body: [ \r\n            function(d){\r\n                return     bs({name:"user_id[]",type:"hidden"})\r\n                        +  bs({name:"cb[]",type:"checkbox"});\r\n            }            \r\n            ,function(d){ return bs({name:"empl_id[]",type:"select"}); }\r\n            ,function(d){ return bs({name:"user_name[]"}); }\r\n            ,function(d){ return bs({name:"user_password[]"}); }\r\n            ,function(d){ return bs({name:"role_id[]",type:"select"}); }\r\n            ,function(d){ return bs({name:"active[]",type:"yesno",value:0}); }\r\n            ,function(d){ return ""; }\r\n        ]\r\n        ,onComplete : function(){\r\n            ctrlSel( base_url + "select_options/code/employees","select[name=''p_empl_id[]'']","","N");\r\n            ctrlSel( base_url + "select_options/code/roles","select[name=''p_role_id[]'']","","N"); \r\n\r\n        }\r\n    });    \r\n}\r\n\r\nfunction submitSelectedItems(){\r\n    var data = $("#frm_modalWindow").serializeArray();\r\n    $(''#modalWindow'').modal("hide");\r\n    $.post(base_url + "user_locations/update",data,function(d){});\r\n}\r\n\r\nfunction checkDelete(l_cmd) {\r\n   var l_stmt=[], l_count;\r\n    \r\n   var data = zsi.table.getCheckBoxesValues("input[name=''p_cb[]'']:checked");\r\n    for(var x=0;x<data.length; x++){\r\n        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); \r\n    }\r\n   if (l_stmt!="") {\r\n      if(confirm("Are you sure you want to delete selected items?")) {\r\n      $.post( l_cmd , l_stmt, function(d){\r\n            window.location.reload();\r\n         }).fail(function(d) {\r\n            alert("Sorry, the curent transaction is not successfull.");\r\n        });\r\n      }\r\n   }\r\nreturn false;\r\n}   \r\n\r\n\r\n\r\n \r\n', NULL, '2015-06-09 06:37:49', 2, '2015-06-16 09:42:18');
INSERT INTO `javascripts` (`js_id`, `version_id`, `page_url`, `content`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(21, 69, 'zsi_lib', '/* JS Package Names or Namespaces */\r\n   var zsi           = {};\r\n   zsi.form          = {};\r\n   zsi.table         = {};\r\n   zsi.table.dhtmlx  = {};\r\n   zsi.page          = {};\r\n   zsi.control       = {};\r\n   zsi.calendar      = {};\r\n   zsi.url           = {};\r\n   zsi.json          = {};\r\n   zsi.bs            = {};\r\n\r\n/* Prototypes */\r\nDate.prototype.isValid = function () {\r\n    return this.getTime() === this.getTime();\r\n};  \r\n\r\n/* Page Initialization */\r\n$(document).ready(function(){\r\n   monitorAjaxResponse();      \r\n   initDatePicker();\r\n   initTabNavigation();\r\n   initFormAdjust();\r\n   initDeleteRecord();\r\n   zsi.initInputTypesAndFormats();\r\n\r\n});\r\n\r\nfunction monitorAjaxResponse(){\r\n   $(document).ajaxStart(function(){});      \r\n\r\n   $( document ).ajaxSend(function(event,request,settings) {\r\n      if(typeof zsi_request_count === ''undefined'') zsi_request_count=0;\r\n      zsi_request_count++;\r\n      \r\n      if(zsi._strValueExist(settings.url,"zsi_lib.value_exist") ) return;\r\n      if(zsi._strValueExist(settings.url,"employee_search_json") ) return;      \r\n      \r\n      if(typeof parent.ShowHideProgressWindow !== ''undefined'') {\r\n         parent.ShowHideProgressWindow(true);\r\n      }\r\n\r\n   });\r\n\r\n   $(document).ajaxComplete(function() {\r\n      if(typeof zsi_request_count !== ''undefined''){\r\n         zsi_request_count--;\r\n         if(zsi_request_count==0){\r\n            //console.log("no remaining request");\r\n            CloseProgressWindow();\r\n         }\r\n      }\r\n   });   \r\n\r\n   $(document).ajaxSuccess(function(event,request,settings){\r\n      //console.log("zsi.Ajax.Request Status=Success, url: "+ settings.url);\r\n   });      \r\n   \r\n   $(document).ajaxError(function(event, request, settings ){   \r\n      var retryLimit=2;\r\n      var error_url="errors_update";\r\n      var errorObject = {};\r\n      errorObject.event =event;\r\n      errorObject.request =request;\r\n      errorObject.settings =settings;\r\n      \r\n      CloseProgressWindow();\r\n\r\n      if( zsi._strValueExist(settings.url,error_url) ){\r\n         console.log("url: " + settings.url);         \r\n         return false;\r\n      }\r\n\r\n      if(request.responseText==""){\r\n         console.log("zsi.Ajax.Request Status = %cNo Data (warning!) %c, url: " + settings.url, "color:orange;", "color:#000;");         \r\n         $.post( error_url + "?p_error_type=W&p_error_message=" + escape("No Response Data") + "&p_url="  + escape(settings.url)  , function() {\r\n            console.log( "Warning submited." );\r\n         });\r\n      }\r\n      else{\r\n         console.log("zsi.Ajax.Request Status = Ïailed %c, url: " + settings.url, "color:red;", "color:#000;");\r\n         console.log(errorObject);              \r\n\r\n\r\n         if(!settings.retryCounter ) settings.retryCounter=0;\r\n         settings.retryCounter++;\r\n\r\n         if(settings.retryCounter<=retryLimit){                \r\n            setTimeout(function(){\r\n               console.log("retry#:" + settings.retryCounter);                 \r\n               $.ajax(settings);\r\n            },1000);\r\n         }\r\n         if(settings.retryCounter>retryLimit){\r\n            console.log("retry limit is reached");\r\n            \r\n            $.post( error_url + "?p_error_type=E&p_error_message=" + escape(request.responseText) + "&p_url="  + escape(settings.url)  , function() {\r\n               console.log( "Error submited." );\r\n               if(typeof parent.ShowHideErrorWindow !== ''undefined''){\r\n                  parent.ShowHideErrorWindow(true);                  \r\n                  setTimeout(function(){\r\n                     parent.ShowHideErrorWindow(false);\r\n                  },5000);                        \r\n                  \r\n               }\r\n\r\n            });\r\n            \r\n         }\r\n        \r\n\r\n      }\r\n   });         \r\n   \r\n   function CloseProgressWindow(){\r\n      setTimeout(function(){\r\n         if(typeof zsi_request_count!==''undefined''){\r\n            if(zsi_request_count<=0){\r\n               if(typeof parent.ShowHideProgressWindow !== ''undefined'')  parent.ShowHideProgressWindow(false);\r\n               zsi_request_count=0;\r\n            }\r\n         }\r\n      },1000);      \r\n   }\r\n}\r\n\r\nfunction initDatePicker(){\r\n   var inputDate =$(''[id*=date]'');\r\n\r\n   inputDate.attr("placeholder","mm/dd/yyyy");\r\n     //console.log( inputDate.css("width") ) ;\r\n   \r\n   \r\n   if(inputDate.length > 0){\r\n      \r\n      inputDate.datepicker({\r\n              format: ''mm/dd/yyyy''\r\n              ,autoclose:true\r\n      }).on(''show'', function(e){\r\n\r\n          var dhtmlxForm=$(".dhtmlx_skin_dhx_skyblue .form-horizontal");\r\n\r\n           var l_dp     = $(''.datepicker'');\r\n\r\n           if(dhtmlxForm.length>0){\r\n              var l_window = $(document); //$(parent.w1)\r\n              var l_offset = $(this).offset();\r\n              var l_left="";\r\n              var l_top="";\r\n              if(l_offset.left>l_window.width() - l_dp.width())\r\n                  l_left=parseInt(l_offset.left - l_dp.width()) + "px";\r\n              else\r\n                  l_left=parseInt(l_offset.left) + "px";\r\n\r\n              if(l_offset.top>l_window.height()- (l_dp.height()+100))\r\n                  l_top= parseInt(l_offset.top - l_dp.height()-18 ) + "px";\r\n              else\r\n                  l_top=parseInt(l_offset.top + ($(this).height()*2) ) + "px";\r\n\r\n              l_dp.css({top:l_top, left:l_left});\r\n           }\r\n\r\n\r\n           var highest = -999;\r\n\r\n           $("*").each(function() {\r\n               var current = parseInt($(this).css("z-index"), 10);\r\n               if(current && highest < current) highest = current;\r\n           });\r\n\r\n           l_dp.css("z-index",highest + 1);\r\n\r\n\r\n      });\r\n   }\r\n      \r\n   inputDate.keyup(function(){      \r\n         if(this.value.length==2 || this.value.length==5 ) this.value += "/";\r\n   });\r\n   \r\n   \r\n}\r\n\r\n\r\nfunction initTabNavigation(){\r\n   $(".nav-tabs li").each(function(){\r\n      $(this).click(function(){\r\n         $(".nav-tabs li").removeClass("active");\r\n         $(this).addClass("active" );\r\n          var l_a=$(this).children("a")[0];\r\n          $("#p_tab").val(l_a.id);          \r\n          var l_clsTabPagesName =".tab-pages";\r\n          var l_tab = $( l_clsTabPagesName + " #" + l_a.id);\r\n\r\n          l_tab.parent().children().each(function(){\r\n            $(this).removeClass("active");\r\n          });\r\n          l_tab.addClass("active" );\r\n          \r\n      });\r\n\r\n   });\r\n}\r\n\r\nfunction initFormAdjust(){\r\n   /*adjustment form with search*/\r\n   var searchIcon=$(".form-group .glyphicon-search");\r\n   if(searchIcon.length>0){\r\n      $(document.body).css("margin-left","10px");\r\n      $(document.body).css("margin-right","10px");\r\n   }\r\n}\r\n\r\nfunction initDeleteRecord(){\r\n   $("a[id=delete-row]").click(function(){\r\n      var value = $(this).attr("value");\r\n      var table = $(this).attr("table");\r\n      var tr = $(this.parentNode.parentNode);\r\n\r\n      if(confirm("Are you sure you want to delete this Item?")) {\r\n         $.post("s004_delete?p_table=" + table + "&p_field=seq_no&p_value=" + value,\r\n            function(d){\r\n               tr.remove();\r\n               if(zsi.table.onDeleteRow) zsi.table.onDeleteRow();\r\n            }).fail(function(d) {\r\n               alert("Sorry, the curent transaction is not successfull.");\r\n         });\r\n      }\r\n\r\n   });\r\n}\r\n\r\nzsi.initInputTypesAndFormats = function(){\r\n   $(".numeric").keypress(function(event){\r\n   \r\n         return zsi.form.checkNumber(event,''.,'');\r\n   });\r\n    \r\n   $(".format-decimal").blur(function(){\r\n              var obj= this;\r\n              zsi.form.checkNumberFormat(this);\r\n       \r\n   });\r\n}\r\n\r\n\r\n/*--[ common functions]---------------------------------------------------------------------*/\r\n   zsi._strValueExist=function(source,value){\r\n      var _result=false;\r\n      var i = source.toLowerCase().indexOf(value.toLowerCase());\r\n      if (i>-1) _result=true;\r\n      return _result;\r\n   }\r\n      \r\n\r\n/*--[zsi.table]------------------------------------------------------------------------------*/\r\n\r\n   zsi.table.getCheckBoxesValues = function(){\r\n/*Example:\r\n  [3-parameters]:\r\n  var x= zsi.table.getCheckBoxesValues("input[name=p_cb]:checked","p_del_ds=","&");\r\n   result: p_del_ds=1031&p_del_ds=1032&p_del_ds=1027\r\n\r\n  [1-parameters]:\r\n  var x= zsi.table.getCheckBoxesValues("input[name=p_cb]:checked");\r\n  result:  ["1031", "1027"]\r\n\r\n*/\r\n    var args = arguments;\r\n    var result=null;\r\n    var _hidden= "input[type=hidden]";\r\n    switch(args.length) {\r\n      case 1: /* return type : Array */\r\n                     var arrayItems = new Array();\r\n                     var i=0;\r\n                  var selectorCheckboxName=args[0];\r\n                     $(selectorCheckboxName).each(function(){\r\n                           arrayItems[i]=$(this.parentNode).children(_hidden).val();\r\n                           i++;\r\n                     });\r\n                     result = arrayItems;\r\n                  break;\r\n\r\n      case 3: /* return type : string */\r\n                  var params="";\r\n                  var selectorCheckboxName=args[0];\r\n                  var parameterValue         =args[1];\r\n                  var separatorValue         =args[2];\r\n\r\n                     $(selectorCheckboxName).each(function(){\r\n                           var _value =   $(this.parentNode).children(_hidden).val();\r\n                           if(_value == undefined) _value = this.value; /* patch for no hidden field*/\r\n                           if(params!="") params = params + separatorValue;\r\n                           params = params + parameterValue + _value;\r\n                     });\r\n                     result = params;\r\n                  break;\r\n\r\n      default: break;\r\n    }\r\n   return result;\r\n}\r\n/*------------------------------------------------------------------------------------------*/\r\n/*Example:\r\n   zsi.table.dhtmlx.ResizeGrid(window,mygrid,100);\r\n*/\r\nzsi.table.dhtmlx.ResizeGrid   = function(p_Window,p_dhtmlGrid,p_less_ht){\r\n   var ht=p_Window.innerHeight || p_Window.document.documentElement.clientHeight || p_Window.document.body.clientHeight;\r\n      //ht = ht - 76;\r\n      if (p_less_ht==null) ht = ht - 76;\r\n      else ht = ht - p_less_ht;\r\n   p_dhtmlGrid.enableAutoHeight(true,ht,true);\r\n   p_dhtmlGrid.setSizes();\r\n}\r\n\r\n/*Example:\r\n   zsi.table.dhtmlx.Unescape(data,2);\r\n   mygrid.parse(data, "json");\r\n*/\r\nzsi.table.dhtmlx.Unescape   = function(data,col_index){\r\n   $.each(data.rows,function(){\r\n      this.data[col_index]=unescape(this.data[col_index]);\r\n   });\r\n}\r\n\r\n/*------------------------------------------------------------------------------------------*/\r\n/*Example:\r\n  <input type="checkbox" name="p_cb" onclick="zsi.table.setCheckBox(this,l_tran_no );">\r\n*/\r\n   zsi.table.setCheckBox = function(obj, cbValue){\r\n   var _hidden= "input[type=hidden]";\r\n      var _input =   $(obj.parentNode).children(_hidden);\r\n      if(_input.attr("type")!=''hidden'') { alert(_hidden + " not found"); return;}\r\n\r\n       if(obj.checked){\r\n            _input.val(cbValue);\r\n      }\r\n      else{\r\n            _input.val("");\r\n      }\r\n   }\r\n\r\n/*------------------------------------------------------------------------------------------*/\r\n/*Example:\r\n   var jsonData = $.parseJSON(mygrid.xmlLoader.xmlDoc.responseText);\r\n   zsi.page.DisplayRecordPage(jsonData.page_no,jsonData.page_rows,jsonData.row_count);\r\n*/\r\nzsi.page.DisplayRecordPage   = function(p_page_no,p_rows,p_numrec){\r\n   var l_max_rows       =25;\r\n   var l_last_page    = Math.ceil(p_rows/l_max_rows);\r\n   var l_record_from    = (l_max_rows * (p_page_no-1)) + 1;\r\n   var l_record_to      = parseInt(l_record_from) + parseInt(p_numrec) - 1;\r\n\r\n   var l_select         = $("select[name=p_page_no]");\r\n   l_select.clearSelect();\r\n   for(var x=0;x<l_last_page;x++){\r\n      var l_option;\r\n       if (p_page_no==x+1){\r\n             l_select.append("<option selected value=''" +  (x+1) + "''>"+ (x+1) +"</option>");\r\n        }\r\n        else{\r\n             l_select.append("<option value=''" +  (x+1) + "''>"+ (x+1) +"</option>");\r\n\r\n        }\r\n\r\n   }\r\n\r\n   $("#of").html('' of '' + l_last_page );\r\n   $(".pagestatus").html("Showing records from <i>" + l_record_from + "</i> to <i>" + l_record_to + "</i>");\r\n\r\n}\r\n/*------------------------------------------------------------------------------------------*/\r\n/*Example:\r\n  SelectList("common/get_select_data","#p_vaccine_code","=l_vaccine_code","N");\r\n*/\r\n\r\nzsi.control.SelectList = function(p_url,p_selector,p_selval,p_req,p_onLoadComplete){\r\n   $.getJSON(p_url, function( data ) {\r\n      if(p_selector instanceof jQuery)\r\n         p_selector.fillSelect(data,p_selval,p_req,p_onLoadComplete);\r\n      else\r\n         $(p_selector).fillSelect(data,p_selval,p_req,p_onLoadComplete);\r\n   });\r\n}\r\n\r\n/*--[zsi.calendar]------------------------------------------------------------------------------*/\r\nzsi.calendar.LoadMonths = function(p_select){\r\n   p_select.add(new Option(" ", ""),null);\r\n   var monthNames = [ "January", "February", "March", "April", "May", "June",\r\n    "July", "August", "September", "October", "November", "December" ];\r\n   for(var x=0;x<12;x++){\r\n      var l_option = new Option(monthNames[x], x+1);\r\n      p_select.add(l_option, null);\r\n   }\r\n}\r\n/*--[zsi.form]------------------------------------------------------------------------------*/\r\nzsi.form.checkNumber = function(e) {\r\n   var keynum;\r\n   var keychar;\r\n   var numcheck;\r\n   var allowedStr =''''\r\n\r\n   for (i=1;i<arguments.length;i++) {\r\n      allowedStr+=arguments[i];\r\n   }\r\n   if (window.event) {\r\n      //IE\r\n      keynum = e.keyCode;\r\n   } else if (e.which) {\r\n      //Netscape,Firefox,Opera\r\n      keynum = e.which;\r\n      if (keynum==8) return true; //backspace\r\n      if (String.charCodeAt(keynum)=="91") return true;\r\n   } else return true;\r\n\r\n   keychar = String.fromCharCode(keynum);\r\n\r\n   if (allowedStr.indexOf(keychar)!=-1) return true;\r\n      numcheck = /\\d/;\r\n      return numcheck.test(keychar);\r\n}\r\n\r\nzsi.form.isValidNumberFormat = function(o) {\r\n   var regex = /(?=.)^\\$?(([1-9][0-9]{0,2}(,[0-9]{3})*)|[0-9]+)?(\\.[0-9]{1,4})?$/;\r\n   var val = o.value;\r\n   if (val!="") {\r\n      var ok = regex.test(val);\r\n       if (ok) \r\n         return true;\r\n       else \r\n         return false;\r\n   }\r\n}\r\n\r\nzsi.form.checkNumberFormat = function(o){\r\n   if(!zsi.form.isValidNumberFormat(o)){\r\n         alert("Please enter a valid number format.");\r\n         setTimeout(function(){o.focus()}, 0);\r\n   }\r\n}\r\n\r\nzsi.form.__objMandatory;\r\nzsi.form.__objMandatoryGroupIndexValues=[];\r\n\r\nzsi.form.__checkMandatory=function(oGroupN, oGroupT,groupIndex){\r\nvar e = oGroupN.names;\r\nvar d = oGroupT.titles;\r\nvar l_irecords=[];\r\nvar l_firstArrObj;\r\n\r\nzsi.form.__objMandatoryGroupIndexValues[groupIndex]="N";\r\n   for(var x=0;x<e.length;x++){\r\n      var l_obj = document.getElementsByName(e[x]);\r\n     if(l_obj.length > 1){\r\n         /* collect row-index if the row has a value */\r\n         var l_index=0;\r\n         for(var i=0;i<l_obj.length;i++){\r\n            if(l_obj[i].type!="hidden"){\r\n               if(!l_firstArrObj) l_firstArrObj = l_obj[i];\r\n               if($.trim(l_obj[i].value)!="") {\r\n                 l_irecords[l_index]=i;\r\n                 l_index++;\r\n                 zsi.form.__objMandatoryGroupIndexValues[groupIndex]="Y";\r\n               }\r\n            }\r\n         }\r\n\r\n     }else{ /* single */\r\n         if(l_obj[0]){\r\n            if(l_obj[0].value==undefined || $.trim(l_obj[0].value)==""){\r\n               l_obj[0].focus();\r\n               alert("Enter " + d[x] + ".");\r\n               return false;\r\n            }\r\n         }\r\n     }\r\n\r\n   }\r\n  /* multiple */\r\n   if(oGroupN.type=="M"){\r\n      if(oGroupN.required_one){\r\n         if(oGroupN.required_one=="Y"){\r\n            if(l_irecords.length==0){\r\n               alert("Please enter at least 1 record.");\r\n               if(l_firstArrObj) l_firstArrObj.focus();\r\n               return false;\r\n            }\r\n         }\r\n      }\r\n      for(var x=0;x<e.length;x++){\r\n         var l_obj = document.getElementsByName(e[x]);\r\n         if(l_obj.length > 1){\r\n            //console.log(l_irecords.length);\r\n            for(var i=0;i<l_irecords.length;i++){\r\n               if(l_obj[l_irecords[i]].type!="hidden"){\r\n                  if($.trim(l_obj[l_irecords[i]].value)=="") {\r\n                    l_obj[l_irecords[i]].focus();\r\n                    alert("Enter " + d[x] + ".");\r\n                    return false;\r\n                  }\r\n               }\r\n            }\r\n         }\r\n      }\r\n   }\r\n\r\n   return true;\r\n }\r\n\r\n/* Mandatory: public function(s) */\r\nzsi.form.checkMandatory=function(){\r\n   var l_om = zsi.form.__objMandatory;\r\n   for(var x=0;x < l_om.groupNames.length;x++){  /*loop per group objects*/\r\n      if (!zsi.form.__checkMandatory( l_om.groupNames[x], l_om.groupTitles[x], x ))\r\n         return false;\r\n   }\r\n\r\n   /*check  required one indexes */\r\n   if(l_om.required_one_indexes){\r\n      var roi=l_om.required_one_indexes;\r\n      var mgiv = zsi.form.__objMandatoryGroupIndexValues;\r\n      var countNoRecords=0;\r\n      for(var x=0;x < roi.length;x++){\r\n         for(var y=0;y < mgiv.length;y++){\r\n            if(roi[x]==y){\r\n               if(mgiv[y]=="N") countNoRecords++;\r\n            }\r\n         }\r\n      }\r\n\r\n      if(roi.length == countNoRecords){\r\n         alert("Please enter at least one record.");\r\n         return false;\r\n      }\r\n   }\r\n\r\n   return true;\r\n}\r\n\r\nzsi.form.markMandatory=function(om){\r\nzsi.form.__objMandatory=om;\r\n\r\nfor(var x=0;x<om.groupNames.length;x++){\r\n   if(om.groupNames[x].names.length!=om.groupTitles[x].titles.length){\r\n      alert("Error!, parameters are not equal.");\r\n      return false;\r\n   }\r\n}\r\n\r\n\r\nvar e;\r\n\r\n//setTimeout(function(){\r\n   for(var gn=0;gn< om.groupNames.length;gn++){  /*loop per groupNames*/\r\n      e = om.groupNames[gn].names;\r\n\r\n      var border ="solid 2px #F3961C";\r\n      for(var x=0;x< e.length;x++){\r\n         var elements = document.getElementsByName(e[x]);\r\n         if(elements.length == 1){ /* single */\r\n            var o=$("#" + e[x]);\r\n            changeborder(o[0],border);\r\n            o.on(''change keyup blur'', function() {\r\n               changeborder(this,border);\r\n            });\r\n\r\n         }else{ /* multiple */\r\n         $("*[name=''" +  e[x] + "''][type!=hidden]").each(function(){\r\n            changeborder(this,border);\r\n            $(this).on(''change keyup blur'', function() {\r\n               if($(this).val()!=""){\r\n                  $("*[name=''" +  this.name + "''][type!=hidden]").each(function(){\r\n                     $(this).css("border","solid 1px #ccc");\r\n                  });\r\n               }\r\n               else{\r\n                  /* check input elements if there''s a value */\r\n                  var hasValue=false;\r\n                  $("*[name=''" +  this.name + "''][type!=hidden]").each(function(){\r\n                      if($(this).val()!="") hasValue=true;\r\n                  });\r\n\r\n                  /* start changing border */\r\n                  $("*[name=''" +  this.name + "''][type!=hidden]").each(function(){\r\n                     if(hasValue){\r\n                        $(this).css("border","solid 1px #ccc");\r\n                     }\r\n                     else{\r\n                        $(this).css("border-left",border);\r\n                        $(this).css("border-right",border);\r\n                     }\r\n                  });\r\n\r\n               }\r\n            });\r\n\r\n         });\r\n\r\n         }\r\n      }\r\n   } /* end of group loop */\r\n\r\n//},3000);\r\n\r\n   function changeborder(o,border){\r\n      jo = $(o);\r\n      if(jo.val() == undefined || jo.val()==""){\r\n         jo.css("border-left",border);\r\n         jo.css("border-right",border);\r\n      }else{\r\n         jo.css("border","solid 1px #ccc");\r\n      }\r\n   }\r\n\r\n}\r\n\r\n/* ----[ End Mandatory ]-----  */\r\n\r\n zsi.form.checkDate=function(e, d){\r\n var l_format_msg=" must be in [mm/dd/yyyy] format.";\r\n    for(var x=0;x<e.length;x++){\r\n       var l_obj = document.getElementsByName(e[x]);\r\n\r\n      if(l_obj.length > 1){\r\n          /* multiple */\r\n          var l_index=0;\r\n          for(var i=0;i<l_obj.length;i++){\r\n             if(l_obj[i].type!="hidden"){\r\n                if($.trim(l_obj[i].value)!=""){\r\n                   if( isValidDate(l_obj[i].value)!=true){\r\n                      alert(d[x] + l_format_msg);\r\n                      l_obj[i].focus();\r\n                      return false;\r\n                   }\r\n                }\r\n             }\r\n          }\r\n\r\n      }\r\n      else{ /* single */\r\n         if(l_obj[0]){\r\n            if($.trim(l_obj[0].value)!=""){\r\n               if( isValidDate(l_obj[0].value)!=true){\r\n                 alert(d[x] + l_format_msg);\r\n                 l_obj[0].focus();\r\n                 return false;\r\n               }\r\n            }\r\n         }\r\n\r\n      }\r\n\r\n    }\r\n\r\n    return true;\r\n  }\r\n\r\n\r\n function isValidDate(l_date){\r\n    var comp = l_date.split(''/'');\r\n    var m = parseInt(comp[0], 10);\r\n    var d = parseInt(comp[1], 10);\r\n    var y = parseInt(comp[2], 10);\r\n    var date = new Date(y,m-1,d);\r\n    if (date.getFullYear() == y && date.getMonth() + 1 == m && date.getDate() == d) {\r\n      return true;\r\n    }\r\n    else {\r\n      return false;\r\n    }\r\n}\r\n\r\nzsi.form.setCriteria=function(p_inputName,p_desc, p_result){\r\n   var input = $(p_inputName);\r\n   if (input.prop("tagName")=="SELECT"){\r\n      if(input.find(":selected").text()){\r\n         if (p_result!="") p_result += ", ";\r\n         p_result += p_desc + ": " +  input.find(":selected").text();\r\n      }\r\n   }\r\n   else{\r\n      if(input.val()){\r\n         if (p_result!="") p_result += ", ";         \r\n         p_result += p_desc + ":" + input.val(); \r\n      }\r\n   }\r\n   return p_result;\r\n}\r\n\r\n\r\nzsi.form.showAlert= function(p_class){   \r\n   var box = $("." + p_class);         \r\n   box.center();\r\n   box.show();         \r\n   setTimeout(function(){\r\n      box.hide("slow");\r\n\r\n   }, 500);\r\n}\r\n\r\nzsi.form.displayLOV = function(p){\r\n    var td_data = [];\r\n    var td_prop;\r\n    if(typeof p.td_properties!=="undefined") td_prop = p.td_properties;\r\n    if(typeof p.show_checkbox==="undefined") p.show_checkbox=true;\r\n    td_data.push(function(d){\r\n                var inputs= ''<input name="p_'' + p.params[0] + ''[]"  type="hidden"  value="'' + d[p.params[0]] + ''">'' \r\n                     + ''<input name="p_'' + p.params[1] + ''[]" type="hidden" value="'' + d[p.params[1]] + ''" >''    \r\n                     + ''<input name="p_isCheck[]" type="hidden" value="'' +  ((d[p.params[0]])? 1:0)  + ''" >'';\r\n                if(p.show_checkbox==true)  \r\n                    inputs +=''<input name="p_cb[]" onclick="clickCB(this);" class="" type="checkbox" '' + ((d[p.params[0]])? ''checked'':'''') + ''>''\r\n                return inputs;     \r\n                     \r\n    });\r\n    \r\n    td_data = td_data.concat(p.column_data);        \r\n    zsi.json.loadGrid({\r\n         table          : p.table\r\n        ,url            : p.url\r\n        ,td_body        : td_data\r\n        ,td_properties  : td_prop\r\n        ,onComplete     : function(){\r\n            if(p.onComplete) p.onComplete();\r\n        }\r\n    });\r\n    \r\n    clickCB = function(o){\r\n            var td = o.parentNode;\r\n            if(o.checked==false) {\r\n                $(td).children("input[name=''p_isCheck[]'']").val(0);\r\n            }else{\r\n                $(td).children("input[name=''p_isCheck[]'']").val(1);\r\n            }\r\n    }   \r\n      \r\n}\r\n\r\n/*--[zsi.url]------------------------------------------------------------------------------*/\r\n\r\nzsi.url.getQueryValue = function (source,keyname) {\r\n   source = source.toString().toLowerCase(); \r\n   keyname = keyname.toLowerCase();\r\n   var qLoc =  source.indexOf("?");   \r\n   if(qLoc>-1) source=source.substr(qLoc+1);\r\n   if (source.indexOf("&") > -1){ \r\n      var vars = source.split("&");\r\n      for (var i=0;i<vars.length;i++) {\r\n         var pair = vars[i].split("=");\r\n         if (pair[0] == keyname) {\r\n\r\n            return pair[1];\r\n         }\r\n      }\r\n   }\r\n   else{\r\n      var pair = source.split("=");\r\n      if (pair[0] == keyname) {\r\n         return pair[1];\r\n      }      \r\n   }   \r\n   return ""\r\n}\r\n\r\nzsi.url.removeQueryItem = function (source,keyname) {\r\n   source = source.toString().toLowerCase(); \r\n   keyname = keyname + "".toLowerCase();\r\n   var qLoc =  source.indexOf("?");   \r\n   if(qLoc>-1) source=source.substr(qLoc+1);\r\n   var result = "";\r\n\r\n   if (source.indexOf("&") > -1){ \r\n      var pairs = source.split("&");\r\n      for (var i=0;i<pairs.length;i++) {\r\n          var l_keyname = pairs[i].split("=")[0];         \r\n         if(l_keyname !=keyname){ \r\n            if(result)  result +="&"; \r\n            result += pairs[i];\r\n         }\r\n         \r\n      }\r\n   }\r\n\r\n   return result;\r\n}\r\n\r\n/*--[zsi.json]------------------------------------------------------------------------------*/\r\n\r\nzsi.json.groupByColumnIndex = function(data,column_index){\r\n   var _result ={};\r\n   var _group=[];\r\n\r\n      $.each(data.rows, function () {\r\n            var _value = this.data[column_index];\r\n          if ($.inArray(_value, _group)==-1) {\r\n            _group.push(_value);\r\n            _result[_value]= [] \r\n         }\r\n         _result[_value].push(this.data);\r\n\r\n   });\r\n   return _result;\r\n}  \r\n\r\n\r\nzsi.json.checkValueExist = function(p_url, p_target,p_table, p_field){  \r\n   $(p_target).keyup(function(){\r\n      var l_obj=this;\r\n      if($.trim(this.value)==""){\r\n         showPopup(l_obj,false);                  \r\n         return false;\r\n      }\r\n      var l_value=$.trim(this.value);\r\n      if(zsi.timer) clearTimeout(zsi.timer);\r\n      zsi.timer = setTimeout(function(){              \r\n         $(l_obj).addClass("loadIconR" );\r\n         $.getJSON(p_url + "/" + p_table + "/" +  p_field + "/" +  l_value\r\n            , function(data) {\r\n                  $(l_obj).removeClass("loadIconR" );\r\n                  if(data.exist){\r\n                     showPopup(l_obj,true);                  \r\n                  }\r\n                  else{\r\n                     showPopup(l_obj,false);                  \r\n                  }\r\n              }\r\n\r\n         );\r\n\r\n      }, 1000);         \r\n   \r\n   });\r\n   \r\n   function showPopup(o,isShow){\r\n      if(isShow){\r\n         $(o.parentNode).addClass("has-error");\r\n         $(o).popover({\r\n                 placement  : ''right''\r\n                ,content    : ''Data already exist.''\r\n         });\r\n\r\n         $(o).popover(''show'');         \r\n      }\r\n      else{\r\n         $(o.parentNode).removeClass("has-error");\r\n         $(o).popover(''destroy'');\r\n      }\r\n   }\r\n}\r\n     \r\nzsi.json.loadGrid = function(o){           \r\n    var l_grid = $(o.table);\r\n    var trItem= function(data){\r\n        var r = ""\r\n        r +="<tr>";\r\n            for(var x=0;x<o.td_body.length;x++){\r\n                var l_prop='''';\r\n                if (typeof o.td_properties !== "undefined"){\r\n                    if (typeof o.td_properties[x] !== "undefined") l_prop = o.td_properties[x]; \r\n                } \r\n                r +="<td " + l_prop + " >" + o.td_body[x](data) + "</td>";                                                         \r\n            }\r\n        r +="</tr>";                         \r\n\r\n        l_grid.append(r);    \r\n    }\r\n    if(typeof o.isNew !== "undefined"){\r\n        if(o.isNew==true) l_grid.children(''tbody'').html('''');   \r\n    } \r\n    \r\n    if(o.url){\r\n        l_grid.children(''tbody'').html('''');      \r\n        $.getJSON(o.url, function(data){\r\n             $.each(data, function () {\r\n                 trItem(this)\r\n             });\r\n            if(o.onComplete) o.onComplete();\r\n        });    \r\n    }\r\n    else{\r\n        if(typeof o.rows === "undefined") o.rows =5;\r\n        for(var y=0;y<o.rows;y++){\r\n            trItem();\r\n        }\r\n        if(o.onComplete) o.onComplete();\r\n    }\r\n    \r\n}\r\n\r\n/*--[zsi.bs]-------bootstrap--------------------------------------------------------------*/\r\n\r\nzsi.bs.ctrl = function(o){\r\n    var l_tag="input";\r\n    var l_name ='' name="p_'' + o.name + ''" id="p_'' + o.name + ''"'';\r\n    var l_type = '' type="text"'';\r\n    var l_class ='' class="form-control"'';\r\n    var l_endTag="";\r\n    var l_value="";\r\n    var l_in_value="";\r\n    var l_selected_value="";\r\n\r\n    var yesno = function(p){\r\n        var v = 0;\r\n        var str ='''';\r\n        var cls = ''class="form-control input-sm"'';\r\n        \r\n        if (typeof p.class !=="undefined") cls = ''class="'' + p.class + ''"'';\r\n        str +=''<select name="p_'' + p.name + ''" id="p_'' + p.name + ''" '' + cls +   ''>'';\r\n        if (typeof p.value !=="undefined") v = p.value;\r\n        if(typeof p.mandatory !=="undefined"){\r\n            if(p.mandatory.toLowerCase()==''n'') str += ''<option value=""></option>'';\r\n        }\r\n        str += ''<option '' + (v==1 ? ''selected'':'''' ) +  '' value="1">Yes</option>'';\r\n        str += ''<option '' + (v==0 ? ''selected'':'''' ) +  '' value="0">No</option>'';\r\n        str += ''</select>'';\r\n        return str;\r\n    }    \r\n\r\n    if(typeof o.class!=="undefined") l_class='' class="'' + o.class + ''"'';         \r\n    if(typeof o.value!=="undefined") l_value='' value="'' + o.value + ''"'';\r\n    \r\n    if(typeof o.type!=="undefined"){\r\n        var t = o.type.toLowerCase();\r\n        \r\n        if(t==''yesno'') return yesno(o);\r\n        \r\n        l_type='' type="'' + o.type + ''"'';\r\n\r\n        if(t=="hidden") l_class='''';\r\n        \r\n        if( !(t=="hidden" || t=="input" || t=="checkbox" || t=="password"  || t=="email") ) l_tag=t;        \r\n        \r\n        if(t==''select'' || t ==''textarea''){\r\n            l_type="";\r\n            l_endTag=''</'' + l_tag + ''>'';\r\n            if(t==''select'' && typeof o.value!=="undefined"){ \r\n                l_selected_value = " selectedvalue=" + o.value;\r\n            }\r\n            if(o.type ==''textarea'' && typeof o.value!=="undefined"){\r\n                l_value="";\r\n                l_in_value=o.value;\r\n            }\r\n        }\r\n\r\n    }\r\n   return ''<'' + l_tag + l_name + l_type + l_class + l_value + l_selected_value + ''>'' + l_in_value + l_endTag;\r\n}    \r\n  \r\nzsi.bs.button =function(p){\r\n    var l_icon ='''';\r\n    var l_class ='' class="btn btn-primary btn-sm"'';\r\n    var l_type ='' type="button"'';\r\n    var l_onclick='''';\r\n    \r\n    if(typeof p.type !== "undefined") l_type = '' type="'' + p.type + ''"'';\r\n    if(typeof p.class !== "undefined") l_class = '' class="'' + p.class + ''"'';\r\n    if(typeof p.onclick !== "undefined") l_onclick = '' onclick="'' + p.onclick + ''"'';\r\n    switch(p.name.toLowerCase()){\r\n        case ''search'': l_icon=''search'';break;\r\n        case ''add'': \r\n        case ''new'': l_icon=''plus-sign'';break;\r\n        case ''delete'': l_icon=''trash'';break;\r\n        case ''close'': l_icon=''off'';break;\r\n        case ''save'': l_icon=''floppy-disk'';break;\r\n        case ''reset'': l_icon=''retweet'';break;\r\n        case ''login'': l_icon=''log-in'';break;\r\n        default:break;\r\n    }\r\n    \r\n    var l_span =''<span class="glyphicon glyphicon-'' + l_icon + ''"></span>'';\r\n    var result = ''<button id="btn'' + p.name + ''" '' + l_class +  l_type + l_onclick + ''>'' + l_span + '' '' + p.name + ''</button>'';\r\n    return result;\r\n}\r\n  \r\n\r\n/*----[ extended-JQuery Function ]--------------------------------------------------------------*/\r\n\r\n$.fn.clearSelect = function() {\r\n\r\n    if(this.length>1){\r\n       $(this).each(function(){\r\n           _clear(this);\r\n       });\r\n    }\r\n    else if(this.length==1){\r\n       _clear(this[0]);\r\n    }\r\n\r\n\r\n   function _clear(o){\r\n       if (o) {\r\n           if (o.tagName.toLowerCase() == "select") {\r\n               o.options.length = 0;\r\n           }\r\n       }\r\n   }\r\n\r\n}\r\n\r\n$.fn.fillSelect = function(data,p_selval,p_req,p_onLoadComplete) {\r\n    this.clearSelect();\r\n\r\n    if(this.length>1){\r\n       $(this).each(function(){\r\n           _load(this);\r\n       });\r\n    }\r\n    else if(this.length==1){\r\n       _load(this[0]);\r\n    }\r\n\r\n   function _load(ddl){\r\n          var reqIndex=0;\r\n       if (ddl) {\r\n           if (ddl.tagName.toLowerCase() == ''select'') {\r\n               if(p_req=="N"){\r\n                  var l_option_blank = new Option("", "");\r\n                  ddl.add(l_option_blank, null);\r\n                  reqIndex=1;\r\n               }\r\n               $.each(data, function(index, optionData) {\r\n                  var l_option = new Option(unescape(optionData.text), optionData.value);\r\n                  ddl.add(l_option, null);\r\n                  if(optionData.value==p_selval){\r\n                     ddl.selectedIndex=parseInt(index + reqIndex );\r\n                  }\r\n               });\r\n\r\n               var selval = $(ddl).attr("selectedvalue");\r\n               if(selval){\r\n                     $(ddl).children("option").each(function(i){\r\n                        if (selval==this.value){\r\n                           ddl.selectedIndex = i;\r\n                           $(ddl).change();\r\n                           return false;\r\n                        }\r\n                     });\r\n               }\r\n               $(ddl).removeAttr("selectedvalue");\r\n\r\n               if(p_onLoadComplete) {\r\n                  ddl.LoadComplete = p_onLoadComplete;\r\n                  ddl.LoadComplete();\r\n               }\r\n\r\n           }\r\n       }\r\n\r\n   }\r\n\r\n\r\n\r\n\r\n}\r\n\r\n$.fn.clearGrid = function() {\r\n    var t = $($(this).children("tbody")).children("tr");\r\n    t.each(function() {\r\n        var th = $(this).children()[0];\r\n        if (th.tagName.toLowerCase() != "th") {\r\n            $(this).remove();\r\n        }\r\n    });\r\n}\r\n\r\n\r\n$.fn.serializeExclude = function(p_arr_exclude) {\r\n  var _arr =  this.serializeArray();\r\n   var str = '''';\r\n   $.each(_arr, function(i,data){\r\n      if ($.inArray(data[''name''].toLowerCase(), p_arr_exclude)==-1) {\r\n         str += (str == '''') ? data[''name''] + ''='' + data[''value''] : ''&'' + data[''name''] + ''='' + data[''value''];\r\n      }\r\n   });\r\n   \r\n   return str;  \r\n\r\n}\r\n\r\n$.fn.center = function () {\r\n    this.css("position","absolute");\r\n    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + \r\n                                                $(window).scrollTop()) + "px");\r\n    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + \r\n                                                $(window).scrollLeft()) + "px");\r\n    return this;\r\n}\r\n\r\n\r\n/*------------------------------------------------------------------------------------------*/\r\n\r\n', 1, '2015-06-09 09:58:39', 2, '2015-06-19 12:25:33'),
(24, 144, 'purchase_order/index', 'var ctrlSel = zsi.control.SelectList;  \r\nvar supply_brands;\r\n$(document).ready(function(){\r\n    \r\n    ctrlSel( base_url + "select_options/code/suppliers","#p_supplier_id","","N");\r\n    ctrlSel( base_url + "select_options/code/locations","#p_loc_id","","N");\r\n\r\n    displayBlankRows(true);\r\n    getUnpostedPO();\r\n    initInputs();    \r\n    markMandatory();\r\n    setSupplyBrands();\r\n});\r\n$("form[id=frm]").submit(function(){\r\n     if( zsi.form.checkMandatory()!==true) return false;\r\n }); \r\n \r\n $("#btnNew").click(function(){\r\n    displayBlankRows(true);\r\n    //clear data\r\n    po_id.val('''');\r\n    po_no.val('''');\r\n });\r\n \r\n \r\nfunction setTotalEvent(){\r\n    \r\n       $("input[name=''p_po_qty[]'']").keyup(function(){\r\n            var p_unit_price = $(this.parentNode).next().children("input[name=''p_unit_price[]'']");\r\n            var p_total = $(this.parentNode).next().next().children("input[name=''p_total[]'']");\r\n            if(p_unit_price.val()!==""){\r\n                p_total.val(parseFloat(this.value  *  p_unit_price.val()).toFixed(2) );\r\n            }\r\n       });\r\n       \r\n\r\n       $("input[name=''p_unit_price[]'']").keyup(function(){\r\n            var p_po_qty = $(this.parentNode).prev().children("input[name=''p_po_qty[]'']");\r\n            var p_total = $(this.parentNode).next().children("input[name=''p_total[]'']");\r\n            if(p_po_qty.val()!==""){\r\n                p_total.val(parseFloat(this.value  *  p_po_qty.val()).toFixed(2) );\r\n            }\r\n       });\r\n    \r\n} \r\n\r\nfunction setSupplyBrands(){\r\n  $.getJSON(base_url + "supply_brands/getdata_supply_brands_json", function(d){\r\n        supply_brands = d;\r\n    });\r\n}\r\n\r\nfunction displayUnitDescriptions(){\r\n    $("select[name=''p_supply_brand_id[]'']").each(function(){\r\n        var td = $(this.parentNode).next();\r\n        var input =  td.children("input[name=''p_unit_conv_id[]'']");\r\n        var val = $(this).attr("selectedvalue");\r\n        $.each(supply_brands,function(){\r\n            if (this.supply_brand_id == val){\r\n                input.val(this.cu_desc);\r\n                return;\r\n            }\r\n        });\r\n    });\r\n}\r\n\r\nfunction markMandatory(){\r\n    zsi.form.markMandatory({       \r\n      "groupNames":[\r\n            {\r\n                 "names" : ["p_po_no","p_po_date","p_supplier_id","p_loc_id"]\r\n                ,"type":"S"\r\n            }             \r\n            ,{\r\n                 "names" : ["p_po_qty[]","p_supply_brand_id[]","p_unit_price[]"]\r\n                ,"type":"M"\r\n                ,"required_one":"Y"            \r\n            }\r\n      ]      \r\n      ,"groupTitles":[ \r\n             {"titles" :["P.O No.","Date","Supplier","Location"]}\r\n            ,{"titles" :["Quantity","Supply","Unit Price"]}\r\n      ]\r\n   });\r\n   \r\n}\r\nfunction getUnpostedPO(){\r\n    \r\n    $.getJSON(base_url + "purchase_order/getdata_json/",function(data){\r\n        $.each(data,function(){\r\n            var params = {\r\n                 po_id: this.po_id\r\n                ,po_no: this.po_no\r\n                ,po_date: this.po_date\r\n                ,loc_id: this.loc_id\r\n                ,supplier_id:this.supplier_id\r\n            };\r\n            var removeicon = "<a class=''glyphicon glyphicon-remove-sign poRemove'' onclick=''removePO(" + this.po_id  + ");'' href=''javascript:void(0);''></a>";\r\n            $(".list-group").append("<a href=''javascript:void(0);'' onclick=''displayDetails("   + JSON.stringify(params) +  ");'' class=''list-group-item'' >" + this.po_no + "</a>" + removeicon);\r\n        });\r\n        \r\n    });\r\n\r\n}\r\n\r\nfunction removePO(id){\r\n    console.log(id);\r\n}\r\n\r\nfunction initInputs(){\r\n    po_id = $("#p_po_id");\r\n    po_no = $("#p_po_no");\r\n    po_date = $("#p_po_date");\r\n    loc_id = $("#p_loc_id");\r\n    supplier_id = $("#p_supplier_id");    \r\n}\r\n\r\nfunction displayDetails(p){\r\n    po_id.val(p.po_id).change();\r\n    po_no.val(p.po_no).change();\r\n    po_date.val(p.po_date).change();\r\n    loc_id.val(p.loc_id).change();\r\n    supplier_id.val(p.supplier_id).change();\r\n\r\n    displayRecords(p.po_id);\r\n}\r\n\r\nfunction displayRecords(id){       \r\n    var bs = zsi.bs.ctrl;    \r\n    //var inputCls = "form-control input-sm";\r\n    zsi.json.loadGrid({\r\n         table  : "#grid"\r\n        ,url   : base_url + "purchase_order/getdata_dtls_json/" + id\r\n        ,td_body: [ \r\n            function(d){\r\n                return     bs({name:"po_dtls_id[]",type:"hidden",value: d.po_dtls_id})\r\n                        +  bs({name:"cb[]",type:"checkbox"});\r\n\r\n            }            \r\n            ,function(d){ return bs({name:"supply_brand_id[]",type:"select",value:d.supply_brand_id}); }\r\n            ,function(d){ return bs({name:"unit_conv_id[]"}); }\r\n            ,function(d){ return bs({name:"po_qty[]",value:d.po_qty,class:"form-control numeric"}); }\r\n            ,function(d){ return bs({name:"unit_price[]",value:d.unit_price,class:"form-control numeric"});  }\r\n            ,function(d){\r\n                var total = (d.unit_price!==null?d.unit_price:0 )  * (d.po_qty!==null?d.po_qty:0)\r\n                return bs({name:"total[]",value:total.toFixed(2)});  \r\n                \r\n            }\r\n        ]\r\n        ,onComplete : function(){\r\n            displayUnitDescriptions();\r\n            displayBlankRows(false);\r\n        }\r\n    });    \r\n}\r\n\r\nfunction onSupplyBrandChange(){\r\n    \r\n    $("select[name=''p_supply_brand_id[]'']").change(function(){\r\n        var td = $(this.parentNode).next();\r\n        var input =  td.children("input[name=''p_unit_conv_id[]'']");\r\n        var selVal = this.value;\r\n        \r\n        $.each(supply_brands,function(){\r\n            if (this.supply_brand_id == selVal){\r\n                input.val(this.cu_desc);\r\n                return;\r\n            }\r\n        });\r\n\r\n    });\r\n    \r\n}\r\n\r\nfunction displayBlankRows(p_isNew){       \r\n    var bs = zsi.bs.ctrl;    \r\n    //var inputCls = "form-control input-sm";\r\n    zsi.json.loadGrid({\r\n         table  : "#grid"\r\n        ,isNew  : p_isNew\r\n        ,td_body: [ \r\n            function(d){\r\n                return     bs({name:"po_dtls_id[]",type:"hidden"})\r\n                        +  bs({name:"select[]",type:"checkbox"});\r\n\r\n            }            \r\n            ,function(d){ return bs({name:"supply_brand_id[]",type:"select"}); }\r\n            ,function(d){ return bs({name:"unit_conv_id[]"}); }\r\n            ,function(d){ return bs({name:"po_qty[]",class:"form-control numeric"}); }\r\n            ,function(d){ return bs({name:"unit_price[]",class:"form-control numeric"});  }\r\n            ,function(d){ return bs({name:"total[]"});  }\r\n        ]\r\n        ,onComplete : function(){\r\n            ctrlSel( base_url + "select_options/code/supply_brands","select[name=''p_supply_brand_id[]'']","","N");\r\n            onSupplyBrandChange();\r\n            markMandatory();\r\n            $("input[name=''p_po_qty[]''],input[name=''p_unit_price[]'']").change();\r\n            setTotalEvent();\r\n            zsi.initInputTypesAndFormats();\r\n        }\r\n    });    \r\n}\r\n\r\n\r\n', NULL, '2015-06-10 10:14:49', 2, '2015-06-20 09:44:05'),
(25, 37, 'select_options/index', '\r\n$(document).ready(function(){\r\n    $("#frm").attr("action",base_url + "select_options/update").attr("method","post");\r\n    \r\n    var bsButton = zsi.bs.button;\r\n    $(".buttonGroup").append( \r\n          bsButton({name:"Save",type:"submit"})\r\n        + bsButton({name:''Delete'',onclick:"checkDelete(''"  +  base_url  + "select_options/delete'');"}) \r\n    );\r\n\r\n    displayRecords();\r\n});\r\n\r\nfunction displayRecords(){       \r\n    var bs = zsi.bs.ctrl;    \r\n    //var inputCls = "form-control input-sm";\r\n    zsi.json.loadGrid({\r\n         table  : "#grid"\r\n        ,url   : base_url + "select_options/getdata_json/"\r\n        ,td_body: [ \r\n            function(d){\r\n                return     bs({name:"select_id[]",type:"hidden",value: d.select_id})\r\n                        +  bs({name:"cb[]",type:"checkbox"});\r\n\r\n            }            \r\n            ,function(d){ return bs({name:"code[]",value: d.code}); }\r\n            ,function(d){ return bs({name:"table_name[]",value: d.table_name}); }\r\n            ,function(d){ return bs({name:"text[]",value: d.text}); }\r\n            ,function(d){ return bs({name:"value[]",value: d.value}); }\r\n            ,function(d){ return bs({name:"condition_text[]",value: d.condition_text}); }\r\n            ,function(d){ return d.created_by;}\r\n            ,function(d){ return toDate(d.created_date); }\r\n            ,function(d){ return d.updated_by;}\r\n            ,function(d){ return toDate(d.updated_date); }\r\n        ]\r\n        ,onComplete : function(){\r\n            displayBlankRows();\r\n        }\r\n    });    \r\n}\r\n\r\n\r\n\r\nfunction displayBlankRows(){       \r\n    var bs = zsi.bs.ctrl;    \r\n    var inputCls = "form-control input-sm";\r\n    zsi.json.loadGrid({\r\n         table  : "#grid"\r\n        ,td_body: [ \r\n            function(d){\r\n                return     bs({name:"select_id[]",type:"hidden"})\r\n                        +  bs({name:"cb[]",type:"checkbox"});\r\n            }            \r\n            ,function(d){ return bs({name:"code[]",class:inputCls}); }\r\n            ,function(d){ return bs({name:"table_name[]",class:inputCls}); }\r\n            ,function(d){ return bs({name:"text[]",class:inputCls}); }\r\n            ,function(d){ return bs({name:"value[]",class:inputCls}); }\r\n            ,function(d){ return bs({name:"condition_text[]",class:inputCls}); }\r\n            ,function(d){ return "";}\r\n            ,function(d){ return "";}\r\n            ,function(d){ return "";}\r\n            ,function(d){ return "";}\r\n        ]\r\n        ,onComplete : function(){\r\n            //console.log("display done.");\r\n        }\r\n    });    \r\n}\r\n\r\nfunction checkDelete(l_cmd) {\r\n   var l_stmt=[], l_count;\r\n    \r\n   var data = zsi.table.getCheckBoxesValues("input[name=''p_cb[]'']:checked");\r\n    for(var x=0;x<data.length; x++){\r\n        l_stmt.push( { name:"p_del_id[]",value : data[x] }  ); \r\n    }\r\n   if (l_stmt!="") {\r\n      if(confirm("Are you sure you want to delete selected items?")) {\r\n      $.post( l_cmd , l_stmt, function(d){\r\n            window.location.reload();\r\n         }).fail(function(d) {\r\n            alert("Sorry, the curent transaction is not successfull.");\r\n        });\r\n      }\r\n   }\r\nreturn false;\r\n}   \r\n\r\n\r\nfunction toDate(value){\r\n    var result='''';\r\n    if(value!==null){\r\n        var _d = new Date(value.replace(/-/g,"/"));\r\n        result =  (_d.getMonth() + 1) + "/" + _d.getDate() + "/" + _d.getFullYear();\r\n    }\r\n    return result;\r\n}\r\n\r\n \r\n', NULL, '2015-06-15 04:51:28', 2, '2015-06-16 07:18:41'),
(26, NULL, 'brands/index', '//This is system generated. new javascript created.', NULL, '2015-06-15 15:25:15', NULL, NULL),
(28, 2, 'loadmenu', '    $.getJSON(base_url + "menu_types/getdata_json",function(data){         \r\n        var nav = $("#navbar-main");\r\n        var m = ''<ul class="nav navbar-nav">'';        \r\n        $.each(data,function(){ \r\n            var mlength= this.subMenus.length;\r\n            m += ''<li class="dropdown">'';\r\n                m += ''<a data-toggle="dropdown" class="dropdown-toggle" href="#">'' + this.name + ( mlength >0 ? ''<span class="caret"></span>'':'''')  + ''</a>'';            \r\n                if(mlength>0){                    \r\n                    m +=''<ul class="dropdown-menu">'';\r\n                    $.each(this.subMenus,function(){\r\n                         m +=''<li><a href="'' + this.url + ''">'' + this.name + ''</a></li>'';\r\n                    });\r\n                    m +=''</ul>'';\r\n                }            \r\n            m += ''</>'';\r\n        });\r\n        m +=''<url>'';\r\n        nav.append(m);    \r\n    });', NULL, '2015-06-17 04:01:48', 2, '2015-06-17 04:11:39');
INSERT INTO `javascripts` (`js_id`, `version_id`, `page_url`, `content`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(29, 24, 'supply_is/index', 'var ctrlSel = zsi.control.SelectList;  \r\nvar bs = zsi.bs.ctrl;\r\nsetInputs();\r\n$(document).ready(function(){\r\n    ctrlSel( base_url + "select_options/code/store_locs","#p_store_loc_id","","N");\r\n    markMandatory();\r\n});   \r\n$("form[id=frm]").submit(function(){\r\n     if( zsi.form.checkMandatory()!==true) return false;\r\n }); \r\n \r\n function markMandatory(){\r\n    zsi.form.markMandatory({       \r\n      "groupNames":[\r\n            {\r\n                 "names" : ["p_store_loc_id","p_is_no","p_is_date"]\r\n                ,"type":"S"\r\n            }             \r\n            \r\n      ]      \r\n      ,"groupTitles":[ {"titles" :["Location","Issuance No","Date"]}]\r\n   });\r\n   \r\n}\r\n \r\nfunction setInputs(){\r\n    store_loc_id = $("#p_store_loc_id");\r\n    is_no = $("#p_is_no");\r\n    is_date = $("#p_is_date");\r\n    posted = $("#p_posted");\r\n    supply_is_id = $("#p_supply_is_id");\r\n}\r\n\r\nstore_loc_id.change(function(){\r\n    $.getJSON(base_url + "supply_is/get_is_info/" + store_loc_id.val(), function(info){\r\n        supply_is_id.val(info.supply_is_id);\r\n        is_no.val( info.is_no );\r\n        is_date.val( info.is_date );\r\n    });\r\n    \r\n    zsi.json.loadGrid({\r\n         table  : ".table"\r\n        ,url   : base_url + "supply_is/get_detail_json/" + store_loc_id.val() \r\n        ,td_body: [ \r\n            function(d){\r\n                return    bs({name:"supply_is_dtl_id[]",type:"hidden",value: d.supply_is_dtl_id})\r\n                        + bs({name:"supply_brand_id[]",type:"hidden",value: d.supply_brand_id})\r\n                        + bs({name:"cb[]",type:"checkbox"});\r\n            }            \r\n            \r\n            ,function(d){ return d.supply; }\r\n            ,function(d){ return d.cu_desc; }\r\n            ,function(d){ return bs({name:"supply_is_qty[]",value: d.rep_qty}) }\r\n\r\n        ]\r\n        ,onComplete : function(){\r\n            //displayUnitDescriptions();\r\n           // displayBlankRows(false);\r\n        }\r\n    });       \r\n\r\n});\r\n\r\n\r\n \r\n \r\n', NULL, '2015-06-17 09:34:12', 2, '2015-06-20 10:49:22');

--
-- Truncate table before insert `locations`
--

TRUNCATE TABLE `locations`;
--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`loc_id`, `location`, `created_by`, `created_date`, `updated_by`, `updated_date`, `loc_group_id`) VALUES
(1, 'Cebu City', 1, '2015-06-02 17:11:10', 1, '2015-06-10 08:39:52', NULL),
(2, 'Surigao City', 1, '2015-06-02 17:12:23', 1, '2015-06-10 08:39:53', NULL),
(3, 'Tandag City', 1, '2015-06-10 06:21:10', 1, '2015-06-10 08:39:53', NULL),
(4, 'San Carlos City', 1, '2015-06-10 06:25:24', 1, '2015-06-10 08:39:53', NULL),
(5, 'Bogo City', 1, '2015-06-10 08:39:53', NULL, NULL, NULL);

--
-- Truncate table before insert `loc_supplies`
--

TRUNCATE TABLE `loc_supplies`;
--
-- Dumping data for table `loc_supplies`
--

INSERT INTO `loc_supplies` (`loc_supply_id`, `loc_id`, `supply_id`, `stock_qty`, `reorder_level`, `max_level`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 4, 6, NULL, NULL, NULL, 1, '2015-06-10 06:25:24', NULL, NULL),
(2, 4, 7, NULL, NULL, NULL, 1, '2015-06-10 06:25:24', NULL, NULL),
(3, 4, 8, NULL, NULL, NULL, 1, '2015-06-10 06:25:24', NULL, NULL),
(4, 4, 9, NULL, NULL, NULL, 1, '2015-06-10 06:25:24', NULL, NULL),
(5, 4, 10, NULL, NULL, NULL, 1, '2015-06-10 06:25:24', NULL, NULL),
(6, 4, 11, NULL, NULL, NULL, 1, '2015-06-10 06:25:24', NULL, NULL),
(7, 4, 12, NULL, NULL, NULL, 1, '2015-06-10 06:25:24', NULL, NULL),
(8, 4, 13, NULL, NULL, NULL, 1, '2015-06-10 06:25:24', NULL, NULL),
(9, 4, 14, NULL, NULL, NULL, 1, '2015-06-10 06:25:24', NULL, NULL),
(10, 4, 15, NULL, NULL, NULL, 1, '2015-06-10 06:25:24', NULL, NULL),
(11, 4, 16, NULL, NULL, NULL, 1, '2015-06-10 06:25:24', NULL, NULL),
(12, 4, 17, NULL, NULL, NULL, 1, '2015-06-10 06:25:24', NULL, NULL),
(13, 4, 18, NULL, NULL, NULL, 1, '2015-06-10 06:25:24', NULL, NULL),
(14, 5, 6, NULL, 0, 0, 1, '2015-06-10 08:39:53', 2, '2015-06-12 08:27:07'),
(15, 5, 7, NULL, 0, 0, 1, '2015-06-10 08:39:53', 2, '2015-06-12 08:27:07'),
(16, 5, 8, NULL, 0, 0, 1, '2015-06-10 08:39:53', 2, '2015-06-12 08:27:07'),
(17, 5, 9, NULL, 0, 0, 1, '2015-06-10 08:39:53', 2, '2015-06-12 08:27:07'),
(18, 5, 10, NULL, 0, 0, 1, '2015-06-10 08:39:53', 2, '2015-06-12 08:27:07'),
(19, 5, 11, NULL, 0, 0, 1, '2015-06-10 08:39:53', 2, '2015-06-12 08:27:08'),
(20, 5, 12, NULL, 0, 0, 1, '2015-06-10 08:39:53', 2, '2015-06-12 08:27:08'),
(21, 5, 13, NULL, 0, 0, 1, '2015-06-10 08:39:53', 2, '2015-06-12 08:27:08'),
(22, 5, 14, NULL, 0, 0, 1, '2015-06-10 08:39:53', 2, '2015-06-12 08:27:08'),
(23, 5, 15, NULL, 0, 0, 1, '2015-06-10 08:39:53', 2, '2015-06-12 08:27:08'),
(24, 5, 16, NULL, 0, 0, 1, '2015-06-10 08:39:53', 2, '2015-06-12 08:27:09'),
(25, 5, 17, NULL, 0, 0, 1, '2015-06-10 08:39:53', 2, '2015-06-12 08:27:09'),
(26, 5, 18, NULL, 5, 100, 1, '2015-06-10 08:39:53', 2, '2015-06-12 08:27:09'),
(27, 1, 10, NULL, 0, 0, 2, '2015-06-11 08:22:50', 2, '2015-06-16 09:01:11'),
(28, 1, 9, NULL, 33, 300, 2, '2015-06-11 08:22:51', 2, '2015-06-16 09:01:10'),
(29, 1, 8, NULL, 0, 0, 2, '2015-06-11 08:22:51', 2, '2015-06-16 09:01:10'),
(30, 1, 7, NULL, 22, 22, 2, '2015-06-11 08:22:51', 2, '2015-06-16 09:01:10'),
(31, 1, 6, NULL, 1, 11, 2, '2015-06-11 08:22:51', 2, '2015-06-16 09:01:10'),
(32, 1, 11, NULL, 0, 0, 2, '2015-06-11 08:22:51', 2, '2015-06-16 09:01:11'),
(33, 1, 12, NULL, 6, 600, 2, '2015-06-11 08:22:52', 2, '2015-06-16 09:01:11'),
(34, 1, 13, NULL, 0, 0, 2, '2015-06-11 08:22:52', 2, '2015-06-16 09:01:11'),
(35, 1, 14, NULL, 0, 0, 2, '2015-06-11 08:22:52', 2, '2015-06-16 09:01:11'),
(36, 1, 15, NULL, 0, 0, 2, '2015-06-11 08:22:52', 2, '2015-06-16 09:01:12'),
(37, 1, 16, NULL, 3, 33, 2, '2015-06-11 08:22:52', 2, '2015-06-16 09:01:12'),
(38, 1, 17, NULL, 0, 0, 2, '2015-06-11 08:22:53', 2, '2015-06-16 09:01:12'),
(39, 1, 18, NULL, 0, 0, 2, '2015-06-11 08:22:53', 2, '2015-06-16 09:01:12');

--
-- Truncate table before insert `menu`
--

TRUNCATE TABLE `menu`;
--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_url`, `menu_type_id`, `system_id`, `seq_no`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Bank Accounts', 'bank_ref', 1, 2, 10, 1, '2015-06-01 09:58:34', 2, '2015-06-22 04:11:14'),
(2, 'Systems', 'systems', 6, 0, 1, 1, '2015-06-01 10:16:24', 2, '2015-06-22 04:11:14'),
(3, 'Menu Types', 'menu_types', 6, 0, 2, 1, '2015-06-01 10:16:25', 2, '2015-06-22 04:11:14'),
(4, 'Menu ', 'menu', 6, 0, 3, 1, '2015-06-01 10:16:25', 2, '2015-06-22 04:11:14'),
(5, 'Roles', 'roles', 6, 0, 4, 1, '2015-06-01 10:16:25', 2, '2015-06-22 04:11:14'),
(6, 'Users', 'users', 6, 0, 5, 1, '2015-06-01 10:16:25', 2, '2015-06-22 04:11:14'),
(7, 'Cash Denominations', 'denomination_ref', 5, 2, 1, 1, '2015-06-01 11:48:00', 2, '2015-06-22 04:11:14'),
(8, 'Store Franchise', 'stores', 5, 2, 2, 1, '2015-06-01 13:08:08', 2, '2015-06-22 04:11:14'),
(9, 'Store Banches', 'store_loc', 1, 2, 4, 1, '2015-06-01 13:25:45', 2, '2015-06-22 04:11:14'),
(10, 'Warehouse Locations', 'locations', 1, 1, 3, 1, '2015-06-02 17:08:10', 2, '2015-06-22 04:11:14'),
(11, 'Employees', 'employees', 1, 0, 3, 1, '2015-06-02 20:51:08', 2, '2015-06-22 04:11:14'),
(12, 'Positions', 'positions', 5, 0, 3, 1, '2015-06-02 20:51:08', 2, '2015-06-22 04:11:14'),
(13, 'Daily Cash Box', 'store_daily_cash', 2, 0, 0, 1, '2015-06-02 23:34:08', 2, '2015-06-22 04:11:14'),
(14, 'Supply Types', 'supply_types', 5, 0, 4, 1, '2015-06-02 23:45:49', 2, '2015-06-22 04:11:14'),
(15, 'Supplies', 'supplies', 1, 0, 2, 1, '2015-06-02 23:46:07', 2, '2015-06-22 04:11:14'),
(16, 'Units', 'units', 5, 0, 6, 1, '2015-06-03 00:31:25', 2, '2015-06-22 04:11:14'),
(17, 'Unit Conversion', 'conv_units', 5, 0, 7, 1, '2015-06-03 00:31:25', 2, '2015-06-22 04:11:14'),
(18, 'Suppliers', 'suppliers', 1, 0, 1, 1, '2015-06-03 02:39:25', 2, '2015-06-22 04:11:14'),
(19, 'Daily Sent Stocks ', 'supply_is', 2, 0, 0, 1, '2015-06-05 11:09:04', 2, '2015-06-22 04:11:14'),
(20, 'Daily Supplies Used', 'store_daily_sales', 2, 0, 0, 1, '2015-06-05 11:20:54', 2, '2015-06-22 04:11:14'),
(22, 'Bank Deposits', 'bank_deposits', 2, 0, 0, 1, '2015-06-05 11:24:38', 2, '2015-06-22 04:11:14'),
(23, 'Bank Withdrawals', 'bank_withdrawals', 2, 0, 0, 1, '2015-06-05 11:24:38', 2, '2015-06-22 04:11:14'),
(24, 'Log Out', 'users/logout', 6, 0, 50, 1, '2015-06-06 11:00:05', 2, '2015-06-22 04:11:14'),
(26, 'Purchase Order', 'purchase_order', 2, 0, 1, 1, '2015-06-10 07:37:04', 2, '2015-06-22 04:11:14'),
(27, 'Receiving Supplier Deliveries', '', 2, 0, 2, 1, '2015-06-10 07:37:04', 2, '2015-06-22 04:11:14'),
(28, 'Brands', 'brands', 5, 0, 3, 1, '2015-06-10 07:41:15', 2, '2015-06-22 04:11:14'),
(29, 'Select Options', 'select_options', 6, 0, 6, 2, '2015-06-15 09:04:50', 2, '2015-06-22 04:11:14'),
(31, 'Page Templates', 'page_templates', 6, 0, 7, 2, '2015-06-16 09:03:05', 2, '2015-06-22 04:11:14'),
(32, 'Payroll', 'payroll', 2, 0, 20, 2, '2015-06-19 10:58:02', 2, '2015-06-22 04:11:14'),
(34, 'Cash Returns', 'cash_returns', 2, 0, 6, 2, '2015-06-22 04:05:42', 2, '2015-06-22 04:11:14'),
(33, 'Expenses', 'daily_expenses', 2, 0, 40, 2, '2015-06-22 04:04:35', 2, '2015-06-22 04:11:14');

--
-- Truncate table before insert `menu_types`
--

TRUNCATE TABLE `menu_types`;
--
-- Dumping data for table `menu_types`
--

INSERT INTO `menu_types` (`menu_type_id`, `menu_type`, `seq_no`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Manage', 1, 1, '2015-06-01 07:00:38', 1, '2015-06-01 09:29:26'),
(2, 'Transaction', 2, 1, '2015-06-01 07:00:39', 1, '2015-06-01 09:29:26'),
(3, 'Inquiry', 3, 1, '2015-06-01 07:00:39', 1, '2015-06-01 09:29:26'),
(4, 'Report', 4, 1, '2015-06-01 07:00:39', 1, '2015-06-01 09:29:26'),
(5, 'Reference Files', 5, 1, '2015-06-01 07:00:39', 1, '2015-06-01 09:29:27'),
(6, 'System', 6, 1, '2015-06-01 09:29:27', NULL, NULL);

--
-- Truncate table before insert `page_templates`
--

TRUNCATE TABLE `page_templates`;
--
-- Dumping data for table `page_templates`
--

INSERT INTO `page_templates` (`page_template_id`, `page_url`, `content`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'select_options/index', '<form id="frm"  >\r\n    <table id="grid" class="table">    \r\n        <thead>\r\n        <tr>\r\n            <th></th>\r\n            <th>Code</th>\r\n            <th>Table</th>\r\n            <th>Text</th>\r\n            <th>Value</th>\r\n            <th>Condition</th>\r\n            <th>Created By</th>\r\n            <th>Created Date</th>\r\n            <th>Updated By</th>\r\n            <th>Updated Date</th>\r\n        </tr>\r\n        </thead>\r\n    </table>    \r\n    <div class="buttonGroup"></div>\r\n</form>    \r\n', NULL, '2015-06-16 02:26:54', 2, '2015-06-16 04:03:43'),
(2, 'users/index', '<form id="frm"  >\r\n    <table id="grid" class="table">    \r\n        <thead>\r\n        <tr>\r\n            <th></th>\r\n            <th>Employee</th>\r\n            <th>User Name</th>\r\n            <th>Password</th>\r\n            <th>Role</th>\r\n            <th>Active?</th>\r\n            <th>Location Access</th>\r\n        </tr>\r\n        </thead>\r\n    </table>    \r\n    <div class="buttonGroup"></div>\r\n</form>    \r\n', NULL, '2015-06-16 07:28:59', 2, '2015-06-16 07:30:59'),
(3, 'supplies/index', '<form id="frm"  >\r\n    <table id="grid" class="table">    \r\n        <thead>\r\n        <tr>\r\n            <th></th>\r\n            <th>Code</th>\r\n            <th>Description</th>\r\n            <th>Type</th>   \r\n            <th>Item Brands</th>\r\n        </tr>\r\n        </thead>\r\n    </table>    \r\n    <div class="buttonGroup"></div>\r\n</form>    \r\n', NULL, '2015-06-16 09:51:28', 2, '2015-06-16 09:56:09'),
(4, 'bank_ref/index', '', NULL, '2015-06-17 04:07:40', NULL, NULL);

--
-- Truncate table before insert `po`
--

TRUNCATE TABLE `po`;
--
-- Dumping data for table `po`
--

INSERT INTO `po` (`po_id`, `po_no`, `po_date`, `loc_id`, `supplier_id`, `posted`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 224, '2015-06-19 00:00:00', 1, 1, 0, 2, '2015-06-18 09:34:15', 2, '2015-06-19 12:01:37'),
(2, 434, '2015-06-19 00:00:00', 1, 1, 0, 2, '2015-06-19 12:09:04', NULL, NULL),
(3, 232, '2015-06-19 00:00:00', 1, 1, 0, 2, '2015-06-19 13:29:01', NULL, NULL);

--
-- Truncate table before insert `positions`
--

TRUNCATE TABLE `positions`;
--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`position_id`, `position_desc`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Owner', 1, '2015-06-02 20:54:09', NULL, NULL),
(2, 'Manager', 1, '2015-06-02 20:54:09', NULL, NULL),
(3, 'Supervisor', 1, '2015-06-02 20:54:09', NULL, NULL),
(4, 'Sales Staff', 1, '2015-06-02 20:54:09', NULL, NULL);

--
-- Truncate table before insert `po_dtls`
--

TRUNCATE TABLE `po_dtls`;
--
-- Truncate table before insert `receiving`
--

TRUNCATE TABLE `receiving`;
--
-- Truncate table before insert `receiving_dtls`
--

TRUNCATE TABLE `receiving_dtls`;
--
-- Truncate table before insert `roles`
--

TRUNCATE TABLE `roles`;
--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_desc`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Stocks Encoder', 1, '2015-06-02 07:54:37', 1, '2015-06-08 05:33:06'),
(2, 'Executive', 1, '2015-06-02 07:54:37', 1, '2015-06-08 05:33:07'),
(3, 'Manager', 1, '2015-06-02 07:54:59', 1, '2015-06-08 05:33:07'),
(4, 'Supervisor', 1, '2015-06-02 07:55:36', 1, '2015-06-08 05:33:08');

--
-- Truncate table before insert `role_menus`
--

TRUNCATE TABLE `role_menus`;
--
-- Truncate table before insert `sales_summ`
--

TRUNCATE TABLE `sales_summ`;
--
-- Truncate table before insert `sales_supply_summ`
--

TRUNCATE TABLE `sales_supply_summ`;
--
-- Truncate table before insert `select_options`
--

TRUNCATE TABLE `select_options`;
--
-- Dumping data for table `select_options`
--

INSERT INTO `select_options` (`select_id`, `code`, `table_name`, `text`, `value`, `condition_text`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'positions', 'positions', 'position_desc', 'position_id', '', 2, '2015-06-15 04:54:08', 2, '2015-06-18 10:05:14'),
(2, 'locations', 'locations', 'location', 'loc_id', '', 2, '2015-06-15 04:54:08', 2, '2015-06-18 10:05:14'),
(3, 'store_locs', 'store_loc', 'store_loc', 'store_loc_id', '', 2, '2015-06-15 04:54:08', 2, '2015-06-18 10:05:14'),
(5, 'stores', 'stores', 'store_name', 'store_id', '', 2, '2015-06-15 05:33:26', 2, '2015-06-18 10:05:14'),
(6, 'supplies', 'supplies', 'supply_code', 'supply_id', '', 2, '2015-06-15 05:40:11', 2, '2015-06-18 10:05:15'),
(7, 'units', 'units', 'unit_desc', 'unit_id', '', 2, '2015-06-15 05:40:11', 2, '2015-06-18 10:05:15'),
(8, 'systems', 'systems', 'system_name', 'system_id', '', 2, '2015-06-15 05:40:11', 2, '2015-06-18 10:05:15'),
(9, 'supply_types', 'supply_types', 'supply_type', 'supply_type_id', '', 2, '2015-06-15 08:54:54', 2, '2015-06-18 10:05:15'),
(10, 'menu_types', 'menu_types', 'menu_type', 'menu_type_id', '', 2, '2015-06-15 09:02:34', 2, '2015-06-18 10:05:15'),
(11, 'roles', 'roles', 'role_desc', 'role_id', '', 2, '2015-06-15 09:07:50', 2, '2015-06-18 10:05:16'),
(12, 'employees', 'employees', 'empl_name', 'empl_id', '', 2, '2015-06-15 09:08:35', 2, '2015-06-18 10:05:16'),
(13, 'suppliers', 'suppliers', 'supplier_name', 'supplier_id', '', 2, '2015-06-16 03:38:30', 2, '2015-06-18 10:05:16'),
(15, 'conv_units', 'conv_units_v', 'cu_desc', 'conv_id', '', 2, '2015-06-17 07:26:46', 2, '2015-06-18 10:05:16'),
(16, 'supply_brands', 'supply_brands_v', 'supply', 'supply_brand_id', '', 2, '2015-06-17 07:49:39', 2, '2015-06-18 10:05:16');

--
-- Truncate table before insert `stores`
--

TRUNCATE TABLE `stores`;
--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`store_id`, `store_name`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Potato Corner', 1, '2015-06-01 13:10:40', 1, '2015-06-10 08:59:16'),
(2, 'Master Siomai', 1, '2015-06-01 13:10:40', 1, '2015-06-10 08:59:16');


--
-- Truncate table before insert `store_loc`
--

TRUNCATE TABLE `store_loc`;
--
-- Dumping data for table `store_loc`
--

INSERT INTO `store_loc` (`store_loc_id`, `store_loc`, `loc_id`, `store_id`, `active`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(8, 'Gaisano Talamban PC', 1, 1, 1, 2, '2015-06-19 09:02:24', 2, '2015-06-20 07:25:09'),
(9, 'SM Cebu PC', 1, 1, 1, 2, '2015-06-19 09:57:35', 2, '2015-06-20 07:25:09');

--
-- Truncate table before insert `store_loc_supplies`
--

TRUNCATE TABLE `store_loc_supplies`;
--
-- Dumping data for table `store_loc_supplies`
--

INSERT INTO `store_loc_supplies` (`store_loc_supply_id`, `store_loc_id`, `supply_brand_id`, `stock_daily_qty`, `stock_curr_qty`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(16, 8, 8, '5.00', NULL, NULL, NULL, 2, '2015-06-19 09:29:13'),
(15, 8, 7, '5.00', NULL, NULL, NULL, 2, '2015-06-19 09:29:13'),
(14, 8, 6, '50.00', NULL, NULL, NULL, 2, '2015-06-19 09:29:14'),
(13, 8, 1, '50.00', NULL, NULL, NULL, 2, '2015-06-19 09:29:14'),
(12, 8, 2, '50.00', NULL, NULL, NULL, 2, '2015-06-19 09:29:14'),
(11, 8, 3, '50.00', NULL, NULL, NULL, 2, '2015-06-19 09:29:14'),
(10, 8, 4, '50.00', NULL, NULL, NULL, 2, '2015-06-19 09:29:14'),
(9, 8, 5, '50.00', NULL, NULL, NULL, 2, '2015-06-19 09:29:15'),
(17, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 9, 4, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 9, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 9, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Truncate table before insert `store_supplies`
--

TRUNCATE TABLE `store_supplies`;
--
-- Dumping data for table `store_supplies`
--

INSERT INTO `store_supplies` (`store_supply_id`, `store_id`, `supply_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 1, 6, NULL, NULL, NULL, NULL),
(2, 1, 7, NULL, NULL, NULL, NULL),
(3, 1, 8, NULL, NULL, NULL, NULL),
(4, 1, 9, NULL, NULL, NULL, NULL),
(5, 1, 10, NULL, NULL, NULL, NULL),
(6, 1, 11, NULL, NULL, NULL, NULL),
(7, 1, 12, 1, '2015-06-10 08:33:07', NULL, NULL),
(17, 1, 16, 1, '2015-06-10 08:55:00', NULL, NULL),
(39, 1, 18, 2, '2015-06-19 11:34:00', NULL, NULL),
(38, 1, 17, 2, '2015-06-19 11:34:00', NULL, NULL),
(37, 1, 15, 2, '2015-06-19 11:34:00', NULL, NULL),
(36, 1, 14, 2, '2015-06-19 11:34:00', NULL, NULL),
(35, 1, 13, 2, '2015-06-19 11:34:00', NULL, NULL),
(32, 3, 12, 2, '2015-06-12 08:36:14', NULL, NULL),
(33, 3, 13, 2, '2015-06-12 08:36:14', NULL, NULL);

--
-- Truncate table before insert `suppliers`
--

TRUNCATE TABLE `suppliers`;
--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `active`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'ZettaSolutions, Inc.', 1, 1, '2015-06-03 02:41:13', NULL, NULL);

--
-- Truncate table before insert `supplies`
--

TRUNCATE TABLE `supplies`;
--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`supply_id`, `supply_code`, `supply_desc`, `supply_type_id`, `supply_srp`, `created_by`, `created_date`, `updated_by`, `updated_date`, `supply_cost`) VALUES
(10, 'GIGA', '', 1, '169.00', 1, '2015-06-03 03:34:05', 1, '2015-06-09 07:41:39', '14.00'),
(9, 'MEGA', '', 1, '99.00', 1, '2015-06-03 03:34:05', 1, '2015-06-09 07:41:39', '11.00'),
(8, 'JUMBO', '', 1, '79.00', 1, '2015-06-03 03:34:05', 1, '2015-06-09 07:41:39', '7.00'),
(7, 'LARGE', '', 1, '48.00', 1, '2015-06-03 03:34:05', 1, '2015-06-09 07:41:39', '6.00'),
(6, 'REGULAR', '', 1, '33.00', 1, '2015-06-03 03:34:05', 1, '2015-06-09 07:41:39', '5.00'),
(11, 'TERA', '', 1, '199.00', 1, '2015-06-03 03:39:17', 1, '2015-06-09 07:41:39', '16.00'),
(12, 'FRIES', '', 3, '0.00', 1, '2015-06-03 03:39:17', 1, '2015-06-09 07:41:39', '480.00'),
(13, 'OIL', '', 3, '0.00', 1, '2015-06-03 03:39:17', 1, '2015-06-09 07:41:39', '999.99'),
(14, 'CHEESE', '', 2, '0.00', 1, '2015-06-03 03:39:17', 1, '2015-06-09 07:41:39', '200.00'),
(15, 'BBQ', 'BARBECUE', 2, '0.00', 1, '2015-06-03 03:39:18', 1, '2015-06-09 07:41:39', '200.00'),
(16, 'SR CRM', 'SOUR CREAM', 2, '0.00', 1, '2015-06-03 03:42:18', 1, '2015-06-09 07:41:39', '200.00'),
(17, 'CHEDDR', 'CHEDDAR ', 2, '0.00', 1, '2015-06-03 03:42:18', 1, '2015-06-09 07:41:39', '200.00'),
(18, 'SWT CRN', 'SWEEN CORN', 2, '0.00', 1, '2015-06-03 03:42:18', 1, '2015-06-09 07:41:39', '200.00');

--
-- Truncate table before insert `supply_adj`
--

TRUNCATE TABLE `supply_adj`;
--
-- Truncate table before insert `supply_brands`
--

TRUNCATE TABLE `supply_brands`;
--
-- Dumping data for table `supply_brands`
--

INSERT INTO `supply_brands` (`supply_brand_id`, `brand_id`, `supply_id`, `conv_id`, `supply_cost`, `supply_srp`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 1, 10, 4, '15.00', '150.00', 2, '2015-06-18 10:05:46', 2, '2015-06-20 06:58:48'),
(2, 1, 9, 4, '0.00', '120.00', 2, '2015-06-18 10:05:55', 2, '2015-06-20 06:58:38'),
(3, 1, 8, 4, '0.00', '0.00', 2, '2015-06-18 10:06:01', NULL, NULL),
(4, 1, 7, 4, '0.00', '0.00', 2, '2015-06-18 10:06:10', NULL, NULL),
(5, 1, 6, 4, '0.00', '0.00', 2, '2015-06-18 10:06:19', NULL, NULL),
(6, 1, 11, 4, '16.00', '0.00', 2, '2015-06-18 10:06:39', 2, '2015-06-19 11:47:47'),
(7, 2, 12, 1, '450.00', '0.00', 2, '2015-06-18 10:06:48', 2, '2015-06-18 10:07:10'),
(8, 3, 12, 2, '550.00', '0.00', 2, '2015-06-18 10:07:10', NULL, NULL),
(9, 1, 15, 3, '100.00', '0.00', 2, '2015-06-19 11:45:15', NULL, NULL),
(10, 1, 16, 3, '100.00', '0.00', 2, '2015-06-19 11:45:27', NULL, NULL),
(11, 1, 17, 3, '100.00', '0.00', 2, '2015-06-19 11:45:39', NULL, NULL),
(12, 1, 18, 3, '100.00', '0.00', 2, '2015-06-19 11:45:54', NULL, NULL),
(13, 1, 14, 3, '100.00', '0.00', 2, '2015-06-19 11:47:07', NULL, NULL),
(14, 1, 13, 3, '150.00', '0.00', 2, '2015-06-19 11:47:24', NULL, NULL);

--
-- Truncate table before insert `supply_is`
--

TRUNCATE TABLE `supply_is`;
--
-- Dumping data for table `supply_is`
--

INSERT INTO `supply_is` (`supply_is_id`, `is_no`, `is_date`, `store_loc_id`, `posted`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 34234, '2015-06-17 00:00:00', 8, 0, 2, '2015-06-20 10:52:57', 2, '2015-06-20 10:55:56'),
(2, 23232, '2015-06-20 00:00:00', 8, 0, 2, '2015-06-22 04:10:24', NULL, NULL);

--
-- Truncate table before insert `supply_is_dtl`
--

TRUNCATE TABLE `supply_is_dtls`;
--
-- Dumping data for table `supply_is_dtl`
--

INSERT INTO `supply_is_dtls` (`supply_is_dtl_id`, `supply_is_id`, `supply_is_qty`, `supply_brand_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 2, '5.00', 7, 2, '2015-06-20 10:52:57', 2, '2015-06-22 04:10:24'),
(2, 2, '5.00', 8, 2, '2015-06-20 10:52:57', 2, '2015-06-22 04:10:24'),
(3, 2, '50.00', 1, 2, '2015-06-20 10:52:58', 2, '2015-06-22 04:10:24'),
(4, 2, '2.00', 2, 2, '2015-06-20 10:52:58', 2, '2015-06-22 04:10:24'),
(5, 2, '3.00', 3, 2, '2015-06-20 10:52:58', 2, '2015-06-22 04:10:24'),
(6, 2, '50.00', 4, 2, '2015-06-20 10:52:58', 2, '2015-06-22 04:10:24'),
(7, 2, '50.00', 5, 2, '2015-06-20 10:52:58', 2, '2015-06-22 04:10:24'),
(8, 2, '50.00', 6, 2, '2015-06-20 10:52:59', 2, '2015-06-22 04:10:24');


--
-- Truncate table before insert `supply_types`
--

TRUNCATE TABLE `supply_types`;
--
-- Dumping data for table `supply_types`
--

INSERT INTO `supply_types` (`supply_type_id`, `supply_type`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Product', 1, '2015-06-03 00:25:04', 1, '2015-06-09 07:32:14'),
(2, 'Flavoring', 1, '2015-06-03 00:25:04', 1, '2015-06-09 07:32:14'),
(3, 'Supply', 1, '2015-06-03 03:53:59', 1, '2015-06-09 07:32:14'),
(4, 'Utensils', 1, '2015-06-09 07:32:14', NULL, NULL),
(5, 'Cockwares', 1, '2015-06-09 07:32:14', NULL, NULL);

--
-- Truncate table before insert `systems`
--

TRUNCATE TABLE `systems`;
--
-- Dumping data for table `systems`
--

INSERT INTO `systems` (`system_id`, `system_name`, `system_desc`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Inventory', '', 1, '2015-06-01 07:20:58', 1, '2015-06-01 07:21:07'),
(2, 'Sales', '', 1, '2015-06-01 07:20:58', 1, '2015-06-01 07:21:07');

--
-- Truncate table before insert `units`
--

TRUNCATE TABLE `units`;
--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_sdesc`, `unit_desc`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'PC', 'Piece', 1, '2015-06-03 00:47:16', 1, '2015-06-03 00:47:50'),
(2, 'PK', 'Pack', 1, '2015-06-03 00:47:16', 1, '2015-06-03 00:47:50'),
(3, 'KL', 'Kilograms', 1, '2015-06-03 00:47:16', 1, '2015-06-03 00:47:50'),
(4, 'BX', 'Box', 1, '2015-06-03 00:47:51', NULL, NULL);

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_password`, `user_name`, `empl_id`, `role_id`, `active`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, '', 'gtabinas', 1, 1, 1, 1, '2015-06-02 20:38:44', 2, '2015-06-15 10:08:47'),
(2, 'smager', 'gfuentes', 2, 1, 1, 1, '2015-06-02 20:38:59', 2, '2015-06-15 10:08:47'),
(3, 'lyndon123', 'lmancio', 3, 2, 1, 1, '2015-06-02 20:39:17', 2, '2015-06-15 10:08:47'),
(4, 'ctan123', 'ctan', 4, 2, 1, 1, '2015-06-02 20:39:36', 2, '2015-06-15 10:08:47');

--
-- Truncate table before insert `user_locations`
--

TRUNCATE TABLE `user_locations`;
--
-- Dumping data for table `user_locations`
--

INSERT INTO `user_locations` (`user_loc_id`, `user_id`, `loc_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 1, 1, 2, '2015-06-16 09:41:07', 2, '2015-06-16 09:42:52'),
(3, 1, 5, 2, '2015-06-16 09:42:46', 2, '2015-06-16 09:42:53'),
(4, 4, 1, 2, '2015-06-22 03:20:55', NULL, NULL),
(5, 4, 2, 2, '2015-06-22 03:20:55', NULL, NULL),
(6, 4, 3, 2, '2015-06-22 03:20:55', NULL, NULL),
(7, 4, 4, 2, '2015-06-22 03:20:55', NULL, NULL),
(8, 4, 5, 2, '2015-06-22 03:20:55', NULL, NULL);

