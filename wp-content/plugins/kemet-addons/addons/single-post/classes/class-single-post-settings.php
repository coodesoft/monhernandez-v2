<?php
/**
 * Extra Headers
 * 
 * @package Kemet Addons
 */

if ( !class_exists( 'Kemet_Single_Post_Setting' )) {
    /**
	 * Single Post Settings
	 *
	 * @since 1.0.0
	 */
    class Kemet_Single_Post_Setting {
        
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
            add_filter( 'kemet_theme_defaults', array( $this, 'theme_defaults' ) );
			add_action( 'customize_preview_init', array( $this, 'preview_scripts' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ) );
        }
        
		function theme_defaults( $defaults ) {
            
			$defaults['prev-next-links'] = false;
			$defaults['enable-author-box'] = false;
			$defaults['enable-page-title-content-area'] = true;
			$defaults['padding-inside-container'] = '';
			$defaults['title-meta-position'] = 'left';
			$defaults['content-alignment'] = 'left';
			$defaults['featured-image-header'] = false;
			$defaults['page-header-title'] = 'post-title';
            return $defaults;
        }
		function customize_register($wp_customize) {
			require_once KEMET_SINGLE_POST_DIR . 'customizer/customizer-options.php';  
			
        }
		function preview_scripts() {
			if ( SCRIPT_DEBUG ) {
			wp_enqueue_script( 'kemet-single-post-customize-preview-js', KEMET_SINGLE_POST_URL . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);
		} else {
			wp_enqueue_script( 'kemet-single-post-customize-preview-js', KEMET_SINGLE_POST_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);			}
	}
        
    }
}
Kemet_Single_Post_Setting::get_instance();