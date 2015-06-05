/* JS Package Names or Namespaces */
   var zsi           = {};
   zsi.form          = {};
   zsi.table         = {};
   zsi.table.dhtmlx  = {};
   zsi.page          = {};
   zsi.control       = {};
   zsi.calendar      = {};
   zsi.url           = {};
   zsi.json          = {};    

/* Prototypes */
Date.prototype.isValid = function () {
    return this.getTime() === this.getTime();
};  

/* Page Initialization */

$(document).ready(function(){

   monitorAjaxResponse();      
   initDatePicker();
   initTabNavigation();
   initFormAdjust();
   initDeleteRecord();
   initInputTypesAndFormats();

});

function monitorAjaxResponse(){
   $(document).ajaxStart(function(){});      

   $( document ).ajaxSend(function(event,request,settings) {
      if(typeof zsi_request_count === 'undefined') zsi_request_count=0;
      zsi_request_count++;
      
      if(zsi._strValueExist(settings.url,"zsi_lib.value_exist") ) return;
      if(zsi._strValueExist(settings.url,"employee_search_json") ) return;      
      
      if(typeof parent.ShowHideProgressWindow !== 'undefined') {
         parent.ShowHideProgressWindow(true);
      }

   });

   $(document).ajaxComplete(function() {
      if(typeof zsi_request_count !== 'undefined'){
         zsi_request_count--;
         if(zsi_request_count==0){
            //console.log("no remaining request");
            CloseProgressWindow();
         }
      }
   });   

   $(document).ajaxSuccess(function(event,request,settings){
      //console.log("zsi.Ajax.Request Status=Success, url: "+ settings.url);
   });      
   
   $(document).ajaxError(function(event, request, settings ){   
      var retryLimit=2;
      var error_url="errors_update";
      var errorObject = {};
      errorObject.event =event;
      errorObject.request =request;
      errorObject.settings =settings;
      
      CloseProgressWindow();

      if( zsi._strValueExist(settings.url,error_url) ){
         console.log("url: " + settings.url);         
         return false;
      }

      if(request.responseText==""){
         console.log("zsi.Ajax.Request Status = %cNo Data (warning!) %c, url: " + settings.url, "color:orange;", "color:#000;");         
         $.post( error_url + "?p_error_type=W&p_error_message=" + escape("No Response Data") + "&p_url="  + escape(settings.url)  , function() {
            console.log( "Warning submited." );
         });
      }
      else{
         console.log("zsi.Ajax.Request Status = %cFailed %c, url: " + settings.url, "color:red;", "color:#000;");
         console.log(errorObject);              


         if(!settings.retryCounter ) settings.retryCounter=0;
         settings.retryCounter++;

         if(settings.retryCounter<=retryLimit){                
            setTimeout(function(){
               console.log("retry#:" + settings.retryCounter);                 
               $.ajax(settings);
            },1000);
         }
         if(settings.retryCounter>retryLimit){
            console.log("retry limit is reached");
            
            $.post( error_url + "?p_error_type=E&p_error_message=" + escape(request.responseText) + "&p_url="  + escape(settings.url)  , function() {
               console.log( "Error submited." );
               if(typeof parent.ShowHideErrorWindow !== 'undefined'){
                  parent.ShowHideErrorWindow(true);                  
                  setTimeout(function(){
                     parent.ShowHideErrorWindow(false);
                  },5000);                        
                  
               }

            });
            
         }
        

      }
   });         
   
   function CloseProgressWindow(){
      setTimeout(function(){
         if(typeof zsi_request_count!=='undefined'){
            if(zsi_request_count<=0){
               if(typeof parent.ShowHideProgressWindow !== 'undefined')  parent.ShowHideProgressWindow(false);
               zsi_request_count=0;
            }
         }
      },1000);      
   }
}

