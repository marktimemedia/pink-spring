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
