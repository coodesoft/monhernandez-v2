<?php
/**
* Bottom Footer Options for Kemet Theme.
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
* Option: Footer Bar Layout
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[copyright-footer-layout]', array(
        'default'           => $defaults[ 'copyright-footer-layout' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Radio_Image(
        $wp_customize, KEMET_THEME_SETTINGS . '[copyright-footer-layout]', array(
            'type'     => 'kmt-radio-image',
            'section'  => 'section-footer-copyright',
            'priority' => 5,
            'label'    => __( 'Footer Bar Layout', 'kemet' ),
            'choices'  => array(
                'disabled'            => array(
                    'label' => __( 'Disable', 'kemet' ),
                    'path'  => KEMET_THEME_URI . 'assets/images/disable-copyright-area.png',
                ),
                'copyright-footer-layout-1' => array(
                    'label' => __( 'Footer Bar Layout 1', 'kemet' ),
                    'path'  => KEMET_THEME_URI . 'assets/images/copyright-area-layout-1.png',
                ),
                'copyright-footer-layout-2' => array(
                    'label' => __( 'Footer Bar Layout 2', 'kemet' ),
                    'path'  => KEMET_THEME_URI . 'assets/images/copyright-area-layout-2.png',
                ),
            ),
        )
    )
);

/**
* Option: Section 1
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[footer-copyright-section-1]', array(
        'default'           => $defaults[ 'footer-copyright-section-1' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[copyright-footer-layout]', 
            'conditions' => '!=', 
            'values' => 'disabled',
        ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[footer-copyright-section-1]', array(
        'type'     => 'select',
        'section'  => 'section-footer-copyright',
        'priority' => 10,
        'label'    => __( 'First Section', 'kemet' ),
        'choices'  => array(
            ''       => __( 'None', 'kemet' ),
            'menu'   => __( 'Footer Menu', 'kemet' ),
            'custom' => __( 'Custom Text', 'kemet' ),
            'widget' => __( 'Widget', 'kemet' ),
        ),
    )
);

/**
* Option: Section 1 Custom Text
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[footer-copyright-section-1-part]', array(
        'default'           => $defaults[ 'footer-copyright-section-1-part' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_html' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[copyright-footer-layout]/' . KEMET_THEME_SETTINGS . '[footer-copyright-section-1]', 
            'conditions' => '!=/==', 
            'values' => 'disabled/custom',
            'operators' => '&&'
        ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[footer-copyright-section-1-part]', array(
        'type'     => 'textarea',
        'section'  => 'section-footer-copyright',
        'priority' => 15,
        'label'    => __( 'First Section Custom Text', 'kemet' ),
    )
);

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial(
        KEMET_THEME_SETTINGS . '[footer-copyright-section-1-part]', array(
            'selector'            => '.kmt-footer-copyright-section-1',
            'container_inclusive' => false,
            'render_callback'     => array( 'Kemet_Customizer_Partials', '_render_footer_copyright_section_1_part' ),
        )
    );
}

/**
* Option: Section 2
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[footer-copyright-section-2]', array(
        'default'           => $defaults[ 'footer-copyright-section-2' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[copyright-footer-layout]', 
            'conditions' => '!=', 
            'values' => 'disabled',
        ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[footer-copyright-section-2]', array(
        'type'     => 'select',
        'section'  => 'section-footer-copyright',
        'priority' => 20,
        'label'    => __( 'Second Section', 'kemet' ),
        'choices'  => array(
            ''       => __( 'None', 'kemet' ),
            'menu'   => __( 'Footer Menu', 'kemet' ),
            'custom' => __( 'Custom Text', 'kemet' ),
            'widget' => __( 'Widget', 'kemet' ),
        ),
    )
);

/**
* Option: Section 2 Custom Text
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[footer-copyright-section-2-part]', array(
        'default'           => $defaults[ 'footer-copyright-section-2-part' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_html' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[copyright-footer-layout]/' . KEMET_THEME_SETTINGS . '[footer-copyright-section-2]', 
            'conditions' => '!=/==', 
            'values' => 'disabled/custom',
            'operators' => '&&'
        ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[footer-copyright-section-2-part]', array(
        'type'     => 'textarea',
        'section'  => 'section-footer-copyright',
        'priority' => 25,
        'label'    => __( 'Second Section Custom Text', 'kemet' ),
    )
);

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial(
        KEMET_THEME_SETTINGS . '[footer-copyright-section-2-part]', array(
            'selector'            => '.kmt-footer-copyright-section-2',
            'container_inclusive' => false,
            'render_callback'     => array( 'Kemet_Customizer_Partials', '_render_footer_copyright_section_2_part' ),
        )
    );
}
/**
* Option - Widget Spacing
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[footer-bar-padding]', array(
        'default'           => $defaults[ 'footer-bar-padding' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[copyright-footer-layout]', 
            'conditions' => '!=', 
            'values' => 'disabled',
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Spacing(
        $wp_customize, KEMET_THEME_SETTINGS . '[footer-bar-padding]', array(
            'type'           => 'kmt-responsive-spacing',
            'section'        => 'section-footer-copyright',
            'priority'       => 28,
            'label'          => __( 'Footer Bar Spacing', 'kemet' ),
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
* Option: Footer Width
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[footer-layout-width]', array(
        'default'           => $defaults[ 'footer-layout-width' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[copyright-footer-layout]', 
            'conditions' => '!=', 
            'values' => 'disabled',
        ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[footer-layout-width]', array(
        'type'     => 'select',
        'section'  => 'section-footer-copyright',
        'priority' => 30,
        'label'    => __( 'Footer Bar Width', 'kemet' ),
        'choices'  => array(
            'full'    => __( 'Full Width', 'kemet' ),
            'content' => __( 'Content Width', 'kemet' ),
        ),
    )
);

/**
* Option: Footer Background
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[footer-bar-bg-obj]', array(
        'default'           => $defaults[ 'footer-bar-bg-obj' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_background_obj' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[copyright-footer-layout]', 
            'conditions' => '!=', 
            'values' => 'disabled',
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Background(
        $wp_customize, KEMET_THEME_SETTINGS . '[footer-bar-bg-obj]', array(
            'type'    => 'kmt-background',
            'section' => 'section-footer-copyright',
            'priority' => 35,
            'label'   => __( 'Footer Bar Background', 'kemet' ),
        )
    )
);
/**
* Option: Title
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[kmt-footer-bar-title]', array(
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[copyright-footer-layout]', 
            'conditions' => '!=', 
            'values' => 'disabled',
        ),
        'sanitize_callback' 	=> 'wp_kses',
    )
);
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-footer-bar-title]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Footer Bar Settings', 'kemet' ),
            'section'  => 'section-footer-copyright',
            'priority' => 40,
            'settings' => array(),
        )
    )
);
/**
* Option: Footer Top Border
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[footer-copyright-divider]', array(
        'default'           => $defaults[ 'footer-copyright-divider' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[copyright-footer-layout]', 
            'conditions' => '!=', 
            'values' => 'disabled',
        ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[footer-copyright-divider]', array(
        'type'        => 'number',
        'section'     => 'section-footer-copyright',
        'priority'    => 45,
        'label'       => __( 'Top Border Size', 'kemet' ),
        'input_attrs' => array(
            'min'  => 0,
            'step' => 1,
            'max'  => 600,
        ),
    )
);

/**
* Option: Footer Top Border Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[footer-copyright-divider-color]', array(
        'default'           => $defaults[ 'footer-copyright-divider-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[copyright-footer-layout]/' . KEMET_THEME_SETTINGS . '[footer-copyright-divider]', 
            'conditions' => '!=/>=', 
            'values' => 'disabled/1',
            'operators' => '&&'
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[footer-copyright-divider-color]', array(
            'section'  => 'section-footer-copyright',
            'priority' => 50,
            'label'    => __( 'Top Border Color', 'kemet' ),
        )
    )
);
/**
* Option: Title
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[kmt-footer-bar-content-title]', array(
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[copyright-footer-layout]', 
            'conditions' => '!=', 
            'values' => 'disabled',
        ),
        'sanitize_callback' 	=> 'wp_kses',
    )
);
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-footer-bar-content-title]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Footer Bar Content Style', 'kemet' ),
            'section'  => 'section-footer-copyright',
            'priority' => 55,
            'settings' => array(),
        )
    )
);
/**
* Option: Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[footer-color]', array(
        'default'           => $defaults[ 'footer-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[copyright-footer-layout]', 
            'conditions' => '!=', 
            'values' => 'disabled',
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[footer-color]', array(
            'label'   => __( 'Font Color', 'kemet' ),
            'section' => 'section-footer-copyright',
            'priority' => 60,
        )
    )
);

/**
* Option: Footer Font Size
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[footer-copyright-font-size]', array(
        'default'           => $defaults[ 'footer-copyright-font-size' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[copyright-footer-layout]', 
            'conditions' => '!=', 
            'values' => 'disabled',
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[footer-copyright-font-size]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'section-footer-copyright',
            'priority'       => 65,
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
* Option: Footer Letter Spacing
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[footer-copyright-letter-spacing]', array(
        'default'           => $defaults[ 'footer-copyright-letter-spacing' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[copyright-footer-layout]', 
            'conditions' => '!=', 
            'values' => 'disabled',
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[footer-copyright-letter-spacing]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'section-footer-copyright',
            'priority'       => 68,
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
* Option: Link Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[footer-link-color]', array(
        'default'           => $defaults[ 'footer-link-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[copyright-footer-layout]', 
            'conditions' => '!=', 
            'values' => 'disabled',
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[footer-link-color]', array(
            'label'   => __( 'Link Color', 'kemet' ),
            'section' => 'section-footer-copyright',
            'priority'    => 70,
        )
    )
);

/**
* Option: Link Hover Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[footer-link-h-color]', array(
        'default'           =>  $defaults[ 'footer-link-h-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[copyright-footer-layout]', 
            'conditions' => '!=', 
            'values' => 'disabled',
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[footer-link-h-color]', array(
            'label'   => __( 'Link Hover Color', 'kemet' ),
            'section' => 'section-footer-copyright',
            'priority' => 75,
        )
    )
);
