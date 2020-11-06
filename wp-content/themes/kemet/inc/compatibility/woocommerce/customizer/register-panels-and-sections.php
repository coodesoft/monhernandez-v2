<?php
/**
 * Register customizer panels & sections fro Woocommerce.
 *
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
 * @link        https://kemet.io/
 * @since       Kemet 1.0.0
 */

/**
 * WooCommerce
 */

$wp_customize->get_section( 'woocommerce_store_notice' )->priority = 5;

$wp_customize->add_section(
	new Kemet_WP_Customize_Section(
		$wp_customize, 'section-woo-general',
		array(
			'title'    => __( 'General', 'kemet' ),
			'panel'    => 'woocommerce',
			'priority' => 10,
		)
	)
);

$wp_customize->add_section(
	new Kemet_WP_Customize_Section(
		$wp_customize, 'section-woo-cart-menu-items',
		array(
			'title'    => __( 'Cart Menu Item', 'kemet' ),
			'panel'    => 'woocommerce',
			'priority' => 15,
		)
	)
);

$wp_customize->get_section( 'woocommerce_product_catalog' )->priority = 20;
$wp_customize->get_section( 'woocommerce_product_catalog' )->title = __( 'Shop', 'kemet' );

$wp_customize->add_section(
	new Kemet_WP_Customize_Section(
		$wp_customize, 'section-woo-shop-single',
		array(
			'title'    => __( 'Single Product', 'kemet' ),
			'panel'    => 'woocommerce',
			'priority' => 25,
		)
	)
);

$wp_customize->add_section(
	new Kemet_WP_Customize_Section(
		$wp_customize, 'section-woo-shop-cart',
		array(
			'title'    => __( 'Cart Page', 'kemet' ),
			'panel'  => 'woocommerce',
			'priority' => 30,
		)
	)
);

$wp_customize->get_section( 'woocommerce_checkout' )->priority = 35;

$wp_customize->get_section( 'woocommerce_product_images' )->priority = 40;