function initDatePicker(){
   var inputDate =$('[id*=date]');

   inputDate.attr("placeholder","mm/dd/yyyy");
     //console.log( inputDate.css("width") ) ;
   
   
   if(inputDate.length > 0){
      
      inputDate.datepicker({
              format: 'mm/dd/yyyy'
              ,autoclose:true
      }).on('show', function(e){

          var dhtmlxForm=$(".dhtmlx_skin_dhx_skyblue .form-horizontal");

           var l_dp     = $('.datepicker');

           if(dhtmlxForm.length>0){
              var l_window = $(document); //$(parent.w1)
              var l_offset = $(this).offset();
              var l_left="";
              var l_top="";
              if(l_offset.left>l_window.width() - l_dp.width())
                  l_left=parseInt(l_offset.left - l_dp.width()) + "px";
              else
                  l_left=parseInt(l_offset.left) + "px";

              if(l_offset.top>l_window.height()- (l_dp.height()+100))
                  l_top= parseInt(l_offset.top - l_dp.height()-18 ) + "px";
              else
                  l_top=parseInt(l_offset.top + ($(this).height()*2) ) + "px";

              l_dp.css({top:l_top, left:l_left});
           }


           var highest = -999;

           $("*").each(function() {
               var current = parseInt($(this).css("z-index"), 10);
               if(current && highest < current) highest = current;
           });

           l_dp.css("z-index",highest + 1);


      });
   }
      
   inputDate.keyup(function(){      
         if(this.value.length==2 || this.value.length==5 ) this.value += "/";
   });
   
   
}


function initTabNavigation(){
   $(".nav-tabs li").each(function(){
      $(this).click(function(){
         $(".nav-tabs li").removeClass("active");
         $(this).addClass("active" );
          var l_a=$(this).children("a")[0];
          $("#p_tab").val(l_a.id);          
          var l_clsTabPagesName =".tab-pages";
          var l_tab = $( l_clsTabPagesName + " #" + l_a.id);

          l_tab.parent().children().each(function(){
            $(this).removeClass("active");
          });
          l_tab.addClass("active" );
          
      });

   });
}

function initFormAdjust(){
   /*adjustment form with search*/
   var searchIcon=$(".form-group .glyphicon-search");
   if(searchIcon.length>0){
      $(document.body).css("margin-left","10px");
      $(document.body).css("margin-right","10px");
   }
}

function initDeleteRecord(){
   $("a[id=delete-row]").click(function(){
      var value = $(this).attr("value");
      var table = $(this).attr("table");
      var tr = $(this.parentNode.parentNode);

      if(confirm("Are you sure you want to delete this Item?")) {
         $.post("s004_delete?p_table=" + table + "&p_field=seq_no&p_value=" + value,
            function(d){
               tr.remove();
               if(zsi.table.onDeleteRow) zsi.table.onDeleteRow();
            }).fail(function(d) {
               alert("Sorry, the curent transaction is not successfull.");
         });
      }

   });
}

function initInputTypesAndFormats(){
   $(".numeric").keypress(function(event){
   
         return zsi.form.checkNumber(event,'.,');
   });
    
   $(".format-decimal").blur(function(){
              var obj= this;
              zsi.form.checkNumberFormat(this);
       
   });
}


/*--[ common functions]---------------------------------------------------------------------*/
   zsi._strValueExist=function(source,value){
      var _result=false;
      var i = source.toLowerCase().indexOf(value.toLowerCase());
      if (i>-1) _result=true;
      return _result;
   }
      

