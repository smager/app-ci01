/* JS Package Names or Namespaces */
var zsi           = {};
zsi.config        = {};
zsi.form          = {};
zsi.table         = {};
zsi.table.dhtmlx  = {};
zsi.page          = {};
zsi.control       = {};
zsi.calendar      = {};
zsi.url           = {};
zsi.json          = {};
zsi.bs            = {};

var ud='undefined';   

/* Prototypes */
Date.prototype.isValid = function () {
    return this.getTime() === this.getTime();
};  
Date.prototype.toShortDate = function () {
    var m =  (this.getMonth()+1) + "";
    var d = this.getDate() + "";
    m = (m.length==1? "0"+m:m);
    d = (d.length==1? "0" +d:d);
    return m + '/' + d + '/' +  this.getFullYear();
};  
String.prototype.toDateFormat = function () {
    var val="";
    if(this.indexOf("-") >-1 ){
        aDate = this.substr(0,10).split("-");
        val = aDate[1] + "/" + aDate[2] + "/" + aDate[0];
    }else{
        var _date = Date.parse(this);
        if(isNaN(_date)===false )  val = (new Date(_date).toShortDate()) + "";
    }
     return val;
}; 
String.prototype.toMoney = function(){
    var res = "";
    if(isNaN(this)===false) res = parseFloat(this).toMoney();
    return res;
};
Number.prototype.toMoney = function(){
    return this.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
};
/*initialize configuration settings*/
zsi.init =function(o){
     zsi.config =o;
     zsi.monitorAjaxResponse();    
 }
/* Page Initialization */
$(document).ready(function(){
   initDatePicker();
   initTabNavigation();
   initFormAdjust();
   zsi.initInputTypesAndFormats();

});

zsi.ShowHideProgressWindow =  function (isShow){
    var pw = $(".progressWindow");
   if(isShow){
      pw.centerWidth();
      pw.css("display","block");
   }
   else{
      pw.hide("slow");      
   }
 }

zsi.ShowErrorWindow=function(){
    var pw = $(".errorWindow");
    pw.centerWidth();
    pw.css("display","block");
    setTimeout(function(){
            pw.hide("slow");      
    },5000);   
 };

