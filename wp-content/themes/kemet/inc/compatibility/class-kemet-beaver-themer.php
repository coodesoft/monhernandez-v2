<?php
/**
 * Beaver Themer Compatibility File.
 *
 * @package Kemet
 */

// If plugin - 'Beaver Builder' not exist then return.
if ( ! class_exists( 'FLThemeBuilderLoader' ) || ! class_exists( 'FLThemeBuilderLayoutData' ) ) {
	return;
}

/**
 * Kemet Beaver Themer Compatibility
 */
if ( ! class_exists( 'Kemet_Beaver_Themer' ) ) :

	/**
	 * Kemet Beaver Themer Compatibility
	 *
	 * @since 1.0.6
	 */
	class Kemet_Beaver_Themer {

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
            add_action( 'after_setup_theme', array( $this, 'header_footer_support' ) );
            add_action( 'wp', array( $this, 'replace_theme_header_footer' ) );
            add_filter( 'post_class', array( $this, 'remove_theme_post_class' ), 99 );
            add_action( 'fl_theme_builder_before_render_content', array( $this, 'before_content' ), 10, 1 );
			add_action( 'fl_theme_builder_after_render_content', array( $this, 'after_content' ), 10, 1 );
        }

        /**
		 * Function to add Theme Support
		 *
		 */
		public function header_footer_support() {

			add_theme_support( 'fl-theme-builder-headers' );
			add_theme_support( 'fl-theme-builder-footers' );
			add_theme_support( 'fl-theme-builder-parts' );
        }
        
        
		/**
		 * Function to update Kemet header/footer with Beaver template
		 *
		 */
		public function replace_theme_header_footer() {

			// Get the header ID.
			$header_ids = FLThemeBuilderLayoutData::get_current_page_header_ids();

			// If we have a header, remove the theme header and hook in Theme Builder's.
			if ( ! empty( $header_ids ) ) {
				remove_action( 'kemet_header', 'kemet_header_markup' );
				add_action( 'kemet_header', 'FLThemeBuilderLayoutRenderer::render_header' );
			}

			// Get the footer ID.
			$footer_ids = FLThemeBuilderLayoutData::get_current_page_footer_ids();

			// If we have a footer, remove the theme footer and hook in Theme Builder's.
			if ( ! empty( $footer_ids ) ) {
				remove_action( 'kemet_footer', 'kemet_footer_markup' );
				add_action( 'kemet_footer', 'FLThemeBuilderLayoutRenderer::render_footer' );
			}

        }
        
        /**
		 * Remove theme post's default classes when Beaver Themer template builder is activated.
		 *
		 * @param  array $classes Post Classes.
		 * @return array
		 */
		public function remove_theme_post_class( $classes ) {
			$post_class = array( 'fl-post-grid-post', 'fl-post-gallery-post', 'fl-post-feed-post' );
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
		 * Function to theme before render content
		 *
		 * @param int $post_id Post ID.
		 */
		public function before_content( $post_id ) {

			?>
			<?php if ( 'left-sidebar' === kemet_layout() ) : ?>

				<?php get_sidebar(); ?>

			<?php endif ?>

			<div id="primary" <?php kemet_content_class(); ?>>
			<?php
		}

		/**
		 * Function to theme after render content
		 *
		 * @param int $post_id Post ID.
		 */
		public function after_content( $post_id ) {

			?>
			</div><!-- #primary -->

			<?php if ( 'right-sidebar' === kemet_layout() ) : ?>

				<?php get_sidebar(); ?>

			<?php endif ?>

			<?php
		}
	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Kemet_Beaver_Themer::get_instance();
