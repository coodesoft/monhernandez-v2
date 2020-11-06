<?php
/**
* Sticky Header Partials
*
* @package Kemet Addons
*/
if ( ! class_exists( 'Kemet_Sticky_Header_Partials' ) ) {
    class Kemet_Sticky_Header_Partials {
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
        *  Constructor
        */

        public function __construct() {
            add_action ( 'kemet_header', array( $this, 'sticky_header_logo' ), 1 );
            add_filter( 'kemet_header_class', array( $this, 'header_classes' ), 10, 1 );
            add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
            add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
        }

        function sticky_header_logo() {
            $enabled_sticky           = kemet_get_option( 'enable-sticky' );
            $sticky_logo          = kemet_get_option( 'sticky-logo' );
            if ( '' !== $sticky_logo && '1' == $enabled_sticky ) {
                // Logo For None Effect.
                add_filter( 'kemet_has_custom_logo', '__return_true' );
                add_filter( 'get_custom_logo', array( $this, 'kemet_sticky_header_logo' ), 10, 2 );
            }
        }

        function kemet_sticky_header_logo( $html ) {
            $enabled_sticky           = kemet_get_option( 'enable-sticky' );
            $sticky_logo          = kemet_get_option( 'sticky-logo' );

            if ( '' !== $sticky_logo && '1' == $enabled_sticky ) {

                add_filter( 'wp_get_attachment_image_attributes', array( $this, 'replace_sticky_header_attr' ), 10, 3 );
                $custom_logo_id = attachment_url_to_postid( $sticky_logo );
                $size = 'full';
                $html = sprintf(
                    '<a href="%1$s" class="custom-logo-link sticky-custom-logo" rel="home" itemprop="url">%2$s</a>',
                    esc_url( home_url( '/' ) ),
                    wp_get_attachment_image(
                        $custom_logo_id,
                        $size,
                        false,
                        array(
                            'class' => 'custom-logo',
                        )
                    )
                );
                $html .= sprintf(
                    '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
                    esc_url( home_url( '/' ) ),
                    wp_get_attachment_image(
                        get_theme_mod( 'custom_logo' ),
                        $size,
                        false,
                        array(
                            'class' => 'custom-logo',
                        )
                    )
                );
            }
            return $html;
        }

        function replace_sticky_header_attr( $attr, $attachment, $size ) {
            $sticky_logo          = kemet_get_option( 'sticky-logo' );
            $custom_logo_id = attachment_url_to_postid( $sticky_logo );
            if ( $custom_logo_id == $attachment->ID ) {
                $attach_data = array();
                if ( ! is_customize_preview() ) {
                    $attach_data = wp_get_attachment_image_src( $attachment->ID, 'full' );
                    if ( isset( $attach_data[0] ) ) {
                        $attr['src'] = $attach_data[0];
                    }
                }

                $attr['srcset'] = '';

                if ( '' !== $sticky_logo ) {
                    $cutom_logo     = wp_get_attachment_image_src( $custom_logo_id, 'full' );
                    $cutom_logo_url = $cutom_logo[0];
                    $attr['srcset'] = $cutom_logo_url;
                }
                $attr['srcset'] = $cutom_logo_url;
            }
            return $attr;
        }

        public function header_classes($classes) {
            $enabled_sticky           = apply_filters('kemet_disable_sticky_header' , kemet_get_option( 'enable-sticky' ));
            $sticky_logo              = kemet_get_option( 'sticky-logo' );
            $sticky_style             = kemet_get_option( 'sticky-style' );
            $enable_top_bar           = kemet_get_option( 'sticky-top-bar' );
            $kemet_header_layout = apply_filters( 'kemet_primary_header_layout', kemet_get_option( 'header-layouts' ) );
            $sticky_responsive        = kemet_get_option('sticky-responsive');
            if( ($enabled_sticky) && ('header-main-layout-5' != $kemet_header_layout && 'header-main-layout-7' != $kemet_header_layout && 'header-main-layout-6' != $kemet_header_layout)) {
                $classes[] = 'kmt-sticky-header';
                $classes[] =  $sticky_responsive;
                if( $enabled_sticky ) {
                    $classes[] = 'kmt-sticky-header';
                    $classes[] = 'sticky-main-header';
                    $classes[] = $sticky_style;
                    if ( '' !== $sticky_logo ) {
                        $classes[] = 'kmt-sticky-logo';
                    }
                }
                if( ($enabled_sticky) && ('header-main-layout-5' != $kemet_header_layout && 'header-main-layout-7' != $kemet_header_layout && 'header-main-layout-6' != $kemet_header_layout)) {
                    if($enable_top_bar){
                        $classes[] = 'kmt-sticky-top-bar';
                    }
    
                }    

            }
            
            return $classes;
            
        }

        public function add_styles() {

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
            Kemet_Style_Generator::kmt_add_css( KEMET_STICKY_HEADER_DIR.'assets/css/'. $dir  .'/style' . $css_prefix);
        }

        public function add_scripts() {

            $js_prefix  = '.min.js';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix  = '.js';
				$dir        = 'unminified';
			}
            Kemet_Style_Generator::kmt_add_js( KEMET_STICKY_HEADER_DIR.'assets/js/'. $dir  .'/sticky-header' . $js_prefix);
        }
    }
}
Kemet_Sticky_Header_Partials::get_instance();