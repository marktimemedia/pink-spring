<?php // Footer
$footerclass = is_active_sidebar( 'sidebar-footer' ) ? 'widgetized-footer footer--widgets' : 'standard-footer';
?>
<footer class="footer" role="contentinfo">
	<section class="footer-main">
		<div class="footer--inner">
			<div class="<?php echo esc_attr( $footerclass ); ?> wp-block-columns">
				<?php if ( get_theme_mod( 'mtm_footer_logo' ) || has_nav_menu( 'footer_navigation' ) || mtm_get_social_media() || mtm_get_phone_number() ) : ?>
					<div class="wp-block-column">
						<?php the_mtm_footer_logo(); ?>
						<nav aria-label="Footer" class="nav-footer" role="navigation">
								<?php
								if ( has_nav_menu( 'footer_navigation' ) ) :
										wp_nav_menu(
											array(
												'theme_location' => 'footer_navigation',
												'menu_class' => 'footer--menu',
											)
										);
								endif;
								?>
						</nav>
						<div class="footer--contact">
							<?php echo wp_kses_post( mtm_get_phone_number() ); ?>
							<?php echo wp_kses_post( mtm_get_social_media() ); ?>
						</div>
					</div>
				<?php endif; ?>
				<?php dynamic_sidebar( 'sidebar-footer' ); ?>
			</div>
		</div>
	</section>
	<section class="footer-credits">
		<div class="footer--inner">
			<div class="footer--copyright">
				<?php the_mtm_footer_copyright(); ?>
			</div>
			<div class="footer--extra-text">
				<?php echo wp_kses_post( get_mtm_footer_text() ); ?>
			</div>
		</div>
	</section>
</footer>
<?php wp_footer(); ?>
