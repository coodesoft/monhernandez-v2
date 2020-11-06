<?php
/**
 * Sidebar Manager functions
 *
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
 * @link        https://kemet.io/
 * @since       Kemet 1.0.0
 */

/**
 * Site Sidebar
 */
if ( ! function_exists( 'kemet_layout' ) ) {

	/**
	 * Site Sidebar
	 *
	 * Default 'right sidebar' for overall site.
	 */
	function kemet_layout() {

		if ( is_singular() ) {

			// If post meta value isset,
			// Then get the POST_TYPE sidebar.
            $layout= '';
			if( class_exists( 'KFW' ) ) {
                $meta = get_post_meta( get_the_ID(), 'kemet_page_options', true);
                $layout = ( isset( $meta['site-sidebar-layout'] ) && $meta['site-sidebar-layout'] ) ? $meta['site-sidebar-layout'] : '';
            }
			if ( empty( $layout ) ) {

				$post_type = get_post_type();

				if ( 'post' === $post_type || 'page' === $post_type || 'product' === $post_type ) {
					$layout = kemet_get_option( 'single-' . get_post_type() . '-sidebar-layout' );
				}

				if ( 'default' == $layout || empty( $layout ) ) {

					// Get the global sidebar value.
					// NOTE: Here not used `true` in the below function call.
					$layout = kemet_get_option( 'site-sidebar-layout' );
				}
			}
		} else {

			if ( is_search() ) {

				// Check only post type archive option value.
				$layout = kemet_get_option( 'archive-post-sidebar-layout' );

				if ( 'default' == $layout || empty( $layout ) ) {

					// Get the global sidebar value.
					// NOTE: Here not used `true` in the below function call.
					$layout = kemet_get_option( 'site-sidebar-layout' );
				}
			} else {

				$post_type = get_post_type();
				$layout    = '';

				if ( 'post' === $post_type ) {
					$layout = kemet_get_option( 'archive-' . get_post_type() . '-sidebar-layout' );
				}

				if ( 'default' == $layout || empty( $layout ) ) {

					// Get the global sidebar value.
					// NOTE: Here not used `true` in the below function call.
					$layout = kemet_get_option( 'site-sidebar-layout' );
				}
			}
		}

		return apply_filters( 'kemet_layout', $layout );
	}
}
