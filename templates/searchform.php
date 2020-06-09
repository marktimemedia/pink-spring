<?php // Search Form

/* Generate unique ID for each search form on page */
global $txtSearch;
if( !isset( $txtSearch ) ) { $txtSearch = 1; }
?>

<section class="search-form">
    <form role="search" method="get" class="search--form" action="<?php echo home_url( '/' ); ?>">
        <div class="form--group">
            <label for="txtSearch-<?php echo $txtSearch; ?>"><?php _e( 'Search for:', 'spring' ); ?></label>
            <input id="txtSearch-<?php echo $txtSearch++; ?>" type="search" value="<?php if ( is_search() ) { echo get_search_query(); } ?>" name="s" class="textbox search--textbox" placeholder="<?php _e( 'Search', 'spring' ); ?> <?php bloginfo( 'name' ); ?>">
            <button type="submit" class="button search--button"><?php _e( 'Search', 'spring' ); ?></button>
        </div>
    </form>
</section>
