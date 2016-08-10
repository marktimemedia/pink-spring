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
    wp_enqueue_style( 'spring_main', get_template_directory_uri() . '/style.css', false );

    if ( is_single() && comments_open() && get_option('thread_comments') ) {
        wp_enqueue_script('comment-reply');
    }

    wp_register_script( 'modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-2.7.0.min.js', false, null, false );
    wp_enqueue_script( 'modernizr' );
    wp_enqueue_script( 'jquery' );

    wp_enqueue_script( 'mobile-menu-toggle', get_template_directory_uri() . '/assets/js/build/mobile-menu-toggle.js', '', '', true );
     wp_enqueue_script( 'header-resize', get_template_directory_uri() . '/assets/js/build/header-resize.js', '', false, true );
}

add_action( 'wp_enqueue_scripts', 'spring_scripts', 100 );

// Admin Scripts
function spring_admin_scripts() {
    wp_enqueue_style( 'admin-styles', get_template_directory_uri() . '/assets/css/admin-style.css', false );
}

add_action( 'admin_enqueue_scripts', 'spring_admin_scripts' );

/**
* decide whether to enqueue sidebar or non-sidebar scripts
**/
function spring_enqueue_sidebar_script() {

  $sidebarfile = 'spring-production-no-sidebar';
  if( spring_display_sidebar() ) { $sidebarfile = 'spring-production'; }

  wp_enqueue_script( 'spring_app', get_template_directory_uri() . '/assets/js/build/' . $sidebarfile . '.js', '', '', true );
}
add_action( 'wp_enqueue_scripts', 'spring_enqueue_sidebar_script', 100 );