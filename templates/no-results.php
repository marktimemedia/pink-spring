<?php if ( !have_posts() ) : ?>
    <div class="alert alert-warning">
        <?php _e( 'Sorry, no results were found.', 'spring' ); ?>
    </div>
    <?php get_template_part( 'templates/searchform' ) ?>
<?php endif;