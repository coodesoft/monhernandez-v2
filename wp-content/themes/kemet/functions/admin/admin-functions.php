<?php
/**
 * Admin functions - Functions that add some functionality to WordPress admin panel
 *
 * @package Kemet
 * @since 1.0.0
 */

/**
 * Register menus
 */
if ( ! function_exists( 'kemet_register_menu_locations' ) ) {

	/**
	 * Register menus
	 */
	function kemet_register_menu_locations() {

		/**
		 * Menus
		 */
		register_nav_menus(
			array(
				'primary'     => __( 'Primary Menu', 'kemet' ),
				'top_menu'     => __( 'Top Menu', 'kemet' ),
				'left_menu' => __( 'Left Menu', 'kemet' ),
            	'footer_menu' => __( 'Footer Menu', 'kemet' ),
			)
		);
	}
}

add_action( 'init', 'kemet_register_menu_locations' );
