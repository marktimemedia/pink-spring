<section class="content--page" id="content-page">
	<?php get_template_part( 'template-parts/page-header' ); ?>

	<?php get_template_part( 'template-parts/no', 'results' ); ?>

	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<?php get_template_part( 'template-parts/content-archive' ); ?>
	<?php endwhile; ?>

</section>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<?php get_template_part( 'template-parts/pagination' ); ?>
<?php endif; ?>
