<?php
/**
* WooCommerce Support & Functions
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
* Will also need to change layout CSS
*/
// add_filter('loop_shop_columns', 'loop_columns');
// if (!function_exists('loop_columns')) {
// 	function loop_columns() {
// 		return 3; // 3 products per row
// 	}
// }

/**
* Remove unwanted WooCommerce styles from pages
* @see https://wordimpress.com/how-to-load-woocommerce-scripts-and-styles-only-in-shop/
*/

//add_action( 'wp_enqueue_scripts', 'mtm_manage_woocommerce_styles', 99 );
function mtm_manage_woocommerce_styles() {
	//first check that woo exists to prevent fatal errors
	if ( function_exists( 'is_woocommerce' ) ) {
		//dequeue scripts and styles
		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() && ! is_account_page() && is_page_template() ) {
			// wp_dequeue_style( 'woocommerce-layout' ); // layout specific
			// wp_dequeue_style( 'woocommerce-general' ); // gloss
			// wp_dequeue_style( 'woocommerce-smallscreen' ); // smallscreen optimizaiton

			// scripts
			// wp_dequeue_script( 'wc-add-to-cart' );
			// wp_dequeue_script( 'wc-cart-fragments' );
			// wp_dequeue_script( 'woocommerce' );
			// wp_dequeue_script( 'jquery-blockui' );
			// wp_dequeue_script( 'jquery-placeholder' );
		}
	}
}
