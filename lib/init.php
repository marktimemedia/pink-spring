<?php
// Gutenberg Color Palette, Update with Spring Colors
$springcolor1     = '#de1e7e';
$springcolor2     = '#009fd4';
$springcolor3     = '#03a678';
$springcolor4     = '#9053ed';
$springwhite      = '#ffffff';
$springNlightest  = '#f8f4f6';
$springNlighter   = '#d4ccd4';
$springNlight     = '#afa8af';
$springNmid       = '#948b90';
$springNdark      = '#635d61';
$springNdarker    = '#464144';
$springNdarkest   = '#3a3538';

/**
 * Spring Theme initial setup and constants
 */
function spring_setup() {

  global $springcolor1, $springcolor2, $springcolor3, $springcolor4, $springwhite, $springNlightest, $springNlighter, $springNlight, $springNmid, $springNdark, $springNdarker, $springNdarkest;

  /** Make theme available for translation */
  load_theme_textdomain( 'spring-theme', get_template_directory() . '/lang' );

  /** Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus) */
  register_nav_menus( array(
    'primary_navigation' => __( 'Primary Navigation', 'spring-theme' ),
    'quicklink_navigation' => __( 'Quicklink Navigation', 'spring-theme' ),
    'footer_navigation' => __( 'Footer Navigation', 'spring-theme' ),
  ));

  add_theme_support( 'responsive-embeds' );

  /** Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails) */
  add_theme_support( 'post-thumbnails' );
  // set_post_thumbnail_size( 500, 370, false );

  /** Add and Modify Image Sizes */
  // add_image_size( 'square', 800, 800, array( 'center', 'center' ) );

  /** Add post formats (http://codex.wordpress.org/Post_Formats) */
  // add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

  /**
   * Enable theme features
   */
  add_theme_support( 'root-relative-urls' );            // Enable relative URLs
  add_theme_support( 'nice-search' );                   // Enable /?s= to /search/ redirect
  //add_theme_support( 'jquery-cdn' );                    // Enable to load jQuery from the Google CDN
  add_theme_support( 'html5', array( 'search-form' ) );   // Enable HTML in the search form
  add_theme_support( 'custom-logo' );                     // Configured below

  /** Editor Style */
  add_theme_support('editor-styles');
  // add_theme_support( 'dark-editor-style' ); // dark mode (optional)

  /**
   * Gutenberg Features
   */
  add_theme_support( 'align-wide' ); // gutenberg wide block support
  //add_theme_support( 'wp-block-styles' ); // allow default block styles
  add_theme_support( 'disable-custom-colors' ); // no custom picker
  add_theme_support( 'editor-color-palette', array(
      array(
          'name' => __( 'Accent Color 1', 'spring' ),
          'slug' => 'spring-color-1',
          'color' => $springcolor1,
      ),
      array(
          'name' => __( 'Accent Color 2', 'spring' ),
          'slug' => 'spring-color-2',
          'color' => $springcolor2,
      ),
      array(
          'name' => __( 'Accent Color 3', 'spring' ),
          'slug' => 'spring-color-3',
          'color' => $springcolor3,
      ),
      array(
          'name' => __( 'Accent Color 4', 'spring' ),
          'slug' => 'spring-color-4',
          'color' => $springcolor4,
      ),
      array(
          'name' => __( 'White', 'spring' ),
          'slug' => 'white',
          'color' => $springwhite,
      ),
      array(
          'name' => __( 'Neutral 1', 'spring' ),
          'slug' => 'neutral-lightest',
          'color' => $springNlightest,
      ),
      array(
          'name' => __( 'Neutral 2', 'spring' ),
          'slug' => 'neutral-lighter',
          'color' => $springNlighter,
      ),
      array(
          'name' => __( 'Neutral 3', 'spring' ),
          'slug' => 'neutral-light',
          'color' => $springNlight,
      ),
      array(
          'name' => __( 'Neutral 4', 'spring' ),
          'slug' => 'neutral-mid',
          'color' => $springNmid,
      ),
      array(
          'name' => __( 'Neutral 5', 'spring' ),
          'slug' => 'neutral-dark',
          'color' => $springNdark,
      ),
      array(
          'name' => __( 'Neutral 6', 'spring' ),
          'slug' => 'neutral-darker',
          'color' => $springNdarker,
      ),
      array(
          'name' => __( 'Neutral 7', 'spring' ),
          'slug' => 'neutral-darkest',
          'color' => $springNdarkest,
      ),

  ) );
}
add_action('after_setup_theme', 'spring_setup');

/**
 * ACF Color Palette
 *
 * Add default color palatte to ACF color picker for branding
 * Match these colors to colors in Gutenberg function & SCSS values
 *
*/
// Admin Scripts
function spring_acf_admin_scripts() {
  global $springcolor1, $springcolor2, $springcolor3, $springcolor4, $springwhite, $springNlightest, $springNlighter, $springNlight, $springNmid, $springNdark, $springNdarker, $springNdarkest;

    wp_register_script( 'acf_custom', get_template_directory_uri() . '/assets/js/build/acf-custom.js' );

    // Localize the script with new data
    $spring_acf_colors = array(
      'springcolor1'     => $springcolor1,
      'springcolor2'     => $springcolor2,
      'springcolor3'     => $springcolor3,
      'springcolor4'     => $springcolor4,
      'white'              => $springwhite,
      'neutrallightest'   => $springNlightest,
      'neutrallighter'    => $springNlighter,
      'neutrallight'      => $springNlight,
      'neutralmid'        => $springNmid,
      'neutraldark'       => $springNdark,
      'neutraldarker'     => $springNdarker,
      'neutraldarkest'    => $springNdarkest
    );
    wp_localize_script( 'acf_custom', 'custom_colors', $spring_acf_colors );

    wp_enqueue_script( 'acf_custom');
}

