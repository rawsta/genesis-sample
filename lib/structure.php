<?php
/**
 * Raw Child.
 *
 * structuring the posts and pages
 *
 * @package Raw Child
 * @author  rawsta
 * @license GPL-2.0-or-later
 *  @link    https://github.com/rawsta/raw-child/
 */

add_filter( 'template_include', 'raw_child_template_hierarchy' );
/**
 * Template Hierarchy
 */
function raw_child_template_hierarchy( $template ) {
	if ( is_home() ) {
		$template = get_query_template( 'archive' );
	}
	return $template;
}

add_action( 'template_redirect', 'raw_child_use_archive_loop', 20 );
/**
 * Use Archive Loop
 */
function raw_child_use_archive_loop() {

	if ( ! is_singular() && ! is_404() ) {
		add_action( 'genesis_loop', 'raw_child_archive_loop' );
		remove_action( 'genesis_loop', 'genesis_do_loop' );
	}
}

/**
 * Archive Loop
 * Uses template partials
 */
function raw_child_archive_loop() {
	if ( have_posts() ) {
		do_action( 'genesis_before_while' );
		while ( have_posts() ) {
			the_post();
			do_action( 'genesis_before_entry' );
			// Template part
			$partial = apply_filters( 'raw_child_loop_partial', 'archive' );
			$context = apply_filters( 'raw_child_loop_partial_context', is_search() ? 'search' : get_post_type() );
			get_template_part( 'partials/' . $partial, $context );
			do_action( 'genesis_after_entry' );
		}
		do_action( 'genesis_after_endwhile' );
	} else {
		do_action( 'genesis_loop_else' );
	}
}

add_action( 'genesis_before_entry', 'raw_child_remove_entry_title' );
/**
 * Remove entry-title if h1 block used
 *
 * @link https://www.billerickson.net/building-a-header-block-in-wordpress/
 */
function raw_child_remove_entry_title() {

	if ( ! ( is_singular() && function_exists( 'parse_blocks' ) ) ) {
		return;
	}

	global $post;
	$blocks = parse_blocks( $post->post_content );
	$has_h1 = raw_child_has_h1_block( $blocks );

	if ( $has_h1 ) {
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
		remove_action( 'genesis_entry_header', 'genesis_do_breadcrumbs', 8 );
		remove_action( 'genesis_entry_header', 'raw_child_entry_category', 8 );
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		remove_action( 'genesis_entry_header', 'raw_child_entry_author', 12 );
		remove_action( 'genesis_entry_header', 'raw_child_entry_header_share', 13 );
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
	}
}

add_filter( 'genesis_attr_content', 'raw_child_change_content' );
/**
 * Change '.content' to '.site-main'
 *
 * @param string $open, opening markup
 * @param array  $args, markup args
 * @return string
 */
function raw_child_change_content( $attributes ) {
	$attributes['class'] = 'site-main';
	return $attributes;
}

add_filter( 'genesis_attr_site-inner', 'raw_child_site_inner_id' );
/**
 * Add #main-content to .site-inner
 */
function raw_child_site_inner_id( $attributes ) {
	$attributes['id'] = 'main-content';
	return $attributes;
}

add_filter( 'genesis_attr_site-inner', 'raw_child_site_inner_no_padding' );
/**
 * Remove padding from .site-inner
 */
function raw_child_site_inner_no_padding( $attributes ) {
	$attributes['class'] .= ' full';
	return $attributes;
}

add_filter( 'genesis_skip_links_output', 'raw_child_main_content_skip_link' );
/**
 * Change skip link to #main-content
 */
function raw_child_main_content_skip_link( $skip_links ) {

	$old        = $skip_links;
	$skip_links = [];

	foreach ( $old as $id => $label ) {
		if ( 'genesis-content' == $id ) {
			$id = 'main-content';
		}
		$skip_links[ $id ] = $label;
	}

	return $skip_links;
}

/**
 * Archive Description markup
 */
function raw_child_archive_description_markup( $markup ) {
	return str_replace( [ '<div', '</div' ], [ '<header', '</header' ], $markup );
}
add_filter( 'genesis_markup_posts-page-description_open', 'raw_child_archive_description_markup' );
add_filter( 'genesis_markup_posts-page-description_close', 'raw_child_archive_description_markup' );
add_filter( 'genesis_markup_taxonomy-archive-description_open', 'raw_child_archive_description_markup' );
add_filter( 'genesis_markup_taxonomy-archive-description_close', 'raw_child_archive_description_markup' );
add_filter( 'genesis_markup_author-archive-description_open', 'raw_child_archive_description_markup' );
add_filter( 'genesis_markup_author-archive-description_close', 'raw_child_archive_description_markup' );
add_filter( 'genesis_markup_cpt-archive-description_open', 'raw_child_archive_description_markup' );
add_filter( 'genesis_markup_cpt-archive-description_close', 'raw_child_archive_description_markup' );
add_filter( 'genesis_markup_date-archive-description_open', 'raw_child_archive_description_markup' );
add_filter( 'genesis_markup_date-archive-description_close', 'raw_child_archive_description_markup' );
add_filter( 'genesis_markup_search-description_open', 'raw_child_archive_description_markup' );
add_filter( 'genesis_markup_search-description_close', 'raw_child_archive_description_markup' );

/**
 * Archive Pagination markup
 */
function raw_child_archive_pagination_markup( $markup ) {
	return str_replace( [ '<div', '</div' ], [ '<nav', '</nav' ], $markup );
}
add_filter( 'genesis_markup_archive-pagination_open', 'raw_child_archive_pagination_markup' );
add_filter( 'genesis_markup_archive-pagination_close', 'raw_child_archive_pagination_markup' );

add_filter( 'genesis_attr_cpt-archive-description', 'genesis_attributes_cpt_archive_description' );

/**
 * Search Header Classes
 */
function raw_child_search_header_classes( $attributes ) {
	$attributes['class'] = 'archive-description search-description';
	return $attributes;
}
add_filter( 'genesis_attr_search-description', 'raw_child_search_header_classes' );

/**
 * Recursively searches content for h1 blocks.
 *
 * @link https://www.billerickson.net/building-a-header-block-in-wordpress/
 *
 * @param array $blocks
 * @return bool
 */
function raw_child_has_h1_block( $blocks = [] ) {
	foreach ( $blocks as $block ) {

		if ( ! isset( $block['blockName'] ) ) {
			continue;
		}

		// Custom header block
		if ( 'acf/header' === $block['blockName'] ) {
			return true;

			// Heading block
		} elseif ( 'core/heading' === $block['blockName'] && isset( $block['attrs']['level'] ) && 1 === $block['attrs']['level'] ) {
			return true;

			// Scan inner blocks for headings
		} elseif ( isset( $block['innerBlocks'] ) && ! empty( $block['innerBlocks'] ) ) {
			$inner_h1 = raw_child_has_h1_block( $block['innerBlocks'] );
			if ( $inner_h1 ) {
				return true;
			}
		}
	}

	return false;
}
