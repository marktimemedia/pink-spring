<?php
/** Gutenberg Color Palette, Update with Spring Colors */
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
$springNdarkest   = '#30292d';
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
* Editor Setup
*/
function spring_setup_editor() {

  global $springcolor1, $springcolor2, $springcolor3, $springcolor4, $springwhite, $springNlightest, $springNlighter, $springNlight, $springNmid, $springNdark, $springNdarker, $springNdarkest;

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
add_action('after_setup_theme', 'spring_setup_editor');

/**
* Remove certain blocks on page template
*/

// add_filter( 'allowed_block_types', 'mtm_allowed_block_types', 10, 2 );
//
// function mtm_allowed_block_types( $allowed_blocks, $post ) {
//
// 	if( $post->_wp_page_template === 'template-background' || $post->_wp_page_template === 'template-home' ) {
//     $allowed_blocks = array(
//   		'core/paragraph',
//   		'core/heading',
//   		'core/list',
//       'core/quote',
//       'core/audio',
//       'core/table',
//       'core/html',
//       'core/pullquote',
//       'core/button',
//       'core/shortcode',
//       'core/spacer'
//   	);
// 	}
//
// 	return $allowed_blocks;
//
// }

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
