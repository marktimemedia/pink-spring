<?php
/**
 * Block templates
 * @link https://www.billerickson.net/gutenberg-block-templates/
 *
*/

/* Page */
function spring_page_block_template() {
	$headline_block             = spring_check_block_registry( 'acf/spring-headline' ) ? array( 'acf/spring-headline', array( 'align' => 'center' ) ) : array( 'core/heading', array( 'level' => 1 ) );
	$post_type_object           = get_post_type_object( 'page' );
	$post_type_object->template = array(
		array( 'core/cover', array(
			'overlayColor' => 'spring-color-1',
			'align'        => 'full',
		), array(
			$headline_block,
			array( 'core/paragraph', array(
				'fontSize'    => 'large',
				'align'       => 'center',
				'placeholder' => 'Lead subheading text...',
			) ),
		) ),
		array( 'core/paragraph', array(
				'placeholder' => 'Start typing to add your page text...',
		) ),
	);
}
add_action( 'init', 'spring_page_block_template' );

/* Post */
function spring_post_block_template() {
	$headline_block   = spring_check_block_registry( 'acf/spring-headline' ) ? array( 'acf/spring-headline' ) : array( 'core/heading', array( 'level' => 1 ) );
	$post_type_object = get_post_type_object( 'post' );
	$post_type_object->template = array(
		$headline_block,
		array( 'core/paragraph', array(
			"fontSize" => "large",
			'placeholder' => 'Subheading text...'
		) ),
		array( 'core/paragraph', array(
				'placeholder' => 'Start typing to add your post text...'
		) ),
	);
}
add_action( 'init', 'spring_post_block_template' );


/**
* Block Patterns
*/
// if( function_exists( 'unregister_block_pattern' ) ) {
// 	unregister_block_pattern( 'core/EXAMPLE' );
// }

if( function_exists( 'register_block_pattern_category' ) ) {
	register_block_pattern_category(
		'cover',
		array( 'label' => __( 'Cover', 'spring' ) )
	);
	register_block_pattern_category(
		'links',
		array( 'label' => __( 'Links', 'spring' ) )
	);
	register_block_pattern_category(
		'columns',
		array( 'label' => __( 'Columns', 'spring' ) )
	);
	register_block_pattern_category(
		'media-text',
		array( 'label' => __( 'Media And Text', 'spring' ) )
	);
	register_block_pattern_category(
		'featured',
		array( 'label' => __( 'Featured Content', 'spring' ) )
	);
}

