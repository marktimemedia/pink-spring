<?php get_template_part( 'template-parts/header' ); ?>
<section class="content <?php echo ( spring_display_sidebar() ? 'has_sidebar' : 'has_no_sidebar' ); ?>" id="content">
	<main class="content--body <?php echo esc_attr( spring_main_class() ); ?>" role="main">
		<?php require spring_template_path(); ?>
	</main>
		<!-- /.main -->
	<?php if ( spring_display_sidebar() ) : ?>
		<aside class="sidebar content--sidebar <?php echo esc_attr( spring_sidebar_class() ); ?>" role="complementary">
			<?php require spring_sidebar_path(); ?>
		</aside><!-- /.sidebar -->
	<?php endif; ?>
</section><!-- /.content -->

<?php get_template_part( 'template-parts/footer' ); ?>

</body>
</html>
