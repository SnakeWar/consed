require('./bootstrap');

$(document).ready(function(){

	if($(window).width() < 991) {
		$('#slide-carousel-mobile').owlCarousel({
			items: 1,
			dots: true
		});

		$('#blog-carousel').owlCarousel({
			navText: [
				'<img src="/images/min/arrow-left.svg" />',
				'<img src="/images/min/arrow-right.svg" />',
			],
			responsive: {
				0: {
					items: 1,
					nav: true,
				},
				576: {
					items: 2
				}
			}
		});

		$('#services-carousel').owlCarousel({
			responsive: {
				0: {
					items: 1
				},
				576: {
					items: 2
				}
			}
		});

		$('.menu-link').bigSlide({
			menuWidth: '90%',
			side: 'right'
		});

	} else {
		$('#slide-carousel-desktop').owlCarousel({
			items: 1,
			autoplay: true,
			autoplayTimeout: 8000,
			dots: false
		});
	}

	$('.click-scroll').click(function (e) {
		$('#menu .menu-link').trigger('click');
	    var linkHref = $(this).attr("href");
	    var idElement = linkHref.substr(linkHref.indexOf("#"));
        $('.click-scroll').parent().removeClass('active');
        $(this).parent().addClass('active');
	    $('html, body').animate({
	        scrollTop: $(idElement).offset().top - $(".header-site").height()

	    }, 1000);
	    return false;
	});

	var SPMaskBehavior = function (val) {
	  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	spOptions = {
	  onKeyPress: function(val, e, field, options) {
	      field.mask(SPMaskBehavior.apply({}, arguments), options);
	    }
	};

	$('.sp_celphones').mask(SPMaskBehavior, spOptions);

});
