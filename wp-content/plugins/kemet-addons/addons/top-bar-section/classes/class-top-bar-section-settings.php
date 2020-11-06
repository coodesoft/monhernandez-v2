<?php
/**
 * Top Bar Section
 * 
 * @package Kemet Addons
 */
if (! class_exists('Kemet_Top_Bar_Settings')) {


    class Kemet_Top_Bar_Settings {

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
            add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 1 );
        }

		public function customize_register( $wp_customize ) {

			// Update the Customizer Sections under Layout.
            $wp_customize->add_section(
                new Kemet_WP_Customize_Section(
                    $wp_customize, 'section-topbar-header', array(
                            'title'    => __( 'Top Bar Section', 'kemet-addons' ),
                            'panel'    => 'panel-layout',
                            'section'  => 'section-header-group',
                            'priority' => 15,
                        )
                )
            );
            require_once KEMET_TOPBAR_DIR . 'customizer/customizer-options.php';  
        }

        
        function theme_defaults( $defaults ) {
            $defaults['top-section-1']              = '';
            $defaults['top-section-2']              = '';
            $defaults['top-section-1-html']              = '';
            $defaults['top-section-2-html']                    = '';
            $defaults['section1-content-align']              = 'flex-start';
            $defaults['section2-content-align']                    = 'flex-end';
            $defaults['topbar-padding']         = '';
            $defaults['topbar-responsive']         = 'all-devices';
            $defaults['topbar-bg-color']    = '';
            $defaults['topbar-font-size']                  = '';
            $defaults['topbar-text-color']                  = '';
            $defaults['top-bar-search-style']               = 'search-icon';
            $defaults['topbar-link-color']           = '';
            $defaults['topbar-link-h-color']           = '';
            $defaults['topbar-border-size']           = array(
                                            'desktop'      => array(
                                                'top'    => 2,
                                                'right'  => 2,
                                                'bottom' => 2,
                                                'left'   => 2,
                                            ),
                                            'tablet'       => array(
                                                'top'    => '',
                                                'right'  => '',
                                                'bottom' => '',
                                                'left'   => '',
                                            ),
                                            'mobile'       => array(
                                                'top'    => '',
                                                'right'  => '',
                                                'bottom' => '',
                                                'left'   => '',
                                            ),
                                            'desktop-unit' => 'px',
                                            'tablet-unit'  => 'px',
                                            'mobile-unit'  => 'px',
                                        );
            $defaults['topbar-border-color']           = '';
            $defaults['topbar-submenu-bg-color']           = '';
            $defaults['topbar-submenu-items-color']           = '';
            $defaults['topbar-submenu-items-h-color']           = '';
            $defaults['topbar-item-padding']           = '';
            $defaults['top-bar-font-family']           = 'inherit';
            $defaults['top-bar-font-weight']           = 'inherit';
            $defaults['top-bar-text-transform']           = '';
            $defaults['top-bar-line-height']           = '';
            $defaults['top-bar-letter-spacing']           = '';
            return $defaults;
        }
        
        function preview_scripts() {
                if ( SCRIPT_DEBUG ) {
				wp_enqueue_script( 'kemet-topbar-customize-preview-js', KEMET_TOPBAR_URL . 'assets/js/unminified/customizer-preview.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);
			} else {
                wp_enqueue_script( 'kemet-topbar-customize-preview-js', KEMET_TOPBAR_URL . 'assets/js/minified/customizer-preview.min.js', array( 'customize-preview', 'kemet-customizer-preview-js' ), KEMET_ADDONS_VERSION, true);			}
        }

    }
}
Kemet_Top_Bar_Settings::get_instance();
