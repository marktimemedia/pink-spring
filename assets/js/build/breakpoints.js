// ---------------------------------------------------- //
// VISIBILITY CHECKING
// ---------------------------------------------------- //
var isVisible = function(element) {
	return $(element).is(':visible');
};

// ---------------------------------------------------- //
// BREAKPOINTS MANAGE
// ---------------------------------------------------- //
var breakpoints = function () {

	/*** Vars ***/
	var breakpoints = {},
		breakpoint_selector,
		breakpoint_isVisible;

	/*** Init ***/
	var init = function() {

		$('.bp_checking').each(function() { // First pass, loop on DOM
			manage( $(this).attr('id') );
		});

		$(window).on('resize', function(){ // On resize, loop on array
			$.each(breakpoints, function(breakpoint_id) {
				manage(breakpoint_id);
			});
		});
	};

	/*** Breakpoint testing ***/
	var is = function(breakpoint) {
		return breakpoints[breakpoint];
	};

	/*** Manage array ***/
	var manage = function(breakpoint_id) {
		breakpoint_selector = '#' + breakpoint_id;
		breakpoint_isVisible = isVisible(breakpoint_selector);
		breakpoints[breakpoint_id] = breakpoint_isVisible;
	};

	/*** Public methods ***/
	return {
		init: init,
		is: is
	};

}();

// Init
breakpoints.init();
