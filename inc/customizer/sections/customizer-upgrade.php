<?php
/**
 * Register PRO Version section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'glades_customize_register_upgrade_settings' );

function glades_customize_register_upgrade_settings( $wp_customize ) {

	// Get Theme Details from style.css
	$theme = wp_get_theme(); 
	
	// Add Sections for Post Settings
	$wp_customize->add_section( 'glades_section_upgrade', array(
        'title'    => esc_html__( 'Pro Version', 'glades' ),
        'priority' => 70,
		'panel' => 'glades_options_panel' 
		)
	);

	// Add PRO Version Section
	$wp_customize->add_setting( 'glades_theme_options[pro_version_label]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Glades_Customize_Header_Control(
        $wp_customize, 'glades_control_pro_version_label', array(
            'label' => esc_html__( 'You need more features?', 'glades' ),
            'section' => 'glades_section_upgrade',
            'settings' => 'glades_theme_options[pro_version_label]',
            'priority' => 	1
            )
        )
    );
	$wp_customize->add_setting( 'glades_theme_options[pro_version]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Glades_Customize_Text_Control(
        $wp_customize, 'glades_control_pro_version', array(
            'label' =>  esc_html__( 'Purchase the Pro Version to get additional features and advanced customization options.', 'glades' ),
            'section' => 'glades_section_upgrade',
            'settings' => 'glades_theme_options[pro_version]',
            'priority' => 	2
            )
        )
    );
	$wp_customize->add_setting( 'glades_theme_options[pro_version_button]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Glades_Customize_Button_Control(
        $wp_customize, 'glades_control_pro_version_button', array(
            'label' => sprintf( esc_html__( 'Learn more about %s Pro', 'glades' ), $theme->get( 'Name' ) ),
			'section' => 'glades_section_upgrade',
            'settings' => 'glades_theme_options[pro_version_button]',
            'priority' => 	3
            )
        )
    );

}

?>