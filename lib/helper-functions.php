<?php
/**
 * Raw Child.
 *
 * This file adds the required helper functions used in the Raw Child Theme.
 * Functions taken from https://github.com/billerickson/EA-Genesis-Child/blob/master/inc/helper-functions.phphttps://github.com/billerickson/EA-Genesis-Child/blob/master/inc/helper-functions.php
 *
 * @package Raw Child
 * @author  rawsta
 * @license GPL-2.0-or-later
 * @link    https://github.com/rawsta/raw-child/
 */

// Duplicate 'the_content' filters
global $wp_embed;
add_filter( 'raw_child_the_content', [ $wp_embed, 'run_shortcode' ], 8 );
add_filter( 'raw_child_the_content', [ $wp_embed, 'autoembed' ], 8 );
add_filter( 'raw_child_the_content', 'wptexturize' );
add_filter( 'raw_child_the_content', 'convert_chars' );
add_filter( 'raw_child_the_content', 'wpautop' );
add_filter( 'raw_child_the_content', 'shortcode_unautop' );
add_filter( 'raw_child_the_content', 'do_shortcode' );


/**
 * Calculates if white or gray would contrast more with the provided color.
 *
 * @since 1.0.0
 *
 * @param string $color A color in hex format.
 * @return string The hex code for the most contrasting color: dark grey or white.
 */
function raw_child_color_contrast( $color ) {

	$hexcolor = str_replace( '#', '', $color );
	$red      = hexdec( substr( $hexcolor, 0, 2 ) );
	$green    = hexdec( substr( $hexcolor, 2, 2 ) );
	$blue     = hexdec( substr( $hexcolor, 4, 2 ) );

	$luminosity = ( ( $red * 0.2126 ) + ( $green * 0.7152 ) + ( $blue * 0.0722 ) );

	return ( $luminosity > 128 ) ? '#333333' : '#ffffff';

}

/**
 * Generates a lighter or darker color from a starting color.
 * Used to generate complementary hover tints from user-chosen colors.
 *
 * @since 1.0.0
 *
 * @param string $color A color in hex format.
 * @param int    $change The amount to reduce or increase brightness by.
 * @return string Hex code for the adjusted color brightness.
 */
function raw_child_color_brightness( $color, $change ) {

	$hexcolor = str_replace( '#', '', $color );

	$red   = hexdec( substr( $hexcolor, 0, 2 ) );
	$green = hexdec( substr( $hexcolor, 2, 2 ) );
	$blue  = hexdec( substr( $hexcolor, 4, 2 ) );

	$red   = max( 0, min( 255, $red + $change ) );
	$green = max( 0, min( 255, $green + $change ) );
	$blue  = max( 0, min( 255, $blue + $change ) );

	return '#' . dechex( $red ) . dechex( $green ) . dechex( $blue );

}

/**
 * Get the first term attached to post
 *
 * @param string     $taxonomy
 * @param string/int $field, pass false to return object
 * @param int        $post_id
 * @return string/object
 */
function raw_child_first_term( $args = [] ) {

	$defaults = [
		'taxonomy' => 'category',
		'field'    => null,
		'post_id'  => null,
	];

	$args = wp_parse_args( $args, $defaults );

	$post_id = ! empty( $args['post_id'] ) ? intval( $args['post_id'] ) : get_the_ID();
	$field   = ! empty( $args['field'] ) ? esc_attr( $args['field'] ) : false;
	$term    = false;

	// Use WP SEO Primary Term
	// from https://github.com/Yoast/wordpress-seo/issues/4038
	if ( class_exists( 'WPSEO_Primary_Term' ) ) {
		$term = get_term( ( new WPSEO_Primary_Term( $args['taxonomy'], $post_id ) )->get_primary_term(), $args['taxonomy'] );
	}

	// Fallback on term with highest post count
	if ( ! $term || is_wp_error( $term ) ) {

		$terms = get_the_terms( $post_id, $args['taxonomy'] );

		if ( empty( $terms ) || is_wp_error( $terms ) ) {
			return false;
		}

		// If there's only one term, use that
		if ( 1 == count( $terms ) ) {
			$term = array_shift( $terms );

			// If there's more than one...
		} else {

			// Sort by term order if available
			// @uses WP Term Order plugin
			if ( isset( $terms[0]->order ) ) {
				$list = [];
				foreach ( $terms as $term ) {
					$list[ $term->order ] = $term;
				}
				ksort( $list, SORT_NUMERIC );

				// Or sort by post count
			} else {
				$list = [];
				foreach ( $terms as $term ) {
					$list[ $term->count ] = $term;
				}
				ksort( $list, SORT_NUMERIC );
				$list = array_reverse( $list );
			}

			$term = array_shift( $list );
		}
	}

	// Output
	if ( ! empty( $field ) && isset( $term->$field ) ) {
		return $term->$field;

	} else {
		return $term;
	}
}

