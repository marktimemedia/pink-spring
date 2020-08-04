<?php while ( have_posts() ) :
	the_post();
	?>
		<article <?php post_class(); ?>>
				<header >
					<?php if ( get_the_title() ) : ?>
							<h1 class="post--title"><?php the_title(); ?></h1>
						<?php endif; ?>
						<?php get_template_part( 'templates/entry-meta' ); ?>
						<?php if ( has_excerpt() ) : ?>
							<div class="post--summary"><?php the_excerpt(); ?></div>
						<?php endif; ?>
				</header>
				<div class="post--content">
						<?php the_content(); ?>
				</div>
				<?php get_template_part( 'templates/post-meta' ); ?>
				<?php get_template_part( 'templates/nav-postname-pager' ); ?>
				<?php comments_template( '/templates/comments.php' ); ?>
		</article>
<?php endwhile; ?>
