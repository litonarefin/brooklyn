(function($){

	"use strict";

	var Brooklyn = {

		// Background Img
		bgImageStretch: function() {
			$(".background-bg").css('background-image', function () {
				var bg = ('url(' + $(this).data("image-src") + ')');
				return bg;
			});
		},

		// Responsive Menu Open and Close in Mobile
		toggleMobileMenu: function() {
			if ($(window).width() < 767) {
				"use strict";
				$('.menu-item-has-children>a').on('click', function(e) {
					event.preventDefault(); 
					event.stopPropagation(); 
					$(this).parent().siblings().removeClass('open');
					$(this).parent().toggleClass('open');
				});
			};
		},

		// Sidebar Menu Open
		menuOpen: function() {
			$('.nav-trigger').on('click', function(event) {
				event.preventDefault(); 
				event.stopPropagation();
				$('body').toggleClass('open');
			});
		},

		// Sidebar Menu Close
		menuClose: function() {
			$('.menu-close').on('click', function(event) {
				event.preventDefault(); 
				event.stopPropagation();
				$('body').removeClass('open');
			});			
		}

	};

	$(document).ready(function() {
		"use strict";

		Brooklyn.bgImageStretch();
		Brooklyn.toggleMobileMenu();
		Brooklyn.menuOpen();
		Brooklyn.menuClose();
	});



    $(document).scroll(function () {
    	console.log('scrolled');
        var $nav = $(".main-header");
        // $nav.addClass('fixed-top');
        $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
    });	

})(jQuery);