<?php
/**
 * Kemet Extra Widgets
 *
 * @package Kemet Addons
 */

define( 'KEMET_WIDGETS_DIR', KEMET_ADDONS_DIR . 'addons/extra-widgets/' );
define( 'KEMET_WIDGETS_URL', KEMET_ADDONS_URL . 'addons/extra-widgets/' );

if ( ! class_exists( 'Kemet_Extra_Widgets' ) ) {

	/**
	 * Widgets Setup
	 *
	 * @since 1.0.0
	 */
	class Kemet_Extra_Widgets {

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

			require_once KEMET_WIDGETS_DIR . 'classes/class-create-widgets.php';
			require_once KEMET_WIDGETS_DIR . 'classes/class-widgets-settings.php';
			require_once KEMET_WIDGETS_DIR . 'classes/class-widgets-partials.php';
			if ( ! is_admin() ) {
				require_once KEMET_WIDGETS_DIR . 'classes/dynamic.css.php';
			}

		}

	}

    Kemet_Extra_Widgets::get_instance();
}