(function( $ ){

	/* Scroll Header */

	var lastScrollTop = $(window).scrollTop(); // reset variable any time it reloads
	var siteHeader = $('.header-main'); // your header element
	var changeDirection = -1; // base comparitive variable

	$(window).on('scroll', (function(event) {
		var scrollPosition = $(this).scrollTop();

		if($(window).width() > 776 ) { // we're mobile first so this is anything larger than our mobile breakpoint

			if (scrollPosition > 100) { // once you get far enough down, shrink the header
		    	
		        siteHeader.addClass('header-main-small'); 

		    } else { // bring it back up again when we get back to the top

		    	siteHeader.removeClass('header-main-small');
		    }

		} else { // this is mobile breakpoint or smaller

			if (scrollPosition > 120 && scrollPosition > lastScrollTop) { // once you get far enough down, hide the header
		    	
		    	changeDirection = -1; // reset changeDirection
		        siteHeader.addClass('header-main-small'); 

		    } else { // bring it back up again if we scroll up at all

		    	if ( -1 == changeDirection) {
		    		changeDirection = scrollPosition; // only set changeDirection once
		    	}

		    	// console.log(changeDirection + ' ' + scrollPosition);

		    	if ( scrollPosition < (changeDirection - 100) ) { // only add after you've scrolled up a bit

			    	siteHeader.removeClass('header-main-small');
			    	changeDirection = -1; // reset changeDirection
			    }

		    }

		    lastScrollTop = scrollPosition;
		}

	}));


})( jQuery );