<?php
/**
* Page titles
*/

function spring_title() {
	if ( is_home() ) {
		// Settings > Reading > Front Page Displays > Static Page > Posts Page
		if ( get_option( 'page_for_posts', true ) ) {
			return get_the_title( get_option( 'page_for_posts', true ) );
		} else {
			// Settings > Reading > Front Page Displays > Your Latest Posts
			return __( 'Latest Posts', 'spring' );
		}
	} elseif ( is_archive() ) {
		if ( is_tag() ) {
			return '<span class="small-title">' . __( 'Tagged:', 'spring' ) . ' </span>' . apply_filters( 'single_term_title', get_queried_object()->name );
		} elseif ( is_category() ) {
			return apply_filters( 'single_term_title', get_queried_object()->name );
		} elseif ( is_post_type_archive() ) {
			return apply_filters( 'the_title', get_queried_object()->labels->name, get_queried_object_id() );
		} elseif ( is_day() ) {
			// translators: %s is archive term name
			return sprintf( __( 'Daily Archives: %s', 'spring' ), get_the_date() );
		} elseif ( is_month() ) {
			// translators: %s is archive month
			return sprintf( __( 'Monthly Archives: %s', 'spring' ), get_the_date( 'F Y' ) );
		} elseif ( is_year() ) {
			// translators: %s is archive year
			return sprintf( __( 'Yearly Archives: %s', 'spring' ), get_the_date( 'Y' ) );
		} elseif ( is_author() ) {
			// translators: %s is author name
			return sprintf( __( 'All Posts by %s', 'spring' ), get_queried_object()->display_name );
		} else {
			return single_term_title( '', false );
		}
	} elseif ( is_search() ) {
		// translators: %s is search result name
		return sprintf( __( 'Search Results for:', 'spring' ) );
	} elseif ( is_404() ) {
		return __( 'Page Not Found', 'spring' );
	} elseif ( get_the_title() ) {
		return esc_html( get_the_title() );
	} else {
		$obj = get_post_type_object( get_post_type( get_the_ID() ) );
		// translators: %s is post type
		return sprintf( __( '%s Title', 'spring' ), $obj->labels->singular_name );
	}
}

/**
 * Manage output of wp_title()
 */
function spring_wp_title( $title ) {
	if ( is_feed() ) {
		return $title;
	}

	$title .= get_bloginfo( 'name' );

	return $title;
}
add_filter( 'wp_title', 'spring_wp_title', 10 );
