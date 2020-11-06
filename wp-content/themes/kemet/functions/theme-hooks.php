<?php
/**
 * Theme Hook Alliance hook stub list.
 *
 * @see  https://github.com/zamoose/themehookalliance
 *
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
 * @link        https://kemet.io/
 * @since       Kemet 1.0.0
 */

/**
 *
 * Example:
 * <code>
 *      // Declare support for all hook types
 *      add_theme_support( 'kemet_hooks', array( 'all' ) );
 *
 *      // Declare support for certain hook types only
 *      add_theme_support( 'kemet_hooks', array( 'header', 'content', 'footer' ) );
 * </code>
 */
add_theme_support(
	'kemet_hooks', array(

		/**
		 * As a Theme developer, use the 'all' parameter, to declare support for all
		 * hook types.
		 * Please make sure you then actually reference all the hooks in this file,
		 * Plugin developers depend on it!
		 */
		'all',

		/**
		 * Themes can also choose to only support certain hook types.
		 * Please make sure you then actually reference all the hooks in this type
		 * family.
		 *
		 * When the 'all' parameter was set, specific hook types do not need to be
		 * added explicitly.
		 */
		'html',
		'body',
		'head',
		'header',
		'content',
		'entry',
		'comments',
		'sidebars',
		'sidebar',
		'footer',

	/**
	 * If/when WordPress Core implements similar methodology, Themes and Plugins
	 * will be able to check whether the version of THA supplied by the theme
	 * supports Core hooks.
	 */
	)
);

/**
 * Determines, whether the specific hook type is actually supported.
 *
 * Plugin developers should always check for the support of a <strong>specific</strong>
 * hook type before hooking a callback function to a hook of this type.
 *
 * Example:
 * <code>
 *      if ( current_theme_supports( 'kemet_hooks', 'header' ) )
 *          add_action( 'kemet_head_top', 'prefix_header_top' );
 * </code>
 *
 * @param bool  $bool true.
 * @param array $args The hook type being checked.
 * @param array $registered All registered hook types.
 *
 * @return bool
 */
function kemet_current_theme_supports( $bool, $args, $registered ) {
	return in_array( $args[0], $registered[0] ) || in_array( 'all', $registered[0] );
}
add_filter( 'current_theme_supports-kemet_hooks', 'kemet_current_theme_supports', 10, 3 );

/**
 * HTML <head> hooks
 *
 * $kemet_supports[] = 'head';
 */
function kemet_head_top() {
	do_action( 'kemet_head_top' );
}

/**
 * Site Header
 */
function kemet_header() {
	do_action( 'kemet_header' );
}

/**
 * After Header
 */
function kemet_after_header_block() {
	do_action( 'kemet_after_header_block' );
}

/**
 * Before Header
 */
function kemet_before_header_block() {
	do_action( 'kemet_before_header_block' );
}
 
/**
 * sitehead Top
 */
function kemet_sitehead_top() {
	do_action( 'kemet_sitehead_top' );
}

/**
 * sitehead
 */
function kemet_sitehead() {
	do_action( 'kemet_sitehead' );
}

/**
 * sitehead Bottom
 */
function kemet_sitehead_bottom() {
	do_action( 'kemet_sitehead_bottom' );
}

/**
 * Main Header bar top
 */
function kemet_main_header_bar_top() {
	do_action( 'kemet_main_header_bar_top' );
}

/**
 * Main Header bar bottom
 */
function kemet_main_header_bar_bottom() {
	do_action( 'kemet_main_header_bar_bottom' );
}

/**
 * Main Header Content
 */
function kemet_sitehead_content() {
	do_action( 'kemet_sitehead_content' );
}
/**
 * Main toggle button before
 */
function kemet_sitehead_toggle_buttons_before() {
	do_action( 'kemet_sitehead_toggle_buttons_before' );
}

/**
 * Main toggle buttons
 */
