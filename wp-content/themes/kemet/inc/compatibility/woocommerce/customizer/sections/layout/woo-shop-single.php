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
		KEMET_THEME_SETTINGS . '[single-product-breadcrumb-disable]', array(
			'default'           => kemet_get_option( 'single-product-breadcrumb-disable' ),
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[single-product-breadcrumb-disable]', array(
			'section'  => 'section-woo-shop-single',
			'label'    => __( 'Disable Breadcrumb', 'kemet' ),
			'priority' => 10,
			'type'     => 'checkbox',
		)
	);
