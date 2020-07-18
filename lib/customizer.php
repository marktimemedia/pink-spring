<?php
/**
* Register Customizer Settings
*/
function spring_customize_options( $wp_customize ) {

	/**
	* Add our Header & Navigation Panel
	*/
	$wp_customize->add_panel( 'site_branding_panel',
		array(
			'title'    => __( 'Site Branding', 'spring' ),
			'priority' => 41,
		)
	);

	$wp_customize->add_section( 'color_section',
		array(
			'title' => __( 'Colors', 'mtm' ),
			'panel' => 'site_branding_panel',
		)
	);

	$wp_customize->add_section( 'layout_section',
		array(
			'title' => __( 'Layout', 'mtm' ),
			'panel' => 'site_branding_panel',
		)
	);


	// Color
	$palette = spring_customizer_palette(); // palette.php
	foreach ( $palette as $key => $item ) {
		$wp_customize->add_setting( $key, array(
			'default'           => $item['color'],
			'sanitize_callback' => 'sanitize_hex_color',
		));
		$wp_customize->add_control(
			new WP_Customize_Color_Control( $wp_customize, $key, array(
				'label'    => $item['name'],
				'section'  => 'color_section',
				'settings' => $key,
			))
		);
	}

	// Body Style Options
	$wp_customize->add_setting( 'mtm_body_style',
		array(
			'default'   => 'option-square',
			'transport' => 'refresh',
		)
	);

	$wp_customize->add_control( 'mtm_body_style',
		array(
			'label'       => __( 'Theme Geometry' ),
			'description' => esc_html__( 'Choose whether the theme should follow a square or rounded style by default' ),
			'section'     => 'layout_section',
			'priority'    => 10, // Optional. Order priority to load the control. Default: 10
			'type'        => 'select',
			'capability'  => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
			'choices'     => array( // Optional.
				'option-square' => __( 'Square' ),
				'option-round'  => __( 'Rounded' ),
			),
		)
	);

	// Archive Layout
	$wp_customize->add_setting( 'mtm_archive_type',
		array(
			'default'   => 'list',
			'transport' => 'refresh',
			'type'      => 'option',
		)
	);

	$wp_customize->add_control( 'mtm_archive_type',
		array(
			'label'       => __( 'Archive Layout' ),
			'description' => esc_html__( 'Choose whether post archives should display as a grid or a list by default' ),
			'section'     => 'layout_section',
			'priority'    => 10, // Optional. Order priority to load the control. Default: 10
			'type'        => 'select',
			'capability'  => 'manage_options', // Optional. Default: 'edit_theme_options'
			'choices'     => array( // Optional.
				'grid' => __( 'Grid' ),
				'list' => __( 'List' ),
			),
		)
	);

	// Grid Per Row
	$wp_customize->add_setting( 'mtm_grid_per_row',
		array(
			'default'   => 3,
			'transport' => 'refresh',
			'type'      => 'option',
		)
	);

	$wp_customize->add_control( 'mtm_grid_per_row',
		array(
			'label'       => __( 'Grid Items Per Row' ),
			'description' => __( 'If you display items in a grid, how many items should display per row?' ),
			'section'     => 'layout_section',
			'priority'    => 10, // Optional. Order priority to load the control. Default: 10
			'type'        => 'number',
			'capability'  => 'manage_options', // Optional. Default: 'edit_theme_options'
			'input_attrs' => array(
				'min'  => 2,
				'max'  => 6,
				'step' => 1,
			),
		)
	);

}
add_action( 'customize_register', 'spring_customize_options' );
