<?php
/**
 * Blog Helper Functions
 *
 * @package Kemet
 */

/**
 * Adds custom classes to the array of body classes.
 */
if ( ! function_exists( 'kemet_blog_body_classes' ) ) {

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function kemet_blog_body_classes( $classes ) {

		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		return $classes;
	}
}

add_filter( 'body_class', 'kemet_blog_body_classes' );

/**
 * Adds custom classes to the array of post grid classes.
 */
if ( ! function_exists( 'kemet_post_class_blog_grid' ) ) {

	/**
	 * Adds custom classes to the array of post grid classes.
	 *
	 * @since 1.0
	 * @param array $classes Classes for the post element.
	 * @return array
	 */
	function kemet_post_class_blog_grid( $classes ) {

		if ( is_archive() || is_home() || is_search() ) {
			$classes[] = 'kmt-col-sm-12';
			$classes[] = 'kmt-article-post';
		}

		return $classes;
	}
}

add_filter( 'post_class', 'kemet_post_class_blog_grid' );

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if ( ! function_exists( 'kemet_blog_get_post_meta' ) ) {

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @return mixed            Markup.
	 */
	function kemet_blog_get_post_meta() {

		$enable_meta = apply_filters( 'kemet_blog_post_meta_enabled', '__return_true' );
		$post_meta   = kemet_get_option( 'blog-meta' );

		if ( 'post' == get_post_type() && is_array( $post_meta ) && $enable_meta ) {

			$output_str = kemet_get_post_meta( $post_meta );

			if ( ! empty( $output_str ) ) {
				echo apply_filters( 'kemet_blog_post_meta', '<div class="entry-meta">' . $output_str . '</div>', $output_str ); // WPCS: XSS OK.
			}
		}
	}
}

/**
 * Featured post meta.
 */
if ( ! function_exists( 'kemet_blog_post_get_featured_item' ) ) {

	/**
	 * To featured image / gallery / audio / video etc. As per the post format.
	 *
	 * @return mixed
	 */
	function kemet_blog_post_get_featured_item() {

		$post_featured_data = '';
		$post_format        = get_post_format();

		if ( has_post_thumbnail() ) {

			$post_featured_data  = '<a href="' . esc_url( get_permalink() ) . '" >';
			$post_featured_data .= get_the_post_thumbnail();
			$post_featured_data .= '</a>';

		} else {

			switch ( $post_format ) {
				case 'image':
					break;

				case 'video':
					$post_featured_data = kemet_get_video_from_post( get_the_ID() );
					break;

				case 'gallery':
					$post_featured_data = get_post_gallery( get_the_ID(), false );
					if ( isset( $post_featured_data['ids'] ) ) {
						$img_ids = explode( ',', $post_featured_data['ids'] );

						$image_alt = get_post_meta( $img_ids[0], '_wp_attachment_image_alt', true );
						$image_url = wp_get_attachment_url( $img_ids[0] );

						if ( isset( $img_ids[0] ) ) {
							$post_featured_data  = '<a href="' . esc_url( get_permalink() ) . '" >';
							$post_featured_data .= '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $image_alt ) . '" >';
							$post_featured_data .= '</a>';
						}
					}
					break;

				case 'audio':
					$post_featured_data = do_shortcode( kemet_get_audios_from_post( get_the_ID() ) );
					break;
			}
		}

		echo $post_featured_data; // WPCS: XSS OK.
	}
}

add_action( 'kemet_blog_post_featured_format', 'kemet_blog_post_get_featured_item' );

/**
 * Single Post Thumbnail / Title & Meta Order
 */
if ( ! function_exists( 'kemet_single_post_thumbnai_and_title_order' ) ) {

	/**
	 * Single post Thubmnail, Title & Blog Meta order
	 *
	 */
	function kemet_single_post_thumbnai_and_title_order() {
		
		$blog_post_thumb_title_order = kemet_get_option( 'blog-single-post-structure' );

		if ( is_array( $blog_post_thumb_title_order ) ) {
			// Append the custom class for second element for single post.
			foreach ( $blog_post_thumb_title_order as $post_thumb_title_order ) {

				switch ( $post_thumb_title_order ) {

					// Blog Post Featured Image.
					case 'single-image':
						do_action( 'kemet_blog_single_featured_image_before' );
						kemet_get_blog_post_thumbnail( 'single' );
						do_action( 'kemet_blog_single_featured_image_after' );
						break;

					// Blog Post Title and Blog Post Meta.
					case 'single-title-meta':
						do_action( 'kemet_blog_single_title_meta_before' );
						kemet_get_single_post_title_meta();
						do_action( 'kemet_blog_single_title_meta_after' );
						break;
				}
			}
		}
	}
}
/**
 * Blog / Single Post Thumbnail
 */