/**
 * Conditional CSS Classes
 *
 * @param string $base_classes, classes always applied
 * @param string $optional_class, additional class applied if $conditional is true
 * @param bool   $conditional, whether to add $optional_class or not
 * @return string $classes
 */
function raw_child_class( $base_classes, $optional_class, $conditional ) {
	return $conditional ? $base_classes . ' ' . $optional_class : $base_classes;
}

/**
 *  Background Image Style
 *
 * @param int $image_id
 * @return string $output
 */
function raw_child_bg_image_style( $image_id = false, $image_size = 'full' ) {
	if ( ! empty( $image_id ) ) {
		return ' style="background-image: url(' . wp_get_attachment_image_url( $image_id, $image_size ) . ');"';
	}
}

/**
 * Get Icon
 * This function is in charge of displaying SVG icons across the site.
 *
 * Place each <svg> source in the /assets/icons/{group}/ directory, without adding
 * both `width` and `height` attributes, since these are added dynamically,
 * before rendering the SVG code.
 *
 * All icons are assumed to have equal width and height, hence the option
 * to only specify a `$size` parameter in the svg methods.
 */
function raw_child_icon( $atts = [] ) {

	$atts = shortcode_atts(
		[
			'icon'  => false,
			'group' => 'utility',
			'size'  => 16,
			'class' => false,
			'label' => false,
		],
		$atts
	);

	if ( empty( $atts['icon'] ) ) {
		return;
	}

	$icon_path = get_theme_file_path( '/assets/icons/' . $atts['group'] . '/' . $atts['icon'] . '.svg' );
	if ( ! file_exists( $icon_path ) ) {
		return;
	}

		$icon = file_get_contents( $icon_path );

		$class = 'svg-icon';
	if ( ! empty( $atts['class'] ) ) {
		$class .= ' ' . esc_attr( $atts['class'] );
	}

	if ( false !== $atts['size'] ) {
		$repl = sprintf( '<svg class="' . $class . '" width="%d" height="%d" aria-hidden="true" role="img" focusable="false" ', $atts['size'], $atts['size'] );
		$svg  = preg_replace( '/^<svg /', $repl, trim( $icon ) ); // Add extra attributes to SVG code.
	} else {
		$svg = preg_replace( '/^<svg /', '<svg class="' . $class . '"', trim( $icon ) );
	}
		$svg = preg_replace( "/([\n\t]+)/", ' ', $svg ); // Remove newlines & tabs.
		$svg = preg_replace( '/>\s*</', '><', $svg ); // Remove white space between SVG tags.

	if ( ! empty( $atts['label'] ) ) {
		$svg = str_replace( '<svg class', '<svg aria-label="' . esc_attr( $atts['label'] ) . '" class', $svg );
		$svg = str_replace( 'aria-hidden="true"', '', $svg );
	}

		return $svg;
}

/**
 * Has Action
 */
function raw_child_has_action( $hook ) {
	ob_start();
	do_action( $hook );
	$output = ob_get_clean();
	return ! empty( $output );
}

/**
 * Entry Category
 */
function raw_child_entry_category() {
	$term = raw_child_first_term();
	if ( ! empty( $term ) && ! is_wp_error( $term ) ) {
		echo '<p class="entry-category"><a href="' . get_term_link( $term, 'category' ) . '">' . $term->name . '</a></p>';
	}
}

/**
 * Post Summary Title
 */
function raw_child_post_summary_title() {
	global $wp_query;
	$tag = ( is_singular() || -1 === $wp_query->current_post ) ? 'h3' : 'h2';
	echo '<' . $tag . ' class="post-summary__title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></' . $tag . '>';
}

/**
 * Post Summary Image
 */
function raw_child_post_summary_image( $size = 'thumbnail_medium' ) {
	echo '<a class="post-summary__image" href="' . get_permalink() . '" tabindex="-1" aria-hidden="true">' . wp_get_attachment_image( raw_child_entry_image_id(), $size ) . '</a>';
}


/**
 * Entry Image ID
 */
function raw_child_entry_image_id() {
	return has_post_thumbnail() ? get_post_thumbnail_id() : get_option( 'options_raw_child_default_image' );
}

/**
 * Entry Author
 */
function raw_child_entry_author() {
	$id = get_the_author_meta( 'ID' );
	echo '<p class="entry-author"><a href="' . get_author_posts_url( $id ) . '" aria-hidden="true" tabindex="-1">' . get_avatar( $id, 40 ) . '</a><em>by</em> <a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a></p>';
}
