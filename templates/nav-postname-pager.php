<?php // Nav Pager (single)
$post_type_obj = get_post_type( $post );
$slug          = get_post_type_object( $post_type_obj )->rewrite['slug'];
$prev          = get_previous_post();
$next          = get_next_post();
?>

<section class="nav-pager postname-pager">
<?php
if ( $prev ) :
	setup_postdata( $prev );
	?>
	<div class="pager pager--previous">
		<div class="entry-meta">
			<span class="posted-on">
				<time class="byline--date entry-date published" datetime="<?php echo esc_attr( get_the_date( 'm.d.Y', $prev ) ); ?>">
					<?php echo esc_attr( get_the_date( 'F j, Y', $prev ) ); ?>
				</time>
			</span>
		</div>
		<h3 class="pager--title h4"><?php echo esc_html( get_the_title( $prev ) ); ?></h3>
		<a class="read-more" href="<?php echo esc_url( get_the_permalink( $prev ) ); ?>"><?php esc_html_e( 'Previous', 'boreta' ); ?></a>
	</div>
	<?php
	wp_reset_postdata();
endif;
if ( $next ) :
	setup_postdata( $next );
	?>
	<div class="pager pager--next">
		<div class="entry-meta">
			<span class="posted-on">
				<time class="byline--date entry-date published" datetime="<?php echo esc_attr( get_the_date( 'm.d.Y', $next ) ); ?>">
					<?php echo esc_attr( get_the_date( 'F j, Y', $next ) ); ?>
				</time>
			</span>
		</div>
		<h3 class="pager--title h4"><?php echo esc_html( get_the_title( $next ) ); ?></h3>
		<a class="read-more" href="<?php echo esc_url( get_the_permalink( $next ) ); ?>"><?php esc_html_e( 'Next', 'boreta' ); ?></a>
	</div>
	<?php
	wp_reset_postdata();
endif;
?>
</section>
