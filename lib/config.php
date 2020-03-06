<?php

/**
 * Configuration values
 * How and which things will display
 */
define( 'POST_EXCERPT_LENGTH', 55 ); // Length in words for excerpt_length filter (http://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_length)

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

function spring_sidebar_button() {

  if ( spring_display_sidebar() ) {
    // Show sidebar button on pages where sidebar is enabled
    $sidebar_button = '<button id="openSidebar" class="open-sidebar open-button"><span>Open Sidebar</span></button>';
  } else {
    // Disable sidebar button where sidebar is disabled
    $sidebar_button = '';
  }

  return $sidebar_button;
}

/**
 * Define which pages shouldn't have the sidebar
 *
 * @see lib/sidebar.php for more details
 */
function spring_display_sidebar() {
  $sidebar_config = new Spring_Sidebar(
    /**
     * Conditional tag checks (http://codex.wordpress.org/Conditional_Tags)
     * Any of these conditional tags that return true will show the sidebar
     *
     * To use a function that accepts arguments, use the following format:
     *
     * array('function_name', array('arg1', 'arg2'))
     *
     * The second element must be an array even if there's only 1 argument.
     */
    array(
  //'is_archive'
    ),
    /**
     * Page template checks (via is_page_template())
     * By default, page templates do not show the sidebar
     * Any of these page templates that return true will show the sidebar
     */
    array(
      //'template-custom.php'
    )
  );

  return apply_filters( 'spring_display_sidebar', $sidebar_config->display );
}

/**
* Display and output search bar
*/
function spring_search_scripts() {
  wp_enqueue_script( 'search-toggle', get_template_directory_uri() . '/assets/js/build/search-toggle.js', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'spring_search_scripts', 100 );

function spring_search_bar() {
  echo '<button class="fa fa-search search-toggle run-toggle"></button>';
  get_template_part( 'templates/searchform' );
}

/**
 * $content_width is a global variable used by WordPress for max image upload sizes
 * and media embeds (in pixels).
 *
 * Example: If the content area is 640px wide, set $content_width = 620; so images and videos will not overflow.
 * Default: 1140px is the default Bootstrap container width.
 */
if ( !isset( $content_width ) ) { $content_width = 1140; }


/**
* Email Notification Defaults
*/
// add_filter( 'wp_mail_from', 'mtm_mail_from' );
// add_filter( 'wp_mail_from_name', 'mtm_mail_name' );

// function mtm_mail_from ($email ){
//   return 'sample@wordpress.com'; // new email address from sender.
// }

// function mtm_mail_name( $email ){
//   return 'Sample'; // new email name from sender.
// }


/**
* Comment out the following line to enable the admin bar
*/
// add_filter('show_admin_bar', '__return_false');


/**
* Remove access to specific page templates
* 'FILE_PATH_AND_NAME' => 'TEMPLATE_TITLE'
*/

  // function spring_theme_templates( $templates ) {

  //   $templates = array(
  //       //    '../templates/template-components.php' => 'Components Page',
  //       //    '../templates/template-home.php' => 'Landing Page',
  //       //    '../templates/template-news.php' => 'News Page',
  //       // '../templates/template-modules.php' => 'Modular Content',
  //       );

  //   return $templates;
  // }
  // add_filter( 'mtm_filter_templates', 'spring_theme_templates' );

/**
 * Templates and Page IDs without editor
 *
 */
function spring_disable_editor( $id = false ) {

	$excluded_templates = array(
		//'page-homepage.php',
		//'page-timeline.php'
	);

	$excluded_ids = array(
		// get_option( 'page_on_front' )
	);

	if( empty( $id ) )
		return false;

	$id = intval( $id );
	$template = get_page_template_slug( $id );

	return in_array( $id, $excluded_ids ) || in_array( $template, $excluded_templates );
}

/**
 * Disable Gutenberg by template
 *
 */
function spring_disable_gutenberg( $can_edit, $post_type ) {

	if( ! ( is_admin() && !empty( $_GET['post'] ) ) )
		return $can_edit;

	if( spring_disable_editor( $_GET['post'] ) )
		$can_edit = false;

	return $can_edit;

}
add_filter( 'gutenberg_can_edit_post_type', 'spring_disable_gutenberg', 10, 2 );
add_filter( 'use_block_editor_for_post_type', 'spring_disable_gutenberg', 10, 2 );

/**
 * Disable Classic Editor by template
 *
 */
function spring_disable_classic_editor() {

	$screen = get_current_screen();
	if( 'page' !== $screen->id || ! isset( $_GET['post']) )
		return;

	if( spring_disable_editor( $_GET['post'] ) ) {
		remove_post_type_support( 'page', 'editor' );
	}

}
add_action( 'admin_head', 'spring_disable_classic_editor' );



/**
* Deregister sidebars from plugin
*/

// function mtm_theme_sidebars( $templates ) {

//   // unregister_sidebar( 'news-page-sidebar' );
//   // unregister_sidebar( 'modular-page-sidebar' );

// }
// add_action( 'widgets_init', 'mtm_theme_sidebars', 11 );
