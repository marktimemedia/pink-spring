<section class="content--page" id="content-page">
	<?php
	$error_page = get_theme_mod( 'custom_error_page' ) ? get_theme_mod( 'custom_error_page' ) : false;

	if ( $error_page ) :
		$post = get_post( $error_page ); // override $post
		setup_postdata( $post );
		get_template_part( 'templates/page', 'header' );
		if ( get_theme_mod( 'error_page_search_bar' ) ) :
				get_template_part( 'templates/searchform' );
			endif;
		the_content();
		wp_reset_postdata();

	else :
		get_template_part( 'templates/page', 'header' );
		if ( get_theme_mod( 'error_page_search_bar' ) ) :
			get_template_part( 'templates/searchform' );
		endif;
		?>
		<div class="alert alert-warning">
			<?php esc_html_e( 'Sorry, but the page you were trying to view does not exist.', 'spring' ); ?>
		</div>
		<p><?php esc_html_e( 'It looks like this was the result of either:', 'spring' ); ?></p>
		<ul>
				<li><?php esc_html_e( 'a mistyped address', 'spring' ); ?></li>
				<li><?php esc_html_e( 'an out-of-date link', 'spring' ); ?></li>
		</ul>
	<?php endif; ?>
</section>
