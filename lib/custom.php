<?php
/**
 * Custom functions
 */

// Comment out the following line to enable the admin bar
// add_filter('show_admin_bar', '__return_false');


// Custom Taxonomy Term Links
// From http://codex.wordpress.org/Function_Reference/get_the_terms
// echo custom_taxonomies_terms_links(); in your template file

// get taxonomies terms links
function custom_taxonomies_terms_links(){
  // get post by post id
  $post = get_post( $post->ID );

  // get post type by post
  $post_type = $post->post_type;

  // get post type taxonomies
  $taxonomies = get_object_taxonomies( $post_type, 'objects' );

  $out = array();
  foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){

    // get the terms related to post
    $terms = get_the_terms( $post->ID, $taxonomy_slug );

    if ( !empty( $terms ) ) {
      $out[] = '<span class="post--metadata--title">' . $taxonomy->label . ': </span><ul>';
      foreach ( $terms as $term ) {
        $out[] =
          '  <li><a href="'
        .    get_term_link( $term->slug, $taxonomy_slug ) .'">'
        .    $term->name
        . "</a></li>\n";
      }
      $out[] = "</ul>\n";
    }
  }

  return implode( '', $out );
}
?>