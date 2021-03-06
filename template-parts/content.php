<article <?php post_class(); ?>>
		<header>
			<h1 class="post--title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		</header>
		<?php get_template_part( 'template-parts/entry-meta' ); ?>
		<div class="post--summary">
			<?php the_content( '<p>Continue Reading...</p>' ); ?>
		</div>
		<?php get_template_part( 'template-parts/post-meta' ); ?>
</article>