/*--[zsi.table]------------------------------------------------------------------------------*/

   zsi.table.getCheckBoxesValues = function(){
/*Example:
  [3-parameters]:
  var x= zsi.table.getCheckBoxesValues("input[name=p_cb]:checked","p_del_ds=","&");
   result: p_del_ds=1031&p_del_ds=1032&p_del_ds=1027

  [1-parameters]:
  var x= zsi.table.getCheckBoxesValues("input[name=p_cb]:checked");
  result:  ["1031", "1027"]

*/
    var args = arguments;
    var result=null;
    var _hidden= "input[type=hidden]";
    switch(args.length) {
      case 1: /* return type : Array */
                     var arrayItems = new Array();
                     var i=0;
                  var selectorCheckboxName=args[0];
                     $(selectorCheckboxName).each(function(){
                           arrayItems[i]=$(this.parentNode).children(_hidden).val();
                           i++;
                     });
                     result = arrayItems;
                  break;

      case 3: /* return type : string */
                  var params="";
                  var selectorCheckboxName=args[0];
                  var parameterValue         =args[1];
                  var separatorValue         =args[2];

                     $(selectorCheckboxName).each(function(){
                           var _value =   $(this.parentNode).children(_hidden).val();
                           if(_value == undefined) _value = this.value; /* patch for no hidden field*/
                           if(params!="") params = params + separatorValue;
                           params = params + parameterValue + _value;
                     });
                     result = params;
                  break;

      default: break;
    }
   return result;
}
/*------------------------------------------------------------------------------------------*/
/*Example:
   zsi.table.dhtmlx.ResizeGrid(window,mygrid,100);
*/
zsi.table.dhtmlx.ResizeGrid   = function(p_Window,p_dhtmlGrid,p_less_ht){
   var ht=p_Window.innerHeight || p_Window.document.documentElement.clientHeight || p_Window.document.body.clientHeight;
      //ht = ht - 76;
      if (p_less_ht==null) ht = ht - 76;
      else ht = ht - p_less_ht;
   p_dhtmlGrid.enableAutoHeight(true,ht,true);
   p_dhtmlGrid.setSizes();
}

/*Example:
   zsi.table.dhtmlx.Unescape(data,2);
   mygrid.parse(data, "json");
*/
zsi.table.dhtmlx.Unescape   = function(data,col_index){
   $.each(data.rows,function(){
      this.data[col_index]=unescape(this.data[col_index]);
   });
}

/*------------------------------------------------------------------------------------------*/
/*Example:
  <input type="checkbox" name="p_cb" onclick="zsi.table.setCheckBox(this,l_tran_no );">
*/
   zsi.table.setCheckBox = function(obj, cbValue){
   var _hidden= "input[type=hidden]";
      var _input =   $(obj.parentNode).children(_hidden);
      if(_input.attr("type")!='hidden') { alert(_hidden + " not found"); return;}

       if(obj.checked){
            _input.val(cbValue);
      }
      else{
            _input.val("");
      }
   }

/*------------------------------------------------------------------------------------------*/
/*Example:
   var jsonData = $.parseJSON(mygrid.xmlLoader.xmlDoc.responseText);
   zsi.page.DisplayRecordPage(jsonData.page_no,jsonData.page_rows,jsonData.row_count);
*/
zsi.page.DisplayRecordPage   = function(p_page_no,p_rows,p_numrec){
   var l_max_rows       =25;
   var l_last_page    = Math.ceil(p_rows/l_max_rows);
   var l_record_from    = (l_max_rows * (p_page_no-1)) + 1;
   var l_record_to      = parseInt(l_record_from) + parseInt(p_numrec) - 1;

   var l_select         = $("select[name=p_page_no]");
   l_select.clearSelect();
   for(var x=0;x<l_last_page;x++){
      var l_option;
       if (p_page_no==x+1){
             l_select.append("<option selected value='" +  (x+1) + "'>"+ (x+1) +"</option>");
        }
        else{
             l_select.append("<option value='" +  (x+1) + "'>"+ (x+1) +"</option>");

        }

   }

   $("#of").html(' of ' + l_last_page );
   $(".pagestatus").html("Showing records from <i>" + l_record_from + "</i> to <i>" + l_record_to + "</i>");

}
/*------------------------------------------------------------------------------------------*/
/*Example:
  SelectList("common/get_select_data","#p_vaccine_code","=l_vaccine_code","N","S004_T08005","vaccine_code","vaccine_name","");
*/
zsi.control.SelectList = function(p_url,p_selector,p_selval,p_req, p_table,p_value,p_text,p_con,p_onLoadComplete){
   var param = '/' + p_table + '/' +  p_text + '/' +  p_value + '/' +  p_con ;
   $.getJSON(p_url + param, function( data ) {
      if(p_selector instanceof jQuery)
         p_selector.fillSelect(data,p_selval,p_req,p_onLoadComplete);
      else
         $(p_selector).fillSelect(data,p_selval,p_req,p_onLoadComplete);
   });
}
/*--[zsi.calendar]------------------------------------------------------------------------------*/
zsi.calendar.LoadMonths = function(p_select){
   p_select.add(new Option(" ", ""),null);
   var monthNames = [ "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December" ];
   for(var x=0;x<12;x++){
      var l_option = new Option(monthNames[x], x+1);
      p_select.add(l_option, null);
   }
}

