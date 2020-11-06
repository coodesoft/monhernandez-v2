<?php
/**
* Single Post Options for Kemet Theme.
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
* Option: Single Post Content Width
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[blog-single-width]', array(
        'default'           => $defaults['blog-single-width'],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[blog-single-width]', array(
        'type'     => 'select',
        'section'  => 'section-blog-single',
        'priority' => 5,
        'label'    => __( 'Single Post Content Width', 'kemet' ),
        'choices'  => array(
            'default' => __( 'Default', 'kemet' ),
            'custom'  => __( 'Custom', 'kemet' ),
        ),
    )
);
/**
* Option: Enter Width
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[blog-single-max-width]', array(
        'default'           => $defaults['blog-single-max-width'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[blog-single-width]', 
            'conditions' => '==', 
            'values' => 'custom',
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[blog-single-max-width]', array(
            'type'        => 'kmt-slider',
            'section'     => 'section-blog-single',
            'priority'    => 10,
            'label'       => __( 'Enter Width', 'kemet' ),
            'suffix'      => '',
            'input_attrs' => array(
                'min'  => 768,
                'step' => 1,
                'max'  => 1920,
            ),
        )
    )
);
/**
* Option: Display Post Structure
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[blog-single-post-structure]', array(
        'default'           => $defaults['blog-single-post-structure'],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Sortable(
        $wp_customize, KEMET_THEME_SETTINGS . '[blog-single-post-structure]', array(
            'type'     => 'kmt-sortable',
            'section'  => 'section-blog-single',
            'priority' => 15,
            'label'    => __( 'Single Post Structure', 'kemet' ),
            'choices'  => array(
                'single-image'      => __( 'Featured Image', 'kemet' ),
                'single-title-meta' => __( 'Title & Blog Meta', 'kemet' ),
            ),
        )
    )
);

/**
* Option: Single Post Meta
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[blog-single-meta]', array(
        'default'           => $defaults[ 'blog-single-meta' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[blog-single-post-structure]', 
            'conditions' => 'inarray', 
            'values' => 'single-title-meta',
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Sortable(
        $wp_customize, KEMET_THEME_SETTINGS . '[blog-single-meta]', array(
            'type'     => 'kmt-sortable',
            'section'  => 'section-blog-single',
            'priority' => 20,
            'label'    => __( 'Single Post Meta', 'kemet' ),
            'choices'  => array(
                'author'   => __( 'Author', 'kemet' ),
                'category' => __( 'Category', 'kemet' ),
                'date'     => __( 'Publish Date', 'kemet' ),
                'comments' => __( 'Comments', 'kemet' ),
                'tag'      => __( 'Tags', 'kemet' ),
            ),
        )
    )
);

/**
* Option: Title
*/
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-single-post-style]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Title and Meta', 'kemet' ),
            'section'  => 'section-blog-single',
            'priority' => 30,
            'settings' => array(),
        )
    )
);
/**
* Option: Single Post / Page Title Font Size
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[font-size-entry-title]', array(
        'default'           => $defaults[ 'font-size-entry-title' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[font-size-entry-title]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'section-blog-single',
            'priority'       => 35,
            'label'          => __( 'Title Font Size', 'kemet' ),
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
* Option: Single Post / Page Title Letter Spacing
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[letter-spacing-entry-title]', array(
        'default'           => $defaults[ 'letter-spacing-entry-title' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[letter-spacing-entry-title]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'section-blog-single',
            'priority'       => 38,
            'label'          => __( 'Title Letter Spacing', 'kemet' ),
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
* Option: Single Post / Page Title Font Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[font-color-entry-title]', array(
        'default'           => $defaults[ 'font-color-entry-title' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[font-color-entry-title]', array(
            'type'    => 'kmt-color',
            'priority'    => 40,
            'label'   => __( 'Post Title Font Color', 'kemet' ),
            'section' => 'section-blog-single',
        )
    )
);






