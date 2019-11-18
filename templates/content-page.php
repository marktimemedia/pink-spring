<?php while ( have_posts() ) : the_post(); ?>
	<?php if ( has_post_thumbnail() ) : ?>
    	<figure class="post--thumbnail"><?php the_post_thumbnail( 'full' ); ?></figure>
    <?php endif; ?>
    <div class="post--content">
    	<?php the_content(); ?>
    </div>
    <?php wp_link_pages( array( 'before' => '<nav class="pagination">', 'after' => '</nav>' ) ); ?>
<?php endwhile; ?>
