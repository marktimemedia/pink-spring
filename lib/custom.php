<?php
/**
 * Custom functions
 */

/**
* Filter Yoast Meta Priority
*/
//add_filter( 'wpseo_metabox_prio', function() { return 'low';});

/**
* Yoast SSL Canonical
* @see https://xeromediaservices.wordpress.com/2016/02/10/yoast-seo-canonical-urls-on-a-site-with-optional-ssl/
*/
// function mtb_canonical_ssl($url) {
//    $url = preg_replace("/^http:/i", "https:", $url);
//    return $url;
// }
// add_filter( 'wpseo_canonical', 'mtb_canonical_ssl' );