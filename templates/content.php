<article <?php post_class(); ?>>
    <header>
        <h1 class="post--title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php edit_post_link( '(Edit)', ' • ' ); ?></h1>
    </header>
    <?php if ( has_post_thumbnail() ) : ?>
        <figure class="post--thumbnail"><?php the_post_thumbnail( 'full' ) ?></figure>
    <?php endif; ?>
    <?php get_template_part( 'templates/entry-meta' ); ?>
    <div class="post--summary">
        <?php the_content( '<p>Continue Reading...</p>' ); ?>
    </div>
    <?php get_template_part( 'templates/post-meta' ); ?>
</article>
