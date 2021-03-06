<?php
/**
 * Block templates
 * @link https://www.billerickson.net/gutenberg-block-templates/
 *
*/

/* Page */
function spring_page_block_template() {
	$headline_block             = spring_check_block_registry( 'acf/spring-headline' ) ? array( 'acf/spring-headline', array( 'align' => 'center' ) ) : array( 'core/heading', array( 'level' => 1, 'align' => 'center' ) );
	$post_type_object           = get_post_type_object( 'page' );
	$post_type_object->template = array(
		array(
			'core/cover',
			array(
				'overlayColor' => 'brand-color-1',
				'align'        => 'full',
			),
			array(
				$headline_block,
				array(
					'core/paragraph',
					array(
						'fontSize'    => 'large',
						'align'       => 'center',
						'placeholder' => 'Lead subheading text...',
					),
				),
			),
		),
		array(
			'core/paragraph',
			array(
				'placeholder' => 'Start typing to add your page text...',
			),
		),
	);
}
add_action( 'init', 'spring_page_block_template' );

/* Post */
function spring_post_block_template() {
	$headline_block             = spring_check_block_registry( 'acf/spring-headline' ) ? array( 'acf/spring-headline' ) : array( 'core/heading', array( 'level' => 1 ) );
	$post_type_object           = get_post_type_object( 'post' );
	$post_type_object->template = array(
		$headline_block,
		array(
			'core/paragraph',
			array(
				'fontSize'    => 'large',
				'placeholder' => 'Subheading text...',
			),
		),
		array(
			'core/paragraph',
			array(
				'placeholder' => 'Start typing to add your post text...',
			),
		),
	);
}
add_action( 'init', 'spring_post_block_template' );
