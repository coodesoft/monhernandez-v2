<?php
/**
* Buttons for Kemet Theme.
*
* @package     Kemet
* @author      Kemet
* @copyright   Copyright ( c ) 2019, Kemet
* @link        https://kemet.io/
* @since       Kemet 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$defaults = Kemet_Theme_Options::defaults();
/**
* Option: Title
*/
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-buttons]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Buttons Style', 'kemet' ),
            'section'  => 'section-buttons-fields',
            'priority' => 1,
            'settings' => array(),
        )
    )
);
/**
* Option: Blog - Buttons Font Size
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[buttons-font-size]', array(
        'default'           => $defaults[ 'buttons-font-size' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[buttons-font-size]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'section-buttons-fields',
            'priority'       => 2,
            'label'          => __( 'Buttons Font Size', 'kemet' ),
            'unit_choices'   => array(
                'px' => array(
                    'min' => 1,
                    'step' => 1,
                    'max' =>200,
                ),
                'em' => array(
                    'min' => 0.1,
                    'step' => 0.1,
                    'max' => 10,
                ),
            ),
        )
    )
);
/**
* Option: Button Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[button-color]', array(
        'default'           => $defaults[ 'button-color' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[button-color]', array(
            'section' => 'section-buttons-fields',
            'label'   => __( 'Text Color', 'kemet' ),
            'priority'    => 5,
        )
    )
);
/**
* Option: Button Background Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[button-bg-color]', array(
        'default'           => $defaults[ 'button-bg-color' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[button-bg-color]', array(
            'section' => 'section-buttons-fields',
            'label'   => __( 'Background Color', 'kemet' ),
            'priority'    => 10,
        )
    )
);
/**
* Option: Button Hover Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[button-h-color]', array(
        'default'           => $defaults[ 'button-h-color' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[button-h-color]', array(
            'section' => 'section-buttons-fields',
            'label'   => __( 'Text Hover Color', 'kemet' ),
            'priority'    => 15,
        )
    )
);

/**
* Option: Button Background Hover Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[button-bg-h-color]', array(
        'default'           => $defaults[ 'button-bg-h-color' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[button-bg-h-color]', array(
            'section' => 'section-buttons-fields',
            'label'   => __( 'Background Hover Color', 'kemet' ),
            'priority'    => 20,
        )
    )
);
/**
* Option: Button Radius
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[button-radius]', array(
        'default'           => $defaults['button-radius'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[button-radius]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'section-buttons-fields',
            'priority'       => 25,
            'label'          => __( 'Border Radius', 'kemet' ),
            'unit_choices'   => array(
                'px' => array(
                    'min' => 0,
                    'step' => 1,
                    'max' =>100,
                ),
                'em' => array(
                    'min' => 0,
                    'step' => 1,
                    'max' => 10,
                ),
                '%' => array(
                    'min' => 0,
                    'step' => 1,
                    'max' => 100,
                ),
            ),
        )
    )
);
/**
* Option: Button Border Size
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[btn-border-size]', array(
        'default'           => $defaults[ 'btn-border-size' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
    )
);
$wp_customize->add_control(
		new Kemet_Control_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[btn-border-size]', array(
				'type'        => 'kmt-slider',
				'section'     => 'section-buttons-fields',
				'priority'    => 30,
				'label'       => __( 'Border Size', 'kemet' ),
				'input_attrs' => array(
					'min'  => 0,
					'step' => 1,
					'max'  => 10,
				),
			)
		)
	);
/**
* Option: Button Border Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[btn-border-color]', array(
        'default'           => $defaults[ 'btn-border-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[btn-border-color]', array(
            'section' => 'section-buttons-fields',
            'label'   => __( 'Border Color', 'kemet' ),
            'priority'    => 35,
        )
    )
);

/**
* Option: Button Border Hover color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[btn-border-h-color]', array(
        'default'           => $defaults['btn-border-h-color'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[btn-border-h-color]', array(
            'section' => 'section-buttons-fields',
            'label'   => __( 'Border Hover color', 'kemet' ),
            'priority'    => 40,
        )
    )
);

/**
* Option - Button Spacing
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[button-spacing]', array(
        'default'           => $defaults[ 'button-spacing' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Spacing(
        $wp_customize, KEMET_THEME_SETTINGS . '[button-spacing]', array(
            'type'           => 'kmt-responsive-spacing',
            'section'        => 'section-buttons-fields',
            'priority'       => 45,
            'label'          => __( 'Padding', 'kemet' ),
            'linked_choices' => true,
            'unit_choices'   => array( 'px', 'em', '%' ),
            'choices'        => array(
                'top'    => __( 'Top', 'kemet' ),
                'right'  => __( 'Right', 'kemet' ),
                'bottom' => __( 'Bottom', 'kemet' ),
                'left'   => __( 'Left', 'kemet' ),
            ),
        )
    )
);
/**
* Option: Title
*/
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-input-color]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Input Fields Style', 'kemet' ),
            'section'  => 'section-buttons-fields',
            'priority' => 50,
            'settings' => array(),
        )
    )
);

