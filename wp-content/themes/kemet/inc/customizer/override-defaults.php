<?php
/**
 * Override default customizer panels, sections, settings or controls.
 *
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
 * @link        https://kemet.io/
 * @since       Kemet 1.0.0
 */

/**
 * Override Sections
 */
$wp_customize->get_section( 'title_tagline' )->priority = 5;

/**
 * Override Settings
 */
$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
/**
 * Override Panels
 */


/**
 * Override Controls
 */
$wp_customize->get_control( 'custom_logo' )->priority      = 60;
$wp_customize->get_control( 'site_icon' )->priority        = 95;
$wp_customize->get_control( 'blogname' )->priority         = 5;
$wp_customize->get_control( 'blogdescription' )->priority  = 10;
$wp_customize->get_control( 'header_textcolor' )->priority = 8;

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'blogname', array(
			'selector'            => '.main-header-bar .site-title a,  .kmt-footer-copyright-wrap .kmt-footer-site-title',
			'container_inclusive' => false,
			'render_callback'     => array( 'Kemet_Customizer_Partials', '_render_partial_site_title' ),
		)
	);
}

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'blogdescription', array(
			'selector'            => '.main-header-bar .site-description',
			'container_inclusive' => false,
			'render_callback'     => array( 'Kemet_Customizer_Partials', '_render_partial_site_tagline' ),
		)
	);
}
