<?php
/**
* Editor Setup
*/
function spring_setup_editor() {

  /** Editor Style */
  add_theme_support('editor-styles');
  // add_theme_support( 'dark-editor-style' ); // dark mode (optional)

  /** Gutenberg Features */
  add_theme_support( 'align-wide' ); // gutenberg wide block support
  //add_theme_support( 'wp-block-styles' ); // allow default block styles
  add_theme_support( 'disable-custom-colors' ); // no custom picker
  // add_theme_support( 'disable-custom-gradients' ); // no custom gradients

}
add_action('after_setup_theme', 'spring_setup_editor');

/**
* Register Editor Color Controls
*/
function spring_editor_color_palette()
{
    $palette = spring_editor_palette(); // palette.php
    foreach ( $palette as $key => $item ) {
        $color = get_theme_mod( $key, $item['color'] );
        $editor_color_palette[] = array(
            'name' => $item['name'],
            'slug' => $key,
            'color' => $color,
        );
    }
    add_theme_support('editor-color-palette', $editor_color_palette);

}
add_action('after_setup_theme', 'spring_editor_color_palette');

/**
* Gradient Palettes
* Remove disable gradients above when this is done
*/
function spring_editor_gradient_palette() {

  $palette = spring_brand_colors(); // palette.php
  $j = 1;
  foreach ( $palette as $key => $item ) {
    if ($item['color']) {
      $color = get_theme_mod( $key, $item['color'] );
      $gradients[] = array(
              'name'     => __( 'Theme Color ' . $j .' Darker', 'spring' ),
              'gradient' => 'linear-gradient(135deg,'.$color.' 0%,'.color_luminance($color, -.4).' 100%)',
              'slug'     => $key . '-gradient-darker'
          );
      $gradients[] = array(
              'name'     => __( 'Theme Color ' . $j++ .' Lighter', 'spring' ),
              'gradient' => 'linear-gradient(135deg,'.$color.' 0%,'.color_luminance($color, .4).' 100%)',
              'slug'     => $key . '-gradient-lighter'
          );
    }
  }
  add_theme_support( 'editor-gradient-presets', $gradients );
}
add_action('after_setup_theme', 'spring_editor_gradient_palette');

/**
 * List of templates/IDs
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
 * ACF Color Palette
 *
 * Add default color palatte to ACF color picker for branding
 * Match these colors to colors in Gutenberg function & SCSS values
 *
*/
function spring_acf_admin_scripts() {

    wp_register_script( 'acf_custom', get_template_directory_uri() . '/assets/js/build/acf-custom.js' );

		$palette = spring_editor_palette(); // palette.php
		foreach ( $palette as $key => $item ) {
			$color = get_theme_mod( $key, $item['color'] );
			$newkey = str_replace("-", "", $key);
			$spring_acf_colors[$newkey] = $color;
		}

    wp_localize_script( 'acf_custom', 'custom_colors', $spring_acf_colors );
    wp_enqueue_script( 'acf_custom');
}

add_action( 'acf/input/admin_enqueue_scripts', 'spring_acf_admin_scripts' );

/*
* Add custom colors to ACF color picker
* https://whiteleydesigns.com/synchronizing-your-acf-color-picker-with-gutenberg-color-classes/
*/
function spring_filter_acf_class_colors( $colors ) {
  // global $springcolor1, $springcolor2, $springcolor3, $springcolor4, $springwhite, $springNlightest, $springNlighter, $springNlight, $springNmid, $springNdark, $springNdarker, $springNdarkest;

	$palette = spring_editor_palette();  // palette.php
	foreach ( $palette as $key => $item ) {
		$color = get_theme_mod( $key, $item['color'] );
		$colors[$key] = $color;
	}

  return $colors;
}
add_filter( 'mtm_block_colors_filter', 'spring_filter_acf_class_colors' );

/**
* Remove certain blocks on page template
*/
// function spring_allowed_block_types( $allowed_blocks, $post ) {
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
// add_filter( 'allowed_block_types', 'spring_allowed_block_types', 10, 2 );
