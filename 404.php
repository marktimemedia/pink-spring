<section class="content--page">
	<?php if( false !== mtm_acf_check() && get_field( 'mtm_custom_404_page', 'option' ) ) :
		$errorPage = get_field( 'mtm_custom_404_page', 'option' ) ? : false ;
		// override $post
		$post = $errorPage;
		setup_postdata( $post ); ?>

		<header class="page--header">
				<h1 class="page--title">
						<?php echo the_title(); ?><?php edit_post_link( '(Edit)', ' • ' ); ?>
				</h1>
		</header>
		<?php if( !false == get_field( 'mtm_custom_404_page_enable_search', 'option') ) :
				get_template_part( 'templates/searchform' );
			endif; ?>
		<?php the_content(); ?>
		<?php wp_reset_postdata(); ?>
	<?php else : ?>
		<?php get_template_part( 'templates/page', 'header' ); ?>
		<?php if( false !== mtm_acf_check() && !false == get_field( 'mtm_custom_404_page_enable_search', 'option') ) : // checking for "not false" instead of "true" in case it wasn't set
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
