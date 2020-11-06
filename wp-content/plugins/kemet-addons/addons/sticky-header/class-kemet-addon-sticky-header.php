<?php

/**
 * Kemet Sticky Header Addon
 *
 * @package Kemet Addons
 */

define( 'KEMET_STICKY_HEADER_DIR', KEMET_ADDONS_DIR . 'addons/sticky-header/' );
define( 'KEMET_STICKY_HEADER_URL', KEMET_ADDONS_URL . 'addons/sticky-header/' );

if ( ! class_exists( 'Kemet_Sticky_Header' ) ) {

	class Kemet_Sticky_Header {

		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		
		public function __construct() {
            
			require_once KEMET_STICKY_HEADER_DIR . 'classes/class-sticky-header-settings.php';
			require_once KEMET_STICKY_HEADER_DIR . 'classes/class-sticky-header-partials.php';
			require_once KEMET_STICKY_HEADER_DIR . 'classes/class-sticky-headers-meta.php';
            
            if ( ! is_admin() ) {
				require_once KEMET_STICKY_HEADER_DIR . 'classes/dynamic.css.php';
			}
		}
       
		

	}
    Kemet_Sticky_Header::get_instance();
}
