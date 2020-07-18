<?php
global $archive_type;

if ( has_post_thumbnail() ) : ?>
	<section class="mtm-<?php echo esc_attr( $archive_type ); ?>--image">
		<a aria-hidden="true" tabindex="-1" href="<?php the_permalink(); ?>">
			<figure class="post--thumbnail" >
				<?php the_post_thumbnail( 'medium_large' ); ?>
			</figure>
		</a>
	</section>
<?php endif; ?>
