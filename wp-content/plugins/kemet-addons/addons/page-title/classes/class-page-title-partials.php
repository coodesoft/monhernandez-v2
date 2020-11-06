<?php
/**
 * Page Title Section
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Page_Title_Partials')) {

    /**
     * Page Title Section
     *
     * @since 1.0.0
     */
    class Kemet_Page_Title_Partials {

        private static $instance;
        
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
            add_filter( 'kemet_title_bar_disable', '__return_false' );
            add_filter( 'woocommerce_show_page_title', '__return_false' );
            add_action( 'kemet_after_header_block' , array( $this, 'kemet_page_title_markup' ), 9 );
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
            add_action( 'kemet_before_header_block', array( $this, 'header_merged_with_title' ) );
            add_filter( 'kemet_the_title_enabled', array( $this, 'page_title_display' ) );
            add_filter( 'kemet_disable_breadcrumbs', array( $this, 'breadcrumbs_display' ) );
        }

        public function kemet_page_title_markup() {
            $page_title_layout = apply_filters( 'kemet_the_page_title_layout' , kemet_get_option( 'page-title-layouts' ));
            if ( $page_title_layout != 'disable' ) {
                if($page_title_layout !== 'page-title-layout-2'){
                    kemetaddons_get_template( 'page-title/templates/'. esc_attr( $page_title_layout ) . '.php' );
                }else{
                    kemetaddons_get_template( 'page-title/templates/page-title-layout-1.php' );
                }
            }
            $kemet_header_layout = apply_filters( 'kemet_primary_header_layout', kemet_get_option( 'header-layouts' ) );	
			$unsupported_headers = array('header-main-layout-5' , 'header-main-layout-6' , 'header-main-layout-7');
            $header_merged_title = kemet_get_option('merge-with-header');
            if( $header_merged_title == '1' && !in_array($kemet_header_layout , $unsupported_headers)) {
                echo '</div>';
            }
         }
         public function page_title_display($default){
            if(is_page()){
                $default = false;
            }
            return $default;
         }
        public function header_merged_with_title() {
            $header_merged_title = kemet_get_option("merge-with-header");
            $kemet_header_layout = apply_filters( 'kemet_primary_header_layout', kemet_get_option( 'header-layouts' ) );	
            $unsupported_headers = array('header-main-layout-5' , 'header-main-layout-6' , 'header-main-layout-7');
            
            if( $header_merged_title == '1' && !in_array($kemet_header_layout , $unsupported_headers)) {
                $combined = 'kemet-merged-header-title';
            printf(
				'<div class="%1$s">',
				$combined
            );
            }
            
        }
        function breadcrumbs_display($default){
            $display = true;

			if ( ( is_archive() ) && kemet_get_option( 'disable-breadcrumbs-in-archive' ) ) {
				$display = false;
			}

			if ( is_page() && kemet_get_option( 'disable-breadcrumbs-in-single-page' ) ) {
				$display = false;
			}

			if ( is_single() && kemet_get_option( 'disable-breadcrumbs-in-single-post' ) ) {
				$display = false;
			}

			if ( is_404() && kemet_get_option( 'disable-breadcrumbs-in-404-page' ) ) {
				$display = false;
            }
            
            return $display;
        }
        function add_styles() {

            $css_prefix = '.min.css';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$css_prefix = '.css';
				$dir        = 'unminified';
			}

			if ( is_rtl() ) {
				$css_prefix = '-rtl.min.css';
				if ( SCRIPT_DEBUG ) {
					$css_prefix = '-rtl.css';
				}
			}
            Kemet_Style_Generator::kmt_add_css( KEMET_PAGE_TITLE_DIR.'assets/css/'. $dir .'/style' . $css_prefix);

	    }

    }
}
Kemet_Page_Title_Partials::get_instance();
