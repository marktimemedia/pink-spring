<?php
/**
 * Utility functions
 * Functions to be used within the theme
 */
function add_filters( $tags, $function ) {
	foreach ( $tags as $tag ) {
		add_filter( $tag, $function );
	}
}

function is_element_empty( $element ) {
	$element = trim( $element );
	return empty( $element ) ? false : true;
}

/**
* Check Block Registry if a block exists
*/
function spring_check_block_registry( $name ) {
	// return 1 or nothing
	return WP_Block_Type_Registry::get_instance()->is_registered( $name );
}

/**
* Custom Taxonomy Term Links
* From http://codex.wordpress.org/Function_Reference/get_the_terms
* echo mtm_custom_taxonomies_terms_links(); in your template file
*/

// get taxonomies terms links
function mtm_get_custom_taxonomies_terms_links( $post ) {
	// get post by post id
	$post = get_post( $post->ID );

	// get post type by post
	$post_type = $post->post_type;

	// get post type taxonomies
	$taxonomies = get_object_taxonomies( $post_type, 'objects' );

	$open  = '';
	$close = '';
	$out   = array();
	foreach ( $taxonomies as $taxonomy_slug => $taxonomy ) {

		if ( true === $taxonomy->public ) {

			// get the terms related to post
			$terms = get_the_terms( $post->ID, $taxonomy_slug );

			if ( ! empty( $terms ) ) {
				$num_items = count( $terms ); // how many terms are there
				$i         = 0;

				$open  = '<div class="post--metadata-group">';
				$out[] = '<span class="post--metadata--title">' . $taxonomy->label . ': </span><ul>';
				foreach ( $terms as $term ) {
					if ( ++$i === $num_items ) { // if this is the last one
						$out[] = sprintf(
							'<li><a aria-label="View all filed under %2$s" href="%1$s" data-id="%3$s">%2$s</a></li></ul>',
							esc_url( get_term_link( $term->slug, $taxonomy_slug ) ),
							esc_html( $term->name ),
							esc_html( $term->term_id )
						);
					} else {
						$out[] = sprintf(
							'<li><a aria-label="View all filed under %2$s" href="%1$s" data-id="%3$s">%2$s</a>,</li> ',
							esc_url( get_term_link( $term->slug, $taxonomy_slug ) ),
							esc_html( $term->name ),
							esc_html( $term->term_id )
						);
					}
				}
				$close = "</div>\n";
			}
		}
	}

	return $open . implode( '', $out ) . $close;
}

/**
* Term Links From Defined Taxonomy
*/

function mtm_terms_from_taxonomy_links_all( $tax = '', $post_type = '' ) {

	$terms = get_terms( $tax );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		$count     = count( $terms );
		$i         = 0;
		$term_list = '<ul class="mtm-component--term-list"><li><a href="' . site_url( $post_type ) . '">' . __( 'View All', 'spring' ) . '</a></li>';
		foreach ( $terms as $term ) {
			$i++;
			// translators: %s is term name
			$term_list .= '<li><a aria-label="View all filed under %s" href="' . get_term_link( $term ) . '" title="' . sprintf( __( 'View all filed under %s', 'spring' ), $term->name ) . '" data-id="' . $term->term_id . '">' . $term->name . '</a></li>';
			if ( $count !== $i ) {
				$term_list .= ' ';
			} else {
				$term_list .= '</ul>';
			}
		}
		echo wp_kses_post( $term_list );
	}
}
