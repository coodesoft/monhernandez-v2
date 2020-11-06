<?php
/**
* Header Options for Kemet Theme.
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
    /**
     * Get WP menus
     *
     * @since 1.0.0
     */
    function get_wp_menus() {
        $menus 		= array( esc_html__( 'Select Your Menu', 'kemet' ) );
        $get_menus 	= get_terms( 'nav_menu', array( 'hide_empty' => true ) );
        foreach ( $get_menus as $menu) {
            $menus[$menu->term_id] = $menu->name;
        }
        return $menus;
    }
    $defaults = Kemet_Theme_Options::defaults();
    
/**
* Option: Header Layout
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[header-layouts]', array(
        'default'           => $defaults['header-layouts'],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);

$wp_customize->add_control(
    new Kemet_Control_Radio_Image(
        $wp_customize, KEMET_THEME_SETTINGS . '[header-layouts]', array(
            'section'  => 'section-header',
            'priority' => 10,
            'label'    => __( 'Header Layout', 'kemet' ),
            'type'     => 'kmt-radio-image',
            'choices'  => array(
                'disable' => array(
                    'label' => __( 'Disable', 'kemet' ),
                    'path'  => KEMET_THEME_URI . '/assets/images/disable.png',
                ),
                'header-main-layout-1' => array(
                    'label' => __( 'Header 1', 'kemet' ),
                    'path'  => KEMET_THEME_URI . 'assets/images/header-layout-01.png',
                ),
                'header-main-layout-2' => array(
                    'label' => __( 'Header 2', 'kemet' ),
                    'path'  => KEMET_THEME_URI . 'assets/images/header-layout-02.png',
                ),
                'header-main-layout-3' => array(
                    'label' => __( 'Header 3', 'kemet' ),
                    'path'  => KEMET_THEME_URI . 'assets/images/header-layout-03.png',
                ),
            ),
        )
    )
);
/**
* Option: Header 1 Logo Position
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[header-logo-position]', array(
		'default'           => $defaults['header-logo-position'],
		'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[header-layouts]', 
            'conditions' => '==', 
            'values' => 'header-main-layout-1',
        ),
	)
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[header-logo-position]', array(
        'type'     => 'select',
        'section'  => 'section-header',
        'priority' => 25,
        'label'    => __( 'Logo Position', 'kemet' ),
        'choices'  => array(
            '' => __( 'Left', 'kemet' ),
            'reverse'    => __( 'Right', 'kemet' ),
        ),
    )
);
/**
* Option: Header 3 Right Section
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[header-right-section]', array(
		'default'           =>  $defaults['header-right-section'],
		'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[header-layouts]', 
            'conditions' => '==', 
            'values' => 'header-main-layout-2',
        ),
	)
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[header-right-section]', array(
        'type'     => 'select',
        'section'  => 'section-header',
        'priority' => 25,
        'label'    => __( 'Right Section Content', 'kemet' ),
        'choices'  => array(
            'none'    => __( 'None', 'kemet' ),
            'search'    => __( 'Search', 'kemet' ),
            'menu' => __( 'Menu', 'kemet' ),
            'widget'    => __( 'Widget', 'kemet' ),
        ),
    )
);
/**
* Option: Right Section Menu
*/
$wp_customize->add_setting(
	KEMET_THEME_SETTINGS . '[header-right-section-menu]', array(
		'default'           => $defaults['header-right-section-menu'],
		'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[header-layouts]/' . KEMET_THEME_SETTINGS . '[header-right-section]', 
            'conditions' => '==/==', 
            'values' => 'header-main-layout-2/menu',
            'operators' => '&&'
        ),
	)
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[header-right-section-menu]', array(
        'type'     => 'select',
        'section'  => 'section-header',
        'priority' => 28,
        'label'    => __( 'Right Section Menu', 'kemet' ),
        'choices'  => get_wp_menus(),
    )
);
/**
* Option: Title
*/
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-header-title-style]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Header Layout Style', 'kemet' ),
            'section'  => 'section-header',
            'priority' => 50,
            'settings' => array(),
        )
    )
);
/**
* Option: header Background
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[header-bg-obj]', array(
        'default'           => $defaults['header-bg-obj'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_background_obj' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Background(
        $wp_customize, KEMET_THEME_SETTINGS . '[header-bg-obj]', array(
            'type'    => 'kmt-background',
            'section' => 'section-header',
            'priority' => 60,
            'label'   => __( 'Header Background', 'kemet' ),
        )
    )
);
/**
* Option: Bottom Border Size
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[header-main-sep]', array(
        'default'           => $defaults['header-main-sep'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[header-main-sep]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'section-header',
            'priority'       => 70,
            'label'          => __( 'Border Size', 'kemet' ),
            'unit_choices'   => array(
                'px' => array(
                    'min' => 0,
                    'step' => 1,
                    'max' => 15,
                ),
            ),
        )
    )
);
/**
* Option: Border Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[header-main-sep-color]', array(
        'default'           => $defaults['header-main-sep-color'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[header-main-sep-color]', array(
            'section'  => 'section-header',
            'priority' => 80,
            'label'    => __( 'Border Color', 'kemet' ),
        )
    )
);
/**
* Option - header Spacing
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[header-padding]', array(
        'default'           => $defaults['header-padding'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Spacing(
        $wp_customize, KEMET_THEME_SETTINGS . '[header-padding]', array(
            'type'           => 'kmt-responsive-spacing',
            'section'        => 'section-header',
            'priority'       => 90,
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



