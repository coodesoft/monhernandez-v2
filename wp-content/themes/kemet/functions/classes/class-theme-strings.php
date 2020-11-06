<?php
/**
 * Kemet Theme Strings
 *
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
 * @link        https://kemet.io/
 * @since       Kemet 1.0.0
 */

/**
 * Default Strings
 */
if ( ! function_exists( 'kemet_theme_strings' ) ) {

	/**
	 * Default Strings
	 *
	 * @since 1.0.0
	 * @param  string  $key  String key.
	 * @param  boolean $echo Print string.
	 * @return mixed        Return string or nothing.
	 */
	function kemet_theme_strings( $key, $echo = true ) {

		$defaults = apply_filters(
			'kemet_theme_strings', array(

				// Header.
				'string-header-skip-link'                => __( 'Skip to content', 'kemet' ),

				// 404 Page Strings.
				'string-404-title'                   => __( 'Oops! Looks Like You Got Lost', 'kemet' ),

				// Search Page Strings.
				'string-search-nothing-found'            => __( 'Nothing Found', 'kemet' ),
				'string-search-nothing-found-message'    => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'kemet' ),
				'string-full-width-search-message'       => __( 'Start typing and press enter to search', 'kemet' ),
				'string-full-width-search-placeholder'   => __( 'Start Typing&hellip;', 'kemet' ),
				'string-header-cover-search-placeholder' => __( 'Start Typing&hellip;', 'kemet' ),
				'string-search-input-placeholder'        => __( 'Search &hellip;', 'kemet' ),

				// Comment Template Strings.
				'string-comment-reply-link'              => __( 'Reply', 'kemet' ),
				'string-comment-edit-link'               => __( 'Edit', 'kemet' ),
				'string-comment-awaiting-moderation'     => __( 'Your comment is awaiting moderation.', 'kemet' ),
				'string-comment-title-reply'             => __( 'Leave a Comment', 'kemet' ),
				'string-comment-cancel-reply-link'       => __( 'Cancel Reply', 'kemet' ),
				'string-comment-label-submit'            => __( 'Post Comment &raquo;', 'kemet' ),
				'string-comment-label-message'           => __( 'Write your Comment here..', 'kemet' ),
				'string-comment-label-name'              => __( 'Name*', 'kemet' ),
				'string-comment-label-email'             => __( 'Email*', 'kemet' ),
				'string-comment-label-website'           => __( 'Website', 'kemet' ),
				'string-comment-closed'                  => __( 'Comments are closed.', 'kemet' ),
				'string-comment-navigation-title'        => __( 'Comment navigation', 'kemet' ),
				'string-comment-navigation-next'         => __( 'Newer Comments', 'kemet' ),
				'string-comment-navigation-previous'     => __( 'Older Comments', 'kemet' ),

				// Blog Default Strings.
				'string-blog-page-links-before'          => __( 'Pages:', 'kemet' ),
				'string-blog-meta-leave-a-comment'       => __( 'Leave a Comment', 'kemet' ),
				'string-blog-meta-one-comment'           => __( '1 Comment', 'kemet' ),
				'string-blog-meta-multiple-comment'      => __( '% Comments', 'kemet' ),
				'string-blog-navigation-next'            => __( 'Next >', 'kemet' ),
				'string-blog-navigation-previous'        =>  __( '< Previous', 'kemet' ),

				// Single Post Default Strings.
				'string-single-page-links-before'        => __( 'Pages:', 'kemet' ),
				/* translators: 1: Post type label */
				'string-single-navigation-next'          => __( 'Next %s >', 'kemet' ),
				/* translators: 1: Post type label */
				'string-single-navigation-previous'      => __( '< Previous %s', 'kemet' ),

				// Content None.
				'string-content-nothing-found-message'   => __( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'kemet' ),

			)
		);

		if ( is_rtl() ) {
			$defaults['string-blog-navigation-next']     = __( 'Next >', 'kemet' );
			$defaults['string-blog-navigation-previous'] = __( '< Previous', 'kemet' );

			/* translators: 1: Post type label */
			$defaults['string-single-navigation-next'] = __( 'Next %s >', 'kemet' );
			/* translators: 1: Post type label */
			$defaults['string-single-navigation-previous'] = __( '< Previous %s', 'kemet' );
		}

		$output = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';

		/**
		 * Print or return
		 */
		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}
	}
}
