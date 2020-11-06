<?php
/**
 * Woocommerce
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Woocommerce_Settings')) {


    class Kemet_Woocommerce_Settings {

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
            add_action( 'customize_register', array( $this, 'customize_register' ) );
            add_filter( 'kemet_theme_defaults', array( $this, 'theme_defaults' ) );
            add_action( 'customize_preview_init', array( $this, 'preview_scripts' ) , 1);
		}

        public function customize_register( $wp_customize ) {

            require_once KEMET_WOOCOMMERCE_DIR . 'customizer/customizer-options.php';  
        }

        function theme_defaults( $defaults ) {
            $defaults['quick-view-style'] = 'qv-icon';
            $defaults['shop-layout'] = 'shop-grid';
            $defaults['enable-single-ajax-add-to-cart'] = false;
            $defaults['shop-list-product-structure'] = array(
                'title',
                'price',
                'ratings',
				'category',
				'add_cart',
            );
            $defaults['shop-list-style-structure'] = array(
                'title',
                'price',
                'ratings',
				'category',
				'add_cart',
			);
            $defaults['sale-style'] = '100%';
            $defaults['product-content-alignment'] = 'center';
            $defaults['related-products-count'] = 3;
            $defaults['related-products-colunms'] = 3;
            $defaults['disable-related-products'] = false;
            $defaults['enable-filter-button'] = false;
            $defaults['off-canvas-filter-label'] = 'Filter';
            $defaults['sale-content'] = 'sale-text';
            $defaults['product-image-width'] = '';
            $defaults['product-gallery-style'] = 'horizontal';
            $defaults['up-sells-products-count'] = 3;
            $defaults['up-sells-products-colunms'] = 3;
            $defaults['disable-up-sells-products'] = false;
            $defaults['enable-product-navigation'] = false;
            $defaults['wishlist-in-header'] = false;
            $defaults['enable-quick-view'] = false;
            $defaults['woo-pagination-style'] = 'standard';
            $defaults['infinite-scroll-last-text'] = 'No more products to show.';
            $defaults['infinite-scroll-loader-color'] = '';
            $defaults['list-style-description'] = false;

            return $defaults;
        }

        function preview_scripts() {
            if ( SCRIPT_DEBUG ) {
            wp_enqueue_script( 'kemet-woocommerce-customize-preview-js', KEMET_WOOCOMMERCE_URL . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);
        } else {
            wp_enqueue_script( 'kemet-woocommerce-customize-preview-js', KEMET_WOOCOMMERCE_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);			}
    }
    }
}
Kemet_Woocommerce_Settings::get_instance();
