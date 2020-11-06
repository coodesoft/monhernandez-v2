<?php
/**
 * Kemet Theme Options
 *
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
 * @link        https://kemet.io/
 * @since       Kemet 1.0.0
 */

/**
 * Theme Options
 */
if ( ! class_exists( 'Kemet_Theme_Options' ) ) {
	/**
	 * Theme Options
	 */
	class Kemet_Theme_Options {
		/**
		 * Class instance.
		 *
		 * @access private
		 * @var $instance Class instance.
		 */
		private static $instance;
		/**
		 * Post id.
		 *
		 * @var $instance Post id.
		 */
		public static $post_id = null;
		/**
		 * A static option variable.
		 *
		 * @access private
		 * @var mixed $db_options
		 */
		private static $db_options;
		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {

			// Refresh options variables after customizer save.
			add_action( 'after_setup_theme', array( $this, 'refresh' ) );

		}

		/**
		 * Set default theme option values
		 *
		 * @return default values of the theme.
		 */
		public static function defaults() {
			// Defaults list of options.
			return apply_filters(
				'kemet_theme_defaults', array(
					// Blog Single.
					'blog-single-post-structure'       => array(
						'single-image',
						'single-title-meta',
					),

					'blog-single-width'                => 'default',
					'blog-single-max-width'            => 1200,
					'blog-single-meta'                 => array(
						'comments',
						'category',
						'author',
					),
					// Kemet Blog.
					'blog-post-structure'              => array(
						'image',
						'title-meta',
						'content-readmore',
					),
					'blog-width'                       => 'default',
					'blog-max-width'                   => 1200,
					'blog-post-content'                => 'excerpt',
					'blog-meta'                        => array(
						'comments',
						'category',
						'author',
					),
					'pagination-padding'	=> '',
					'font-color-entry-title'		   => '',
					'listing-post-meta-color'		  => '',
					'font-size-page-meta'			  => '',	
					'listing-post-title-color'		  => '',
					'main-entry-content-color'		  => '',	
					'listing-post-title-hover-color'  => '',
					'post-title-font-family'          => 'inherit',
					'readmore-as-button' => false,		
					'readmore-text-color'		  => '',
					'readmore-text-h-color'		  => '',
					'readmore-padding'		  => array(
					'desktop'      => array(
							'top'    => 10,
							'left'   => 16,
							'right'  => 16,
							'bottom' => 10,
						),
						'tablet'       => array(
							'top'    => '',
							'left'   => '',
							'right'  => '',
							'bottom' => '',
						),
						'mobile'       => array(
							'top'    => '',
							'left'   => '',
							'right'  => '',
							'bottom' => '',
						),
						'desktop-unit' => 'px',
						'tablet-unit'  => 'px',
						'mobile-unit'  => 'px',
					),
					'readmore-bg-color'		  => '',
					'read-more-border-radius'		  => '',
					'read-more-border-size'		  => '',
					'readmore-border-color'		  => '',
					'readmore-border-h-color'		  => '',
					'readmore-bg-h-color'			=> '',
					'letter-spacing-page-title'	=> '',
					'letter-spacing-entry-title'     => '',
					'page-title-font-family'		=> 'inherit',
					// Kemet Colors.
					'smart-skin'				   => '',
					'theme-color'                      => '#0085ba',	
					'headings-links-color'                     => '#333333',
					'text-meta-color'                     => '#444140',
					'global-border-color'		   => '#eaeaea',	
					'global-background-color'                     => '#ffffff',
					'global-footer-text-color'                     => '#fbfbfb',
					'global-footer-bg-color'                     => '#222222',

					// Footer Colors.
					'footer-bar-bg-obj'                    => '',
					'enable-sticky-footer'			   => false,
					'footer-color'                     => '',
					'footer-link-color'                => '',
					'footer-link-h-color'              => '',
					// Footer Widgets.
					'footer-bg-obj'                => '',
					'footer-text-color'            => '',
					'footer-link-color'            => '',
					'footer-widget-meta-color'     => '',
					'footer-wgt-title-color'       => '',
					'footer-button-color'				=> '',
					'footer-button-h-color'				=> '',
					'footer-button-bg-color'			=> '',
					'footer-button-bg-h-color'			=> '',
					'footer-button-radius'				=> '',
					'footer-input-color'				=> '', 
					'footer-input-bg-color'				=> '',
					'footer-input-border-color'			=> '',
					'enable-footer-content-center'       => 0,
					'footer-font-size' 					=> '',
					'footer-widget-padding'   => '',
					'footer-widget-title-font-size'   => '',
					'footer-wgt-title-font-family' => 'inherit',
					'footer-wgt-title-font-weight' => 'inherit',	
					'footer-wgt-title-text-transform' => '',
					'footer-wgt-title-line-height' => '',
					'footer-wgt-bg-color'			=> '',
					'footer-inner-widget-padding'		=> '',
					'footer-wgt-title-separator-color' => '',
					'enable-footer-widget-title-separator'	 => false,
					'footer-widget-title-letter-spacing' => '',
					'footer-letter-spacing' => '',
					// Kemet Buttons & Fields.
					'buttons-font-size'				   => '',	
					'button-color'                     => '#ffffff',
					'button-h-color'                   => '',
					'button-bg-color'                  => '',
					'button-bg-h-color'                => '',
					'btn-border-color'				   => '',	
					'btn-border-size'				   => 0,
					'btn-border-h-color'			   => '',	
					'button-radius'					   => '',
					'button-spacing' 				   => '',
					'input-bg-color'				   => '',
					'input-text-color'				   => '',
					'input-border-color'				   => '',
					'input-radius'				   => '',
					'input-border-size'				   => '',
					'input-border-color'				   => '',
					'input-border-color'				   => '',
					'input-spacing'						   => '',	
					// Main Menu 
					'main-menu-item-spacing'			    => '',
					'main-menu-spacing'			    => '',
					'menu-link-color'						=> '',
					'menu-link-h-color' => '',
					'menu-link-active-color' => '',
					'menu-link-active-bg-color' => '',
					'menu-bg-color'							 => '',
					'menu-items-font-family'                 => 'inherit',
					'menu-items-font-weight'                 => '400',
					'menu-items-line-height'                 => '',
					'menu-items-text-transform'              => '',
					'menu-link-bottom-border-color'              => '',
					'display-responsive-menu-point'			=> 921,
					'sub-menu-animation'					=> 'none',
					'search-style'							=> 'search-icon',
					'search-box-shadow'							=> true,
					'search-btn-bg-color'					=> '',
					'content-padding'						=> array(
					'desktop'      => array(
							'top'    => '',
							'bottom' => '',
						),
						'tablet'       => array(
							'top'    => '',
							'bottom' => '',
						),
						'mobile'       => array(
							'top'    => '',
							'bottom' => '',
						),
						'desktop-unit' => 'px',
						'tablet-unit'  => 'px',
						'mobile-unit'  => 'px',
					),
					'search-btn-h-bg-color'					=> '',
					'search-btn-color'						=> '',
					'search-border-color'					=> '',
					'search-input-bg-color'					=> '',
					'search-input-color'					=> '',
					'search-border-size'					=> 1,
					'menu-letter-spacing'		=> '',	
					// Kemet Footer 
					'copyright-footer-layout'                => 'copyright-footer-layout-1',
					'footer-copyright-section-1'             => 'custom',
					'footer-copyright-section-1-part'      => __( 'Powered by [theme_author] WordPress Theme', 'kemet' ),
					'footer-copyright-section-2'             => '',
					'footer-copyright-section-2-part'      => __( 'Powered by [theme_author] WordPress Theme', 'kemet' ),
					'footer-copyright-dist-equal-align'      => true,
					'footer-copyright-divider'               => 1,
					'footer-bar-padding'					 => '',
					'footer-copyright-divider-color'         => '',
					'footer-layout-width'              => 'content',
					'footer-font-family' => 'inherit',
					'footer-font-weight' => 'inherit',
					'footer-text-transform'	=> '',
					'footer-line-height'   => '',
					'footer-padding'   => '',
					'footer-copyright-letter-spacing' => '',
					'footer-copyright-font-size'	=> '',
					// General.
					'kmt-header-retina-logo'           => '',
					'kmt-header-logo-width'            => '',
					'kmt-header-responsive-logo-width' => '',
					'display-site-title'               => 1,
					'display-site-tagline'             => 0,
					'logo-title-inline'                => 0,
					'tagline-color'				=> '',
					'site-identity-spacing'				=> '',
					// Header 
					'disable-primary-nav'              => false,
					'header-layouts'                   => 'header-main-layout-1',
					'header-main-rt-section'           => array('search'),
					'menu-font-size'				   => '',	 
					'disable-last-menu-items-on-mobile'=> false,
					'header-display-outside-menu'      => true,
					'menu-alignment'				   => '',	
					'last-menu-item-spacing'		   => '',
					'header-right-section-menu'	       => '',
					'header-main-sep'				   => array(
						'desktop'      => 1,
						'tablet'       => '',
						'mobile'       => '',
						'desktop-unit' => 'px',
						'tablet-unit'  => 'px',
						'mobile-unit'  => 'px',
					),
					'header-padding'				   => '',
					'display-submenu-border'           => true,
					'header-bg-obj'                    =>  '',
					'header-right-section'             => 'none',
					'header-logo-position'             => '',

					// Sub Menu 
					'submenu-border-color'			=> '',			
					'submenu-width'					=> '',
					'submenu-link-color'             =>'',
					'sub-menu-items-font-family'                 => 'inherit',
					'sub-menu-items-font-weight'                 => '400',
					'sub-menu-items-line-height'                 => '',
					'sub-menu-items-text-transform'              => '',
					'sub-menu-link-bottom-border-color'              => '',
					'submenu-bg-color'                       =>'',
					'submenu-link-h-color'   =>   '',
					'submenu-top-border-size'   => 1,
					'submenu-top-border-color'   =>'',
					'submenu-font-size'   =>'',
					'submenu-letter-spacing'    => '',
					'submenu-box-shadow'		=> true,
					'sub-menu-item-spacing'	 	=> '',
					// Mobile Menu 
					'mobile-menu-icon-color'      => '',
					'mobile-menu-icon-bg-color'      => '',
					'mobile-menu-icon-h-color'      => '',
					'mobile-menu-icon-bg-h-color'      => '',
					'mobile-menu-items-color'      => '',
					'mobile-menu-items-bg-color'      => '',
					'mobile-menu-items-h-color'      => '',
					'mobile-menu-items-border-size'	=> '',
					'mobile-menu-items-border-color'	=> '',

					//Header Sections
					'header-main-rt-section-html'      => '<button>' . __( 'Contact Us', 'kemet' ) . '</button>',
					'header-main-sep-color'            => '',
					'header-main-menu-label'           => '',
					'header-main-menu-align'           => 'inline',

					// Site Layout.
					'site-content-width'               => 1200,
					'site-layout-outside-bg-obj'       => '',
					// Container.
					'site-title-color'	=> '',
					'site-title-h-color'	=> '',
					'site-content-layout'              => 'plain-container',
					'single-page-content-layout'       => 'default',
					'single-post-content-layout'       => 'default',
					'archive-post-content-layout'      => 'default',
					'site-boxed-inner-bg'			   => '',
					'container-inner-spacing'	=> '',	
					'content-separator-color'	=> '',
					// Typography.
					'body-font-family'                 => 'inherit',
					'body-font-weight'                 => 'inherit',
					'font-size-body'                   => array(
						'desktop'      => 15,
						'tablet'       => '',
						'mobile'       => '',
						'desktop-unit' => 'px',
						'tablet-unit'  => 'px',
						'mobile-unit'  => 'px',
					),

					'body-line-height'                 => '',
					'para-margin-bottom'               => '',
					'body-text-transform'              => '',
					'headings-font-family'             => 'inherit',
					'headings-font-weight'             => 'inherit',
					'headings-text-transform'          => '',
					'font-color-h1'					   => '',
					'font-color-h2'					   => '',
					'font-color-h3'					   => '',
					'font-color-h4'					   => '',
					'font-color-h5'					   => '',
					'font-color-h6'					   => '',
					'site-title-font-size'             => array(
						'desktop'      => 35,
						'tablet'       => '',
						'mobile'       => '',
						'desktop-unit' => 'px',
						'tablet-unit'  => 'px',
						'mobile-unit'  => 'px',
					),
					'font-size-site-tagline'           => array(
						'desktop'      => 15,
						'tablet'       => '',
						'mobile'       => '',
						'desktop-unit' => 'px',
						'tablet-unit'  => 'px',
						'mobile-unit'  => 'px',
					),
					'site-title-letter-spacing'	=> '',
					'tagline-letter-spacing'    => '',
					'font-size-entry-title'            => array(
						'desktop'      => 30,
						'tablet'       => '',
						'mobile'       => '',
						'desktop-unit' => 'px',
						'tablet-unit'  => 'px',
						'mobile-unit'  => 'px',
					),
					'font-size-page-title'             => array(
						'desktop'      => 30,
						'tablet'       => '',
						'mobile'       => '',
						'desktop-unit' => 'px',
						'tablet-unit'  => 'px',
						'mobile-unit'  => 'px',
					),
					'font-size-h1'                     => array(
						'desktop'      => 48,
						'tablet'       => '',
						'mobile'       => '',
						'desktop-unit' => 'px',
						'tablet-unit'  => 'px',
						'mobile-unit'  => 'px',
					),
					'font-size-h2'                     => array(
						'desktop'      => 42,
						'tablet'       => '',
						'mobile'       => '',
						'desktop-unit' => 'px',
						'tablet-unit'  => 'px',
						'mobile-unit'  => 'px',
					),
					'font-size-h3'                     => array(
						'desktop'      => 30,
						'tablet'       => '',
						'mobile'       => '',
						'desktop-unit' => 'px',
						'tablet-unit'  => 'px',
						'mobile-unit'  => 'px',
					),
					'font-size-h4'                     => array(
						'desktop'      => 20,
						'tablet'       => '',
						'mobile'       => '',
						'desktop-unit' => 'px',
						'tablet-unit'  => 'px',
						'mobile-unit'  => 'px',
					),
					'font-size-h5'                     => array(
						'desktop'      => 18,
						'tablet'       => '',
						'mobile'       => '',
						'desktop-unit' => 'px',
						'tablet-unit'  => 'px',
						'mobile-unit'  => 'px',
					),
					'font-size-h6'                     => array(
						'desktop'      => 15,
						'tablet'       => '',
						'mobile'       => '',
						'desktop-unit' => 'px',
						'tablet-unit'  => 'px',
						'mobile-unit'  => 'px',
					),
					'letter-spacing-body'			=> '',
					'letter-spacing-h1'			=> '',
					'letter-spacing-h2'			=> '',
					'letter-spacing-h3'			=> '',
					'letter-spacing-h4'			=> '',
					'letter-spacing-h5'			=> '',
					'letter-spacing-h6'			=> '',
					//Content
					'content-text-color'  => '',
					'content-link-color' => '',
					'content-link-h-color' => '',
					// Sidebar.
					'site-sidebar-layout'              => 'right-sidebar',
					'site-sidebar-width'               => 30,
					'single-page-sidebar-layout'       => 'default',
					'single-post-sidebar-layout'       => 'default',
					'archive-post-sidebar-layout'      => 'default',
					'sidebar-bg-obj'				   =>  '',
					'sidebar-text-color'		=> '',
					'sidebar-link-color'		=> '',
					'sidebar-link-h-color'		=> '',
					'sidebar-padding'			=> '',
					'sidebar-input-border-color' => '',	
					'sidebar-input-color'		=> '',
					'sidebar-input-bg-color'	=> '',
					'sidebar-content-font-size' => '',
					// Sidebar.
					'footer-layout'                       => 'disabled',
					'sidebar-input-border-radius'		=> '',
					'sidebar-input-border-size'			=> '',	

					//Widgets
					'widget-title-font-family' => 'inherit',
					'widget-title-font-weight'	=> 'inherit',
					'widget-title-text-transform'	=> '',
					'widget-title-line-height'	=> '',
					'widget-padding'	=> '',
					'widget-bg-color' => '',
					'widget-margin-bottom'	=> '',
					'widget-title-color'	=> '',
					'widget-title-font-size'	=> '',
					'widget-title-border-size'	=> 1,
					'widget-title-border-color' => '',
					'footer-input-border-radius' => '',
					'footer-input-border-size' => '',
					'enable-widget-title-separator'	=> false,
					'footer-widget-title-border-size' => '1',
					'widget-title-letter-spacing' => '',
				)
			);
		}
		/**
		 * Get theme options from static array()
		 *
		 * @return array    Return array of theme options.
		 */
		public static function get_options() {
			return self::$db_options;
		}
		/**
		 * Update theme static option array.
		 */
		public static function refresh() {
			self::$db_options = wp_parse_args(
				get_option( KEMET_THEME_SETTINGS ),
				self::defaults()
			);
		}
	}
}
/**
 * Kicking this off by calling 'get_instance()' method
 */
Kemet_Theme_Options::get_instance();
