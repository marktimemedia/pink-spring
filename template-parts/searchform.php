<?php // Search Form

/* Generate unique ID for each search form on page */
global $txt_search;
if ( ! isset( $txt_search ) ) {
	$txt_search = 1;
}
?>

<section class="search-form">
	<form role="search" method="get" class="search--form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<div class="form--group">
			<label for="txtSearch-<?php echo esc_html( $txt_search ); ?>"><?php esc_html_e( 'Search for:', 'spring' ); ?></label>
			<input id="txtSearch-<?php echo esc_html( $txt_search++ ); ?>" type="search" value="<?php echo is_search() ? get_search_query() : ''; ?>" name="s" class="textbox search--textbox" placeholder="<?php echo esc_html( 'Search ' . get_bloginfo( 'name' ) ); ?>">
			<button type="submit" class="button search--button"><?php esc_html_e( 'Search', 'spring' ); ?></button>
		</div>
	</form>
</section>
