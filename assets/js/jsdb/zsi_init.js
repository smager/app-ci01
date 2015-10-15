//initialize Settings.
zsi.init({
      baseURL : base_url
     ,errorUpdateURL    :  base_url + "common/errors_update"
     ,sqlConsoleName    :  "runsql"
     ,excludeAjaxWatch  :  ["checkDataExist","employe_search_json"]
});


//check cookie and load user menus.
var userInfo = readCookie("userinfo");
if(userInfo){
    if(isLocalStorageSupport()) {
        userInfo = JSON.parse(localStorage.getItem("userinfo")); 
        var menuInfo = localStorage.getItem("menuInfo");
        if(menuInfo){
            displayMenu( JSON.parse(menuInfo));
        }
    }else{
        loadMenu();
        loadUserInfo();
    }
}else{
    loadMenu();
    loadUserInfo();
}

function isLocalStorageSupport(){
    if(typeof(Storage) !== "undefined") return true; else return false;
}


function loadMenu(){
    $.getJSON(base_url + "menu_types/getdata_json",function(data){ 
        if(isLocalStorageSupport()) { 
            localStorage.setItem("menuInfo", JSON.stringify(data));
        }
        displayMenu(data);
    });    
}

function loadUserInfo(){
    $.getJSON(base_url + "users/getuserinfo",function(data){ 
        createCookie("userinfo", "*",1);
        localStorage.setItem("userinfo", JSON.stringify(data));
        userInfo = data;
    });
}

function displayMenu(data){
    var nav = $("#navbar-main");
    var m = '<ul class="nav navbar-nav">';        
    $.each(data,function(){ 
        var mlength= this.subMenus.length;
        m += '<li class="dropdown">';
            m += '<a data-toggle="dropdown" class="dropdown-toggle" href="#">' + this.name + ( mlength >0 ? '<span class="caret"></span>':'')  + '</a>';            
            if(mlength>0){                    
                m +='<ul class="dropdown-menu">';
                $.each(this.subMenus,function(){
                     m +='<li><a href="' + base_url + this.url + '">' + this.name + '</a></li>';
                });
                m +='</ul>';
            }            
        m += '</>';
    });
    m +='<url>';
    nav.append(m);            
}