<?php // Nav Pager (single)
$posttype = get_post_type( $post );
$all = get_post_type_object( $posttype )->labels->all_items;

if( is_singular( 'post' ) ) :
	$postlink = get_permalink( get_option( 'page_for_posts' ) );
else :
	$postlink = '/' . $posttype;
endif;
?>

<nav class="nav-pager post--pager">
    <?php previous_post_link( '%link', 'Previous' ); ?>
    <a class="post--pager-all" href="<?php echo $postlink; ?>"><?php _e( $all, 'spring' ); ?></a>
    <?php next_post_link(  '%link', 'Next' ); ?></a>
</nav>