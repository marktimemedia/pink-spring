<?php
/**
 * Custom functions
 */

/**
* WooCommerce Support
*/
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/**
* Filter Yoast Meta Priority
*/
//add_filter( 'wpseo_metabox_prio', function() { return 'low';});
?>