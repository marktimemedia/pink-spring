<nav class="nav-pager post--pager">
    <?php previous_post_link( '%link', 'Previous' ); ?>
    <a class="post--pager-all" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"><?php _e( 'All Posts', 'spring' ); ?></a>
    <?php next_post_link(  '%link', 'Next' ); ?></a>
</nav>