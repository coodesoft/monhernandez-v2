<?php
/**
 * Woocommerce - Dynamic CSS
 * 
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_woocommerce_dynamic_css');

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css
 * @return string
 */
function kemet_woocommerce_dynamic_css( $dynamic_css ) {
            //Global
            $global_border_color      = kemet_get_option( 'global-border-color' );
            $theme_color  = kemet_get_option( 'theme-color' );
            $btn_color = kemet_get_option( 'button-color' );
			$btn_h_color = kemet_get_option( 'button-h-color' , $btn_color );
			$btn_bg_color   = kemet_get_option( 'button-bg-color' , $theme_color);
            $btn_bg_h_color = kemet_get_option( 'button-bg-h-color' , kemet_color_brightness($theme_color , 0.8 , 'dark') );
            $global_bg_color      = kemet_get_option( 'global-background-color' );
            $input_bg_color = kemet_get_option( 'input-bg-color' , kemet_color_brightness($global_bg_color , 0.99 , 'dark'));

            //Shop
            $sale_style      = kemet_get_option( 'sale-style' );
            $loader_color    = kemet_get_option('infinite-scroll-loader-color' , $theme_color);
            
            //Single Product
            $image_width = !empty( kemet_get_option('product-image-width') ) ? kemet_get_option('product-image-width') : 50;

            $css_content = array(
                '.woocommerce .product .onsale' => array(
                    'border-radius' => esc_attr( $sale_style ),
                ),
                '.woocommerce #content .kmt-woocommerce-container div.product div.images,.woocommerce .kmt-woocommerce-container div.product div.images' => array(
                    'width' => kemet_get_css_value( $image_width , '%' ),
                    'max-width' => kemet_get_css_value( $image_width , '%' ),
                ),
                '.woocommerce #content .kmt-woocommerce-container div.product div.summary,.woocommerce .kmt-woocommerce-container div.product div.summary' => array(
                    'width' => kemet_get_css_value( ( 100 - $image_width ) - 3 , '%' ),
                    'max-width' => kemet_get_css_value( ( 100 - $image_width ) - 3  , '%' ),
                ),
                '.woocommerce .kmt-toolbar' => array(
                    'border-top-color' => esc_attr( $global_border_color ),
                    'border-bottom-color' => esc_attr( $global_border_color ),
                ),
                '.woocommerce .kmt-toolbar .shop-list-style a' => array(
                    'border-color' => esc_attr( $global_border_color ),
                ),
                '.woocommerce .kmt-toolbar .shop-list-style a:hover , .woocommerce .kmt-toolbar .shop-list-style a.active' => array(
                    'border-color' => esc_attr( $theme_color ),
                    'color' => esc_attr( $theme_color ),
                ),
                '.hover-style ul.products li.product .kemet-shop-thumbnail-wrap .product-top .product-btn-group .woo-wishlist-btn , .shop-list ul.products li.product .kemet-shop-thumbnail-wrap .woo-wishlist-btn' => array(
                    'background-color' => esc_attr( $btn_bg_color ),
                    'color' => esc_attr( $btn_color ),
                ),
                '.shop-list ul.products li.product .kemet-shop-thumbnail-wrap .woo-wishlist-btn a' => array(
                    'color' => esc_attr( $btn_color ),
                ),
                '.shop-list ul.products li.product .kemet-shop-thumbnail-wrap .woo-wishlist-btn:hover a' => array(
                    'color' => esc_attr( $btn_h_color ),
                ),
                '.hover-style ul.products li.product .kemet-shop-thumbnail-wrap .product-top .product-btn-group .woo-wishlist-btn:hover , .shop-list ul.products li.product .kemet-shop-thumbnail-wrap .woo-wishlist-btn:hover' => array(
                    'background-color' => esc_attr( $btn_bg_h_color ),
                    'color' => esc_attr( $btn_h_color ),
                ),
                '.woocommerce .product-list-img a.kmt-qv-on-image ,.woocommerce .product-list-details a.kmt-qv-on-image ,.add-to-cart-group .added_to_cart' => array(
                    'background-color' => esc_attr( $btn_bg_color ),
                    'color' => esc_attr( $btn_color ),
                ),
                '.woocommerce .product-list-img a.kmt-qv-on-image:hover ,.woocommerce .product-list-details a.kmt-qv-on-image:hover , .add-to-cart-group .added_to_cart:hover' => array(
                    'background-color' => esc_attr( $btn_bg_h_color ),
                    'color' => esc_attr( $btn_h_color ),
                ),
                '.kmt-infinite-scroll-loader .kmt-infinite-scroll-dots .kmt-loader' => array(
                    'background-color' => esc_attr( $loader_color ),
                ),
                'a.plus, a.minus' => array(
                    'border-color' => esc_attr( $global_border_color ),
                    'background-color' => esc_attr( $input_bg_color ),
                ),
            );

            $parse_css = kemet_parse_css( $css_content );
            
            // $css_tablet = array(
            //  );
            // $parse_css .= kemet_parse_css( $css_tablet, '', '768' );
            
            // $css_mobile = array(
            //  );
            // $parse_css .= kemet_parse_css( $css_mobile, '', '544' );
            
            return $dynamic_css . $parse_css;
}