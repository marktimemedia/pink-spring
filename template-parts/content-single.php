<?php while ( have_posts() ) :
	the_post();
	?>
		<article <?php post_class(); ?>>
				<div class="post--content">
					<?php the_content(); ?>
				</div>
				<?php get_template_part( 'template-parts/post-meta' ); ?>
				<?php get_template_part( 'template-parts/nav-pager' ); ?>
		</article>
<?php endwhile; ?>
