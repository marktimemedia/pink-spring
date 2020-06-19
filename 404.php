<section class="content--page">
	<?php
	$errorPage = get_theme_mod( 'custom_error_page' ) ? : false ;

	if( $errorPage ) :
		$post = get_post( $errorPage ); // override $post
		setup_postdata( $post ); ?>
		<?php get_template_part( 'templates/page', 'header' ); ?>
		<?php if( get_theme_mod( 'error_page_search_bar' ) ) :
				get_template_part( 'templates/searchform' );
			endif; ?>
		<?php the_content(); ?>
		<?php wp_reset_postdata(); ?>

	<?php else : ?>
		<?php get_template_part( 'templates/page', 'header' ); ?>
		<?php if( get_theme_mod( 'error_page_search_bar' ) ) :
				get_template_part( 'templates/searchform' );
			endif; ?>
		<div class="alert alert-warning">
		    <?php _e( 'Sorry, but the page you were trying to view does not exist.', 'spring' ); ?>
		</div>
		<p><?php _e( 'It looks like this was the result of either:', 'spring' ); ?></p>
		<ul>
		    <li><?php _e( 'a mistyped address', 'spring' ); ?></li>
		    <li><?php _e( 'an out-of-date link', 'spring' ); ?></li>
		</ul>
	<?php endif; ?>
</section>
