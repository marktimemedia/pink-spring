<?php
/**
 * Enqueue scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/assets/css/main.min.css
 *
 * Enqueue scripts in the following order:
 * 1. jquery via WordPress
 * 2. /theme/assets/js/vendor/modernizr-2.7.0.min.js
 * 3. /theme/assets/js/main.min.js (in footer)
 */
function spring_scripts() {
	// this is adding an extra element for cache-busting purposes on file update
	wp_enqueue_style( 'spring-main', get_template_directory_uri() . '/style.css', array(), filemtime( get_stylesheet_directory() . '/style.css' ) );
	wp_enqueue_style( 'spring-client', get_template_directory_uri() . '/client-files/client-style.css', array(), filemtime( get_stylesheet_directory() . '/client-files/client-style.css' ) );

	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
	}

	wp_register_script( 'modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-2.7.0.min.js', false, 1, false );
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'jquery' );

	//wp_enqueue_script( 'ie-fixes', get_template_directory_uri() . '/assets/js/build/ie-fixes.js', '', '', true );
	wp_enqueue_script( 'mobile-menu-toggle', get_template_directory_uri() . '/assets/js/build/mobile-menu-toggle.js', '', 1, true );
	wp_enqueue_script( 'header-resize', get_template_directory_uri() . '/assets/js/build/header-resize.js', '', 1, true );
}
add_action( 'wp_enqueue_scripts', 'spring_scripts', 100 );

/** Frontend Inline Styles **/
function spring_inline_styles() {
	wp_add_inline_style( 'spring-main', spring_palette_css() );
	wp_add_inline_style( 'spring-main', spring_rgb_css() );
	wp_add_inline_style( 'spring-main', spring_inline_media_styles() );
}
add_action( 'wp_enqueue_scripts', 'spring_inline_styles', PHP_INT_MAX ); // prioritize as last

/** Block Editor Assets **/
function spring_add_block_editor_assets() {
	wp_enqueue_style( 'editor-styles', get_template_directory_uri() . '/assets/css/editor-style.css', '', 1 );
	wp_add_inline_style( 'editor-styles', spring_palette_css() );
	wp_add_inline_style( 'editor-styles', spring_rgb_css() );
	wp_add_inline_style( 'editor-styles', spring_inline_media_styles() );
}
add_action( 'enqueue_block_editor_assets', 'spring_add_block_editor_assets' );

/** Admin Scripts **/
function spring_admin_assets() {
		wp_enqueue_style( 'admin-styles', get_template_directory_uri() . '/assets/css/admin-style.css', '', 1 );
}
//add_action( 'admin_enqueue_scripts', 'spring_admin_assets' );


/**
* Sidebar or Non-Sidebar Scripts
**/
function spring_enqueue_sidebar_script() {

	$sidebarfile = 'spring-production-no-sidebar';
	if ( spring_display_sidebar() ) {
		$sidebarfile = 'spring-production';
	}

	wp_enqueue_script( 'spring-app', get_template_directory_uri() . '/assets/js/build/' . $sidebarfile . '.js', '', 1, true );
}
add_action( 'wp_enqueue_scripts', 'spring_enqueue_sidebar_script', 100 );

/** OLD Editor Styles **/
// function spring_add_editor_styles() {
//     add_editor_style( 'assets/css/editor-style.css' ); // enqueue style sheet
// }
// add_action( 'admin_init', 'spring_add_editor_styles' );
