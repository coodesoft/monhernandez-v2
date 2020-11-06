<?php
/**
* Favicon Options for Kemet Theme.
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
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-site-logo-title]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Site Identity', 'kemet' ),
            'section'  => 'title_tagline',
            'priority' => 0,
            'settings' => array(),
        )
    )
);
/**
* Option: Display Title
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[display-site-title]', array(
        'default'           => $defaults[ 'display-site-title' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[display-site-title]', array(
        'type'     => 'checkbox',
        'section'  => 'title_tagline',
        'label'    => __( 'Display Site Title', 'kemet' ),
        'priority' => 15,
    )
);

/**
* Option: Display Tagline
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[display-site-tagline]', array(
        'default'           => $defaults[ 'display-site-tagline' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[display-site-tagline]', array(
        'type'    => 'checkbox',
        'section' => 'title_tagline',
        'label'   => __( 'Display Site Tagline', 'kemet' ),
        'priority'          => 20,
    )
);
/**
* Option: Site Title Font Size
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[site-title-font-size]', array(
        'default'           => $defaults[ 'site-title-font-size' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
        'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[display-site-title]', 
				'conditions' => '==', 
				'values' => true,
			),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[site-title-font-size]', array(
            'type'        => 'kmt-responsive-slider',
            'section'     => 'title_tagline',
            'priority'    => 25,
            'label'       => __( 'Title Font Size', 'kemet' ),
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
* Option: Site Tagline Font Size
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[font-size-site-tagline]', array(
        'default'           => $defaults[ 'font-size-site-tagline' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
        'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[display-site-tagline]', 
				'conditions' => '==', 
				'values' => true,
			),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[font-size-site-tagline]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'title_tagline',
            'priority'       => 30,
            'label'          => __( 'Tagline Font Size', 'kemet' ),
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
* Option: Site Tagline Font Size
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[site-title-letter-spacing]', array(
        'default'           => $defaults[ 'site-title-letter-spacing' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
        'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[display-site-title]', 
				'conditions' => '==', 
				'values' => true,
			),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[site-title-letter-spacing]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'title_tagline',
            'priority'       => 32,
            'label'          => __( 'Title Letter Spacing', 'kemet' ),
            'unit_choices'   => array(
                'px' => array(
                    'min' => 0.1,
                    'step' => 0.1,
                    'max' =>10,
                ),
            ),
        )
    )
);
/**
* Option: Site Tagline Font Size
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[tagline-letter-spacing]', array(
        'default'           => $defaults[ 'tagline-letter-spacing' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
        'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[display-site-tagline]', 
				'conditions' => '==', 
				'values' => true,
			),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[tagline-letter-spacing]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'title_tagline',
            'priority'       => 33,
            'label'          => __( 'Tagline Letter Spacing', 'kemet' ),
            'unit_choices'   => array(
                'px' => array(
                    'min' => 0.1,
                    'step' => 0.1,
                    'max' =>10,
                ),
            ),
        )
    )
);
/**
* Option: Site Title Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[site-title-color]', array(
        'default'           => $defaults[ 'site-title-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[site-title-color]', array(
            'label'   => __( 'Site Title Color', 'kemet' ),
            'priority'       => 35,
            'section' => 'title_tagline',
        )
    )
);
/**
* Option: Tagline Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[tagline-color]', array(
        'default'           => $defaults[ 'tagline-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[tagline-color]', array(
            'label'   => __( 'Tagline Color', 'kemet' ),
            'priority'       => 40,
            'section' => 'title_tagline',
        )
    )
);
/**
* Option: Site Title Hover Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[site-title-h-color]', array(
        'default'           => $defaults[ 'site-title-h-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[site-title-h-color]', array(
            'label'   => __( 'Site Title Hover Color', 'kemet' ),
            'priority'       => 45,
            'section' => 'title_tagline',
        )
    )
);
/**
* Option - Site Identity Padding
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[site-identity-spacing]', array(
        'default'           => $defaults[ 'site-identity-spacing' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Spacing(
        $wp_customize, KEMET_THEME_SETTINGS . '[site-identity-spacing]', array(
            'type'           => 'kmt-responsive-spacing',
            'section'        => 'title_tagline',
            'priority'       => 50,
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
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-site-logo-settings]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Logo Settings', 'kemet' ),
            'section'  => 'title_tagline',
            'priority' => 55,
            'settings' => array(),
        )
    )
);
/**
* Option: Retina logo selector
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[kmt-header-retina-logo]', array(
        'default'           => $defaults[ 'kmt-header-retina-logo' ],
        'type'              => 'option',
        'sanitize_callback' => 'esc_url_raw',
    )
);

$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-header-retina-logo]', array(
            'section'        => 'title_tagline',
            'priority'       => 65,
            'label'          => __( 'Retina Logo', 'kemet' ),
        )
    )
);
/**
* Option - Site Logo Width
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[kmt-header-responsive-logo-width]', array(
        'default'           => $defaults[ 'kmt-header-responsive-logo-width' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
        'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[kmt-header-retina-logo]/' . 'custom_logo', 
				'conditions' => '!=/!=', 
                'values' => '/',
                'operators' => '||'
			),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-header-responsive-logo-width]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'title_tagline',
            'priority'       => 70,
            'label'          => __( 'Logo Width', 'kemet' ),
            'unit_choices'   => array(
                'px' => array(
                    'min' => 50,
                    'step' => 1,
                    'max' =>600,
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
			'description'  => __('This option will not increase your uploaded logo width beyond its original size.', 'kemet'),
        )
    )
);

/**
* Option: Disable Menu
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[logo-title-inline]', array(
        'default'           => $defaults[ 'logo-title-inline' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
        'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[display-site-title]/' . 'custom_logo', 
				'conditions' => '==/!=', 
                'values' => '1/',
                'operators' => '&&'
			),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[logo-title-inline]', array(
        'type'     => 'checkbox',
        'section'  => 'title_tagline',
        'label'    => __( 'Inline Logo & Site Title', 'kemet' ),
        'priority' => 85,
    )
);


/**
* Option: Title
*/
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-site-icon-title]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Site Icon', 'kemet' ),
            'section'  => 'title_tagline',
            'priority' => 90,
            'settings' => array(),
        )
    )
);



