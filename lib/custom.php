<?php
/**
 * Custom functions
 */

/**
* Jetpack support
*/
function spring_jetpack_content_options() {
	add_theme_support(
		'jetpack-content-options',
		array(
			'blog-display'       => 'content', // the default setting of the theme: 'content', 'excerpt' or array( 'content', 'excerpt' ) for themes mixing both display.
			'author-bio'         => true, // display or not the author bio: true or false.
			'author-bio-default' => false, // the default setting of the author bio, if it's being displayed or not: true or false (only required if false).
			'masonry'            => '.site-main', // a CSS selector matching the elements that triggers a masonry refresh if the theme is using a masonry layout.
			'post-details'       => array(
				'stylesheet' => 'spring-main', // name of the theme's stylesheet.
				'date'       => '.byline--date', // a CSS selector matching the elements that display the post date.
				'categories' => '.post--metadata', // a CSS selector matching the elements that display the post categories.
				'tags'       => '.post--metadata', // a CSS selector matching the elements that display the post tags.
				'author'     => '.byline--author', // a CSS selector matching the elements that display the post author.
				'comment'    => '.comments--respond', // a CSS selector matching the elements that display the comment link.
			),
			'featured-images'    => array(
				'archive'         => false, // enable or not the featured image check for archive pages: true or false.
				'archive-default' => true, // the default setting of the featured image on archive pages, if it's being displayed or not: true or false (only required if false).
				'post'            => false, // enable or not the featured image check for single posts: true or false.
				'post-default'    => true, // the default setting of the featured image on single posts, if it's being displayed or not: true or false (only required if false).
				'page'            => false, // enable or not the featured image check for single pages: true or false.
				'page-default'    => true, // the default setting of the featured image on single pages, if it's being displayed or not: true or false (only required if false).
			),
		)
	);

	add_theme_support(
		'infinite-scroll',
		array(
			'container' => 'content-page',
			'render'    => 'spring_infinite_scroll_render',
			'footer'    => 'page',
		)
	);
}
// add_action( 'after_setup_theme', 'spring_jetpack_content_options' );

/**
 * Custom render function for Infinite Scroll.
 */
function spring_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'templates/content', 'search' );
		else :
			get_template_part( 'templates/content', get_post_type() );
		endif;
	}
}

/**
* Add theme support for Responsive Videos.
*/
function spring_responsive_videos_setup() {
	add_theme_support( 'jetpack-responsive-videos' );
}
// add_action( 'after_setup_theme', 'spring_responsive_videos_setup' );

/**
* Add theme support for Social Menu.
* Use if ( function_exists( 'jetpack_social_menu' ) ) { jetpack_social_menu(); }
*/
// add_theme_support( 'jetpack-social-menu' );

/**
 * Jetpack author bio size
 */
function spring_author_bio_avatar_size() {
	return 60; // in px
}
// add_filter( 'jetpack_author_bio_avatar_size', 'spring_author_bio_avatar_size' );


/**
* Filter Yoast Meta Priority
*/
//add_filter( 'wpseo_metabox_prio', function() { return 'low';});

/**
* Yoast SSL Canonical
* @see https://xeromediaservices.wordpress.com/2016/02/10/yoast-seo-canonical-urls-on-a-site-with-optional-ssl/
*/
function spring_canonical_ssl( $url ) {
	$url = preg_replace( '/^http:/i', 'https:', $url );
	return $url;
}
// add_filter( 'wpseo_canonical', 'spring_canonical_ssl' );
