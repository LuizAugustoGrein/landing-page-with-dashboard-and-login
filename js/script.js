$(function(){
    //Aqui vai todo o código de Javascript com o JQuery
    $('nav.mobile').click(function(){
        //O que vai acontecer quando clicarmos na nav.mobile
        var listaMenu = $('nav.mobile ul');

        //Abrir menu através do fadeIn()
        /*
        if(listaMenu.is(':hidden') == true){
            listaMenu.fadeIn();
        }else{
            listaMenu.fadeOut();
        }
        //Abrir ou fechar sem efeitos (metodo 1)
        if(listaMenu.is(':hidden') == true){
            listaMenu.show();
        }else{
            listaMenu.hide();
        }
        //Abrir ou fechar sem efeitos (metodo 2)
        if(listaMenu.is(':hidden') == true){
            listaMenu.css('display','block');
        }else{
            listaMenu.css('display','none');
        }
        */


        if(listaMenu.is(':hidden') == true){
            //var icone = $('.botao-menu-mobile i');
            var icone = $('.botao-menu-mobile').find('i');
            icone.removeClass('fa-bars');
            icone.addClass('fa-times');
            listaMenu.slideToggle();
        }else{
            var icone = $('.botao-menu-mobile').find('i');
            icone.removeClass('fa-times');
            icone.addClass('fa-bars');
            listaMenu.slideToggle();
        }
        
        //fas fa-bars
        //fas fa-times
    })

    if($('target').length > 0){
        //O elemento existe, portando precisamos dar o scroll em algum elemento
        var elemento = "#"+$('target').attr('target');
        var divScroll = $(elemento).offset().top;
        $('html,body').animate({'scrollTop':divScroll},2000);
    }

    carregarDinamico();

    function carregarDinamico(){
        $('[realtime]').click(function(){
            var pagina = $(this).attr('realtime');
            $('.container-principal').hide();
            $('.container-principal').load(include_path+'pages/'+pagina+'.php');

            setTimeout(function(){
                initialize();
	            addMarker(-26.192412,-49.817024,'','Minha casa',undefined,false);
            },1000);

            $('.container-principal').fadeIn(1000);
            
            window.history.pushState('','', pagina);

            return false;
        })
    }

})