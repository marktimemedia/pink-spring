<?php
/**
 * Spring Theme initial setup and constants
 */
function spring_setup() {
	/* Make theme available for translation */
	load_theme_textdomain( 'spring-theme', get_template_directory() . '/lang' );

	/**
	* Register wp_nav_menu() menus
	* (http://codex.wordpress.org/Function_Reference/register_nav_menus)
	*/
	register_nav_menus(
		array(
			'primary_navigation'   => __( 'Primary Navigation', 'spring-theme' ),
			'quicklink_navigation' => __( 'Quicklink Navigation', 'spring-theme' ),
			'footer_navigation'    => __( 'Footer Navigation', 'spring-theme' ),
			'mobile_navigation'    => __( 'Mobile Navigation', 'spring-theme' ),
		)
	);

	/* Logo Options */
	$logo_defaults = array(
		'height'      => 300,
		'width'       => 600,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	);
	/* Header Options */
	$header_defaults = array(
		'default-image'      => get_stylesheet_directory_uri() . '/assets/img/default-cover.png',
		'width'              => 1440,
		'height'             => 450,
		'flex-height'        => true,
		'flex-width'         => true,
		'default-text-color' => '',
		'header-text'        => false,
		'uploads'            => true,
	);
		/* Background Options */
	$bg_defaults = array(
		'default-image'      => '',
		'default-preset'     => 'default',
		'default-size'       => 'cover',
		'default-repeat'     => 'no-repeat',
		'default-attachment' => 'scroll',
	);

	/**
	 * Enable theme features
	 */
	// add_theme_support( 'jquery-cdn' );                    // Enable to load jQuery from the Google CDN
	add_theme_support( 'root-relative-urls' );            // Enable relative URLs
	add_theme_support( 'nice-search' );                   // Enable /?s= to /search/ redirect
	add_theme_support( 'customize-selective-refresh-widgets' ); // https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
	add_theme_support( 'custom-logo', $logo_defaults );    // https://developer.wordpress.org/reference/functions/add_theme_support/#custom-logo
	// add_theme_support( 'custom-background', $bg_defaults ); // https://developer.wordpress.org/reference/functions/add_theme_support/#custom-background
	add_theme_support( 'custom-header', $header_defaults ); // https://developer.wordpress.org/reference/functions/add_theme_support/#custom-header
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) ); // https://developer.wordpress.org/reference/functions/add_theme_support/#html5
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	// add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat')); // http://codex.wordpress.org/Post_Formats
	// add_image_size( 'square', 800, 800, array( 'center', 'center' ) );

}
add_action( 'after_setup_theme', 'spring_setup' );


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
			'name'             => 'Site Customizer',
			'slug'             => 'mtm-customizer',
			'source'           => 'https://github.com/marktimemedia/site-customizer/archive/master.zip',
			'required'         => true, // If false, the plugin is only 'recommended' instead of required.
			'force_activation' => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'external_url'     => 'https://github.com/marktimemedia/site-customizer', // If set, overrides default API URL and points to an external URL.
		),

		array(
			'name'             => 'ACF Function Check',
			'slug'             => 'mtm-safe-acf',
			'source'           => WP_PLUGIN_DIR . '/mtm-safe-acf',
			'required'         => true, // If false, the plugin is only 'recommended' instead of required.
			'force_activation' => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
		),

		array(
			'name'             => 'Advanced Custom Fields Pro', // The plugin name.
			'slug'             => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
			'source'           => WP_PLUGIN_DIR . '/advanced-custom-fields-pro', // The plugin source.
			'required'         => true, // If false, the plugin is only 'recommended' instead of required.
			'force_activation' => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			//'external_url'       => 'http://www.advancedcustomfields.com/pro/', // If set, overrides default API URL and points to an external URL.
		),

		// array(
		//   'name'               => 'ACF Block Components',
		//   'slug'               => 'mtm-block-components',
		//   'source'             => 'https://github.com/marktimemedia/acf-component-blocks/archive/master.zip',
		//   'required'           => false, // If false, the plugin is only 'recommended' instead of required.
		//   'external_url'       => 'https://github.com/marktimemedia/acf-component-blocks', // If set, overrides default API URL and points to an external URL.
		// ),

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
if ( ! defined( '__DIR__' ) ) {
	define( '__DIR__', dirname( __FILE__ ) );
}
