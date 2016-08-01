<?php // Nav Pager (single)
$posttype = get_post_type( $post );
$all = get_post_type_object( $posttype )->labels->all_items;
?>

<nav class="nav-pager post--pager">
    <?php previous_post_link( '%link', 'Previous' ); ?>
    <a class="post--pager-all" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"><?php _e( $all, 'spring' ); ?></a>
    <?php next_post_link(  '%link', 'Next' ); ?></a>
</nav>