zsi.form.checkNumber = function(e) {
   var keynum;
   var keychar;
   var numcheck;
   var allowedStr =''

   for (i=1;i<arguments.length;i++) {
      allowedStr+=arguments[i];
   }
   if (window.event) {
      //IE
      keynum = e.keyCode;
   } else if (e.which) {
      //Netscape,Firefox,Opera
      keynum = e.which;
      if (keynum==8) return true; //backspace
      if (String.charCodeAt(keynum)=="91") return true;
   } else return true;

   keychar = String.fromCharCode(keynum);

   if (allowedStr.indexOf(keychar)!=-1) return true;
      numcheck = /\d/;
      return numcheck.test(keychar);
}

zsi.form.isValidNumberFormat = function(o) {
   var regex = /(?=.)^\$?(([1-9][0-9]{0,2}(,[0-9]{3})*)|[0-9]+)?(\.[0-9]{1,4})?$/;
   var val = o.value;
   if (val!="") {
      var ok = regex.test(val);
       if (ok) 
         return true;
       else 
         return false;
   }
}

zsi.form.checkNumberFormat = function(o){
   if(!zsi.form.isValidNumberFormat(o)){
         alert("Please enter a valid number format.");
         setTimeout(function(){o.focus()}, 0);
   }
}




zsi.form.__objMandatory;
zsi.form.__objMandatoryGroupIndexValues=[];

zsi.form.__checkMandatory=function(oGroupN, oGroupT,groupIndex){
var e = oGroupN.names;
var d = oGroupT.titles;
var l_irecords=[];
var l_firstArrObj;

zsi.form.__objMandatoryGroupIndexValues[groupIndex]="N";
   for(var x=0;x<e.length;x++){
      var l_obj = document.getElementsByName(e[x]);
     if(l_obj.length > 1){
         /* collect row-index if the row has a value */
         var l_index=0;
         for(var i=0;i<l_obj.length;i++){
            if(l_obj[i].type!="hidden"){
               if(!l_firstArrObj) l_firstArrObj = l_obj[i];
               if($.trim(l_obj[i].value)!="") {
                 l_irecords[l_index]=i;
                 l_index++;
                 zsi.form.__objMandatoryGroupIndexValues[groupIndex]="Y";
               }
            }
         }

     }else{ /* single */
         if(l_obj[0]){
            if(l_obj[0].value==undefined || $.trim(l_obj[0].value)==""){
               l_obj[0].focus();
               alert("Enter " + d[x] + ".");
               return false;
            }
         }
     }

   }
  /* multiple */
   if(oGroupN.type=="M"){
      if(oGroupN.required_one){
         if(oGroupN.required_one=="Y"){
            if(l_irecords.length==0){
               alert("Please enter at least 1 record.");
               if(l_firstArrObj) l_firstArrObj.focus();
               return false;
            }
         }
      }
      for(var x=0;x<e.length;x++){
         var l_obj = document.getElementsByName(e[x]);
         if(l_obj.length > 1){
            for(var i=0;i<l_irecords.length;i++){
               if(l_obj[l_irecords[i]].type!="hidden"){
                  if($.trim(l_obj[l_irecords[i]].value)=="") {
                    l_obj[l_irecords[i]].focus();
                    alert("Enter " + d[x] + ".");
                    return false;
                  }
               }
            }
         }
      }
   }

   return true;
 }

