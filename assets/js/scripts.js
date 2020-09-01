(function($){

	"use strict";

	var nextModel = {

      	// Bootstrap Carousels

      	// carousel: function() {

      	// 	$('.carousel.slide').carousel({
      	// 		cycle: true
      	// 	}); 
      	// }, 

      	// Fancybox For Popup Image

      	// fancybox: function() {
      	// 	$(".fancybox").fancybox();

      	// 	$('.more-images .fancybox').attr('rel', 'gallery').fancybox({});

      	// 	$('.video-popup').fancybox({});
      	// },

		// Owl Carousel Sliders

		// owlcarousel: function() {
		// 	$(".team-slider").owlCarousel({
		// 		items:2,
		// 		loop:true,
		// 		autoplay: true,
		// 		responsive:{
		// 			320:{
		// 				items:1
		// 			},
		// 			480:{
		// 				items:2
		// 			}
		// 		}
		// 	});
		// },

		//Unisearch For Top Search 

		// counterUp: function() {
		// 	$('.counter').counterUp({
		// 		delay: 10,
		// 		time: 1500,
		// 		offset: 70,
		// 		formatter: function (n) {
		// 			return n.replace(/,/g, '.');
		// 		}
		// 	});
		// },

		//Unisearch For Top Search 

		// markers: function() {
		// 	try { 
		// 		(function($) {
		// 			$('#search-map').mapit();
		// 		})(jQuery);
		// 	} catch(e) { 

		// 	}
		// },

		// Google Map Functions

		// googlemap: function() {
		// 	function isMobile() {
		// 		return ('ontouchstart' in document.documentElement);
		// 	}
		// 	function init_gmap() {
		// 		if ( typeof google == 'undefined' ) return;
		// 		var options = {
		// 			center: {lat: -37.834812, lng: 144.963055},
		// 			zoom: 14,
		// 			mapTypeControl: true,
		// 			mapTypeControlOptions: {
		// 				style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
		// 			},
		// 			navigationControl: true,
		// 			scrollwheel: false,
		// 			streetViewControl: true,
		// 			styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#faf8f8"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#faf8f8"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#cdcdcd"},{"visibility":"on"}]}]
		// 		}
		// 		if (isMobile()) {
		// 			options.draggable = false;
		// 		}

		// 		$('#googleMaps-2').gmap3({
		// 			map: {
		// 				options: options
		// 			},
		// 			marker: {
		// 				latLng: [-37.834811, 144.963054],
		// 				options: { icon: 'images/marker-7.png' }
		// 			}
		// 		});

		// 		$('#googleMaps-3').gmap3({
		// 			map: {
		// 				options: options,
		// 			},
		// 			styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#faf8f8"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#faf8f8"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":36},{"lightness":40}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#000"},{"visibility":"on"}]}],
		// 			marker: {
		// 				latLng: [-37.834811, 144.963054],
		// 				options: { icon: 'images/marker-7.png' }
		// 			}
		// 		});

		// 		$('#googleMaps-4').gmap3({
		// 			map: {
		// 				options: options
		// 			},
		// 			marker: {
		// 				latLng: [-37.834811, 144.963054],
		// 				options: { icon: 'images/marker-7.png' }
		// 			}
		// 		});
		// 	}

		// 	init_gmap();
		// },


	};



	$(document).ready(function() {
		"use strict";

		// Background Img

		$(".background-bg").css('background-image', function () {
			var bg = ('url(' + $(this).data("image-src") + ')');
			return bg;
		});


		// Sidebar Menu Open

		$('.nav-trigger').on('click', function(event) {
			event.preventDefault(); 
			event.stopPropagation();
			$('body').toggleClass('open');
		});

		// Sidebar Menu Close

		$('.menu-close').on('click', function(event) {
			event.preventDefault(); 
			event.stopPropagation();
			$('body').removeClass('open');
		});


		// nextModel.carousel();
		// nextModel.owlcarousel();
		// nextModel.fancybox();
		// nextModel.counterUp();
		// nextModel.markers();
		// nextModel.googlemap();
	});


	// Responsive Menu Open and Close in Mobile

	if ($(window).width() < 767) {
		"use strict";
		$('.menu-item-has-children>a').on('click', function(e) {
			event.preventDefault(); 
			event.stopPropagation(); 
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});

	};

})(jQuery);



/* Working Contact Form Js
-------------------------------------------------------------------*/
// Email from Validation
jQuery('#submit').on("click", function(e){ 

	//Stop form submission & check the validation
	e.preventDefault();

	// Variable declaration
	var error = false;
	var k_name = jQuery('#name').val();
	var k_email = jQuery('#email').val(); 
	var k_message = jQuery('#message').val();

	/* Post Ajax function of jQuery to get all the data from the submission of the form as soon as the form sends the values to email.php*/
	jQuery.post("email.php", jQuery(".wpcf7-form").serialize(),function(result){
	    //Check the result set from email.php file.
	    if(result == 'sent'){
	    	$('.contact-message').html('<i class="fa fa-check contact-success"></i><div>Your message has been sent.</div>').fadeIn();
	    } else {
	    	// $('.error-message').html('<i class="fa fa-thumbs-down contact-error"></i><div>Your message has not been sent</div>').fadeIn();
	    }
	});

}); 
