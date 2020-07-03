<?php
global $archive_type;

if( has_post_thumbnail() ) : ?>
	<section class="mtm-<?php echo $archive_type; ?>--image">
		<a aria-hidden="true" tabindex="-1" href="<?php the_permalink(); ?>">
      <figure class="post--thumbnail mtm-post-thumbnail" style="background-image:url(<?php the_post_thumbnail_url( 'medium_large' ); ?>)"></figure>
    </a>
	</section>
<?php endif; ?>
