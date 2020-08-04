<?php
if ( post_password_required() ) {
		return;
}

if ( have_comments() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<?php do_action( 'comment_form_before', $post->ID ); ?>
		<section class="comments" id="comments">
			<h3 class="comments--title"><?php printf( _n( 'One Response to &ldquo;%2$s&rdquo;', '%1$s Responses to &ldquo;%2$s&rdquo;', get_comments_number(), 'spring' ), number_format_i18n( get_comments_number() ), get_the_title() ); ?></h3>

			<ol class="comments--list">
				<?php wp_list_comments( array( 'walker' => new spring_Walker_Comment ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<nav aria-label="Comments Pager" class="nav-comments-pager" role="navigation">
						<ul class="comments--pager pager">
							<?php if ( get_previous_comments_link() ) : ?>
									<li class="pager--previous"><?php previous_comments_link( __( '&larr; Older comments', 'spring' ) ); ?></li>
							<?php endif; ?>
							<?php if ( get_next_comments_link() ) : ?>
									<li class="pager--next"><?php next_comments_link( __( 'Newer comments &rarr;', 'spring' ) ); ?></li>
							<?php endif; ?>
						</ul>
					</nav>
			<?php endif; ?>

			<?php if ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
				<div class="alert alert-warning">
					<?php esc_html_e( 'Comments are closed.', 'spring' ); ?>
				</div>
			<?php endif; ?>
		</section><!-- /#comments -->
<?php endif; ?>

<?php if ( ! have_comments() && ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

<?php endif; ?>

<?php if ( comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<section class="comments--respond" id="respond">
			<h3>
				<?php
				//translators: %s is to whom you are leaving a reply
				comment_form_title( __( 'Leave a Reply', 'spring' ), __( 'Leave a Reply to %s', 'spring' ) );
				?>
			</h3>

				<p class="comments--cancel-reply"><?php cancel_comment_reply_link(); ?></p>
				<?php if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) : ?>
						<p><?php printf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'spring' ), wp_login_url( get_permalink() ) ); ?></p>
				<?php else : ?>
						<form action="<?php echo esc_url( get_option( 'siteurl' ) ); ?>/wp-comments-post.php" method="post" id="commentform">
								<?php if ( is_user_logged_in() ) : ?>
										<p>
												<?php printf( __( 'Logged in as <a href="%1$s/wp-admin/profile.php">%2$s</a>.', 'spring' ), get_option( 'siteurl' ), $user_identity ); ?>
												<a href="<?php echo esc_url( wp_logout_url( get_permalink() ) ); ?>"
													title="<?php __( 'Log out of this account', 'spring' ); ?>"><?php esc_html_e( 'Log out &raquo;', 'spring' ); ?></a>
										</p>
								<?php else : ?>
										<div class="comments--form-row form-row">
												<label for="commentsAuthor">
													<?php $req ? esc_html_e( 'Name (required)', 'spring' ) : esc_html_e( 'Name', 'spring' ); ?>
													</label>
												<input type="text" placeholder="Your Display Name" class="textbox" name="author" id="commentsAuthor" value="<?php echo esc_attr( $comment_author ); ?>" size="22" <?php if ( $req ) { echo 'aria-required="true"'; } ?>>
										</div>
										<div class="comments--form-row form-row">
												<label for="commentsEmail">
													<?php $req ? esc_html_e( 'Email (required, will not be published)', 'spring' ) : esc_html_e( 'Email (will not be published)', 'spring' ); ?>
													</label>
												<input type="email" placeholder="sample@email.com" class="textbox" name="email" id="commentsEmail" value="<?php echo esc_attr( $comment_author_email ); ?>" size="22" <?php if ( $req ) { echo 'aria-required="true"'; } ?>>
										</div>
										<div class="comments--form-row form-row">
												<label for="commentsUrl"><?php esc_html_e( 'Website', 'spring' ); ?></label>
												<input type="url" placeholder="http://example.com" class="textbox" name="url" id="commentsUrl" value="<?php echo esc_attr( $comment_author_url ); ?>" size="22">
										</div>
								<?php endif; ?>
								<?php do_action( 'comment_form_after_fields', $post->ID ); ?>
								<div class="comments--form-row form-row">
										<label for="commentsComment"><?php esc_html_e( 'Comment', 'spring' ); ?></label>
										<textarea name="comment" placeholder="What do you want to say?" id="commentsComment" class="form-control" rows="5" aria-required="true"></textarea>
								</div>
								<div class="button-wrapper">
										<input name="submit" class="button" type="submit" id="submit" value="<?php esc_html_e( 'Submit Comment', 'spring' ); ?>">
								</div>
								<?php comment_id_fields(); ?>
								<?php do_action( 'comment_form', $post->ID ); ?>
						</form>
						<?php do_action( 'comment_form_after', $post->ID ); ?>
				<?php endif; ?>
		</section><!-- /#respond -->
<?php endif; ?>
