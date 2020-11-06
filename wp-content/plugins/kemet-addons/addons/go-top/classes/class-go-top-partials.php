<?php
/**
 * Go Top Partials
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Go_Top_Partials')) {

    class Kemet_Go_Top_Partials {

        private static $instance;

        /**
         * Initiator
         */
        
        public static function get_instance()
        {
            if (! isset(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }
        /**
		 *  Constructor
		 */
		public function __construct() {
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
            add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
            add_action( 'kemet_footer', array( $this, 'kemet_go_top_markup') );
        }

        public function kemet_go_top_markup() {
            $display_go_top = apply_filters('display_go_top_icon' , kemet_get_option( 'enable-go-top' ));
            if( $display_go_top ){
            require_once KEMET_GOTOP_DIR . 'templates/go-top.php';
            }
        }


        public function add_styles() {

            $css_prefix = '.min.css';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$css_prefix = '.css';
				$dir        = 'unminified';
			}

			if ( is_rtl() ) {
				$css_prefix = '.min-rtl.css';
				if ( SCRIPT_DEBUG ) {
					$css_prefix = '-rtl.css';
				}
            }
            
            Kemet_Style_Generator::kmt_add_css(KEMET_GOTOP_DIR.'assets/css/'. $dir .'/style' . $css_prefix);

        }
        
        public function add_scripts() {
            $js_prefix  = '.min.js';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix  = '.js';
				$dir        = 'unminified';
            }

			 Kemet_Style_Generator::kmt_add_js(KEMET_GOTOP_DIR.'assets/js/'. $dir .'/go-top' . $js_prefix);
		}
        
    }
}
Kemet_Go_Top_Partials::get_instance();
