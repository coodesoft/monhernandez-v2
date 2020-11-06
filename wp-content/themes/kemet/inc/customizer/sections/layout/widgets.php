<?php
/**
* Widget Options for Kemet Theme.
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
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-widget-settings]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Widget Settings', 'kemet' ),
            'section'  => 'section-widgets',
            'priority' => 0,
            'settings' => array(),
        )
    )
);
/**
* Option - Widgets Spacing
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[widget-padding]', array(
        'default'           => $defaults[ 'widget-padding' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Spacing(
        $wp_customize, KEMET_THEME_SETTINGS . '[widget-padding]', array(
            'type'           => 'kmt-responsive-spacing',
            'section'        => 'section-widgets',
            'priority'       => 5,
            'label'          => __( 'Spacing', 'kemet' ),
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
* Option: Widgets Margin Bottom
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[widget-margin-bottom]', array(
        'default'           => $defaults[ 'widget-margin-bottom' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[widget-margin-bottom]', array(
            'type'        => 'kmt-slider',
            'section'     => 'section-widgets',
            'priority'    => 10,
            'label'       => __( 'Margin Bottom (PX)', 'kemet' ),
            'suffix'      => '',
            'input_attrs' => array(
                'min'  => 10,
                'step' => 1,
                'max'  => 100,
            ),
        )
    )
);
/**
* Option: Title
*/
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-widget-title]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Widget Title Style', 'kemet' ),
            'section'  => 'section-widgets',
            'priority' => 20,
            'settings' => array(),
        )
    )
);
/**
* Option: Widgets Background Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[widget-bg-color]', array(
        'default'           => $defaults[ 'widget-bg-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[widget-bg-color]', array(
            'priority'       => 23,
            'section' => 'section-widgets',
            'label'   => __( 'Widget Background Color', 'kemet' ),
        )
    )
);
/**
* Option:Widgets Title Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[widget-title-color]', array(
        'default'           => $defaults[ 'widget-title-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[widget-title-color]', array(
            'label'   => __( 'Font Color', 'kemet' ),
            'priority'       => 25,
            'section' => 'section-widgets',
        )
    )
);

/**
* Option: Widget Font Size
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[widget-title-font-size]', array(
        'default'           => $defaults[ 'widget-title-font-size' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[widget-title-font-size]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'section-widgets',
            'priority'       => 30,
            'label'          => __( 'Font Size', 'kemet' ),
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
* Option: Widget Font Family
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[widget-title-font-family]', array(
        'default'           => $defaults[ 'widget-title-font-family' ],
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new Kemet_Control_Typography(
        $wp_customize, KEMET_THEME_SETTINGS . '[widget-title-font-family]', array(
            'type'        => 'kmt-font-family',
            'kmt_inherit' => __( 'Default System Font', 'kemet' ),
            'section'     => 'section-widgets',
            'priority'    => 35,
            'label'       => __( 'Font Family', 'kemet' ),
            'connect'     => KEMET_THEME_SETTINGS . '[widget-title-font-weight]',
        )
    )
);

/**
* Option: Widget Font Weight
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[widget-title-font-weight]', array(
        'default'           => $defaults[ 'widget-title-font-weight' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_font_weight' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Typography(
        $wp_customize, KEMET_THEME_SETTINGS . '[widget-title-font-weight]', array(
            'type'        => 'kmt-font-weight',
            'kmt_inherit' => __( 'Default', 'kemet' ),
            'section'     => 'section-widgets',
            'priority'    => 35,
            'label'       => __( 'Font Weight', 'kemet' ),
            'connect'     => KEMET_THEME_SETTINGS . '[widget-title-font-family]',
        )
    )
);

/**
* Option: Widget Text Transform
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[widget-title-text-transform]', array(
        'default'           => $defaults[ 'widget-title-text-transform' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[widget-title-text-transform]', array(
        'type'     => 'select',
        'section'  => 'section-widgets',
        'priority' => 45,
        'label'    => __( 'Text Transform', 'kemet' ),
        'choices'  => array(
            ''           => __( 'Default', 'kemet' ),
            'none'       => __( 'None', 'kemet' ),
            'capitalize' => __( 'Capitalize', 'kemet' ),
            'uppercase'  => __( 'Uppercase', 'kemet' ),
            'lowercase'  => __( 'Lowercase', 'kemet' ),
        ),
    )
);

/**
* Option: widget Line Height
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[widget-title-line-height]', array(
        'default'           => $defaults[ 'widget-title-line-height' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[widget-title-line-height]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'section-widgets',
            'priority'       => 50,
            'label'          => __( 'Line Height', 'kemet' ),
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
* Option: Widget Letter Spacing
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[widget-title-letter-spacing]', array(
        'default'           => $defaults[ 'widget-title-letter-spacing' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[widget-title-letter-spacing]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'section-widgets',
            'priority'       => 53,
            'label'          => __( 'Letter Spacing', 'kemet' ),
            'unit_choices'   => array(
                'px' => array(
                    'min' => 0.1,
                    'step' => 0.1,
                    'max' => 10,
                ),
            ),
        )
    )
);
/**
 * Option: Enable Widget Title Separator
 */
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[enable-widget-title-separator]', array(
        'default'           =>  $defaults[ 'enable-widget-title-separator' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[enable-widget-title-separator]', array(
            'section'  => 'section-widgets',
            'type'     => 'checkbox',
            'priority' => 55,
            'label'    => __( 'Enable Widget Title Separator', 'kemet' ),
        )
    )
);
/**
* Option: Widget Title Border Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[widget-title-border-color]', array(
        'default'           => $defaults[ 'widget-title-border-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[enable-widget-title-separator]', 
            'conditions' => '==', 
            'values' => true,
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[widget-title-border-color]', array(
            'section'  => 'section-widgets',
            'priority' => 60,
            'label'    => __( 'Separator Color', 'kemet' ),
        )
    )
);

/**
* Option: Widget Title Border Size
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[widget-title-border-size]', array(
        'default'           => $defaults[ 'widget-title-border-size' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[enable-widget-title-separator]', 
            'conditions' => '==', 
            'values' => true,
        ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[widget-title-border-size]', array(
        'type'        => 'number',
        'section'     => 'section-widgets',
        'priority'    => 65,
        'label'       => __( 'Separator Width', 'kemet' ),
        'input_attrs' => array(
            'min'  => 0,
            'step' => 1,
            'max'  => 600,
        ),
    )
);