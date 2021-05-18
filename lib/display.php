<?php


/**
 * Define which pages should have the sidebar
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
			array( 'is_singular', array( 'post' ) ),
			// 'is_archive',
			array( 'is_post_type_archive', array( 'post' ) ),
			'is_blog',
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
 * $content_width is a global variable used by WordPress for max image upload sizes
 * and media embeds (in pixels).
 *
 * Example: If the content area is 640px wide, set $content_width = 620; so images and videos will not overflow.
 * Default: 1140px is the default Bootstrap container width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1140;
}

/**
 * Clean up the_excerpt()
 */
define( 'POST_EXCERPT_LENGTH', 30 ); // Length in words for excerpt_length filter (http://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_length)
function spring_excerpt_length( $length ) {
	return POST_EXCERPT_LENGTH;
}

function spring_excerpt_more( $more ) {
	return '... <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read More', 'spring' ) . '</a>';
}
add_filter( 'excerpt_length', 'spring_excerpt_length' );
add_filter( 'excerpt_more', 'spring_excerpt_more' );

/**
* Email Notification Defaults
*/
add_filter( 'wp_mail_from', 'mtm_mail_from' );
add_filter( 'wp_mail_from_name', 'mtm_mail_name' );

function mtm_mail_from( $email ) {
	$email = str_replace( 'http://', '', get_site_url( '', '', 'http' ) );
	return 'noreply@' . $email; // new email address from sender.
}

function mtm_mail_name( $email ) {
	return get_bloginfo( 'name' ); // new email name from sender.
}
