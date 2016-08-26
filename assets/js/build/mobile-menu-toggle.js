(function($) {

	$('.sub-menu').addClass('menu-collapse');
	$('.menu-item-has-children > a').append('<span class="menu-toggle"></span>');
	 
	$('.menu-toggle').on('click', function(e) {

		e.preventDefault();
  
	    if ($(this).parent().next('.sub-menu').hasClass('menu-collapse')) {
	        $(this).parent().next('.sub-menu').removeClass('menu-collapse');
	        $(this).addClass('menu-toggle-active');
	        e.stopPropagation();
	    } else {
	        $(this).parent().next('.sub-menu').addClass('menu-collapse');
	        $(this).removeClass('menu-toggle-active');
	        e.stopPropagation();
	    }
	});

})( jQuery );