/**
* Option: Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[input-text-color]', array(
        'default'           => $defaults[ 'input-text-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[input-text-color]', array(
            'section' => 'section-buttons-fields',
            'label'   => __( 'Text Color', 'kemet' ),
            'priority'    => 55,
        )
    )
);

/**
* Option: Background Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[input-bg-color]', array(
        'default'           => $defaults[ 'input-bg-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[input-bg-color]', array(
            'section' => 'section-buttons-fields',
            'label'   => __( 'Background Color', 'kemet' ),
            'priority'    => 60,
        )
    )
);
/**
* Option: Input Radius
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[input-radius]', array(
        'default'           => $defaults['input-radius'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[input-radius]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'section-buttons-fields',
            'priority'       => 65,
            'label'          => __( 'Border Radius', 'kemet' ),
            'unit_choices'   => array(
                'px' => array(
                    'min' => 0,
                    'step' => 1,
                    'max' =>100,
                ),
                'em' => array(
                    'min' => 0,
                    'step' => 1,
                    'max' => 10,
                ),
                '%' => array(
                    'min' => 0,
                    'step' => 1,
                    'max' => 100,
                ),
            ),
        )
    )
);
/**
* Option: Input Border Size
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[input-border-size]', array(
        'default'           => $defaults[ 'input-border-size' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[input-border-size]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'section-buttons-fields',
            'priority'       => 70,
            'label'          => __( 'Border Size', 'kemet' ),
            'unit_choices'   => array(
                'px' => array(
                    'min' => 0,
                    'step' => 1,
                    'max' =>100,
                ),
                'em' => array(
                    'min' => 0,
                    'step' => 1,
                    'max' => 10,
                ),
                '%' => array(
                    'min' => 0,
                    'step' => 1,
                    'max' => 100,
                ),
            ),
        )
    )
);
/**
* Option: Border Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[input-border-color]', array(
        'default'           => $defaults[ 'input-border-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[input-border-color]', array(
            'section' => 'section-buttons-fields',
            'label'   => __( 'Border Color', 'kemet' ),
            'priority'    => 75,
        )
    )
);

/**
* Option - Button Spacing
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[input-spacing]', array(
        'default'           => $defaults[ 'input-spacing' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Spacing(
        $wp_customize, KEMET_THEME_SETTINGS . '[input-spacing]', array(
            'type'           => 'kmt-responsive-spacing',
            'section'        => 'section-buttons-fields',
            'priority'       => 85,
            'label'          => __( 'Padding', 'kemet' ),
            'linked_choices' => true,
            'unit_choices'   => array( 'px', 'em', '%' ),
            'choices'        => array(
                'top'    => __( 'Top', 'kemet' ),
                'right'  => __( 'Right', 'kemet' ),
                'bottom' => __( 'Bottom', 'kemet' ),
                'left'   => __( 'Left', 'kemet' ),
            ),
        )
    )
);