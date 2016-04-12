<?php if ( !have_posts() ) : ?>
    <div class="alert alert-warning">
        <?php _e( 'Sorry, no results were found.', 'spring' ); ?>
    </div>
    <?php get_search_form(); ?>
<?php endif; ?>