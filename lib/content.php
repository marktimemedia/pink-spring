<?php
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
