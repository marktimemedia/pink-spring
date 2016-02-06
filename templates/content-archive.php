<article <?php post_class( 'archive' ); ?>>
    <header>
        <h1 class="post--title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php edit_post_link( '(Edit)', ' • ' ); ?></h1>
    </header>
    <?php the_mtm_post_thumbnail( 'medium_large' ); ?>
    <?php get_template_part( 'templates/entry-meta' ); ?>
    <div class="post--summary">
        <?php the_excerpt( '<p>Continue Reading...</p>' ); ?>
    </div>
    <?php get_template_part( 'templates/post-meta' ); ?>
</article>
