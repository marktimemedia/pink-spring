<?php
/**
 * Spring includes
 */

require_once locate_template( '/lib/class-tgm-plugin-activation.php' );  // Plugin dependencies

require_once locate_template( '/lib/utils.php' );           // Utility functions
require_once locate_template( '/lib/init.php' );            // Initial theme setup and constants
require_once locate_template( '/lib/wrapper.php' );         // Theme wrapper class
require_once locate_template( '/lib/sidebar.php' );         // Sidebar output class
require_once locate_template( '/lib/config.php' );          // Configuration
require_once locate_template( '/lib/cleanup.php' );         // Cleanup
require_once locate_template( '/lib/titles.php' );          // Page titles
require_once locate_template( '/lib/comments.php' );        // Custom comments modifications
require_once locate_template( '/lib/relative-urls.php' );   // Root relative URLs
require_once locate_template( '/lib/widgets.php' );         // Sidebars and widgets
require_once locate_template( '/lib/scripts.php' );         // Scripts and stylesheets
require_once locate_template( '/lib/search.php' );          // Search config
require_once locate_template( '/lib/editor.php' );          // Editor styles and setup
require_once locate_template( '/lib/media.php' );           // Specific to media
require_once locate_template( '/lib/content.php' );          // Specific to content
require_once locate_template( '/lib/panels.php' );          // Specific to panels plugin
require_once locate_template( '/lib/woo.php' );          	  // WooCommerce functions
require_once locate_template( '/lib/custom.php' );          // Custom functions
require_once locate_template( '/client-files/client-functions.php' ); // Client functions

?>
