<?php
/**
 * Clean up wp_head()
 *
 * Remove unnecessary <link>'s
 * Remove inline CSS used by Recent Comments widget
 * Remove inline CSS used by posts with galleries
 * Remove self-closing tag and change ''s to "'s on rel_canonical()
 */
function spring_head_cleanup() {
	// Originally from http://wpengineer.com/1438/wordpress-header/
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );

	if ( ! class_exists( 'WPSEO_Frontend' ) ) {
		remove_action( 'wp_head', 'rel_canonical' );
		add_action( 'wp_head', 'spring_rel_canonical' );
	}
}

function spring_rel_canonical() {
	global $wp_the_query;

	if ( ! is_singular() ) {
		return;
	}

	$id = $wp_the_query->get_queried_object_id();

	if ( 0 === $id ) {
		return;
	}

	$link = get_permalink( $id );
	if ( ! empty( $link ) ) {
		echo '<link rel="canonical" href="' . esc_url( $link ) . '">';
	}
}

add_action( 'init', 'spring_head_cleanup' );

/**
 * Remove the WordPress version from RSS feeds
 */
add_filter( 'the_generator', '__return_false' );

/**
 * Clean up language_attributes() used in <html> tag
 *
 * Change lang="en-US" to lang="en"
 * Remove dir="ltr"
 */
function spring_language_attributes() {
	$attributes = array();
	$output     = '';

	if ( function_exists( 'is_rtl' ) ) {
		if ( is_rtl() === 'rtl' ) {
			$attributes[] = 'dir="rtl"';
		}
	}

	$lang = get_bloginfo( 'language' );

	if ( $lang && 'en-US' !== $lang ) {
		$attributes[] = "lang=\"$lang\"";
	} else {
		$attributes[] = 'lang="en"';
	}

	$output = implode( ' ', $attributes );
	$output = apply_filters( 'spring_language_attributes', $output );

	return $output;
}
add_filter( 'language_attributes', 'spring_language_attributes' );



/**
 * Add and remove body_class() classes
 */
function spring_body_class( $classes ) {
	// Add post/page slug
	if ( is_single() || is_page() && ! is_front_page() ) {
		$classes[] = basename( get_permalink() );
	}

	// Remove unnecessary classes
	$home_id_class  = 'page-id-' . get_option( 'page_on_front' );
	$remove_classes = array(
		'page-template-default',
		$home_id_class,
	);
	$classes        = array_diff( $classes, $remove_classes );

	return $classes;
}
add_filter( 'body_class', 'spring_body_class' );


/**
 * Remove unnecessary dashboard widgets
 *
 * @link http://www.deluxeblogtips.com/2011/01/remove-dashboard-widgets-in-wordpress.html
 */
function spring_remove_dashboard_widgets() {
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
}
add_action( 'admin_init', 'spring_remove_dashboard_widgets' );



/**
 * Remove unnecessary self-closing tags
 */
function spring_remove_self_closing_tags( $input ) {
	return str_replace( ' />', '>', $input );
}
add_filter( 'get_avatar', 'spring_remove_self_closing_tags' ); // <img />
add_filter( 'comment_id_fields', 'spring_remove_self_closing_tags' ); // <input />
add_filter( 'post_thumbnail_html', 'spring_remove_self_closing_tags' ); // <img />

/**
 * Don't return the default description in the RSS feed if it hasn't been changed
 */
function spring_remove_default_description( $bloginfo ) {
	$default_tagline = 'Just another WordPress site';
	return ( $bloginfo === $default_tagline ) ? '' : $bloginfo;
}
add_filter( 'get_bloginfo_rss', 'spring_remove_default_description' );


/**
* Gets rid of current_page_parent class mistakenly being applied to Blog pages while on Custom Post Types
* via https://wordpress.org/support/topic/post-type-and-its-children-show-blog-as-the-current_page_parent
*/
function is_blog() {
	global $post;
	$posttype = get_post_type( $post );
	return ( ( 'post' === $posttype ) && ( is_home() || is_single() || is_archive() || is_category() || is_tag() || is_author() ) ) ? true : false;
}

function fix_blog_link_on_cpt( $classes, $item, $args ) {
	if ( ! is_blog() ) {
		$blog_page_id = intval( get_option( 'page_for_posts' ) );

		if ( 0 !== $blog_page_id && $item->object_id === $blog_page_id ) {
			if ( in_array( 'current_page_parent', $classes, true ) ) {
				unset( $classes[ array_search( 'current_page_parent', $classes, true ) ] );
			}
		}
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'fix_blog_link_on_cpt', 10, 3 );
