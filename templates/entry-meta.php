<section class="post--byline">
	<span class="byline--author author vcard"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" aria-label="Posts by author: <?php echo get_the_author(); ?>" class="fn"><?php echo get_the_author(); ?></a></span> &#8226; <time class="byline--date published" datetime="<?php echo esc_html( get_the_time( 'c' ) ); ?>"><?php the_time( 'F j, Y' ); ?></time>
</section>
