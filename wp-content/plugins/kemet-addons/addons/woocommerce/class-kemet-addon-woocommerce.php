<?php 
/**
 * Kemet Woocommerce Addon
 *
 * @package Kemet Addons
 */

define( 'KEMET_WOOCOMMERCE_DIR', KEMET_ADDONS_DIR . 'addons/woocommerce/' );
define( 'KEMET_WOOCOMMERCE_URL', KEMET_ADDONS_URL . 'addons/woocommerce/' );

if ( ! class_exists( 'Kemet_Addons_Woocommerce' ) ) {

	/**
	 * Woocommerce
	 *
	 * @since 1.0.3
	 */
	class Kemet_Addons_Woocommerce {

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
			
			if ( class_exists( 'WooCommerce' ) ) {
				
				require_once KEMET_WOOCOMMERCE_DIR . 'classes/class-woocommerce-partials.php';
				require_once KEMET_WOOCOMMERCE_DIR . 'classes/class-woocommerce-settings.php';
				
				if ( ! is_admin() ) {
					require_once KEMET_WOOCOMMERCE_DIR . 'classes/dynamic.css.php';
				}
			}
		}

	}
    Kemet_Addons_Woocommerce::get_instance();
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