if ( ! function_exists( 'kemet_get_blog_post_thumbnail' ) ) {

	/**
	 * Blog post Thumbnail
	 *
	 * @param string $type Type of post.
	 */
	function kemet_get_blog_post_thumbnail( $type = 'archive' ) {
		if ( 'archive' === $type ) {
			// Blog Post Featured Image.
			kemet_get_post_thumbnail( '<div class="kmt-blog-featured-section post-thumb kmt-col-md-12">', '</div>' );
		} elseif ( 'single' === $type ) {
			// Single Post Featured Image.
			kemet_get_post_thumbnail();
		}
	}
}

/**
 * Blog Post Title & Meta Order
 */
if ( ! function_exists( 'kemet_get_blog_post_title_meta' ) ) {

	/**
	 * Blog post Thumbnail
	 *
	 */
	function kemet_get_blog_post_title_meta() {

		// Blog Post Title and Blog Post Meta.
		do_action( 'kemet_archive_entry_header_before' );
		?>
		<header class="entry-header">
			<?php

				do_action( 'kemet_archive_post_title_before' );
				
				/* translators: 1: Current post link, 2: Current post id */
				kemet_the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>', get_the_id() );

				do_action( 'kemet_archive_post_title_after' );

			?>
			<?php

				do_action( 'kemet_archive_post_meta_before' );

				kemet_blog_get_post_meta();

				do_action( 'kemet_archive_post_meta_after' );

			?>
		</header><!-- .entry-header -->
		<?php

		do_action( 'kemet_archive_entry_header_after' );
	}
}

/**
 * Single Post Title & Meta Order
 */
if ( ! function_exists( 'kemet_get_single_post_title_meta' ) ) {

	/**
	 * Blog post Thumbnail
	 *
     * 	 */
	function kemet_get_single_post_title_meta() {

		// Single Post Title and Single Post Meta.
		do_action( 'kemet_single_post_order_before' );

		?>
		<div class="kmt-single-post-order">
			<?php

			do_action( 'kemet_single_post_title_before' );

			kemet_the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );

			do_action( 'kemet_single_post_title_after' );

			do_action( 'kemet_single_post_meta_before' );

			kemet_single_get_post_meta();

			do_action( 'kemet_single_post_meta_after' );

			?>
		</div>
		<?php

		do_action( 'kemet_single_post_order_after' );
	}
}

/**
 * Get audio files from post content
 */
if ( ! function_exists( 'kemet_get_audios_from_post' ) ) {

	/**
	 * Get audio files from post content
	 *
	 * @param  number $post_id Post id.
	 * @return mixed          Iframe.
	 */
	function kemet_get_audios_from_post( $post_id ) {

		// for audio post type - grab.
		$post    = get_post( $post_id );
		$content = do_shortcode( apply_filters( 'the_content', $post->post_content ) );
		$embeds  = apply_filters( 'kemet_get_post_audio', get_media_embedded_in_content( $content ) );

		if ( empty( $embeds ) ) {
			return '';
		}

		// check what is the first embed containg video tag, youtube or vimeo.
		foreach ( $embeds as $embed ) {
			if ( strpos( $embed, 'audio' ) ) {
				return '<span class="kmt-post-audio-wrapper">' . $embed . '</span>';
			}
		}
	}
}

/**
 * Get first image from post content
 */
if ( ! function_exists( 'kemet_get_video_from_post' ) ) {

	/**
	 * Get first image from post content
	 *
	 * @param  number $post_id Post id.
	 * @return mixed
	 */
	function kemet_get_video_from_post( $post_id ) {

		$post    = get_post( $post_id );
		$content = do_shortcode( apply_filters( 'the_content', $post->post_content ) );
		$embeds  = apply_filters( 'kemet_get_post_audio', get_media_embedded_in_content( $content ) );

		if ( empty( $embeds ) ) {
			return '';
		}

		// check what is the first embed containg video tag, youtube or vimeo.
		foreach ( $embeds as $embed ) {
			if ( strpos( $embed, 'video' ) || strpos( $embed, 'youtube' ) || strpos( $embed, 'vimeo' ) ) {
				return $embed;
			}
		}
	}
}
