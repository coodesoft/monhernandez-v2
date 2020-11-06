<?php
/**
 * Kemet Admin Notice Class
 *
 * @package  Kemet
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kmt_Admin_Notices' ) ) :
	/**
	 * The Admin Notice Class
	 */
	class Kmt_Admin_Notices {

		/**
		 * Instance
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Setup class.
		 */
		public function __construct() {

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			if( ! defined('KEMET_ADDONS_VERSION' ) ){
				/* TO DO */
				add_action( 'admin_notices', array( $this, 'kemet_admin_notice' ) );
				return;
			}
		}

		/**
		 * Add admin notice
		 */
		public function kemet_admin_notice() {

				?>
				<div class="notice kmt-notice is-dismissible">
						<div class="kemet-notice-logo">
						    <span class="kmticon-AncientOwl" style="font-size: 55px;"></span>
						</div>
						<div class="kemet-notice-text">
							<p><?php esc_html_e( 'Take full advantage of Kemet theme! Install Kemet Addons Plugin for tons of extra customization options.', 'kemet' ); ?></p>
								<?php
									
                                    $plugin = 'kemet-addons/kemet-addons.php';
									$install_url   = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=kemet-addons' ), 'install-plugin_kemet-addons' );
									$activate_url   = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
                                    if ( is_addons_installed() ) {
                                        if ( ! current_user_can( 'activate_plugins' ) ) {
                                            return;
										}
										
										$button_label = __( 'Activate Kemet Addons', 'kemet' );
										$status = 'activate';
                                    } else {
                                        if ( ! current_user_can( 'install_plugins' ) ) {
                                            return;
										}

										$status = 'install';
                                        $button_label = __( 'Install Kemet Addons', 'kemet' );
                                    }

                                    $button = '<a class="button-primary kmt-active-plugin"  data-status = '.$status.' data-url-install = '.$install_url.'  data-url-activate = '.$activate_url.' onclick="active_plugin(event)" >' . $button_label . '</a>';

									printf( '<div>%1$s</div>', $button );
									
								?>
						</div>
					</div>

				<?php
		}

		public function enqueue_scripts()  {
			wp_enqueue_style( 'kmt-admin-notice', KEMET_THEME_URI . 'functions/admin/assets/css/style.css', array(), KEMET_THEME_VERSION );
			wp_enqueue_script( 'kmt-admin-notice', KEMET_THEME_URI . 'functions/admin/assets/js/main.js', array(), KEMET_THEME_VERSION );
		}


    }
         /**
         * Is Kemet Addons plugin installed.
         */
        if ( ! function_exists( 'is_addons_installed' ) ) {

            /**
             * Check if Kemet Addons is installed
             *
             * @since 1.0.0
             *
             * @access public
             */
            function is_addons_installed() {
                $path    = 'kemet-addons/kemet-addons.php';
                $plugins = get_plugins();

                return isset( $plugins[ $path ] );
            }
        }

	Kmt_Admin_Notices::get_instance();

endif;
