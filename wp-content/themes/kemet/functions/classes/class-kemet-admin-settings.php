<?php
/**
 * Admin settings helper
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
 * @link        https://kemet.io/
 * @since       Kemet 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kemet_Admin_Settings' ) ) {

	/**
	 * Kemet Admin Settings
	 */
	class Kemet_Admin_Settings {

		/**
		 * View all actions
		 *
		 * @var array $view_actions
		 */
		static public $view_actions = array();

		/**
		 * Menu page title
		 *
		 * @var array $menu_page_title
		 */
		static public $menu_page_title = 'Kemet Theme';

		/**
		 * Page title
		 *
		 * @var array $page_title
		 */
		static public $page_title = 'Kemet';

		/**
		 * Plugin slug
		 *
		 * @var array $plugin_slug
		 */
		static public $plugin_slug = 'kemet';

		/**
		 * Constructor
		 */
		function __construct() {

			if ( ! is_admin() ) {
				return;
			}

			add_action( 'after_setup_theme', __CLASS__ . '::init_admin_settings', 99 );
		}

		/**
		 * Admin settings init
		 */
		static public function init_admin_settings() {
			add_action( 'admin_enqueue_scripts', __CLASS__ . '::admin_scripts' );
			add_action( 'customize_controls_enqueue_scripts', __CLASS__ . '::customizer_scripts' );

		}

		/**
		 * Load the scripts and styles in the customizer controls.
		 *
		 */
		static public function customizer_scripts() {
			$color_palettes = json_encode( kemet_color_palette() );
			wp_add_inline_script( 'wp-color-picker', 'jQuery.wp.wpColorPicker.prototype.options.palettes = ' . $color_palettes . ';' );
		}

		/**
		 * Enqueues the needed CSS/JS for Backend.
		 *
		 */
		static public function admin_scripts() {

			/* Directory and Extension */
			$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';
			$dir_name    = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';

			$assets_js_uri = KEMET_THEME_URI . 'assets/js/' . $dir_name . '/';

			wp_enqueue_script( 'kemet-color-alpha', $assets_js_uri . 'wp-color-picker-alpha' . $file_prefix . '.js', array( 'jquery', 'customize-base', 'wp-color-picker' ), KEMET_THEME_VERSION, true );
		}
	}

	new Kemet_Admin_Settings;
}
