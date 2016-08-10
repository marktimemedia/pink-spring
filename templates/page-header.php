<?php if( get_the_title() ) : ?>
	<header class="page--header">
	    <h1 class="page--title">
	        <?php echo spring_title(); ?><?php edit_post_link( '(Edit)', ' • ' ); ?>
	    </h1>
	</header>
<?php endif; ?>
