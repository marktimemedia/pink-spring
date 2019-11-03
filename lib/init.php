<?php
/**
 * Spring Theme initial setup and constants
 */
function spring_setup() {
  // Make theme available for translation
  load_theme_textdomain( 'spring-theme', get_template_directory() . '/lang' );

  // Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
  register_nav_menus( array(
    'primary_navigation' => __( 'Primary Navigation', 'spring-theme' ),
    'quicklink_navigation' => __( 'Quicklink Navigation', 'spring-theme' ),
    'footer_navigation' => __( 'Footer Navigation', 'spring-theme' ),
  ));

  add_theme_support( 'responsive-embeds' );

  // Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
  add_theme_support( 'post-thumbnails' );
  // set_post_thumbnail_size( 500, 370, false );

  // Add and Modify Image Sizes
  // add_image_size( 'square', 800, 800, array( 'center', 'center' ) );

  // Add post formats (http://codex.wordpress.org/Post_Formats)
  // add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));
/**
 * Enable theme features
 */
add_theme_support( 'root-relative-urls' );            // Enable relative URLs
add_theme_support( 'nice-search' );                   // Enable /?s= to /search/ redirect
//add_theme_support( 'jquery-cdn' );                    // Enable to load jQuery from the Google CDN
add_theme_support( 'html5', array( 'search-form' ) );   // Enable HTML in the search form

add_theme_support( 'custom-logo' );

// Gutenberg Support
add_theme_support( 'align-wide' ); // gutenberg support
//add_theme_support( 'wp-block-styles' ); // allow default block styles

// Editor Style
add_theme_support('editor-styles');
// add_theme_support( 'dark-editor-style' ); // dark mode (optional)

// Gutenberg Color Palette, Update with Spring Colors
add_theme_support( 'disable-custom-colors' ); // no custom picker
add_theme_support( 'editor-color-palette', array(
    array(
        'name' => __( 'Accent Color 1', 'spring' ),
        'slug' => 'spring-color-1',
        'color' => '#de1e7e',
    ),
    array(
        'name' => __( 'Accent Color 2', 'spring' ),
        'slug' => 'spring-color-2',
        'color' => '#10aded',
    ),
    array(
        'name' => __( 'Accent Color 3', 'spring' ),
        'slug' => 'spring-color-3',
        'color' => '#10ca7e',
    ),
    array(
        'name' => __( 'Accent Color 4', 'spring' ),
        'slug' => 'spring-color-4',
        'color' => '#9155ed',
    ),
    array(
        'name' => __( 'White', 'spring' ),
        'slug' => 'white',
        'color' => '#fff',
    ),
    array(
        'name' => __( 'Neutral 1', 'spring' ),
        'slug' => 'neutral-lightest',
        'color' => '#f4f2f3',
    ),
    array(
        'name' => __( 'Neutral 2', 'spring' ),
        'slug' => 'neutral-lighter',
        'color' => '#d4ccd4',
    ),
    array(
        'name' => __( 'Neutral 3', 'spring' ),
        'slug' => 'neutral-light',
        'color' => '#afa8af',
    ),
    array(
        'name' => __( 'Neutral 4', 'spring' ),
        'slug' => 'neutral-mid',
        'color' => '#948b90',
    ),
    array(
        'name' => __( 'Neutral 5', 'spring' ),
        'slug' => 'neutral-dark',
        'color' => '#635d61',
    ),
    array(
        'name' => __( 'Neutral 6', 'spring' ),
        'slug' => 'neutral-darker',
        'color' => '#464144',
    ),
    array(
        'name' => __( 'Neutral 7', 'spring' ),
        'slug' => 'neutral-darkest',
        'color' => '#322e2f',
    ),

) );
}
add_action('after_setup_theme', 'spring_setup');

function spring_add_editor_styles() {
    add_editor_style( 'assets/css/editor-style.css' ); // enqueue style sheet
}
add_action( 'admin_init', 'spring_add_editor_styles' );

// custom logo parameters
// https://developer.wordpress.org/themes/functionality/custom-logo/
function spring_custom_logo_setup() {
 $defaults = array(
 'height'      => 300,
 'width'       => 300,
 'flex-height' => true,
 'flex-width'  => true,
 'header-text' => array( 'site-title', 'site-description' ),
 );
 add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'spring_custom_logo_setup' );

// Backwards compatibility for older than PHP 5.3.0
// Comment out if it's PHP 7.0+
if ( !defined( '__DIR__' ) ) { define( '__DIR__', dirname( __FILE__ ) ); }
