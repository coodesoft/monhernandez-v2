<?php

$defaults = Kemet_Theme_Options::defaults();

/**
 * Option: Title
 */
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-cart-dropdown-title]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Cart Dropdown Settings', 'kemet' ),
            'section'  => 'section-woo-cart-menu-items',
            'priority' => 5,
            'settings' => array(),
        )
    )
);
/**
 * Option: Cart Icon
 */
 /**
 * Option:Cart Display
 */
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[shop-cart-icon]',array(
        'default'           => $defaults[ 'shop-cart-icon' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array('Kemet_Customizer_Sanitizes','sanitize_choices'),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[shop-cart-icon]' ,array(
        'priority'   => 6,
        'section'    => 'section-woo-cart-menu-items',
        'type'     => 'select',
        'label'    => __( 'Icon Display', 'kemet' ),
        'choices'  => array(
            'icon-cart'        => __( 'Cart', 'kemet' ),
            'icon-bag'        => __( 'Bag', 'kemet' ),
        ),
    )
);
/**
* Option: Disable Up-Sells
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[disable-cart-if-empty]', array(
        'default'           => $defaults[ 'disable-cart-if-empty' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[disable-cart-if-empty]', array(
        'type'            => 'checkbox',
        'section'         => 'section-woo-cart-menu-items',
        'label'           => __( 'Disable Cart If Empty', 'kemet' ),
        'priority'        => 10,
    )
);
 /**
 * Option:Cart Display
 */
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[cart-icon-display]',array(
        'default'           => $defaults[ 'cart-icon-display' ],
        'type'              => 'option',
        'sanitize_callback' => array('Kemet_Customizer_Sanitizes','sanitize_choices'),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[cart-icon-display]' ,array(
        'priority'   => 11,
        'section'    => 'section-woo-cart-menu-items',
        'type'     => 'select',
        'label'    => __( 'Display', 'kemet' ),
        'choices'  => array(
            'icon'        => __( 'Icon', 'kemet' ),
            'icon-total'        => __( 'Icon And Cart Total', 'kemet' ),
            'icon-count'        => __( 'Icon And Cart count', 'kemet' ),
            'icon-count-total' => __( 'Icon And Cart count + total', 'kemet' ),
        ),
    )
);
/**
* Option: Icon Size
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[cart-icon-size]', array(
        'default'           => $defaults[ 'cart-icon-size' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[cart-icon-size]', array(
            'type'        => 'kmt-slider',
            'section'     => 'section-woo-cart-menu-items',
            'priority'    => 12,
            'label'       => __( 'Icon Size', 'kemet' ),
            'suffix'      => '',
            'input_attrs' => array(
                'min'  => 10,
                'step' => 1,
                'max'  => 50,
            ),
        )
    )
);

/**
* Option: Icon vertical Align
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[cart-icon-center-vertically]', array(
        'default'           => $defaults[ 'cart-icon-center-vertically' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[cart-icon-center-vertically]', array(
            'type'        => 'kmt-slider',
            'section'     => 'section-woo-cart-menu-items',
            'priority'    => 12,
            'label'       => __( 'Center Vertically', 'kemet' ),
            'suffix'      => '',
            'input_attrs' => array(
                'min'  => 0,
                'step' => 1,
                'max'  => 100,
            ),
        )
    )
);

/**
* Option: Cart Dropdown Width (px)
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[cart-dropdown-width]', array(
        'default'           => $defaults['cart-dropdown-width'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[cart-dropdown-width]', array(
            'type'        => 'kmt-slider',
            'section'     => 'section-woo-cart-menu-items',
            'priority'    => 15,
            'label'       => __( 'Cart Dropdown Width (px)', 'kemet' ),
            'suffix'      => '',
            'input_attrs' => array(
                'min'  => 200,
                'step' => 1,
                'max'  => 600,
            ),
        )
    )
);
/**
 * Option: Cart Dropdown Background Color
 */
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[cart-dropdown-bg-color]', array(
        'default'           => $defaults[ 'cart-dropdown-bg-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize, KEMET_THEME_SETTINGS . '[cart-dropdown-bg-color]', array(
            'section' => 'section-woo-cart-menu-items',
            'label'   => __( 'Cart Dropdown Background Color', 'kemet' ),
            'priority'=> 20,
        )
    )
);
/**
* Option: Cart Dropdown Border Size
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[cart-dropdown-border-size]', array(
        'default'           => $defaults['cart-dropdown-border-size'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[cart-dropdown-border-size]', array(
            'type'        => 'kmt-slider',
            'section'     => 'section-woo-cart-menu-items',
            'priority'    => 25,
            'label'       => __( 'Cart Dropdown Border Size', 'kemet' ),
            'suffix'      => '',
            'input_attrs' => array(
                'min'  => 1,
                'step' => 1,
                'max'  => 100,
            ),
        )
    )
);
/**
 * Option: Cart Dropdown Border Color
 */
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[cart-dropdown-border-color]', array(
        'default'           => $defaults[ 'cart-dropdown-border-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize, KEMET_THEME_SETTINGS . '[cart-dropdown-border-color]', array(
            'section' => 'section-woo-cart-menu-items',
            'label'   => __( 'Cart Dropdown Border Color', 'kemet' ),
            'priority'=> 30,
        )
    )
);