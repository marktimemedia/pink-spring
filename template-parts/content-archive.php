<?php
global $archive_type;
$archive_type   = get_option( 'mtm_archive_type' ) ? get_option( 'mtm_archive_type' ) : 'list';
$grid_row_class = get_option( 'mtm_grid_per_row' ) ? 'mtm-per-row-' . get_option( 'mtm_grid_per_row' ) : 'mtm-per-row-3';
$post_class     = ( 'grid' === $archive_type ) ? 'archive mtm-' . $archive_type . '--single ' . $grid_row_class : 'archive mtm-' . $archive_type . '--single';
?>

<article <?php post_class( $post_class ); ?>>

<?php $content_size = ( has_post_thumbnail() ) ? '' : '-full'; ?>

<?php get_template_part( 'template-parts/featured-image', 'cropped' ); ?>

	<section class="post--summary mtm-<?php echo esc_html( $archive_type ); ?>--post-content<?php echo esc_html( $content_size ); ?>">
		<header>
			<h2 class="post--title h3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</header>
		<?php the_excerpt( '<p>Continue Reading...</p>' ); ?>
	</section>
	<?php get_template_part( 'template-parts/post-meta' ); ?>
</article>
