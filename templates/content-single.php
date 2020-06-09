<?php while ( have_posts() ) : the_post(); ?>
    <article <?php post_class(); ?>>
        <header >
            <h1 class="post--title"><?php the_title(); ?></h1>
        </header>
        <div class="post--content">
            <?php the_content(); ?>
        </div>
        <?php get_template_part( 'templates/post-meta' ); ?>
        <?php get_template_part( 'templates/nav-pager' ); ?>
    </article>
<?php endwhile; ?>