if(function_exists('register_block_pattern')) {
	register_block_pattern(
		'spring/cover',
		array(
			'title'      => __( 'Cover Image', 'spring' ),
			'categories' => array( 'cover' ),
			'content'    => '<!-- wp:cover {"overlayColor":"spring-color-1","minHeight":400,"align":"full", "className":"cover-feature"} -->
			<div class="wp-block-cover alignfull has-spring-color-1-background-color has-background-dim cover-feature" style="min-height:400px">
			<div class="wp-block-cover__inner-container">
			<!-- wp:acf/spring-headline {"id":"block_5ee136f9c2ab4","name":"acf/spring-headline","align":"center","mode":"preview"} /-->
			<!-- wp:paragraph {"align":"center","placeholder":"Lead subheading text...","fontSize":"large"} -->
			<p class="has-text-align-center has-large-font-size"></p>
			<!-- /wp:paragraph -->
			<!-- wp:buttons {"align":"center"} -->
			<div class="wp-block-buttons aligncenter">
			<!-- wp:button {"placeholder":"Call To Action", "backgroundColor":"neutral-white","textColor":"neutral-white","className":"is-style-outline"} -->
			<div class="wp-block-button is-style-outline">
			<a class="wp-block-button__link has-neutral-white-color has-neutral-white-background-color has-text-color has-background"></a>
			</div>
			<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
			</div>
			</div>
			<!-- /wp:cover -->',
		)
	);


	register_block_pattern(
		'spring/read-more',
		array(
			'title'      => __( 'Read More Link', 'spring' ),
			'categories' => array( 'links' ),
			'content'    => '<!-- wp:paragraph --><p><a class="cta-link read-more" href="#">Read More</a></p><!-- /wp:paragraph -->',
		)
	);

	register_block_pattern(
		'spring/two-columns-text',
		array(
			'title'      => __( 'Two Column Text', 'spring' ),
			'categories' => array( 'columns' ),
			'content'    => '<!-- wp:columns {"align":"wide"} -->
			<div class="wp-block-columns alignwide"><!-- wp:column -->
			<div class="wp-block-column">
			<!-- wp:heading {"level":3,"placeholder":"Column subheading..."} -->
			<h3></h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"placeholder":"Add an inner paragraph..."} -->
			<p></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p><a class="cta-link read-more" href="#">Read More</a></p>
			<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->
			<!-- wp:column -->
			<div class="wp-block-column">
			<!-- wp:heading {"level":3,"placeholder":"Column subheading..."} -->
			<h3></h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"placeholder":"Add an inner paragraph..."} -->
			<p></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p><a class="cta-link read-more" href="#">Read More</a></p>
			<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->',
		)
	);

	register_block_pattern(
		'spring/three-columns-text',
		array(
			'title'      => __( 'Three Column Text', 'spring' ),
			'categories' => array( 'columns' ),
			'content'    => '<!-- wp:columns {"align":"wide"} -->
			<div class="wp-block-columns alignwide"><!-- wp:column -->
			<div class="wp-block-column">
			<!-- wp:heading {"level":3,"placeholder":"Column subheading..."} -->
			<h3></h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"placeholder":"Add an inner paragraph..."} -->
			<p></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p><a class="cta-link read-more" href="#">Learn More</a></p>
			<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->
			<!-- wp:column -->
			<div class="wp-block-column">
			<!-- wp:heading {"level":3,"placeholder":"Column subheading..."} -->
			<h3></h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"placeholder":"Add an inner paragraph..."} -->
			<p></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p><a class="cta-link read-more" href="#">Learn More</a></p>
			<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->
			<!-- wp:column -->
			<div class="wp-block-column">
			<!-- wp:heading {"level":3,"placeholder":"Column subheading..."} -->
			<h3></h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"placeholder":"Add an inner paragraph..."} -->
			<p></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p><a class="cta-link read-more" href="#">Learn More</a></p>
			<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->',
		)
	);

	register_block_pattern(
		'spring/three-columns-image',
		array(
			'title'      => __( 'Three Column Images', 'spring' ),
			'categories' => array( 'columns' ),
			'content'    => '<!-- wp:columns {"align":"wide"} -->
			<div class="wp-block-columns alignwide">
			<!-- wp:column -->
			<div class="wp-block-column">
			<!-- wp:image -->
			<figure class="wp-block-image"><img alt=""/></figure>
			<!-- /wp:image -->
			<!-- wp:heading {"level":3,"placeholder":"Column subheading..."} -->
			<h3></h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"placeholder":"Add an inner paragraph..."} -->
			<p></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p><a class="cta-link read-more" href="#">Learn More</a></p>
			<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->
			<!-- wp:column -->
			<div class="wp-block-column">
			<!-- wp:image -->
			<figure class="wp-block-image"><img alt=""/></figure>
			<!-- /wp:image -->
			<!-- wp:heading {"level":3,"placeholder":"Column subheading..."} -->
			<h3></h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"placeholder":"Add an inner paragraph..."} -->
			<p></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p><a class="cta-link read-more" href="#">Learn More</a></p>
			<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->
			<!-- wp:column -->
			<div class="wp-block-column">
			<!-- wp:image -->
			<figure class="wp-block-image"><img alt=""/></figure>
			<!-- /wp:image -->
			<!-- wp:heading {"level":3,"placeholder":"Column subheading..."} -->
			<h3></h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"placeholder":"Add an inner paragraph..."} -->
			<p></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p><a class="cta-link read-more" href="#">Learn More</a></p>
			<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->',
		)
	);

	register_block_pattern(
		'spring/media-text-left',
		array(
			'title'      => __( 'Media And Text Left', 'spring' ),
			'categories' => array( 'media-text' ),
			'content'    => '<!-- wp:media-text {"backgroundColor":"palette-light", "verticalAlignment":"center", "imageFill":true} -->
			<div class="wp-block-media-text is-stacked-on-mobile has-palette-light-background-color has-background">
			<figure class="wp-block-media-text__media"></figure>
			<div class="wp-block-media-text__content">
			<!-- wp:heading {"level":4,"placeholder":"Media Text Heading..."} -->
			<h4></h4>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"placeholder":"Subheading text...","fontSize":"large"} -->
			<p class="has-medium-font-size"></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"placeholder":"Add an inner paragraph..."} -->
			<p></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p><a class="cta-link" href="#">Read More</a></p>
			<!-- /wp:paragraph -->
			</div>
			</div>
			<!-- /wp:media-text -->',
		)
	);

	register_block_pattern(
		'spring/media-text-right',
		array(
			'title'      => __( 'Media And Text Right', 'spring' ),
			'categories' => array( 'media-text' ),
			'content'    => '<!-- wp:media-text {"backgroundColor":"palette-light", "mediaPosition":"right", "verticalAlignment":"center", "imageFill":true} -->
			<div class="wp-block-media-text has-media-on-the-right is-stacked-on-mobile has-palette-light-background-color has-background">
			<figure class="wp-block-media-text__media"></figure>
			<div class="wp-block-media-text__content">
			<!-- wp:heading {"level":4,"placeholder":"Media Text Heading..."} -->
			<h4></h4>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"placeholder":"Subheading text...","fontSize":"large"} -->
			<p class="has-medium-font-size"></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"placeholder":"Add an inner paragraph..."} -->
			<p></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p><a class="cta-link" href="#">Read More</a></p>
			<!-- /wp:paragraph -->
			</div>
			</div>
			<!-- /wp:media-text -->',
		)
	);

	register_block_pattern(
		'spring/content-callout',
		array(
			'title'      => __( 'Content And Callout', 'spring' ),
			'categories' => array( 'featured' ),
			'content'    => '<!-- wp:group {"className":"content-callout"} -->
			<div id="content-callout" class="wp-block-group content-callout"><div class="wp-block-group__inner-container">
			<!-- wp:columns -->
			<div class="wp-block-columns">
			<!-- wp:column {"width":75} -->
			<div class="wp-block-column" style="flex-basis:75%">
			<!-- wp:heading {"placeholder":"Callout Text Heading...","level":2,} -->
			<h2></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"placeholder":"Add an inner paragraph..."} -->
			<p></p>
			<!-- /wp:paragraph --></div>
			<!-- /wp:column -->
			<!-- wp:column {"width":25} -->
			<div class="wp-block-column" style="flex-basis:25%">
			<!-- wp:cover {"overlayColor":"spring-color-2","minHeight":50,"contentPosition":"center center"} -->
			<div class="wp-block-cover has-spring-color-2-background-color has-background-dim is-position-center-center" style="min-height:50px">
			<div class="wp-block-cover__inner-container">
			<!-- wp:paragraph {"placeholder":"Add callout text...","align":"center","fontSize":"medium"} -->
			<p class="has-text-align-center has-medium-font-size"></p>
			<!-- /wp:paragraph -->
			</div>
			</div>
			<!-- /wp:cover -->
			</div>
			<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->
			</div>
			</div>
			<!-- /wp:group -->',
		)
	);

	register_block_pattern(
		'spring/call-to-action',
		array(
			'title'      => __( 'Content And Callout', 'spring' ),
			'categories' => array( 'featured' ),
			'content'    => '<!-- wp:group {"className":"call-to-action","backgroundColor":"spring-color-1","textColor":"neutral-white"} -->
			<div class="wp-block-group alignfull call-to-action has-neutral-white-color has-spring-color-1-background-color has-text-color has-background" id="call-to-action">
			<div class="wp-block-group__inner-container">
			<!-- wp:columns {"verticalAlignment":null} -->
			<div class="wp-block-columns">
			<!-- wp:column {"verticalAlignment":"top","width":66.66} -->
			<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:66.66%">
			<!-- wp:heading {"placeholder":"Call To Action Heading...","level":2,} -->
			<h2></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"placeholder":"Add call to action text...","align":"left","textColor":"neutral-white","fontSize":"medium"} -->
			<p class="has-text-align-left has-neutral-white-color has-text-color has-medium-font-size"></p>
			<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->
			<!-- wp:column {"verticalAlignment":"top","width":33.33} -->
			<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:33.33%">
			<!-- wp:buttons {"align":"right"} -->
			<div class="wp-block-buttons alignright">
			<!-- wp:button {"placeholder":"Call To Action", "backgroundColor":"neutral-white","textColor":"neutral-white","className":"is-style-outline"} -->
			<div class="wp-block-button is-style-outline">
			<a class="wp-block-button__link has-neutral-white-color has-neutral-white-background-color has-text-color has-background"></a>
			</div>
			<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
			</div>
			<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->
			</div>
			</div>
			<!-- /wp:group -->',
		)
	);
}
