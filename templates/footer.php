<footer class="footer-main" role="contentinfo">
		<div class="footer--inner">
			<?php the_mtm_footer_logo(); ?>
			<div class="footer--contact">
				<?php echo wp_kses_post( mtm_get_social_media() ); ?>
				<?php echo wp_kses_post( mtm_get_phone_number() ); ?>
			</div>
			<div class="footer--copyright">
				<?php the_mtm_footer_copyright(); ?>
			</div>
			<div class="footer--extra-text">
				<?php echo wp_kses_post( get_mtm_footer_text() ); ?>
			</div>
				<nav aria-label="Footer" class="nav-footer" role="navigation">
						<?php
						if ( has_nav_menu( 'footer_navigation' ) ) :
								wp_nav_menu(
									array(
										'theme_location' => 'footer_navigation',
										'menu_class'     => 'footer--menu',
									),
								);
						endif;
						?>
				</nav>
		</div>
</footer>
<?php wp_footer(); ?>
