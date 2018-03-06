<?php
/**
* WooCommerce Support
*/
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// theme support for gallery features
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

/**
* Change number of products per row
*/
// add_filter('loop_shop_columns', 'loop_columns');
// if (!function_exists('loop_columns')) {
// 	function loop_columns() {
// 		return 3; // 3 products per row
// 	}
// }

/**
* Remove WooCommerce Styles
*/
// add_filter( 'woocommerce_enqueue_styles', 'spring_dequeue_styles' );
// function spring_dequeue_styles( $enqueue_styles ) {
// 	//unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
// 	//unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
// 	//unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
// 	return $enqueue_styles;
// }