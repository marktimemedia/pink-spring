<?php if ( ! have_posts() ) : ?>
	<div class="alert alert-warning">
		<?php esc_html_e( 'Sorry, no results were found.', 'spring' ); ?>
	</div>
	<?php get_template_part( 'template-parts/searchform' ); ?>
<?php endif; ?>
