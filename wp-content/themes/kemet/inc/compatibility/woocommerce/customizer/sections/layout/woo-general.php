<?php
/**
 * WooCommerce General Options for Kemet Theme.
 *
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
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
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-rating-title]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Rating Style', 'kemet' ),
            'section'  => 'section-woo-general',
            'priority' => 15,
            'settings' => array(),
        )
    )
);
/**
 * Option: Rating color
 */
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[rating-color]', array(
        'default'           => $defaults[ 'rating-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize, KEMET_THEME_SETTINGS . '[rating-color]', array(
            'section' => 'section-woo-general',
            'label'   => __( 'Rating color', 'kemet' ),
            'priority'=> 15,
        )
    )
);