function kemet_sitehead_toggle_buttons() {
	do_action( 'kemet_sitehead_toggle_buttons' );
}

/**
 * Main toggle button after
 */
function kemet_sitehead_toggle_buttons_after() {
	do_action( 'kemet_sitehead_toggle_buttons_after' );
}


/**
 * Content while before
 */
function kemet_content_while_before() {
	do_action( 'kemet_content_while_before' );
}

/**
 * Content loop
 */
function kemet_content_loop() {
	do_action( 'kemet_content_loop' );
}

/**
 * Conten Page Loop.
 *
 * Called from page.php
 */
function kemet_content_page_loop() {
	do_action( 'kemet_content_page_loop' );
}

/**
 * Content while after
 */
function kemet_content_while_after() {
	do_action( 'kemet_content_while_after' );
}

/**
 * Semantic <entry> hooks
 *
 * $kemet_supports[] = 'entry';
 */
function kemet_entry_before() {
	do_action( 'kemet_entry_before' );
}

/**
 * Entry after
 */
function kemet_entry_after() {
	do_action( 'kemet_entry_after' );
}

/**
 * Entry content before
 */
function kemet_entry_content_before() {
	do_action( 'kemet_entry_content_before' );
}

/**
 * Entry content after
 */
function kemet_entry_content_after() {
	do_action( 'kemet_entry_content_after' );
}

/**
 * Entry Top
 */
function kemet_entry_top() {
	do_action( 'kemet_entry_top' );
}

/**
 * Entry bottom
 */
function kemet_entry_bottom() {
	do_action( 'kemet_entry_bottom' );
}

/**
 * Single Post Header Before
 */
function kemet_single_header_before() {
	do_action( 'kemet_single_header_before' );
}

/**
 * Single Post Header After
 */
function kemet_single_header_after() {
	do_action( 'kemet_single_header_after' );
}

/**
 * Single Post Header Top
 */
function kemet_single_header_top() {
	do_action( 'kemet_single_header_top' );
}

/**
 * Single Post Header Bottom
 */
function kemet_single_header_bottom() {
	do_action( 'kemet_single_header_bottom' );
}

/**
 * Entry content blog
 */
function kemet_entry_content_blog() {
	do_action( 'kemet_entry_content_blog' );
}

/**
 * Blog featured post section
 */
function kemet_blog_post_featured_format() {
	do_action( 'kemet_blog_post_featured_format' );
}

/**
 * Semantic <sidebar> hooks
 *
 * $kemet_supports[] = 'sidebar';
 */
function kemet_sidebars_before() {
	do_action( 'kemet_sidebars_before' );
}

/**
 * Semantic <footer> hooks
 *
 * $kemet_supports[] = 'footer';
 */
function kemet_footer() {
	do_action( 'kemet_footer' );
}

/**
 * Footer top
 */
function kemet_footer_content_top() {
	do_action( 'kemet_footer_content_top' );
}

/**
 * Footer
 */
function kemet_footer_content() {
	do_action( 'kemet_footer_content' );
}

/**
 * Footer bottom
 */
function kemet_footer_content_bottom() {
	do_action( 'kemet_footer_content_bottom' );
}

/**
 * Archive header
 */
function kemet_archive_top_info() {
	do_action( 'kemet_archive_top_info' );
}

/**
 * Pagination
 */
function kemet_pagination() {
	do_action( 'kemet_pagination' );
}

/**
 * Entry content single
 */
function kemet_entry_content_single() {
	do_action( 'kemet_entry_content_single' );
}

/**
 * 404
 */
function kemet_404_page() {
	do_action( 'kemet_404_page' );
}

/**
 * 404 Page content template action.
 */
function kemet_404_content_template() {
	do_action( 'kemet_404_content_template' );
}
/**
 * Body Bottom
 */
function kemet_body_bottom() {
	do_action( 'kemet_body_bottom' );
}
/**
 *  Backward compatibility
 */
if ( ! function_exists( 'wp_body_open' ) ) {

	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}