<?php
/**
* Utility functions
* Functions to be used within the theme
*/
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
* Safe ACF checks
*
 * Return a custom field stored by the Advanced Custom Fields plugin
 * From http://seanbutze.com/safely-using-advanced-custom-fields-via-wrapper-functions/
 *
 * @global $post
 * @param str $key The key to look for
 * @param mixed $id The post ID (int|str, defaults to $post->ID)
 * @param mixed $default Value to return if get_field() returns nothing
 * @return mixed
 * @uses get_field()
 */
if ( ! function_exists( '_get_field' ) ) {
	function _get_field( $key, $id = false, $default = '' ) {
		global $post;
		$key    = trim( filter_var( $key, FILTER_SANITIZE_STRING ) );
		$result = '';

		if ( function_exists( 'get_field' ) ) {
			if ( isset( $post->ID ) && ! $id ) {
				$result = get_field( $key );
			} else {
				$result = get_field( $key, $id );
			}
		}
		if ( '' === $result ) { // If ACF enabled but key is undefined, return default
			$result = $default;
		} else {
			$result = $default;
		}
		return $result;
	}
}

/**
 * Shortcut for 'echo _get_field()'
 * @param str $key The meta key
 * @param mixed $id The post ID (int|str, defaults to $post->ID)
 * @param mixed $default Value to return if there's no value for the custom field $key
 * @return void
 * @uses _get_field()
 */
if ( ! function_exists( '_the_field' ) ) {
	function _the_field( $key, $id = false, $default = '' ) {
		echo _get_field( $key, $id, $default ); //phpcs:ignore
	}
}
/**
 * Get a sub field of a Repeater field
 * @param str $key The meta key
 * @param mixed $default Value to return if there's no value for the custom field $key
 * @return mixed
 * @uses get_sub_field()
 */
if ( ! function_exists( '_get_sub_field' ) ) {
	function _get_sub_field( $key, $default = '' ) {
		if ( function_exists( 'get_sub_field' ) && get_sub_field( $key ) ) {
			return get_sub_field( $key );
		} else {
			return $default;
		}
	}
}
/**
 * Shortcut for 'echo _get_sub_field()'
 * @param str $key The meta key Value to return if there's no value for the custom field $key
 * @return void
 * @uses _get_sub_field()
 */
if ( ! function_exists( '_the_sub_field' ) ) {
	function _the_sub_field( $key, $default = '' ) {
		echo _get_sub_field( $key, $default ); //phpcs:ignore
	}
}
/**
 * Check if a given field has a sub field
 * @param str $key The meta key
 * @param mixed $id The post ID
 * @return bool
 * @uses has_sub_field()
 */
if ( ! function_exists( '_has_sub_field' ) ) {
	function _has_sub_field( $key, $id = false ) {
		if ( function_exists( 'has_sub_field' ) ) {
			return has_sub_field( $key, $id );
		} else {
			return false;
		}
	}
}

/**
* kses ruleset for SVG escaping
*/
function kses_svg_ruelset() {
	$kses_defaults = wp_kses_allowed_html( 'post' );

	$svg_args = array(
		'svg'   => array(
			'class'           => true,
			'aria-hidden'     => true,
			'aria-labelledby' => true,
			'role'            => true,
			'xmlns'           => true,
			'width'           => true,
			'height'          => true,
			'viewbox'         => true,
		),
		'g'     => array( 'fill' => true ),
		'title' => array( 'title' => true ),
		'path'  => array(
			'd'    => true,
			'fill' => true,
		),
		'use'   => array(
			'xlink:href' => true,
		),
	);
	return array_merge( $kses_defaults, $svg_args );
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
