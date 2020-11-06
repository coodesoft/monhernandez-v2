<?php
/**
 * WooCommerce Options for Kemet Theme.
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

	/**
	 * Option: Disable Breadcrumb
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[enable-cart-upsells]', array(
			'default'           => kemet_get_option( 'enable-cart-upsells' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[enable-cart-upsells]', array(
			'section'  => 'section-woo-shop-cart',
			'label'    => __( 'Enable Upsells', 'kemet' ),
			'priority' => 10,
			'type'     => 'checkbox',
		)
	);
