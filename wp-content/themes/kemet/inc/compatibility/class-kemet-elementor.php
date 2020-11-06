<?php
/**
 * Elementor Compatibility File.
 *
 * @package Kemet
 */

namespace Elementor;

// If plugin - 'Elementor' not exist then return.
if ( ! class_exists( '\Elementor\Plugin' ) ) {
	return;
}

/**
 * Kemet Elementor Compatibility
 */
if ( ! class_exists( 'Kemet_Elementor' ) ) :

	/**
	 * Kemet Elementor Compatibility
	 *
	 * @since 1.0.5
	 */
	class Kemet_Elementor {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		function __construct() {
			add_action( 'wp', array( $this, 'elementor_default_setting' ), 20 );
			add_action( 'elementor/preview/init', array( $this, 'elementor_default_setting' ) );
			add_action( 'elementor/preview/enqueue_styles', array( $this, 'elementor_overlay_zindex' ) );
			add_action( 'elementor/preview/enqueue_styles', array( $this, 'enqueue_elementor_compatibility_styles' ) );
			add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'enqueue_elementor_compatibility_styles' ) );	
		}

		/**
		 * @return void
		 * @since  1.0.4
		 */
		function enqueue_elementor_compatibility_styles() {
			?>
				<style type="text/css" id="kmt-elementor-compatibility-css">
					.elementor-widget-heading .elementor-heading-title {
						margin: 0;
					}
				</style>
			<?php
		}


		function elementor_default_setting() {

			if ( false == kemet_enable_page_builder() || 'post' == get_post_type() ) {
				return;
			}

			// don't modify post meta settings if we are not on Elementor's edit page.
			if ( ! $this->is_elementor_editor() ) {
				return;
			}

			global $post;
			$id = kemet_get_post_id();
			
			if ( isset( $post ) && ( is_admin() || is_singular() ) ) {
				
				if ( $this->is_elementor_activated( $id ) ) {

					$meta = get_post_meta( get_the_ID(), 'kemet-content-layout', true ); 
					if(isset($meta)){
						update_post_meta( $id, 'kemet-content-layout', 'page-builder' );
					}else{
						add_post_meta( $id, 'kemet-content-layout', 'page-builder' );
					}
					
					add_filter(
						'kemet_get_content_layout',
						function () {
							return 'page-builder';
						}
					);
				}
			}
		}

		public function elementor_overlay_zindex() {

			// return if we are not on Elementor's edit page.
			if ( ! $this->is_elementor_editor() ) {
				return;
			}

			?>
			<style type="text/css" id="kmt-elementor-overlay-css">
				.elementor-editor-active .elementor-element > .elementor-element-overlay {
					z-index: 9999;
				}
			</style>

			<?php
		}

		 function is_elementor_activated( $id ) {
			
			if ( version_compare( ELEMENTOR_VERSION, '1.5.0', '<' ) ) {
				
				return ( 'builder' === Plugin::$instance->db->get_edit_mode( $id ) );
			} else {
				
				return Plugin::$instance->db->is_built_with_elementor( $id );
			}
		}

		private function is_elementor_editor() {
			if ( ( isset( $_REQUEST['action'] ) && 'elementor' == $_REQUEST['action'] ) || isset( $_REQUEST['elementor-preview'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				return true;
			}

			return false;
		}

	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Kemet_Elementor::get_instance();