/* Mandatory: public function(s) */
zsi.form.checkMandatory=function(){
   var l_om = zsi.form.__objMandatory;
   for(var x=0;x < l_om.groupNames.length;x++){  /*loop per group objects*/
      if (!zsi.form.__checkMandatory( l_om.groupNames[x], l_om.groupTitles[x], x ))
         return false;
   }

   /*check  required one indexes */
   if(l_om.required_one_indexes){
      var roi=l_om.required_one_indexes;
      var mgiv = zsi.form.__objMandatoryGroupIndexValues;
      var countNoRecords=0;
      for(var x=0;x < roi.length;x++){
         for(var y=0;y < mgiv.length;y++){
            if(roi[x]==y){
               if(mgiv[y]=="N") countNoRecords++;
            }
         }
      }

      if(roi.length == countNoRecords){
         alert("Please enter at least one record.");
         return false;
      }
   }

   return true;
}

zsi.form.markMandatory=function(om){
zsi.form.__objMandatory=om;

for(var x=0;x<om.groupNames.length;x++){
   if(om.groupNames[x].names.length!=om.groupTitles[x].titles.length){
      alert("Error!, parameters are not equal.");
      return false;
   }
}


var e;

setTimeout(function(){
   for(var gn=0;gn< om.groupNames.length;gn++){  /*loop per groupNames*/
      e = om.groupNames[gn].names;

      var border ="solid 2px #F3961C";
      for(var x=0;x< e.length;x++){
         var elements = document.getElementsByName(e[x]);
         if(elements.length == 1){ /* single */
            var o=$("#" + e[x]);
            changeborder(o[0],border);
            o.on('change keyup blur', function() {
               changeborder(this,border);
            });

         }else{ /* multiple */
         $("*[name='" +  e[x] + "'][type!=hidden]").each(function(){
            changeborder(this,border);
            $(this).on('change keyup blur', function() {
               if($(this).val()!=""){
                  $("*[name='" +  this.name + "'][type!=hidden]").each(function(){
                     $(this).css("border","solid 1px #ccc");
                  });
               }
               else{
                  /* check input elements if there's a value */
                  var hasValue=false;
                  $("*[name='" +  this.name + "'][type!=hidden]").each(function(){
                      if($(this).val()!="") hasValue=true;
                  });

                  /* start changing border */
                  $("*[name='" +  this.name + "'][type!=hidden]").each(function(){
                     if(hasValue){
                        $(this).css("border","solid 1px #ccc");
                     }
                     else{
                        $(this).css("border-left",border);
                        $(this).css("border-right",border);
                     }
                  });

               }
            });

         });

         }
      }
   } /* end of group loop */

},3000);

   function changeborder(o,border){
      jo = $(o);
      if(jo.val() == undefined || jo.val()==""){
         jo.css("border-left",border);
         jo.css("border-right",border);
      }else{
         jo.css("border","solid 1px #ccc");
      }
   }

}

