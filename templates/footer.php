<footer class="footer-main" role="contentinfo">
    <div class="footer--inner">
    	<div class="footer--copyright">
            <?php the_mtm_footer_logo() ?>
            <?php the_mtm_footer_copyright() ?>
            <?php the_mtm_footer_text() ?>
    	</div>
        <nav aria-label="Footer" class="nav-footer" role="navigation">
            <?php
            if ( has_nav_menu( 'footer_navigation' ) ) :
                wp_nav_menu( array( 'theme_location' => 'footer_navigation', 'menu_class' => 'footer--menu' ) );
            endif;
            ?>
        </nav>
    </div>
</footer>
<?php wp_footer(); ?>