add_action( 'acf/input/admin_enqueue_scripts', 'spring_acf_admin_scripts' );

/*
* Add custom colors to ACF color picker
* https://whiteleydesigns.com/synchronizing-your-acf-color-picker-with-gutenberg-color-classes/
*/
function spring_filter_acf_class_colors( $colors ) {
  global $springcolor1, $springcolor2, $springcolor3, $springcolor4, $springwhite, $springNlightest, $springNlighter, $springNlight, $springNmid, $springNdark, $springNdarker, $springNdarkest;

  $colors = array(
     // Change these to match your color class (gutenberg) and hex codes (acf)
       "spring-color-1"   => $springcolor1,
       "spring-color-2"   => $springcolor2,
       "spring-color-3"   => $springcolor3,
       "spring-color-4"   => $springcolor4,
       "white"            => $springwhite,
       "neutral-lightest" => $springNlightest,
       "neutral-lighter"  => $springNlighter,
       "neutral-light"    => $springNlight,
       "neutral-mid"      => $springNmid,
       "neutral-dark"     => $springNdark,
       "neutral-darker"   => $springNdarker,
       "neutral-darkest"  => $springNdarkest,
  );

  return $colors;
}
add_filter( 'mtm_block_colors_filter', 'spring_filter_acf_class_colors' );


/**
 * Editor Styles
 *
*/
function spring_add_editor_styles() {
    add_editor_style( 'assets/css/editor-style.css' ); // enqueue style sheet
}
add_action( 'admin_init', 'spring_add_editor_styles' );

/**
 * Custom logo parameters
 * https://developer.wordpress.org/themes/functionality/custom-logo/
*/

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


/**
 * Theme code to register the required plugins.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

add_action( 'tgmpa_register', 'spring_register_required_plugins' );

function spring_register_required_plugins() {

  $plugins = array(

    array(
      'name'               => 'ACF Options Page',
      'slug'               => 'mtm-options-page',
      'source'             => 'https://github.com/marktimemedia/acf-theme-settings/archive/master.zip',
      'required'           => true, // If false, the plugin is only 'recommended' instead of required.
      'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
      'external_url'       => 'https://github.com/marktimemedia/acf-theme-settings', // If set, overrides default API URL and points to an external URL.
    ),

    array(
      'name'               => 'ACF Function Check',
      'slug'               => 'mtm-safe-acf',
      'source'             => WP_PLUGIN_DIR . '/mtm-safe-acf',
      'required'           => true, // If false, the plugin is only 'recommended' instead of required.
      'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
    ),

    array(
      'name'               => 'Advanced Custom Fields Pro', // The plugin name.
      'slug'               => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
      'source'             => WP_PLUGIN_DIR . '/advanced-custom-fields-pro', // The plugin source.
      'required'           => true, // If false, the plugin is only 'recommended' instead of required.
      'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
      //'external_url'       => 'http://www.advancedcustomfields.com/pro/', // If set, overrides default API URL and points to an external URL.
    ),

    array(
      'name'               => 'ACF Block Components',
      'slug'               => 'mtm-block-components',
      'source'             => 'https://github.com/marktimemedia/acf-component-blocks/archive/master.zip',
      'required'           => false, // If false, the plugin is only 'recommended' instead of required.
      'external_url'       => 'https://github.com/marktimemedia/acf-component-blocks', // If set, overrides default API URL and points to an external URL.
    ),

  );

  /*
   * Array of configuration settings. Amend each line as needed.
   *
   * TGMPA will start providing localized text strings soon. If you already have translations of our standard
   * strings available, please help us make TGMPA even better by giving us access to these translations or by
   * sending in a pull-request with .po file(s) with the translations.
   *
   * Only uncomment the strings in the config array if you want to customize the strings.
   */
  $config = array(
    'id'           => 'spring',                 // Unique ID for hashing notices for multiple instances of TGMPA.
    'default_path' => '',                      // Default absolute path to bundled plugins.
    'menu'         => 'spring-install-plugins', // Menu slug.
    'parent_slug'  => 'themes.php',            // Parent menu slug.
    'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
    'has_notices'  => true,                    // Show admin notices or not.
    'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
    'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => false,                   // Automatically activate plugins after installation or not.
    'message'      => '',                      // Message to output right before the plugins table.
    );

  tgmpa( $plugins, $config );
}


// Backwards compatibility for older than PHP 5.3.0
// Comment out if it's PHP 7.0+
if ( !defined( '__DIR__' ) ) { define( '__DIR__', dirname( __FILE__ ) ); }
