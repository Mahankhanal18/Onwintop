
    $(document).ready(function(){
           if ($(window).width() < 700){
        	    //mobile
        	    $("#sidenav").removeClass('hide');
        	    $('.gap').css('padding-left','0px');
        	    var nav_is_open=false;
        	}else{
        	    //desktop
        	    var nav_is_open=true;
        	}
    })