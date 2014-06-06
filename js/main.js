/* Template: Ethority | Author: GD Themes | Version: 1.0.0  */
/*----------------------------------------------------------*/
(function($) {

"use strict";

$(document).ready(function() {



	// Input placeholder fallback
	$('input, textarea').placeholder();


	$('.flexslider').flexslider({
		selector: ".slides > .review",
		directionNav: false,
		slideshow: true,
		slideshowSpeed: 5000,
		animationLoop: true,
		animation: "slide",
		direction: "horizontal"
	});

	/* Header
	------------------*/
	var topMenu = $('#menu'),
			topMenuHeight = topMenu.outerHeight(), // include padding&margin, if .outerHeight(true), only padding
			menuItems = topMenu.find('a'),

			scrolledItems = menuItems.map( function() {
				var item = $( $(this).attr('href') );
				if ( item.length ) { return item; }
			});


	// Scroll to section
	menuItems.click( function( e ) {
		e.preventDefault();
		var hrefVal = $(this).attr('href'),
				offsetTop = hrefVal === '#' ? 0 : $(hrefVal).offset().top - topMenu.outerHeight();

		// mobile
		var w = $(window).width();
		if ( w < 768 ){
			offsetTop = hrefVal === '#' ? 0 : $(hrefVal).offset().top - 60;
		}

		$('html, body').stop().animate({ scrollTop: offsetTop }, 800);

		// close mobile menu when item is clicked
		if ( $(window).width() < 768 ) {
			$('#menu-toggle').toggleClass('open');
			$('#menu').slideToggle(400);
		}
	}); // menuItems.click( function( e )



	$(window).scroll( function() {

		// Change .active menu item on scroll
		var fromTop = $(this).scrollTop() + topMenuHeight,

				// return menu item as object when scrolled into view
				itemsScrolled = scrolledItems.map( function(){
					if ( $(this).offset().top - 1 < fromTop ) // -1 so that menuItem detects using click event
					return this;
				});

		var scrolledItem = itemsScrolled[itemsScrolled.length - 1]; // index starts from 0...

		var id = scrolledItem && scrolledItem.length ? scrolledItem[0].id : '';

		menuItems
			.parent().removeClass('active')
			.end()
			.filter('[href="#' + id + '"]').parent().addClass('active');


		// Scale down header
		if ( $(this).scrollTop() < 500 ) {
			$('#header').removeClass('scaled-down');
		} else {
			$('#header').addClass('scaled-down');
		}

		if ( $(window).scrollTop() < 1000 ) {
			$('#back-to-top').fadeOut();
		} else {
			$('#back-to-top').fadeIn();
		}
	}); // $(window).scroll( function()


	// Mobile Menu Toggle
	$('#menu-toggle').click( function( e ) {
		e.preventDefault();
		$(this).toggleClass('open');
		$('#menu').slideToggle(400);
	});

	/*------------------
	End Header */


	/* Footer
	------------------*/
	// back to top
	$('#back-to-top').click( function( e ) {
		e.preventDefault();

		$('html, body').animate({ scrollTop: 0 }, 800);
	});


	/* Contact Form
	------------------*/
	$('#contact-form').validate({
	rules: {
		name: {
			required: true,
			minlength: 2
		},
		email: {
			required: true,
			email: true
		},
		message: {
			required: true,
			minlength: 10
		}
	},
	messages: {
		name: "* Please enter in your name.",
		email: "* Please enter a valid email address.",
		message: "* Please enter your message."
	},
	errorElement: "div",
	errorPlacement: function(error, element) {
		element.before(error);
	}
});


});
}(jQuery));