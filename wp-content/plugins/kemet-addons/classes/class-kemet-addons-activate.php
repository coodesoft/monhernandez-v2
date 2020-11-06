<?php 

/**
 * Enable Addons
 *
 * @since 1.0
 */
final class Kemet_Addon_Activate {

	/**
	 * Construct
	 */
	function __construct() {

		if ('kemet' == get_template()){
			$this->load_kmt_addons();
		}
    }
	

	/**
	 * Load Kemet Addons
	 *
	 * @return void
	 */
	function load_kmt_addons() {
		
        $enabled_addon = get_option( 'kmt_framework' );

		if ( 0 < count( $enabled_addon ) ) {

			foreach ( $enabled_addon as $slug => $value ) {

				if ( false == $value ) {
					continue;
				}
                
                $addon_path = KEMET_ADDONS_DIR . 'addons/' . esc_attr( $slug ) . '/class-kemet-addon-' . esc_attr( $slug ) . '.php';

				if ( file_exists( $addon_path ) ) {
					require_once $addon_path;
				}
			}
		}
	}
}

new Kemet_Addon_Activate();