zsi.monitorAjaxResponse = function(){
    $(document).ajaxStart(function(){});      
    $( document ).ajaxSend(function(event,request,settings) {
        if(typeof zsi_request_count === ud) zsi_request_count=0;
        
        var eAW = zsi.config.excludeAjaxWatch;    
        for(var x=0; x<eAW.length;x++){
            if(zsi._strValueExist(settings.url, eAW[x] ) ) return;
        }
        zsi_request_count++;
        zsi.ShowHideProgressWindow(true);
    });

   $(document).ajaxComplete(function(event,request,settings) {
      if(typeof zsi_request_count !== ud){
         zsi_request_count--;
         if(zsi_request_count<=0){
            //console.log("no remaining request");
            CloseProgressWindow();
         }
      }
   });   

   $(document).ajaxSuccess(function(event,request,settings){
      //console.log("zsi.Ajax.Request Status=Success, url: "+ settings.url);
   });      
   
   $(document).ajaxError(function(event, request, settings ){  
      var error_url = (typeof zsi.config.errorUpdateURL!== ud? zsi.config.errorUpdateURL:"")  ;
      var noErrURLMsg = "No error URL found. Error not submitted.";
      var retryLimit=2;
      var errorObject = {};
      errorObject.event =event;
      errorObject.request =request;
      errorObject.settings =settings;
      
      CloseProgressWindow();

      if(error_url){
          if( zsi._strValueExist(settings.url,error_url) ){
             console.log("url: " + settings.url);         
             return false;
          }
      }
      if(typeof zsi.config.sqlConsoleName !== ud){
          if( zsi._strValueExist(settings.url,zsi.config.sqlConsoleName) ){return false;}
      }
      
      if(request.responseText===""){
         console.log("zsi.Ajax.Request Status = %cNo Data (warning!) %c, url: " + settings.url, "color:orange;", "color:#000;");  
        if(error_url==="")
            console.log(noErrURLMsg);
        else
             $.post( error_url + "?p_error_type=W&p_error_message=" + escape("No Response Data") + "&p_url="  + escape(settings.url)  , function() {
                console.log( "Warning submited." );
             });
      }
      else{
         console.log("zsi.Ajax.Request Status = Failed %c, url: " + settings.url, "color:red;", "color:#000;");
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
            
            if(error_url===""){
                console.log(noErrURLMsg);
                zsi.ShowErrorWindow();
            }
            else
                $.post( error_url + "?p_error_type=E&p_error_message=" + escape(request.responseText) + "&p_url="  + escape(settings.url)  , function() {
                    console.log( "Error submited." );
                    zsi.ShowErrorWindow();                       
                });
            
         }
        

      }
   });         
   
   function CloseProgressWindow(){
      setTimeout(function(){
         if(typeof zsi_request_count!==ud){
            if(zsi_request_count<=0){
               zsi.ShowHideProgressWindow(false);
               zsi_request_count=0;
            }
         }
      },100);      
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

zsi.initInputTypesAndFormats = function(){
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
                           if(_value == ud) _value = this.value; /* patch for no hidden field*/
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
/*--[zsi.form]------------------------------------------------------------------------------*/
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
            if(l_obj[0].value==ud || $.trim(l_obj[0].value)==""){
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
            //console.log(l_irecords.length);
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
    //clear colored box;
    $("input,select,textarea").not("[type=hidden]").each(function(){
        $(this).css("border","solid 1px #ccc");
    });
    zsi.form.__objMandatory=om;
    for(var x=0;x<om.groupNames.length;x++){
       if(om.groupNames[x].names.length!=om.groupTitles[x].titles.length){
          alert("Error!, parameters are not equal.");
          return false;
       }
    }
    var e;

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

   function changeborder(o,border){
      jo = $(o);
      if(jo.val() == ud || jo.val()==""){
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


zsi.form.showAlert= function(p_class){   
   var box = $("." + p_class);         
   box.center();
   box.show();         
   setTimeout(function(){
      box.hide("slow");

   }, 500);
}

zsi.form.displayLOV = function(p){
    var td_data = [];
    var td_prop;
    
    if(typeof p.show_checkbox===ud) p.show_checkbox=true;
    td_data.push(function(d){
                var isNew = (typeof d ==="ud"?true:false);
                var inputs= '<input name="p_' + p.params[0] + '[]"  type="hidden"  value="' + (isNew!==true?d[p.params[0]]:"") + '">' 
                     + '<input name="p_' + p.params[1] + '[]" type="hidden" value="' + (isNew!==true?d[p.params[1]]:"") + '" >'    
                     + '<input name="p_isCheck[]" type="hidden" value="' +  (isNew!==true?((d[p.params[0]])? 1:0):"")  + '" >';
                if(p.show_checkbox==true)  
                    inputs +='<input name="p_cb[]" onclick="clickCB(this);" class="" type="checkbox" ' + (isNew!==true?((d[p.params[0]])? 'checked':''):"") + '>'
                return inputs;     
    });
    
    td_data = td_data.concat(p.column_data);        
    var params  ={ table : p.table, td_body:td_data}; 
    if(typeof p.url!==ud) params.url=p.url;
    if(typeof p.limit!==ud) params.limit=p.limit;
    if(typeof p.onComplete!==ud) params.onComplete=p.onComplete;
    if(typeof p.isNew!==ud) params.isNew=p.isNew;
    if(typeof p.td_properties!==ud) params.td_properties = p.td_properties;    
    zsi.json.loadGrid(params);
    clickCB = function(o){
            var td = o.parentNode;
            if(o.checked==false) {
                $(td).children("input[name='p_isCheck[]']").val(0);
            }else{
                $(td).children("input[name='p_isCheck[]']").val(1);
            }
    }   
      
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
     
zsi.json.loadGrid = function(o){  
    var isOnEC= (typeof o.onEachComplete !== ud);
    if (isOnEC){    
        var strFunc = o.onEachComplete.toString();
      args = strFunc
      .replace(/((\/\/.*$)|(\/\*[\s\S]*?\*\/)|(\s))/mg,'')
      .match(/^function\s*[^\(]*\(\s*([^\)]*)\)/m)[1]
      .split(/,/);
      var cbName="callback Function";
     if(args.length!=3) 
        console.warn("you must implement these parameters: tr,data,callbackFunc");
     else
        cbName = args[2];
    if(strFunc.indexOf(cbName+"()") < 0 )    
        console.warn("you must call " + cbName + "() before the end of onEachComplete function.");
    }

    var l_grid = $(o.table);
    var num_rows=0;
    var ctr = 0;   
    var oe="odd";
    var trItem= function(data){
        var r = "";
        
        r +="<tr rowObj class='"  + oe + "'>";
            for(var x=0;x<o.td_body.length;x++){
                var l_prop='';
                if (typeof o.td_properties !== ud){
                    if (typeof o.td_properties[x] !== ud) l_prop = o.td_properties[x]; 
                } 
                r +="<td " + l_prop + " >" + o.td_body[x](data) + "</td>";                                                         
            }
            oe = (oe=="odd"?"even":"odd");
        r +="</tr>";                         

        l_grid.append(r);
        var tr=$("tr[rowObj]");tr.removeAttr("rowObj"); 
        if (isOnEC){
            //this calback function is for asynchronous response.
            var callBackDone = function(){
                ctr++;
                if(num_rows == ctr) {
                    if(o.onComplete) o.onComplete();
                }
            }
            o.onEachComplete(tr,data,callBackDone);
        }
    }
    if(typeof o.isNew !== ud){
        if(o.isNew==true) l_grid.clearGrid();  
    } 
    
    if(o.url){
        l_grid.clearGrid();   
        $.getJSON(o.url, function(data){
             num_rows = data.length;
             $.each(data, function () {
                 trItem(this)
             });
             if (typeof o.onEachComplete === ud) if(o.onComplete) o.onComplete();
        });    
    }
    else{
        if(typeof o.limit === ud) o.limit=5;
        for(var y=0;y<o.limit;y++){
            trItem();
        }
        if (typeof o.onEachComplete === ud) if(o.onComplete) o.onComplete();
    }
    
}

/*--[zsi.bs]-------bootstrap--------------------------------------------------------------*/
zsi.bs.ctrl = function(o){
    var l_tag="input";
    var l_name =' name="p_' + o.name + '" id="p_' + o.name + '"';
    var l_type = ' type="text"';
    var l_class =' class="form-control"';
    var l_endTag="";
    var l_value="";
    var l_in_value="";
    var l_selected_value="";

    var yesno = function(p){
        var v = 0;
        var str ='';
        var cls = 'class="form-control input-sm"';
        
        if (typeof p.class !==ud) cls = 'class="' + p.class + '"';
        str +='<select name="p_' + p.name + '" id="p_' + p.name + '" ' + cls +   '>';
        if (typeof p.value !==ud) v = p.value;
        if(typeof p.mandatory !==ud){
            if(p.mandatory.toLowerCase()=='n') str += '<option value=""></option>';
        }
        str += '<option ' + (v==1 ? 'selected':'' ) +  ' value="1">Yes</option>';
        str += '<option ' + (v==0 ? 'selected':'' ) +  ' value="0">No</option>';
        str += '</select>';
        return str;
    }    

    if(typeof o.class!==ud) l_class=' class="' + o.class + '"';         
    if(typeof o.value!==ud) l_value=' value="' + o.value + '"';
    
    if(typeof o.type!==ud){
        var t = o.type.toLowerCase();
        
        if(t=='yesno') return yesno(o);
        
        l_type=' type="' + o.type + '"';

        if(t=="hidden") l_class='';
        
        if( !(t=="hidden" || t=="input" || t=="checkbox" || t=="password"  || t=="email") ) l_tag=t;        
        
        if(t=='select' || t =='textarea'){
            l_type="";
            l_endTag='</' + l_tag + '>';
            if(t=='select' && typeof o.value!==ud){ 
                l_selected_value = " selectedvalue=" + o.value;
            }
            if(o.type =='textarea' && typeof o.value!==ud){
                l_value="";
                l_in_value=o.value;
            }
        }

    }
   return '<' + l_tag + l_name + l_type + l_class + l_value + l_selected_value + '>' + l_in_value + l_endTag;
}    
  
zsi.bs.button =function(p){
    var l_icon ='';
    var l_class =' class="btn btn-primary btn-sm"';
    var l_type =' type="button"';
    var l_onclick='';
    
    if(typeof p.type !== ud) l_type = ' type="' + p.type + '"';
    if(typeof p.class !== ud) l_class = ' class="' + p.class + '"';
    if(typeof p.onclick !== ud) l_onclick = ' onclick="' + p.onclick + '"';
    switch(p.name.toLowerCase()){
        case 'search': l_icon='search';break;
        case 'add': 
        case 'new': l_icon='plus-sign';break;
        case 'delete': l_icon='trash';break;
        case 'close': l_icon='off';break;
        case 'save': l_icon='floppy-disk';break;
        case 'reset': l_icon='retweet';break;
        case 'login': l_icon='log-in';break;
        default:break;
    }
    
    var l_span ='<span class="glyphicon glyphicon-' + l_icon + '"></span>';
    var result = '<button id="btn' + p.name + '" ' + l_class +  l_type + l_onclick + '>' + l_span + ' ' + p.name + '</button>';
    return result;
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

$.fn.dataBind = function(){
    var a = arguments;
    var p=a[0];
    if(typeof a[0] ==="string"){
         p={}; p.url = a[0]; 
        if(typeof a[1] !==ud) p.onAllComplete = a[1];
    }
    var obj=this;
   $.getJSON(p.url, function( _data ) {
        obj.fillSelect({
               data             : _data
              ,selectedValue    : p.selectedValue
              ,isRequired       : p.required
              ,onLoadComplete   : p.onEachComplete
        });
        if(p.onAllComplete){
            obj.onAllComplete = p.onAllComplete;
            obj.onAllComplete(_data);
        } 
        if(p.isUniqueOptions===true)  obj.setUniqueOptions();
   });
}

$.fn.fillSelect = function(o) {
    //params: data,selectedValue,onLoadComplete;
    if(typeof o.isRequired ===ud)  o.isRequired=false;
    if(typeof o.selectedValue ===ud)  o.selectedValue='';
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
               if(o.isRequired==false){
                  var l_option_blank = new Option("", "");
                  ddl.add(l_option_blank, null);
                  reqIndex=1;
               }
               $.each(o.data, function(index, optionData) {
                  var l_option = new Option(unescape(optionData.text), optionData.value);
                  ddl.add(l_option, null);
                  if(o.selectedValue){
                      if(optionData.value==o.selectedValue){
                         ddl.selectedIndex=parseInt(index + reqIndex );
                        
                      }
                  }
               });

               var selval = $(ddl).attr("selectedvalue");
               if(selval) $(ddl).val(selval); 
              // $(ddl).removeAttr("selectedvalue");

               if(o.onLoadComplete) {
                  ddl.onEachComplete = o.onLoadComplete;
                  ddl.onEachComplete();
               }

           }
       }

   }
}
 
$.fn.setUniqueOptions=function(){
    var optionData=[];
    var obj = this;
    var options = $(obj).children("option");
    //functions
    var addSelectedData=function(o,data){
        var isFound=false;
        for(var x=0;x<data.length;x++){
            if(data[x].value==o.value) {
                isFound=true; 
                break;
            }
        }
        if(isFound===false){
            data.push({value:o.value, text:o.text});
        }
    }
    var getSelectedData=function(){
        selectedData=[];

       obj.each(function(){
            if(this.value!=="")  {
                addSelectedData({value:this.value, text:this.options[this.selectedIndex].text },selectedData);                
            }
        });
        return selectedData;
    }
    var fillUnselectedData=function(selectedData){
        var newData=[];
        for(var x=0;x<optionData.length;x++){
            var isFound=false;
            for(var i=0;i<selectedData.length;i++){
                if(optionData[x].value===selectedData[i].value) {
                    isFound=true;
                    break;
                }  
            }
           if(isFound===false) addSelectedData(optionData[x],newData);
        }
        
        obj.each(function(){
            var ddl = this;
            if(this.value===""){
                $(this).clearSelect(); 
                 this.add(new Option("", ""), null);
                 $.each(newData, function() {
                    var l_option = new Option(unescape(this.text), this.value);
                    ddl.add(l_option, null);
                });
            }else{
                //set new data
                var selOpt = {value:this.value, text: this.options[this.selectedIndex].text};
                 $(this).clearSelect(); 
                 ddl.add(new Option("",""), null);
                 ddl.add(new Option(selOpt.text,selOpt.value), null);
                 $.each(newData, function() {
                    var l_option = new Option(unescape(this.text), this.value);
                    ddl.add(l_option, null);
                });
                $(this).val(selOpt.value);
              
            }
        });
         
    }
    
    options.each(function(){
        if(this.value!=="") optionData.push({value :this.value, text: this.innerHTML});
    });
    
    this.change(function(){
        fire();
    });
    function fire(){
        var data = getSelectedData();
        fillUnselectedData(data);
    }
    fire();
    return this;
    
}

$.fn.clearGrid = function() {
     $(this).children('tbody').html('');
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

$.fn.centerWidth = function () {
    this.css("position","absolute");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
    return this;
}

$.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
    return this;
}

/*--[zsi.calendar]------------------------------------------------------------------------------*/
$.fn.loadMonths = function(){
    var _select  = this[0];
    _select.add(new Option(" ", ""),null);
    var monthNames = [ "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December" ];
    for(var x=0;x<12;x++){
      var l_option = new Option(monthNames[x], x+1);
      _select.add(l_option, null);
    }
}

/*--------[cookie]-----------------------------------------------------------------*/
function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}
function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}
function deleteCookie(name) {
    document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
