<?php
/**
 * Functions for Kemet Theme.
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

/**
 * Foreground Color
 */
if ( ! function_exists( 'kemet_get_foreground_color' ) ) {

	/**
	 * Foreground Color
	 *
	 * @param  string $hex Color code in HEX format.
	 * @return string      Return foreground color depend on input HEX color.
	 */
	function kemet_get_foreground_color( $hex ) {

		if ( 'transparent' == $hex || 'false' == $hex || '#' == $hex || empty( $hex ) ) {
			return 'transparent';

		} else {

			// Get clean hex code.
			$hex = str_replace( '#', '', $hex );

			if ( 3 == strlen( $hex ) ) {
				$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
			}

			// Get r, g & b codes from hex code.
			$r   = hexdec( substr( $hex, 0, 2 ) );
			$g   = hexdec( substr( $hex, 2, 2 ) );
			$b   = hexdec( substr( $hex, 4, 2 ) );
			$hex = ( ( $r * 299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000;

			return 128 <= $hex ? '#000000' : '#ffffff';
		}
	}
}

/**
 * Generate CSS
 */
if ( ! function_exists( 'kemet_css' ) ) {

	/**
	 * Generate CSS
	 *
	 * @param  mixed  $value         CSS value.
	 * @param  string $css_property CSS property.
	 * @param  string $selector     CSS selector.
	 * @param  string $unit         CSS property unit.
	 * @return void               Echo generated CSS.
	 */
	function kemet_css( $value = '', $css_property = '', $selector = '', $unit = '' ) {

		if ( $selector ) {
			if ( $css_property && $value ) {

				if ( '' != $unit ) {
					$value .= $unit;
				}

				$css  = $selector;
				$css .= '{';
				$css .= '	' . $css_property . ': ' . $value . ';';
				$css .= '}';

				printf($css);
			}
		}
	}
}

/**
 * Get Font Size value
 */
if ( ! function_exists( 'kemet_responsive_font' ) ) {

	/**
	 * Get Font CSS value
	 *
	 * @param  array  $font    CSS value.
	 * @param  string $device  CSS device.
	 * @param  string $default Default value.
	 * @return mixed
	 */
	function kemet_responsive_font( $font, $device = 'desktop', $default = '' ) {

		$css_val = '';

		if ( isset( $font[ $device ] ) && isset( $font[ $device . '-unit' ] ) ) {
			if ( '' != $default ) {
				$font_size = kemet_get_css_value( $font[ $device ], $font[ $device . '-unit' ], $default );
			} else {
				$font_size = kemet_get_font_css_value( $font[ $device ], $font[ $device . '-unit' ] );
			}
		} elseif ( is_numeric( $font ) ) {
			$font_size = kemet_get_css_value( $font );
		} else {
			$font_size = ( ! is_array( $font ) ) ? $font : '';
		}

		return $font_size;
	}
}
/**
 * Get Responsive Spacing
 */
if ( ! function_exists( 'kemet_responsive_spacing' ) ) {

	/**
	 * Get Spacing value
	 *
	 * @param  array  $option    CSS value.
	 * @param  string $side  top | bottom | left | right.
	 * @param  string $device  CSS device.
	 * @param  string $default Default value.
	 * @return mixed
	 */
	function kemet_responsive_spacing( $option, $side = '', $device = 'desktop', $default = '' ) {

		if ( isset( $option[ $device ][ $side ] ) && isset( $option[ $device . '-unit' ] ) ) {
			$spacing = kemet_get_css_value( $option[ $device ][ $side ], $option[ $device . '-unit' ], $default );
		} elseif ( is_numeric( $option ) ) {
			$spacing = kemet_get_css_value( $option );
		} else {
			$spacing = ( ! is_array( $option ) ) ? $option : '';
		}

		return $spacing;
	}
}

/**
 * Get Responsive Slider
 */
if ( ! function_exists( 'kemet_responsive_slider' ) ) {

	/**
	 * Get Spacing value
	 *
	 * @param  array  $option    CSS value.
	 * @param  string $device  CSS device.
	 * @param  string $default Default value.
	 * @return mixed
	 */
	function kemet_responsive_slider( $option, $device = 'desktop', $default = '' ) {

		if ( isset( $option[ $device ] ) && isset( $option[ $device . '-unit' ] ) ) {
			if ( '' != $default ) {
				$value = kemet_get_css_value( $option[ $device ], $option[ $device . '-unit' ], $default );
			} else {
				$value = kemet_get_css_value( $option[ $device ], $option[ $device . '-unit' ] );
			}
		} elseif ( is_numeric( $option ) ) {
			$value = kemet_get_css_value( $option );
		} else {
			$value = ( ! is_array( $option ) ) ? $option : '';
		}
		return $value;
	}
}


/**
 * Get Font Size value
 */
if ( ! function_exists( 'kemet_get_font_css_value' ) ) {

	/**
	 * Get Font CSS value
	 *
	 * Syntax:
	 *
	 *  kemet_get_font_css_value( VALUE, DEVICE, UNIT );
	 *
	 * E.g.
	 *
	 *  kemet_get_css_value( VALUE, 'desktop', '%' );
	 *  kemet_get_css_value( VALUE, 'tablet' );
	 *  kemet_get_css_value( VALUE, 'mobile' );
	 *
	 * @param  string $value        CSS value.
	 * @param  string $unit         CSS unit.
	 * @param  string $device       CSS device.
	 * @return mixed                CSS value depends on $unit & $device
	 */
	function kemet_get_font_css_value( $value, $unit = 'px', $device = 'desktop' ) {

		// If value is empty or 0 then return blank.
		if ( '' == $value || 0 == $value ) {
			return '';
		}

		$css_val = '';

		switch ( $unit ) {
			case 'em':
			case '%':
						$css_val = esc_attr( $value ) . $unit;
				break;

			case 'px':
				if ( is_numeric( $value ) || strpos( $value, 'px' ) ) {
					$value            = intval( $value );
					$fonts            = array();
					$body_font_size   = kemet_get_option( 'font-size-body' );
					$fonts['desktop'] = ( isset( $body_font_size['desktop'] ) && '' != $body_font_size['desktop'] ) ? $body_font_size['desktop'] : 15;
					$fonts['tablet']  = ( isset( $body_font_size['tablet'] ) && '' != $body_font_size['tablet'] ) ? $body_font_size['tablet'] : $fonts['desktop'];
					$fonts['mobile']  = ( isset( $body_font_size['mobile'] ) && '' != $body_font_size['mobile'] ) ? $body_font_size['mobile'] : $fonts['tablet'];

					if ( $fonts[ $device ] ) {
						$css_val = esc_attr( $value ) . 'px;font-size:' . ( esc_attr( $value ) / esc_attr( $fonts[ $device ] ) ) . 'rem';
					}
				} else {
					$css_val = esc_attr( $value );
				}
		}

		return $css_val;
	}
}

/**
 * Get Font family
 */
if ( ! function_exists( 'kemet_get_font_family' ) ) {

	/**
	 * Get Font family
	 *
	 * Syntax:
	 *
	 *  kemet_get_font_family( VALUE, DEFAULT );
	 *
	 * E.g.
	 *  kemet_get_font_family( VALUE, '' );
	 *
	 * @param  string $value       CSS value.
	 * @return mixed               CSS value depends on $unit
	 */
	function kemet_get_font_family( $value = '' ) {
		$system_fonts = Kemet_Font_Families::get_system_fonts();
		if ( isset( $system_fonts[ $value ] ) && isset( $system_fonts[ $value ]['fallback'] ) ) {
			$value .= ',' . $system_fonts[ $value ]['fallback'];
		}

		return $value;
	}
}


/**
 * Get CSS value
 */
if ( ! function_exists( 'kemet_get_css_value' ) ) {

	/**
	 * Get CSS value
	 *
	 * Syntax:
	 *
	 *  kemet_get_css_value( VALUE, UNIT );
	 *
	 * @param  string $value        CSS value.
	 * @param  string $unit         CSS unit.
	 * @param  string $default      CSS default font.
	 * @return mixed               CSS value depends on $unit
	 */
	function kemet_get_css_value( $value = '', $unit = 'px', $default = '' ) {

		if ( '' == $value && '' == $default ) {
			return $value;
		}

		$css_val = '';

		switch ( $unit ) {

			case 'font':
				if ( 'inherit' != $value ) {
					$value   = kemet_get_font_family( $value );
					$css_val = $value;
				} elseif ( '' != $default ) {
					$css_val = $default;
				}
				break;

			case 'px':
			case '%':
						$value   = ( '' != $value ) ? $value : $default;
						$css_val = esc_attr( $value ) . $unit;
				break;

			case 'url':
						$css_val = $unit . '(' . esc_url( $value ) . ')';
				break;

			case 'rem':
				if ( is_numeric( $value ) || strpos( $value, 'px' ) ) {
					$value          = intval( $value );
					$body_font_size = kemet_get_option( 'font-size-body' );
					if ( is_array( $body_font_size ) ) {
						$body_font_size_desktop = ( isset( $body_font_size['desktop'] ) && '' != $body_font_size['desktop'] ) ? $body_font_size['desktop'] : 15;
					} else {
						$body_font_size_desktop = ( '' != $body_font_size ) ? $body_font_size : 15;
					}

					if ( $body_font_size_desktop ) {
						$css_val = esc_attr( $value ) . 'px;font-size:' . ( esc_attr( $value ) / esc_attr( $body_font_size_desktop ) ) . $unit;
					}
				} else {
					$css_val = esc_attr( $value );
				}

				break;

			default:
				$value = ( '' != $value ) ? $value : $default;
				if ( '' != $value ) {
					$css_val = esc_attr( $value ) . $unit;
				}
		}

		return $css_val;
	}
}

/**
 * Adjust the background obj.
 */
if ( ! function_exists( 'kemet_get_background_obj' ) ) {

	/**
	 * Adjust Brightness
	 *
	 * @param  array $bg_obj   Color code in HEX.
	 *
	 * @return array         Color code in HEX.
	 */
	function kemet_get_background_obj( $bg_obj ) {

		$gen_bg_css = array();

		$bg_img   = isset( $bg_obj['background-image'] ) ? $bg_obj['background-image'] : '';
		$bg_color = isset( $bg_obj['background-color'] ) ? $bg_obj['background-color'] : '';

		if ( '' !== $bg_img && '' !== $bg_color ) {
			$gen_bg_css = array(
				'background-color' => 'unset',
				'background-image' => 'url(' . esc_url( $bg_img ) . ') , linear-gradient(to right, ' . esc_attr( $bg_color ) . ', ' . esc_attr( $bg_color ) . ')',
			);
		} elseif ( '' !== $bg_img ) {
			$gen_bg_css = array( 'background-image' => 'url(' . esc_url( $bg_img ) . ')' );
		} elseif ( '' !== $bg_color ) {
			$gen_bg_css = array( 'background-color' => esc_attr( $bg_color ) );
		}

		if ( '' !== $bg_img ) {
			if ( isset( $bg_obj['background-repeat'] ) ) {
				$gen_bg_css['background-repeat'] = esc_attr( $bg_obj['background-repeat'] );
			}

			if ( isset( $bg_obj['background-position'] ) ) {
				$gen_bg_css['background-position'] = esc_attr( $bg_obj['background-position'] );
			}

			if ( isset( $bg_obj['background-size'] ) ) {
				$gen_bg_css['background-size'] = esc_attr( $bg_obj['background-size'] );
			}

			if ( isset( $bg_obj['background-attachment'] ) ) {
				$gen_bg_css['background-attachment'] = esc_attr( $bg_obj['background-attachment'] );
			}
		}

		return $gen_bg_css;
	}
}

/**
 * Parse CSS
 */
if ( ! function_exists( 'kemet_parse_css' ) ) {

	/**
	 * Parse CSS
	 *
	 * @param  array  $css_output Array of CSS.
	 * @param  string $min_media  Min Media breakpoint.
	 * @param  string $max_media  Max Media breakpoint.
	 * @return string             Generated CSS.
	 */
	function kemet_parse_css( $css_output = array(), $min_media = '', $max_media = '' ) {

		$parse_css = '';
		if ( is_array( $css_output ) && count( $css_output ) > 0 ) {

			foreach ( $css_output as $selector => $properties ) {

				if ( ! count( $properties ) ) {
					continue; }

				$temp_parse_css   = $selector . '{';
				$properties_added = 0;

				foreach ( $properties as $property => $value ) {

					if ( '' === $value ) {
						continue; }

					$properties_added++;
					$temp_parse_css .= $property . ':' . $value . ';';
				}

				$temp_parse_css .= '}';

				if ( $properties_added > 0 ) {
					$parse_css .= $temp_parse_css;
				}
			}

			if ( '' != $parse_css && ( '' !== $min_media || '' !== $max_media ) ) {

				$media_css       = '@media ';
				$min_media_css   = '';
				$max_media_css   = '';
				$media_separator = '';

				if ( '' !== $min_media ) {
					$min_media_css = '(min-width:' . $min_media . 'px)';
				}
				if ( '' !== $max_media ) {
					$max_media_css = '(max-width:' . $max_media . 'px)';
				}
				if ( '' !== $min_media && '' !== $max_media ) {
					$media_separator = ' and ';
				}

				$media_css .= $min_media_css . $media_separator . $max_media_css . '{' . $parse_css . '}';

				return $media_css;
			}
		}

		return $parse_css;
	}
}

/**
 * Return Theme options.
 */
if ( ! function_exists( 'kemet_get_option' ) ) {

	/**
	 * Return Theme options.
	 *
	 * @param  string $option       Option key.
	 * @param  string $default      Option default value.
	 * @return Mixed               Return option value.
	 */
	function kemet_get_option( $option, $default = '' ) {

		$theme_options = Kemet_Theme_Options::get_options();

		/**
		 * Filter the options array for Kemet Settings.
		 *
		 * @var Array
		 */
		$theme_options = apply_filters( 'kemet_get_option_array', $theme_options, $option, $default );

		$value = ( isset( $theme_options[ $option ] ) && '' !== $theme_options[ $option ] ) ? $theme_options[ $option ] : $default;

		/**
		 * Dynamic filter kemet_get_option_$option.
		 * $option is the name of the Kemet Setting, Refer Kemet_Theme_Options::defaults() for option names from the theme.
		 *
		 * @var Mixed.
		 */
		return apply_filters( "kemet_get_option_{$option}", $value, $option, $default );
	}
}

/**
 * Helper function to get the current post id.
 */
if ( ! function_exists( 'kemet_get_post_id' ) ) {

	/**
	 * Get post ID.
	 *
	 * @param  string $post_id_override Get override post ID.
	 * @return number                   Post ID.
	 */
	function kemet_get_post_id( $post_id_override = '' ) {

		if ( null == Kemet_Theme_Options::$post_id ) {
			global $post;

			$post_id = 0;

			if ( is_home() ) {
				$post_id = get_option( 'page_for_posts' );
			} elseif ( is_archive() ) {
				global $wp_query;
				$post_id = $wp_query->get_queried_object_id();
			} elseif ( isset( $post->ID ) && ! is_search() && ! is_category() ) {
				$post_id = $post->ID;
			}

			Kemet_Theme_Options::$post_id = $post_id;
		}

		return apply_filters( 'kemet_get_post_id', Kemet_Theme_Options::$post_id, $post_id_override );
	}
}


/**
 * Display classes for kemet content div
 */
if ( ! function_exists( 'kemet_content_class' ) ) {

	/**
	 * Display classes for kemet content div
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @return void        Echo classes.
	 */
	function kemet_content_class( $class = '' ) {

		// Separates classes with a single space, collates classes for body element.
		echo 'class="' . esc_attr( join( ' ', kemet_get_primary_class( $class ) ) ) . '"';
	}
}

/**
 * Retrieve the classes for the primary element as an array.
 */
if ( ! function_exists( 'kemet_get_primary_class' ) ) {

	/**
	 * Retrieve the classes for the primary element as an array.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array        Return array of classes.
	 */
	function kemet_get_primary_class( $class = '' ) {

		// array of class names.
		$classes = array();

		// default class for content area.
		$classes[] = 'content-area';

		// primary base class.
		$classes[] = 'primary';

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {

			$class = array();
		}

		// Filter primary div class names.
		$classes = apply_filters( 'kemet_primary_class', $classes, $class );

		$classes = array_map( 'sanitize_html_class', $classes );

		return array_unique( $classes );
	}
}

/**
 * Get post format
 */
if ( ! function_exists( 'kemet_get_post_format' ) ) {

	/**
	 * Get post format
	 *
	 * @param  string $post_format_override Override post formate.
	 * @return string                       Return post format.
	 */
	function kemet_get_post_format( $post_format_override = '' ) {

		if ( ( is_home() ) || is_archive() ) {
			$post_format = 'blog';
		} else {
			$post_format = get_post_format();
		}

		return apply_filters( 'kemet_get_post_format', $post_format, $post_format_override );
	}
}

/**
 * Wrapper function for the_title()
 */
if ( ! function_exists( 'kemet_the_title' ) ) {

	/**
	 * Wrapper function for the_title()
	 *
	 * Displays title only if the page title bar is disabled.
	 *
	 * @param string $before Optional. Content to prepend to the title.
	 * @param string $after  Optional. Content to append to the title.
	 * @param int    $post_id Optional, default to 0. Post id.
	 * @param bool   $echo   Optional, default to true.Whether to display or return.
	 * @return string|void String if $echo parameter is false.
	 */
	function kemet_the_title( $before = '', $after = '', $post_id = 0, $echo = true ) {

		$title             = '';
		$blog_post_title   = kemet_get_option( 'blog-post-structure' );
		$single_post_title = kemet_get_option( 'blog-single-post-structure' );

		
		if ( apply_filters( 'kemet_the_title_enabled', true ) ) {

			$title  = kemet_get_the_title( $post_id );
			$before = apply_filters( 'kemet_the_title_before', $before );
			$after  = apply_filters( 'kemet_the_title_after', $after );

			$title = $before . $title . $after;
		}
		

		// This will work same as `the_title` function but with Custom Title if exits.
		if ( $echo ) {
			echo wp_kses_post( $title );
		} else {
			return $title;
		}
	}
}

/**
 * Wrapper function for get_the_title()
 */
if ( ! function_exists( 'kemet_get_the_title' ) ) {

	/**
	 * Wrapper function for get_the_title()
	 *
	 * Return title for Title Bar and Normal Title.
	 *
	 * @param int  $post_id Optional, default to 0. Post id.
	 * @param bool $echo   Optional, default to false. Whether to display or return.
	 * @return string|void String if $echo parameter is false.
	 */
	function kemet_get_the_title( $post_id = 0, $echo = false ) {

		$title = '';
		if ( $post_id || is_singular() ) {
			$title = get_the_title( $post_id );
		} else {
			if ( is_front_page() && is_home() ) {
				// Default homepage.
				$title = apply_filters( 'kemet_the_default_home_page_title', esc_html__( 'Home', 'kemet' ) );
			} elseif ( is_home() ) {
				// blog page.
				$title = apply_filters( 'kemet_the_blog_home_page_title', get_the_title( get_option( 'page_for_posts', true ) ) );
			} elseif ( is_search() ) {

				/* translators: 1: search string */
				$title = apply_filters( 'kemet_the_search_page_title', sprintf( __( 'Search Results for: %s', 'kemet' ), '<span>' . get_search_query() . '</span>' ) );

			} elseif ( class_exists( 'WooCommerce' ) && is_shop() ) {

				$title = woocommerce_page_title( false );

			} elseif ( is_archive() ) {

				$title = get_the_archive_title();

			}
		}

		// This will work same as `get_the_title` function but with Custom Title if exits.
		if ( $echo ) {
			echo wp_kses_post( $title );
		} else {
			return $title;
		}
	}
}

/**
 * Archive Page Title
 */
if ( ! function_exists( 'kemet_archive_page_info' ) ) {

	/**
	 * Wrapper function for the_title()
	 *
	 * Displays title only if the page title bar is disabled.
	 */
	function kemet_archive_page_info() {

		if ( apply_filters( 'kemet_title_bar_disable', true ) ) {

			// Author.
			if ( is_author() ) { ?>

				<section class="kmt-author-box kmt-archive-description">
					<div class="kmt-author-bio">
						<h1 class='page-title kmt-archive-title'><?php echo get_the_author(); ?></h1>
						<p><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
					</div>
					<div class="kmt-author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'email' ), 120 ); ?>
					</div>
				</section>

			<?php

			// Category.
			} elseif ( is_category() ) {
			?>

				<section class="kmt-archive-description">
					<h1 class="page-title kmt-archive-title"><?php echo single_cat_title(); ?></h1>
					<?php the_archive_description(); ?>
				</section>

			<?php

			// Tag.
			} elseif ( is_tag() ) {
			?>

				<section class="kmt-archive-description">
					<h1 class="page-title kmt-archive-title"><?php echo single_tag_title(); ?></h1>
					<?php the_archive_description(); ?>
				</section>

			<?php

			// Search.
			} elseif ( is_search() ) {
			?>

				<section class="kmt-archive-description">
					<?php
						/* translators: 1: search string */
						$title = apply_filters( 'kemet_the_search_page_title', sprintf( __( 'Search Results for: %s', 'kemet' ), '<span>' . get_search_query() . '</span>' ) );
					?>
					<h1 class="page-title kmt-archive-title"> <?php echo wp_kses_post( $title ); ?> </h1>
				</section>

			<?php

			// Other.
			} else {
			?>

				<section class="kmt-archive-description">
					<?php the_archive_title( '<h1 class="page-title kmt-archive-title">', '</h1>' ); ?>
					<?php the_archive_description(); ?>
				</section>

		<?php
			}
		}
	}

	add_action( 'kemet_archive_top_info', 'kemet_archive_page_info' );
}

/**
 * Content Layout
 */
function content_layout($default){

	$meta = get_post_meta( get_the_ID(), 'kemet-content-layout', true ); 
	
	if ( !empty($meta) ) {
		$default = $meta;
	}
	return $default;
}
add_filter( 'kemet_get_content_layout', 'content_layout' );