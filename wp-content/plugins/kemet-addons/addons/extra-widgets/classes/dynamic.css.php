<?php
/**
 * Extra Widgets - Dynamic CSS
 * 
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_ext_widgets_dynamic_css');

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css
 * @return string
 */

function kemet_ext_widgets_dynamic_css( $dynamic_css ) {
            //Global Colors
            $global_bg_color      = kemet_get_option( 'global-background-color' );
            $global_border_color      = kemet_get_option( 'global-border-color' );
            $global_footer_text_color      = kemet_get_option( 'global-footer-text-color' );
			$global_footer_bg_color      = kemet_get_option( 'global-footer-bg-color' );
            //Widget Styles Colors
            $widget_bg_color         = kemet_get_option( 'widget-style-bg-color' ,  kemet_color_brightness($global_bg_color , 0.94 , 'dark') );
            $widget_border_color         = kemet_get_option( 'widget-border-color' , $global_border_color );
            //Footer Widget Styles Colors
            $footer_widget_bg_color         = kemet_get_option( 'footer-widget-title-bg-color' , kemet_color_brightness($global_footer_bg_color , 0.8 , 'dark') );
            $footer_widget_border_color         = kemet_get_option( 'footer-widget-border-color' , kemet_color_brightness($global_footer_text_color , 0.4 , 'dark'));

            $css_content = array(
                //Widget Styles Css     
                '.kmt-widget-style3 .widget-content,.kmt-widget-style6 div.title .widget-title,.kmt-widget-style6 div.title .widget-title:before, .kmt-widget-style8 .widget-title' => array(
					'border-bottom-color' => esc_attr( $widget_border_color ),
                ),
                '.kmt-widget-style3 .widget-content , .kmt-widget-style5.widget' => array(
					'border-color' => esc_attr( $widget_border_color ),
                ),
                '.kmt-widget-style7 div.title .widget-title:after' => array(
                    'background-color' => esc_attr( $widget_border_color ),
                ),
				'.kmt-widget-style2 .widget-title ,.kmt-widget-style4 .widget-head' => array(
					'background-color' => esc_attr( $widget_bg_color ),
                ),
                //Footer Widget Styles Css
                '.kemet-footer .kmt-widget-style3 .widget-content,.kemet-footer .kmt-widget-style6 div.title .widget-title,.kemet-footer .kmt-widget-style6 div.title .widget-title:before  ,.kmt-footer-copyright .kmt-widget-style3 .widget-content,.kmt-footer-copyright .kmt-widget-style6 div.title .widget-title,.kmt-footer-copyright .kmt-widget-style6 div.title .widget-title:before' => array(
					'border-bottom-color' => esc_attr( $footer_widget_border_color ),
                ),
                '.kemet-footer .kmt-widget-style3 .widget-content ,.kemet-footer .kmt-widget-style5.widget , .kmt-footer-copyright .kmt-widget-style3 .widget-content ,.kmt-footer-copyright .kmt-widget-style5.widget' => array(
					'border-color' => esc_attr( $footer_widget_border_color ),
                ),
                '.kemet-footer .kmt-widget-style7 div.title .widget-title:after ,.kmt-footer-copyright .kmt-widget-style7 div.title .widget-title:after ' => array(
                    'background-color' => esc_attr( $footer_widget_border_color ),
                ),
				'.kemet-footer .kmt-widget-style2 .widget-title ,.kemet-footer .kmt-widget-style4 .widget-head ,  .kmt-footer-copyright .kmt-widget-style2 .widget-title ,.kmt-footer-copyright .kmt-widget-style4 .widget-head ' => array(
					'background-color' => esc_attr( $footer_widget_bg_color ),
                ),
                '.kfw-widget-posts-list .kmt-wdg-posts-list li' => array(
					'border-bottom-color' => esc_attr( $global_border_color ),
                ),
                '.kfw-widget-tags .post-tags .label' => array(
					'border-color' => esc_attr( $global_border_color ),
                ),
                '.wgt-img img' => array(
					'border-color' => esc_attr( $global_border_color ),
                ),
            );

            $parse_css = kemet_parse_css( $css_content );
                        
            return $dynamic_css . $parse_css;
}