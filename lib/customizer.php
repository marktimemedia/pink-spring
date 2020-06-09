<?php
/**
* Register Customizer Color Controls
*/
function spring_customize_color_controls( $wp_customize ) {
    $palette = spring_customizer_palette(); // palette.php
    foreach ( $palette as $key => $item ) {
        $wp_customize->add_setting( $key, array(
            'default' => $item['color'],
            'sanitize_callback' => 'sanitize_hex_color',
        ));
        $wp_customize->add_control(
            new WP_Customize_Color_Control( $wp_customize, $key, array(
                'label' => $item['name'],
                'section' => 'colors',
                'settings' => $key,
            ))
        );
    }
}
add_action( 'customize_register', 'spring_customize_color_controls' );

function spring_customize_body_style( $wp_customize ) {
  // Body Style Options
  $wp_customize->add_setting( 'mtm_body_style',
   array(
      'default' => 'option-square',
      'transport' => 'refresh',
     )
  );

  $wp_customize->add_control( 'mtm_body_style',
   array(
      'label' => __( 'Theme Geometry' ),
      'description' => esc_html__( 'Choose whether the theme should follow a square or rounded style by default' ),
      'section' => 'title_tagline',
      'priority' => 10, // Optional. Order priority to load the control. Default: 10
      'type' => 'select',
      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
      'choices' => array( // Optional.
         'option-square' => __( 'Square' ),
         'option-round' => __( 'Rounded' )
        )
     )
  );
}
add_action( 'customize_register', 'spring_customize_body_style' );
