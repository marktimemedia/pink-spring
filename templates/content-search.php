<article <?php post_class( 'archive' ); ?>>

  <?php
  $content_size = ( has_post_thumbnail() ) ? '' : '-full';
  $post_type_object = get_post_type_object( get_post_type( $post ) );
  $post_type = $post_type_object->labels->singular_name;

  ?>

    <?php if( has_post_thumbnail() ) : ?>
      <section class="mtm-list--image">
        <a aria-hidden="true" tabindex="-1" href="<?php the_permalink(); ?>"><figure class="post--thumbnail mtm-post-thumbnail" style="background-image:url(<?php the_post_thumbnail_url( 'medium_large' ); ?>)"></figure></a>
      </section>
    <?php endif; ?>

  	<section class="post--summary acfes-list--post-content<?php echo $content_size; ?>">
      <header>
    		<h2 class="post--title"><a href="<?php the_permalink(); ?>"><?php echo esc_html( $post_type ) . ': ' . get_the_title(); ?></a></h2>
      </header>
  		<?php the_excerpt('<p>Continue Reading...</p>' ); ?>
  	</section>
    <?php get_template_part( 'templates/post-meta' ); ?>
</article>
