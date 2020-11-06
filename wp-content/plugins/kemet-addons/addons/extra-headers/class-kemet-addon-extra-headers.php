<?php 
/**
 * Kemet Extra Headers Addon
 *
 * @package Kemet Addons
 */

define( 'KEMET_EXTRA_HEADERS_DIR', KEMET_ADDONS_DIR . 'addons/extra-headers/' );
define( 'KEMET_EXTRA_HEADERS_URL', KEMET_ADDONS_URL . 'addons/extra-headers/' );

if ( ! class_exists( 'Kemet_Extra_Headers' ) ) {

	/**
	 * Extra Headers
	 *
	 * @since 1.0.0
	 */
	class Kemet_Extra_Headers {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
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
            
            require_once KEMET_EXTRA_HEADERS_DIR . 'classes/class-extra-headers-partials.php';
			require_once KEMET_EXTRA_HEADERS_DIR . 'classes/class-extra-headers-settings.php';
			require_once KEMET_EXTRA_HEADERS_DIR . 'classes/class-extra-headers-meta.php';
            
            if ( ! is_admin() ) {
				require_once KEMET_EXTRA_HEADERS_DIR . 'classes/dynamic.css.php';
			}
		}

	}
    Kemet_Extra_Headers::get_instance();
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
