<?php
/**
 * Helper class for font settings.
 *
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
 * @link        https://kemet.io/
 * @since       Kemet 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Font info class for System and Google fonts.
 */
if ( ! class_exists( 'Kemet_Fonts_Data' ) ) :

	/**
	 * Fonts Data
	 */
	final class Kemet_Fonts_Data {

		/**
		 * Localize Fonts
		 */
		static public function js() {

			$system = json_encode( Kemet_Font_Families::get_system_fonts() );
			$google = json_encode( Kemet_Font_Families::get_google_fonts() );
			$custom = json_encode( Kemet_Font_Families::get_custom_fonts() );
			if ( ! empty( $custom ) ) {
				return 'var KmtFontFamilies = { system: ' . $system . ', custom: ' . $custom . ', google: ' . $google . ' };';
			} else {
				return 'var KmtFontFamilies = { system: ' . $system . ', google: ' . $google . ' };';
			}
		}
	}

endif;

