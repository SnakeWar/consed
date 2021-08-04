// script suavizar scroll de rolagem com links de navegacao  
$('.scroll a[href^="#"]').on('click', function(e) {
    e.preventDefault();
    var id = $(this).attr('href'),
        targetOffset = $(id).offset().top;

    $('html, body').animate({
        scrollTop: targetOffset - 250
    }, 500);
});


// script carregamento de pagina
$(window).on('load', function() {
    $('#preloader .inner').fadeOut();
    $('#preloader').delay(350).fadeOut('slow');
    $('body').delay(350).css({
        'overflow': 'visible'
    });

    $('#newsletter-input').mask("(99) 99999-9999");
})

// script reduzir altura do navegador quando usar scroll de rolagem  
$(window).scroll(function() {
    if ($(document).scrollTop() > 50) {
        $('.navegador').addClass('sticky');
    } else {
        $('.navegador').removeClass('sticky');
    }
});