/* ----[ End Mandatory ]-----  */

 zsi.form.checkDate=function(e, d){
 var l_format_msg=" must be in [mm/dd/yyyy] format.";
    for(var x=0;x<e.length;x++){
       var l_obj = document.getElementsByName(e[x]);

      if(l_obj.length > 1){
          /* multiple */
          var l_index=0;
          for(var i=0;i<l_obj.length;i++){
             if(l_obj[i].type!="hidden"){
                if($.trim(l_obj[i].value)!=""){
                   if( isValidDate(l_obj[i].value)!=true){
                      alert(d[x] + l_format_msg);
                      l_obj[i].focus();
                      return false;
                   }
                }
             }
          }

      }
      else{ /* single */
         if(l_obj[0]){
            if($.trim(l_obj[0].value)!=""){
               if( isValidDate(l_obj[0].value)!=true){
                 alert(d[x] + l_format_msg);
                 l_obj[0].focus();
                 return false;
               }
            }
         }

      }

    }

    return true;
  }


 function isValidDate(l_date){
    var comp = l_date.split('/');
    var m = parseInt(comp[0], 10);
    var d = parseInt(comp[1], 10);
    var y = parseInt(comp[2], 10);
    var date = new Date(y,m-1,d);
    if (date.getFullYear() == y && date.getMonth() + 1 == m && date.getDate() == d) {
      return true;
    }
    else {
      return false;
    }
}

zsi.form.setCriteria=function(p_inputName,p_desc, p_result){
   var input = $(p_inputName);
   if (input.prop("tagName")=="SELECT"){
      if(input.find(":selected").text()){
         if (p_result!="") p_result += ", ";
         p_result += p_desc + ": " +  input.find(":selected").text();
      }
   }
   else{
      if(input.val()){
         if (p_result!="") p_result += ", ";         
         p_result += p_desc + ":" + input.val(); 
      }
   }
   return p_result;
}


zsi.form.showAlert= function(p_event,p_class){   
   var box = $("." + p_class);         
   box.css("top", p_event.pageY - box.outerHeight() - 25).css("left", p_event.pageX - (box.outerWidth() /  2) );
   box.show();         
   setTimeout(function(){
      box.hide("slow");

   }, 500);
             
}


/*--[zsi.url]------------------------------------------------------------------------------*/

zsi.url.getQueryValue = function (source,keyname) {
   source = source.toString().toLowerCase(); 
   keyname = keyname.toLowerCase();
   var qLoc =  source.indexOf("?");   
   if(qLoc>-1) source=source.substr(qLoc+1);
   if (source.indexOf("&") > -1){ 
      var vars = source.split("&");
      for (var i=0;i<vars.length;i++) {
         var pair = vars[i].split("=");
         if (pair[0] == keyname) {

            return pair[1];
         }
      }
   }
   else{
      var pair = source.split("=");
      if (pair[0] == keyname) {
         return pair[1];
      }      
   }   
   return ""
}

zsi.url.removeQueryItem = function (source,keyname) {
   source = source.toString().toLowerCase(); 
   keyname = keyname + "".toLowerCase();
   var qLoc =  source.indexOf("?");   
   if(qLoc>-1) source=source.substr(qLoc+1);
   var result = "";

   if (source.indexOf("&") > -1){ 
      var pairs = source.split("&");
      for (var i=0;i<pairs.length;i++) {
          var l_keyname = pairs[i].split("=")[0];         
         if(l_keyname !=keyname){ 
            if(result)  result +="&"; 
            result += pairs[i];
         }
         
      }
   }

   return result;
}

/*--[zsi.json]------------------------------------------------------------------------------*/

zsi.json.groupByColumnIndex = function(data,column_index){
   var _result ={};
   var _group=[];

      $.each(data.rows, function () {
            var _value = this.data[column_index];
          if ($.inArray(_value, _group)==-1) {
            _group.push(_value);
            _result[_value]= [] 
         }
         _result[_value].push(this.data);

   });
   return _result;
}  


