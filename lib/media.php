<?php
/**
 * Wrap embedded media as suggested by Readability
 * Able to change based on URL source
 *
 * @link https://gist.github.com/965956
 * @link http://www.readability.com/publishers/guidelines#publisher
 * @link https://wordpress.stackexchange.com/questions/254583/add-wrapper-to-only-youtube-videos-via-embed-oembed-html-filter-function
 */
function spring_embed_wrap($cache, $url, $attr = '', $post_ID = '') {
  $classes = array();

    // Add these classes to all embeds.
    $classes_all = array(
        'entry-content-asset',
    );

    // Check for different providers and add appropriate classes.

    if ( false !== strpos( $url, 'vimeo.com' ) ) {
        $classes[] = 'vimeo video-asset';
    }

    if ( false !== strpos( $url, 'youtube.com' ) ) {
        $classes[] = 'youtube video-asset';
    }

    $classes = array_merge( $classes, $classes_all );

    return '<div class="' . esc_attr( implode( $classes, ' ' ) ) . '">' . $cache . '</div>';
}
add_filter('embed_oembed_html', 'spring_embed_wrap', 10, 4);

/**
* Wrap Gutenberg blocks in a container so we can target them with scroll ScrollReveal
* https://wordpress.stackexchange.com/questions/329587/add-a-containing-div-to-core-gutenberg-blocks
*/

add_filter( 'render_block', function( $block_content, $block ) {
    // Uncomment to only target core/* and core-embed/* blocks.
    if ( preg_match( '~^core|core-embed|mtm~', $block['blockName'] )  && !preg_match( '(button)', $block['blockName'] ) && !preg_match( '(column)', $block['blockName'] ) ) {
       $block_content = sprintf( '<div class="single--block">%s</div>', $block_content );
    }
    return $block_content;
}, PHP_INT_MAX - 1, 2 );

/**
 * Add thumbnail styling to images with captions
 * Use <figure> and <figcaption>
 *
 * @link http://justintadlock.com/archives/2011/07/01/captions-in-wordpress
 */
function spring_caption( $output, $attr, $content ) {
  if ( is_feed() ) {
    return $output;
  }

  $defaults = array(
    'id'      => '',
    'align'   => 'alignnone',
    'width'   => '',
    'caption' => ''
  );

  $attr = shortcode_atts( $defaults, $attr );

  // If the width is less than 1 or there is no caption, return the content wrapped between the [caption] tags
  if ( $attr['width'] < 1 || empty( $attr['caption'] ) ) {
    return $content;
  }

  // Set up the attributes for the caption <figure>
  $attributes  = ( !empty($attr['id'] ) ? ' id="' . esc_attr( $attr['id'] ) . '"' : '' );
  $attributes .= ' class="thumbnail wp-caption ' . esc_attr( $attr['align'] ) . '"';
  // $attributes .= ' style="width: ' . esc_attr($attr['width']) . 'px"';

  $output  = '<figure' . $attributes .'>';
  $output .= do_shortcode( $content );
  $output .= '<figcaption class="caption wp-caption-text">' . $attr['caption'] . '</figcaption>';
  $output .= '</figure>';

  return $output;
}
add_filter('img_caption_shortcode', 'spring_caption', 10, 3);

/**
* remove width attribute of thumbnails
*/
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
    $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
    return $html;
}

/**
* From http://wordpress.stackexchange.com/questions/115368/overide-gallery-default-link-to-settings
* Default image links in gallery (not the same as image_default_link_type)
*/
function spring_gallery_default_type_set_link( $settings ) {
    $settings['galleryDefaults']['link'] = 'file';
    return $settings;
}
add_filter( 'media_view_settings', 'spring_gallery_default_type_set_link' );

/**
* Remove the overly opinionated gallery styles
*/
add_filter( 'use_default_gallery_style', '__return_false' );
