<?php
/**
 * Beaver Builder Compatibility File.
 *
 * @package Kemet
 */

// If plugin - 'Beaver Builder' not exist then return.
if ( ! class_exists( 'FLBuilderModel' ) ) {
	return;
}

/**
 * Kemet Beaver Builder Compatibility
 */
if ( ! class_exists( 'Kemet_Beaver_Builder' ) ) :

	/**
	 * Kemet Beaver Builder Compatibility
	 *
	 * @since 1.0.6
	 */
	class Kemet_Beaver_Builder {

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
            add_action( 'wp', array( $this, 'beaver_builder_default_setting' ), 20 );
            add_action( 'do_meta_boxes', array( $this, 'beaver_builder_default_setting' ), 20 );		
        }


		function beaver_builder_default_setting() {

			if ( false == kemet_enable_page_builder() || 'post' == get_post_type() ) {
				return;
            }
            
			global $post;
			$id = kemet_get_post_id();
            
			if ( isset( $post ) && ( is_admin() || is_singular() ) ) {
				
				if ( FLBuilderModel::is_builder_enabled() ) {

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

	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Kemet_Beaver_Builder::get_instance();
