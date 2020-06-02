<section class="content--page">
    <?php get_template_part( 'templates/page', 'header' ); ?>

    <?php get_template_part( 'templates/no', 'results' ); ?>

    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'templates/content-archive' ); ?>
        <?php // mtm_get_block_part( 'mtm-content', 'list-view' ); ?>
    <?php endwhile; ?>

    <?php if ( $wp_query->max_num_pages > 1 ) : ?>
        <?php get_template_part( 'templates/pagination' ); ?>
    <?php endif; ?>
</section>
