<?php while ( have_posts() ) : the_post(); ?>
    <article <?php post_class(); ?>>
        <?php if ( has_post_thumbnail() ) : ?>
            <figure class="post--thumbnail"><?php the_post_thumbnail( 'full' ) ?></figure>
        <?php endif; ?>
        <header >
            <h1 class="post--title"><?php the_title(); ?><?php edit_post_link( '(Edit)', ' • ' ); ?></h1>
            <?php get_template_part( 'templates/entry-meta' ); ?>
            <?php if( has_excerpt() ) : ?>
                <div class="post--summary"><?php the_excerpt(); ?></div>
            <?php endif; ?>
        </header>
        <div class="post--content">
            <?php the_content(); ?>
        </div>
        <?php get_template_part( 'templates/post-meta' ); ?>
        <?php get_template_part( 'templates/nav-pager' ); ?>
        <?php comments_template( '/templates/comments.php' ); ?>
    </article>
<?php endwhile; ?>
