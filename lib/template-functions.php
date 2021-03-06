<?php
/**
 * .main classes
 */
function spring_main_class() {

	if ( spring_display_sidebar() ) {
		// Classes on pages with the sidebar
		$class = 'content-main';
	} else {
		// Classes on full width pages
		$class = 'content-full';
	}

	return $class;
}

/**
 * .sidebar classes
 */
function spring_sidebar_class() {
	return 'sidebar-main';
}

/**
 * Sidebar button
 */
function spring_sidebar_button() {

	if ( spring_display_sidebar() ) {
		// Show sidebar button on pages where sidebar is enabled
		$sidebar_button = '<button aria-label="Open Sidebar" id="openSidebar" class="open-sidebar open-button"><span>Open Sidebar</span></button>';
	} else {
		// Disable sidebar button where sidebar is disabled
		$sidebar_button = '';
	}

	return $sidebar_button;
}



/**
* Use the following line to disable the admin bar
*/
// add_filter('show_admin_bar', '__return_false');
