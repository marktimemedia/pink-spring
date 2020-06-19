<?php
/**
 * Page titles
 */
function spring_title() {
  if ( is_home() ) {
    // Settings > Reading > Front Page Displays > Static Page > Posts Page
    if ( get_option( 'page_for_posts', true) ) {
      return get_the_title( get_option( 'page_for_posts', true ) );
    } else {
      // Settings > Reading > Front Page Displays > Your Latest Posts
      return __( 'Latest Posts', 'spring' );
    }
  } elseif ( is_archive() ) {
    $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    if ( $term ) {
      return apply_filters( 'single_term_title', $term->name );
    } elseif ( is_post_type_archive() ) {
      return apply_filters('the_title', get_queried_object()->labels->name, get_queried_object_id());
    } elseif ( is_day() ) {
      return sprintf(__( 'Daily Archives: %s', 'spring'), get_the_date() );
    } elseif ( is_month() ) {
      return sprintf(__( 'Monthly Archives: %s', 'spring' ), get_the_date( 'F Y' ) );
    } elseif ( is_year() ) {
      return sprintf(__( 'Yearly Archives: %s', 'spring' ), get_the_date( 'Y' ) );
    } elseif ( is_author() ) {
      $author = get_queried_object();
      return sprintf( __( 'Author Archives: %s', 'spring' ), $author->display_name );
    } else {
      return single_cat_title( '', false );
    }
  } elseif ( is_search() ) {
    return sprintf( __('Search Results for %s', 'spring' ), get_search_query() );
  } elseif ( is_404() ) {
    return __( 'Page Not Found', 'spring' );
  } elseif ( get_the_title() ) {
    return esc_html( get_the_title() );
  } else {
    $obj = get_post_type_object( get_post_type( get_the_ID() ) );
    return sprintf(__( '%s Title', 'spring' ), $obj->labels->singular_name );
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
