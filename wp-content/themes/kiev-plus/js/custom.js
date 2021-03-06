jQuery(document).ready(function($){
    $('.bxslider').bxSlider({
        slideWidth: 400,
        slideHeight: 140,
        minSlides: 3,
        maxSlides: 3,
        slideMargin: 16,
        pager: false,
        nextText: '',
        prevText: '',
        moveSlides:1,
        infiniteLoop:false,
        hideControlOnEnd: true
    });

    var contact = $('#contact'),
        close   = $('.close'),
        popUp   = $('.pop-up'),
        backCall= $('#back-call'),
        backCallFooter = $('#back-call-footer'),
        backContact = $('#back-contact'),
        items   = $('.items'),
        itemsActive   = $('.items.active'),
        cardContent = $('.card-content');

    close.click(function(){
        popUp.hide();
    });
    backContact.click(function(){
        $('.back-contacts').show();
    });
    contact.click(function(){
        $('.contacts').show();
    });

    backCall.click(function(){
        $('.back-call').show();
    });
    backCallFooter.click(function(){
        $('.back-call').show();
    });

    cardContent.click(function(){

        return false;
    });

    items.on('click', function(){
        var dataId  = $(this).data('post-id');
        if( $(this).is('.active') ){
            items.removeClass('active');
            cardContent.removeClass('active');
            cardContent.fadeOut(500);
        }
        else{
        items.removeClass('active');
        $(this).addClass('active');
        if( $(this).hasClass('active') ){
            if(cardContent.hasClass('active')) cardContent.fadeOut(500, function(){
                cardContent.removeClass('active')
            });
            $('#'+dataId).fadeIn(800,function(){
                $('#'+dataId).addClass('active');
                $('html,body').animate({
                    scrollTop: $(this).offset().top - ( $(window).height() - $(this).outerHeight(true) ) / 2
                }, 200);
            });
        }else{
            items.removeClass('active');
            cardContent.removeClass('active');
            cardContent.fadeOut(500);
            }
        }
        return false;
    });
    $('.bx-slider-img').bxSlider({
        infiniteLoop: true,
        hideControlOnEnd: true,
        mode: 'fade'
    });

    $('.hero-image  .bx-wrapper .content-wrapper a ').click(function(){
        return false;
    });

});
