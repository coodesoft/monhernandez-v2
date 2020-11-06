<?php
/**
 * Elementor Compatibility File.
 *
 * @package Kemet
 */

namespace Elementor;

// If plugin - 'Elementor' not exist then return.
if ( ! class_exists( '\Elementor\Plugin' ) || ! class_exists( 'ElementorPro\Modules\ThemeBuilder\Module' )  ) {
	return;
}

namespace ElementorPro\Modules\ThemeBuilder\ThemeSupport;

use Elementor\TemplateLibrary\Source_Local;
use ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager;
use ElementorPro\Modules\ThemeBuilder\Module;

/**
 * Kemet Elementor Compatibility
 */
if ( ! class_exists( 'Kemet_Elementor_Pro' ) ) :

	/**
	 * Kemet Elementor Compatibility
	 *
	 * @since 1.0.6
	 */
	class Kemet_Elementor_Pro {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
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
		 * Constructor
		 */
		function __construct() {
            add_action( 'elementor/theme/register_locations', array($this , 'register_elementor_locations') );
            add_action( 'kemet_header', array( $this, 'replace_header' ), 0 );
            add_action( 'kemet_footer', array( $this, 'replace_footer' ), 0 );
            add_filter( 'post_class', array( $this, 'remove_theme_post_class' ), 99 );
            add_action( 'kemet_404_page', array( $this, 'replace_template_part_404' ), 0 );
            add_action( 'kemet_template_parts_content_top', array( $this, 'replace_template_parts' ), 0 );
		}

        /**
         * Registering all core locations.
         */
        function register_elementor_locations( $elementor_theme_manager ) {

            $elementor_theme_manager->register_all_core_location();

        }

        /**
		 * Header Support
		 * @return void
		 */
		public function replace_header() {
			$did_location = Module::instance()->get_locations_manager()->do_location( 'header' );
			if ( $did_location ) {
				remove_action( 'kemet_header', 'kemet_header_markup' );
			}
		}

		/**
		 * Footer Support
		 * @return void
		 */
		public function replace_footer() {
            $did_location = Module::instance()->get_locations_manager()->do_location( 'footer' );
            
			if ( $did_location ) {
				remove_action( 'kemet_footer', 'kemet_footer_markup' );
			}
		}

        /**
		 * Remove theme post's default classes when Elementor's template builder is activated.
		 *
		 * @param  array $classes Post Classes.
		 * @return array
		 */
		public function remove_theme_post_class( $classes ) {
			$post_class = array( 'elementor-post elementor-grid-item', 'elementor-portfolio-item' );
			$result     = array_intersect( $classes, $post_class );

			if ( count( $result ) > 0 ) {
				$classes = array_diff(
					$classes,
					array(
						// Kemet common grid.
						'kmt-col-xs-1',
						'kmt-col-xs-2',
						'kmt-col-xs-3',
						'kmt-col-xs-4',
						'kmt-col-xs-5',
						'kmt-col-xs-6',
						'kmt-col-xs-7',
						'kmt-col-xs-8',
						'kmt-col-xs-9',
						'kmt-col-xs-10',
						'kmt-col-xs-11',
						'kmt-col-xs-12',
						'kmt-col-sm-1',
						'kmt-col-sm-2',
						'kmt-col-sm-3',
						'kmt-col-sm-4',
						'kmt-col-sm-5',
						'kmt-col-sm-6',
						'kmt-col-sm-7',
						'kmt-col-sm-8',
						'kmt-col-sm-9',
						'kmt-col-sm-10',
						'kmt-col-sm-11',
						'kmt-col-sm-12',
						'kmt-col-md-1',
						'kmt-col-md-2',
						'kmt-col-md-3',
						'kmt-col-md-4',
						'kmt-col-md-5',
						'kmt-col-md-6',
						'kmt-col-md-7',
						'kmt-col-md-8',
						'kmt-col-md-9',
						'kmt-col-md-10',
						'kmt-col-md-11',
						'kmt-col-md-12',
						'kmt-col-lg-1',
						'kmt-col-lg-2',
						'kmt-col-lg-3',
						'kmt-col-lg-4',
						'kmt-col-lg-5',
						'kmt-col-lg-6',
						'kmt-col-lg-7',
						'kmt-col-lg-8',
						'kmt-col-lg-9',
						'kmt-col-lg-10',
						'kmt-col-lg-11',
						'kmt-col-lg-12',
						'kmt-col-xl-1',
						'kmt-col-xl-2',
						'kmt-col-xl-3',
						'kmt-col-xl-4',
						'kmt-col-xl-5',
						'kmt-col-xl-6',
						'kmt-col-xl-7',
						'kmt-col-xl-8',
						'kmt-col-xl-9',
						'kmt-col-xl-10',
						'kmt-col-xl-11',
                        'kmt-col-xl-12',
                        // Kemet Blog / Single Post.
						'kmt-article-post',
						'kmt-article-single',
                    )
				);
			}

			return $classes;
        }

        /**
		 * Override 404 page
		 *
		 * @return void
		 */
		public function replace_template_part_404() {
			if ( is_404() ) {

				// Is Single?
				$did_location = Module::instance()->get_locations_manager()->do_location( 'single' );
				if ( $did_location ) {
					remove_action( 'kemet_404_page', 'kemet_404_page_template' );
				}
			}
        }
        /**
		 * Template Parts Support
		 * @return void
		 */
		public function replace_template_parts() {
			// Is Archive?
			$did_location = Module::instance()->get_locations_manager()->do_location( 'archive' );
			
			if ( $did_location ) {
				// Search and default.
				remove_action( 'kemet_template_parts_content', array( \Kemet_Loop::get_instance(), 'template_parts_search' ) );
				remove_action( 'kemet_template_parts_content', array( \Kemet_Loop::get_instance(), 'template_parts_default' ) );

				// Remove pagination.
				remove_action( 'kemet_pagination', 'kemet_number_pagination' );
				remove_action( 'kemet_entry_after', 'kemet_single_post_navigation_markup' );

				// Content.
				remove_action( 'kemet_entry_content_single', 'kemet_entry_content_single_template' );
			}

			// IS Single?
			$did_location = Module::instance()->get_locations_manager()->do_location( 'single' );
			
			if ( $did_location ) {
                
				remove_action( 'kemet_page_template_parts_content', array( \Kemet_Loop::get_instance(), 'template_parts_comments' ), 15 );
				remove_action( 'kemet_page_template_parts_content', array( \Kemet_Loop::get_instance(), 'template_parts_page' ) );
				remove_action( 'kemet_template_parts_content', array( \Kemet_Loop::get_instance(), 'template_parts_post' ) );
                remove_action( 'kemet_template_parts_content', array( \Kemet_Loop::get_instance(), 'template_parts_comments' ), 15 );
            }
        }
	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Kemet_Elementor_Pro::get_instance();
