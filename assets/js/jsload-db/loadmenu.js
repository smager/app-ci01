    $.getJSON(base_url + "menu_types/getdata_json",function(data){         
        var nav = $("#navbar-main");
        var m = '<ul class="nav navbar-nav">';        
        $.each(data,function(){ 
            var mlength= this.subMenus.length;
            m += '<li class="dropdown">';
                m += '<a data-toggle="dropdown" class="dropdown-toggle" href="#">' + this.name + ( mlength >0 ? '<span class="caret"></span>':'')  + '</a>';            
                if(mlength>0){                    
                    m +='<ul class="dropdown-menu">';
                    $.each(this.subMenus,function(){
                         m +='<li><a href="' + this.url + '">' + this.name + '</a></li>';
                    });
                    m +='</ul>';
                }            
            m += '</>';
        });
        m +='<url>';
        nav.append(m);    
    });