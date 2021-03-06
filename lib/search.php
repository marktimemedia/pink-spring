<?php
/**
* Display and output search bar
*/
function spring_search_scripts() {
	wp_enqueue_script( 'search-toggle', get_template_directory_uri() . '/assets/js/build/search-toggle.js', array( 'jquery' ), 1, true );
}
add_action( 'wp_enqueue_scripts', 'spring_search_scripts', 100 );

function spring_search_bar() {
	if ( get_theme_mod( 'header_search_bar' ) ) {
		echo '<button aria-label="Toggle Search Bar" class="fa fa-search search-toggle run-toggle"></button>';
		get_template_part( 'template-parts/searchform' );
	}
}


/**
 * Redirects search results from /?s=query to /search/query/, converts %20 to +
 *
 * @link http://txfx.net/wordpress-plugins/nice-search/
 */
function spring_nice_search_redirect() {
	global $wp_rewrite;
	if ( ! isset( $wp_rewrite ) || ! is_object( $wp_rewrite ) || ! $wp_rewrite->using_permalinks() ) {
		return;
	}

	$search_base = $wp_rewrite->search_base;
	if ( is_search() && ! is_admin() && strpos( $_SERVER['REQUEST_URI'], "/{$search_base}/" ) === false ) {
		wp_safe_redirect( home_url( "/{$search_base}/" . rawurlencode( get_query_var( 's' ) ) ) );
		exit();
	}
}
if ( current_theme_supports( 'nice-search' ) ) {
	add_action( 'template_redirect', 'spring_nice_search_redirect' );
}

/**
 * Fix for empty search queries redirecting to home page
 *
 * @link http://wordpress.org/support/topic/blank-search-sends-you-to-the-homepage#post-1772565
 * @link http://core.trac.wordpress.org/ticket/11330
 */
function spring_request_filter( $query_vars ) {
	if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
		$query_vars['s'] = ' ';
	}

	return $query_vars;
}
add_filter( 'request', 'spring_request_filter' );

/**
 * Tell WordPress to use searchform.php from the templates/ directory
 */
function spring_get_search_form( $form ) {
	$form = '';
	locate_template( '/template-parts/searchform.php', true, false );
	return $form;
}
add_filter( 'get_search_form', 'spring_get_search_form' );
