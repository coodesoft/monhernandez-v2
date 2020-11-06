<?php
/**
 * Go Top Link Options for Kemet Theme.
 *
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
 * @link        http://wpkemet.com/
 * @since       Kemet 1.0.0
 */


$defaults = Kemet_Theme_Options::defaults();
    /**
	 * Option: Enable Go Top Link
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[enable-go-top]', array(
			'default'           => $defaults[ 'enable-go-top' ],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[enable-go-top]', array(
			'type'            => 'checkbox',
			'section'         => 'section-go-top',
			'label'           => __( 'Enable Go to Top Button', 'kemet-addons' ),
            'priority'        => 1,
		)
    );
    /**
     * Option:Title
     */
    $wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[kmt-go-top-settings]',array(
            'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[enable-go-top]', 
				'conditions' => '==', 
				'values' => true,
            ),
            'sanitize_callback' 	=> 'wp_kses',
        )
    );
    $wp_customize->add_control(
        new Kemet_Control_Title(
            $wp_customize, KEMET_THEME_SETTINGS . '[kmt-go-top-settings]', array(
                'type'     => 'kmt-title',
                'label'    => __( 'Button Settings', 'kemet-addons' ),
                'section'  => 'section-go-top',
                'priority' => 5,
                'settings' => array(),
            )
        )
    );
    /**
	 * Option: Go Top Link Icon Size
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[go-top-icon-size]', array(
			'default'           => $defaults[ 'go-top-icon-size' ],
            'type'              => 'option',
            'transport'         => 'postMessage',
            'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
            'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[enable-go-top]', 
				'conditions' => '==', 
				'values' => true,
			),
		)
    );
    $wp_customize->add_control(
		new Kemet_Control_Responsive_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[go-top-icon-size]', array(
				'type'           => 'kmt-responsive-slider',
				'section'        => 'section-go-top',
				'priority'       => 10,
				'label'          => __( 'Icon Size', 'kemet-addons' ),
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
	 * Option: Go Top Link Button Size
	 */
    $wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[go-top-button-size]', array(
            'default'           => $defaults[ 'go-top-button-size' ],
            'type'              => 'option',
            'transport'         => 'postMessage',
            'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
            'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[enable-go-top]', 
				'conditions' => '==', 
				'values' => true,
			),
        )
    );
    $wp_customize->add_control(
		new Kemet_Control_Responsive_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[go-top-button-size]', array(
				'type'           => 'kmt-responsive-slider',
				'section'        => 'section-go-top',
				'priority'       => 15,
				'label'          => __( 'Background Size', 'kemet-addons' ),
				'unit_choices'   => array(
					 'px' => array(
						 'min' => 1,
						 'step' => 1,
						 'max' => 200,
					 ),
                 ),
			)
		)
	);

    /**
     * Option: Go Top Link Border Radius
     */
    $wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[go-top-border-radius]', array(
            'default'           => $defaults[ 'go-top-border-radius' ],
            'type'              => 'option',
            'transport'         => 'postMessage',
            'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
            'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[enable-go-top]', 
				'conditions' => '==', 
				'values' => true,
			),
        )
    );
    $wp_customize->add_control(
		new Kemet_Control_Responsive_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[go-top-border-radius]', array(
				'type'           => 'kmt-responsive-slider',
				'section'        => 'section-go-top',
				'priority'       => 20,
				'label'          => __( 'Border Radius', 'kemet-addons' ),
				'unit_choices'   => array(
					 'px' => array(
						 'min' => 1,
						 'step' => 1,
						 'max' => 100,
					 ),
					 'em' => array(
						 'min' => 0.1,
						 'step' => 0.1,
						 'max' => 10,
                     ),
                     '%' => array(
                        'min' => 1,
                        'step' => 1,
                        'max' => 100,
                    ),
                 ),
			)
		)
	);
    /**
     * Option:Go Top Responsive
     */
    $wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[go-top-responsive]',array(
            'default'           => $defaults[ 'go-top-responsive' ],
            'type'              => 'option',
            'sanitize_callback' => array('Kemet_Customizer_Sanitizes','sanitize_choices'),
            'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[enable-go-top]', 
				'conditions' => '==', 
				'values' => true,
			),
        )
    );
    $wp_customize->add_control(
        KEMET_THEME_SETTINGS . '[go-top-responsive]' ,array(
            'priority'   => 25,
            'section'    => 'section-go-top',
            'type'     => 'select',
            'label'    => __( 'Go to Top Button Visibility', 'kemet-addons' ),
            'choices'  => array(
                'all-devices'        => __( 'Show on All Devices', 'kemet-addons' ),
                'hide-tablet'        => __( 'Hide on Tablet', 'kemet-addons' ),
                'hide-mobile'        => __( 'Hide on Mobile', 'kemet-addons' ),
                'hide-tablet-mobile' => __( 'Hide on Tablet and Mobile', 'kemet-addons' ),
            ),
        )
    );
    /**
     * Option:Title
     */
    $wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[kmt-go-top-style]',array(
            'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[enable-go-top]', 
				'conditions' => '==', 
				'values' => true,
            ),
            'sanitize_callback' 	=> 'wp_kses',
        )
    );
    $wp_customize->add_control(
        new Kemet_Control_Title(
            $wp_customize, KEMET_THEME_SETTINGS . '[kmt-go-top-style]', array(
                'type'     => 'kmt-title',
                'label'    => __( 'Button Style', 'kemet-addons' ),
                'section'  => 'section-go-top',
                'priority' => 30,
                'settings' => array(),
            )
        )
    );
    /**
     * Option: Icon color
     */
    $wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[go-top-icon-color]', array(
            'default'           => $defaults[ 'go-top-icon-color' ],
            'type'              => 'option',
            'transport'         => 'postMessage',
            'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
            'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[enable-go-top]', 
				'conditions' => '==', 
				'values' => true,
			),
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, KEMET_THEME_SETTINGS . '[go-top-icon-color]', array(
                'section' => 'section-go-top',
                'label'   => __( 'Icon Color', 'kemet-addons' ),
                'priority'=>35,
            )
        )
    );

    /**
     * Option: Icon Hover color
     */
    $wp_customize->add_setting(
        KEMET_THEME_SETTINGS . '[go-top-icon-h-color]', array(
            'default'           => $defaults[ 'go-top-icon-h-color' ],
            'type'              => 'option',
            'transport'         => 'postMessage',
            'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
            'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[enable-go-top]', 
				'conditions' => '==', 
				'values' => true,
			),
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, KEMET_THEME_SETTINGS . '[go-top-icon-h-color]', array(
                'section' => 'section-go-top',
                'label'   => __( 'Icon Hover Color', 'kemet-addons' ),
                'priority'=>40,
            )
        )
    );

    /**
	 * Option: Go Top Link Background Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[go-top-bg-color]', array(
			'default'           => $defaults[ 'go-top-bg-color' ],
            'type'              => 'option',
            'transport'         => 'postMessage',
            'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
            'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[enable-go-top]', 
				'conditions' => '==', 
				'values' => true,
			),
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, KEMET_THEME_SETTINGS . '[go-top-bg-color]', array(
                'priority'       => 40,
                'section' => 'section-go-top',
                'label'   => __( 'Background Color', 'kemet-addons' ),
			)
		)
    );
    
    /**
	 * Option: Go Top Link Background Hover Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[go-top-bg-h-color]', array(
			'default'           => $defaults[ 'go-top-bg-color' ],
            'type'              => 'option',
            'transport'         => 'postMessage',
            'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
            'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[enable-go-top]', 
				'conditions' => '==', 
				'values' => true,
			),
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, KEMET_THEME_SETTINGS . '[go-top-bg-h-color]', array(
                'priority'       => 50,
                'section' => 'section-go-top',
                'label'   => __( 'Background Hover Color', 'kemet-addons' ),
			)
		)
    );
