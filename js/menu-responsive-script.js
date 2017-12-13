 $(document).ready(inicializar);
 var flag = 1;
    function inicializar(){
        $('#menu-responsive').click(function(){
            if(flag == 1){
                flag = 0;
                $('.contenedor-menu').animate({left: '0'});
                $("body").addClass("noscroll");
            }
            else{
                flag = 1;
                $('.contenedor-menu').animate({left: '-100%'});
                $("body").removeClass("noscroll");
            }
        });
        $(window).resize(function(){
            flag = 1;
            if(window.innerWidth > 700) {
                $('.contenedor-menu').removeAttr('style');
                $('body').removeClass('noscroll');
            }
        });
}