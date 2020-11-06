<?php
/**
 * Single Blog Helper Functions
 *
 * @package Kemet
 */

/**
 * Adds custom classes to the array of body classes.
 */
if ( ! function_exists( 'kemet_single_body_class' ) ) {

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function kemet_single_body_class( $classes ) {

		// Blog layout.
		if ( is_single() ) {
			$classes[] = 'kmt-blog-single-style-1';

			if ( 'post' != get_post_type() ) {
				$classes[] = 'kmt-custom-post-type';
			}
		}

		if ( is_singular() ) {
			$classes[] = 'kmt-single-post';
		}

		return $classes;
	}
}

add_filter( 'body_class', 'kemet_single_body_class' );

/**
 * Adds custom classes to the array of body classes.
 */
if ( ! function_exists( 'kemet_single_post_class' ) ) {

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function kemet_single_post_class( $classes ) {

		// Blog layout.
		if ( is_singular() ) {
			$classes[] = 'kmt-article-single';

			// Remove hentry from page.
			if ( 'page' == get_post_type() ) {
				$classes = array_diff( $classes, array( 'hentry' ) );
			}
		}

		return $classes;
	}
}

add_filter( 'post_class', 'kemet_single_post_class' );

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if ( ! function_exists( 'kemet_single_get_post_meta' ) ) {

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @param boolean $echo   Output print or return.
	 * @return string|void
	 */
	function kemet_single_get_post_meta( $echo = true ) {

		$enable_meta = apply_filters( 'kemet_single_post_meta_enabled', '__return_true' );
		$post_meta   = kemet_get_option( 'blog-single-meta' );

		$output = '';
		if ( is_array( $post_meta ) && 'post' == get_post_type() && $enable_meta ) {

			$output_str = kemet_get_post_meta( $post_meta );
			if ( ! empty( $output_str ) ) {
				$output = apply_filters( 'kemet_single_post_meta', '<div class="entry-meta">' . $output_str . '</div>', $output_str ); // WPCS: XSS OK.
			}
		}
		if ( $echo ) {
			echo wp_kses_post( $output );;
		} else {
			return $output;
		}
	}
}

/**
 * Template for comments and pingbacks.
 */
if ( ! function_exists( 'kemet_comment' ) ) {

	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @param  string $comment Comment.
	 * @param  array  $args    Comment arguments.
	 * @param  number $depth   Depth.
	 * @return mixed          Comment markup.
	 */
	function kemet_comment( $comment, $args, $depth ) {

		switch ( $comment->comment_type ) {

			case 'pingback':
			case 'trackback':
				// Display trackbacks differently than normal comments.
			?>
				<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
					<p><?php esc_html_e( 'Pingback:', 'kemet' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'kemet' ), '<span class="edit-link">', '</span>' ); ?></p>
				</li>
				<?php
				break;

			default:
				// Proceed with normal comments.
				global $post;
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

					<article id="comment-<?php comment_ID(); ?>" class="kmt-comment">
						<div class='kmt-comment-avatar-wrap'><?php echo get_avatar( $comment, 50 ); ?></div><!-- Remove 1px Space
						--><div class="kmt-comment-data-wrap">
							<div class="kmt-comment-meta-wrap">
								<header class="kmt-comment-meta kmt-row kmt-comment-author vcard capitalize">

									<?php

									printf(
										'<div class="kmt-comment-cite-wrap kmt-col-lg-12"><cite><b class="fn">%1$s</b> %2$s</cite></div>',
										get_comment_author_link(),
										// If current post author is also comment author, make it known visually.
										( $comment->user_id === $post->post_author ) ? '<span class="kmt-highlight-text kmt-cmt-post-author"></span>' : ''
									);

									printf(
										'<div class="kmt-comment-time kmt-col-lg-12"><span  class="timendate"><a href="%1$s"><time datetime="%2$s">%3$s</time></a></span></div>',
										esc_url( get_comment_link( $comment->comment_ID ) ),
										esc_html(get_comment_time( 'c' )),
										/* translators: 1: date, 2: time */
										sprintf( esc_html__( '%1$s at %2$s', 'kemet' ), esc_html(get_comment_date() ), esc_html(get_comment_time()) )
									);

									?>

								</header> <!-- .kmt-comment-meta -->
							</div>
							<section class="kmt-comment-content comment">
								<?php comment_text(); ?>
								<div class="kmt-comment-edit-reply-wrap">
									<?php edit_comment_link( kemet_theme_strings( 'string-comment-edit-link', false ), '<span class="kmt-edit-link">', '</span>' ); ?>
									<?php
									comment_reply_link(
										array_merge(
											$args, array(
												'reply_text' => kemet_theme_strings( 'string-comment-reply-link', false ),
												'add_below' => 'comment',
												'depth'  => $depth,
												'max_depth' => $args['max_depth'],
												'before' => '<span class="kmt-reply-link">',
												'after'  => '</span>',
											)
										)
									);
									?>
								</div>
								<?php if ( '0' == $comment->comment_approved ) : ?>
									<p class="kmt-highlight-text comment-awaiting-moderation"><?php echo esc_html( kemet_theme_strings( 'string-comment-awaiting-moderation', false ) ); ?></p>
								<?php endif; ?>
							</section> <!-- .kmt-comment-content -->
						</div>
					</article><!-- #comment-## -->
				<!-- </li> -->
				<?php
				break;
		}
	}
}

/**
 * Get Post Navigation
 */
if ( ! function_exists( 'kemet_single_post_navigation_markup' ) ) {

	/**
	 * Get Post Navigation
	 *
	 * Checks post navigation, if exists return as button.
	 *
	 * @return mixed Post Navigation Buttons
	 */
	function kemet_single_post_navigation_markup() {

		$single_post_navigation_enabled = apply_filters( 'kemet_single_post_navigation_enabled', true );

		if ( is_single() && $single_post_navigation_enabled ) {

			$post_obj = get_post_type_object( get_post_type() );

			$next_text = sprintf(
				kemet_theme_strings( 'string-single-navigation-next', false ),
				$post_obj->labels->singular_name
			);

			$prev_text = sprintf(
				kemet_theme_strings( 'string-single-navigation-previous', false ),
				$post_obj->labels->singular_name
			);
			/**
			 * Filter the post pagination markup
			 */
			the_post_navigation(
				apply_filters(
					'kemet_single_post_navigation', array(
						'next_text' => $next_text,
						'prev_text' => $prev_text,
					)
				)
			);

		}
	}
}

add_action( 'kemet_entry_after', 'kemet_single_post_navigation_markup' );