zsi.json.checkValueExist = function(p_url, p_target,p_table, p_field){  
   $(p_target).keyup(function(){
      var l_obj=this;
      if($.trim(this.value)==""){
         showPopup(l_obj,false);                  
         return false;
      }
      var l_value=$.trim(this.value);
      if(zsi.timer) clearTimeout(zsi.timer);
      zsi.timer = setTimeout(function(){              
         $(l_obj).addClass("loadIconR" );
         $.getJSON(p_url + "/" + p_table + "/" +  p_field + "/" +  l_value
            , function(data) {
                  $(l_obj).removeClass("loadIconR" );
                  if(data.exist){
                     showPopup(l_obj,true);                  
                  }
                  else{
                     showPopup(l_obj,false);                  
                  }
              }

         );

      }, 1000);         
   
   });
   
   function showPopup(o,isShow){
      if(isShow){
         $(o.parentNode).addClass("has-error");
         $(o).popover({
                 placement  : 'right'
                ,content    : 'Data already exist.'
         });

         $(o).popover('show');         
      }
      else{
         $(o.parentNode).removeClass("has-error");
         $(o).popover('destroy');
      }
   }
}
     
zsi.json.loadGrid = function(){  
    var l_table         = arguments[0];
    var l_url           = arguments[1];
    var l_td_body       = arguments[2];
    var l_td_properties = arguments[3];
    
    var l_grid = $(l_table);
    l_grid.clearGrid();        
    $.getJSON(l_url
           ,function(data){
                 $.each(data, function () {
                    var r = ""
                    r +="<tr>";
                        for(var x=0;x<l_td_body.length;x++){
                            var l_prop='';
                            if (typeof l_td_properties !== "undefined"){
                                if (typeof l_td_properties[x] !== "undefined") l_prop = l_td_properties[x]; 
                            } 
                            r +="<td " + l_prop + " >" + l_td_body[x](this) + "</td>";                                                         
                        }
                    r +="</tr>";                         

                     l_grid.append(r);
                 });
            }
    );    
}    

/*----[ extended-JQuery Function ]--------------------------------------------------------------*/

$.fn.clearSelect = function() {

    if(this.length>1){
       $(this).each(function(){
           _clear(this);
       });
    }
    else if(this.length==1){
       _clear(this[0]);
    }


   function _clear(o){
       if (o) {
           if (o.tagName.toLowerCase() == "select") {
               o.options.length = 0;
           }
       }
   }

}

$.fn.fillSelect = function(data,p_selval,p_req,p_onLoadComplete) {
    this.clearSelect();

    if(this.length>1){
       $(this).each(function(){
           _load(this);
       });
    }
    else if(this.length==1){
       _load(this[0]);
    }

   function _load(ddl){
          var reqIndex=0;
       if (ddl) {
           if (ddl.tagName.toLowerCase() == 'select') {
               if(p_req=="N"){
                  var l_option_blank = new Option("", "");
                  ddl.add(l_option_blank, null);
                  reqIndex=1;
               }
               $.each(data, function(index, optionData) {
                  var l_option = new Option(unescape(optionData.text), optionData.value);
                  ddl.add(l_option, null);
                  if(optionData.value==p_selval){
                     ddl.selectedIndex=parseInt(index + reqIndex );
                  }
               });

               var selval = $(ddl).attr("selectedvalue");
               if(selval){
                     $(ddl).children("option").each(function(i){
                        if (selval==this.value){
                           ddl.selectedIndex = i;
                           return false;
                        }
                     });
               }
               $(ddl).removeAttr("selectedvalue");

               if(p_onLoadComplete) {
                  ddl.LoadComplete = p_onLoadComplete;
                  ddl.LoadComplete();
               }

           }
       }

   }




}

$.fn.clearGrid = function() {
    var t = $($(this).children("tbody")).children("tr");
    t.each(function() {
        var th = $(this).children()[0];
        if (th.tagName.toLowerCase() != "th") {
            $(this).remove();
        }
    });
}


$.fn.serializeExclude = function(p_arr_exclude) {
  var _arr =  this.serializeArray();
   var str = '';
   $.each(_arr, function(i,data){
      if ($.inArray(data['name'].toLowerCase(), p_arr_exclude)==-1) {
         str += (str == '') ? data['name'] + '=' + data['value'] : '&' + data['name'] + '=' + data['value'];
      }
   });
   
   return str;  

}


/*------------------------------------------------------------------------------------------*/

