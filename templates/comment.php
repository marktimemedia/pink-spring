<?php echo get_avatar( $comment, $size = '64' ); ?>
<div class="comment--body">
		<header class="comment--name">
			<?php echo get_comment_author_link(); ?>
		</header>
		<section class="comment--byline">
			<time datetime="<?php comment_date( 'c' ); ?>">
				<a href="<?php comment_link( $comment->comment_ID ); ?>"><?php comment_date(); ?></a>
			</time>
		</section>

		<?php if ( '0' === $comment->comment_approved ) : ?>
			<section class="comment--awaiting-moderation alert alert-info">
				<?php esc_html_e( 'Your comment is awaiting moderation.', 'spring' ); ?>
			</section>
		<?php endif; ?>

		<section class="comment--text">
			<?php comment_text(); ?>
			<?php comment_reply_link(
				array_merge( $args, array(
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
				))
			);
			edit_comment_link( __( '&#8226; (Edit)', 'spring' ), '', '' ); ?>
		</section>
</div>
