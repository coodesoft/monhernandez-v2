<?php
/**
 * Top Bar Section - Dynamic CSS
 *
 * @package Kemet Addons
 */

add_filter( 'kemet_dynamic_css', 'kemet_topbar_dynamic_css');

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Kemet Dynamic CSS.
 * @return string
 */
function kemet_topbar_dynamic_css( $dynamic_css ) {
            
            //Top Bar Header
            $global_bg_color      = kemet_get_option( 'global-background-color' );
            $global_border_color      = kemet_get_option( 'global-border-color' );
            $topbar_spacing              = kemet_get_option( 'topbar-padding' );
            $topbar_item_spacing         = kemet_get_option( 'topbar-item-padding' );
            $topbar_bg_color             = kemet_get_option( 'topbar-bg-color' , $global_bg_color);
            $topbar_link_color         = kemet_get_option( 'topbar-link-color' );
			$topbar_link_h_color       = kemet_get_option( 'topbar-link-h-color' );
			$topbar_text_color         = kemet_get_option( 'topbar-text-color' );
			$topbar_border_color       = kemet_get_option( 'topbar-border-color' , $global_border_color);
			$topbar_border_size        = kemet_get_option( 'topbar-border-size' );

			//Top Bar Header SubMenu
			$topbar_submenu_bg_color   = kemet_get_option( 'topbar-submenu-bg-color' );
			$topbar_submenu_items_color   = kemet_get_option( 'topbar-submenu-items-color' );
			$topbar_submenu_items_h_color   = kemet_get_option( 'topbar-submenu-items-h-color' );
            $section1_content_align          = kemet_get_option( 'section1-content-align' );
            $section2_content_align          = kemet_get_option( 'section2-content-align' );
            $top_bar_direction              = is_rtl() ? 'row-reverse' : 'row'; 
            $topbar_font_size                    = kemet_get_option( 'topbar-font-size' );
            $topbar_font_family                    = kemet_get_option( 'top-bar-font-family' );
            $topbar_font_weight                    = kemet_get_option( 'top-bar-font-weight' );
            $topbar_text_transform                    = kemet_get_option( 'top-bar-text-transform' );
            $topbar_line_height                    = kemet_get_option( 'top-bar-line-height' );
            $topbar_letter_spacing                    = kemet_get_option( 'top-bar-letter-spacing' );
            $css_content = array(     
                '.kemet-top-header-section-wrap .kemet-top-header-section-1' => array(
                    'justify-content' => $section1_content_align,
                    'flex-direction' => $top_bar_direction 
                ),
                '.kemet-top-header-section-wrap .kemet-top-header-section-2' => array(
                    'justify-content' => $section2_content_align,
                    'flex-direction' => $top_bar_direction 
                ),
                // Top Bar Header   topbar-bg-color
                '.kemet-top-header'  => array(
                    'padding-top'    => kemet_responsive_spacing( $topbar_spacing, 'top', 'desktop' ),
                    'padding-right'  => kemet_responsive_spacing( $topbar_spacing, 'right', 'desktop' ),
                    'padding-bottom' => kemet_responsive_spacing( $topbar_spacing, 'bottom', 'desktop' ),
                    'padding-left'   => kemet_responsive_spacing( $topbar_spacing, 'left', 'desktop' ),  
                    'background-color' => esc_attr($topbar_bg_color),
                    'border-style' => 'solid',
					'border-color'     => esc_attr( $topbar_border_color),
                    'border-top-width'    => kemet_responsive_spacing( $topbar_border_size, 'top', 'desktop' ),
                    'border-right-width'  => kemet_responsive_spacing( $topbar_border_size, 'right', 'desktop' ),
                    'border-bottom-width' => kemet_responsive_spacing( $topbar_border_size, 'bottom', 'desktop' ),
                    'border-left-width'   => kemet_responsive_spacing( $topbar_border_size, 'left', 'desktop' ), 
                    
                    'font-size'    => kemet_responsive_slider( $topbar_font_size, 'desktop' ),
                    'font-family'    => kemet_get_font_family( $topbar_font_family ),
					'font-weight'     => esc_attr( $topbar_font_weight ),
					'text-transform'  => esc_attr( $topbar_text_transform ),
                    'letter-spacing' => kemet_responsive_slider( $topbar_letter_spacing , 'desktop' ),
                    'line-height' => kemet_responsive_slider( $topbar_line_height , 'desktop' ),
					'color'          => esc_attr($topbar_text_color),
                ),
                '.kemet-top-header a'  => array(
					'color' => esc_attr( $topbar_link_color ),
				),

				'.kemet-top-header a:hover'  => array(
					'color' => esc_attr( $topbar_link_h_color ),
				),
				'.top-navigation ul.sub-menu'  => array(
					'background-color' => esc_attr( $topbar_submenu_bg_color),
				),
				'.top-navigation ul.sub-menu li a'  => array(
					'color' => esc_attr( $topbar_submenu_items_color),
				),
				'.top-navigation ul.sub-menu li:hover a'   => array(
					'color' => esc_attr( $topbar_submenu_items_h_color),
                ),
                '.kemet-top-header-section > div'  => array(
                    'padding-top'    => kemet_responsive_spacing( $topbar_item_spacing, 'top', 'desktop' ),
                    'padding-right'  => kemet_responsive_spacing( $topbar_item_spacing, 'right', 'desktop' ),
                    'padding-bottom' => kemet_responsive_spacing( $topbar_item_spacing, 'bottom', 'desktop' ),
                    'padding-left'   => kemet_responsive_spacing( $topbar_item_spacing, 'left', 'desktop' ),  
                ),
                 
            );

            $parse_css = kemet_parse_css( $css_content );
            
            $css_tablet = array(
                '.kemet-top-header'  => array(
                    'padding-top'    => kemet_responsive_spacing( $topbar_spacing, 'top', 'tablet' ),
                    'padding-right'  => kemet_responsive_spacing( $topbar_spacing, 'right', 'tablet' ),
                    'padding-bottom' => kemet_responsive_spacing( $topbar_spacing, 'bottom', 'tablet' ),
                    'padding-left'   => kemet_responsive_spacing( $topbar_spacing, 'left', 'tablet' ),  
                    'font-size'    => kemet_responsive_slider( $topbar_font_size, 'tablet' ),
                    'letter-spacing' => kemet_responsive_slider( $topbar_letter_spacing , 'tablet' ),
                    'line-height' => kemet_responsive_slider( $topbar_line_height , 'tablet' ),
                ),
                '.kemet-top-header-section > div'  => array(
                    'padding-top'    => kemet_responsive_spacing( $topbar_item_spacing, 'top', 'tablet' ),
                    'padding-right'  => kemet_responsive_spacing( $topbar_item_spacing, 'right', 'tablet' ),
                    'padding-bottom' => kemet_responsive_spacing( $topbar_item_spacing, 'bottom', 'tablet' ),
                    'padding-left'   => kemet_responsive_spacing( $topbar_item_spacing, 'left', 'tablet' ),  
                ),
             );
           $parse_css .= kemet_parse_css( $css_tablet, '', '768' );
            
            $css_mobile = array(
                '.kemet-top-header'  => array(
                    'padding-top'    => kemet_responsive_spacing( $topbar_spacing, 'top', 'mobile' ),
                    'padding-right'  => kemet_responsive_spacing( $topbar_spacing, 'right', 'mobile' ),
                    'padding-bottom' => kemet_responsive_spacing( $topbar_spacing, 'bottom', 'mobile' ),
                    'padding-left'   => kemet_responsive_spacing( $topbar_spacing, 'left', 'mobile' ),
                    'font-size'    => kemet_responsive_slider( $topbar_font_size, 'mobile' ),
                    'letter-spacing' => kemet_responsive_slider( $topbar_letter_spacing , 'tablet' ),
                    'line-height' => kemet_responsive_slider( $topbar_line_height , 'tablet' ),
                ),
                '.kemet-top-header-section > div'  => array(
                    'padding-top'    => kemet_responsive_spacing( $topbar_item_spacing, 'top', 'mobile' ),
                    'padding-right'  => kemet_responsive_spacing( $topbar_item_spacing, 'right', 'mobile' ),
                    'padding-bottom' => kemet_responsive_spacing( $topbar_item_spacing, 'bottom', 'mobile' ),
                    'padding-left'   => kemet_responsive_spacing( $topbar_item_spacing, 'left', 'mobile' ),  
                ),
             );
           $parse_css .= kemet_parse_css( $css_mobile, '', '544' );
            
            return $dynamic_css . $parse_css;
}