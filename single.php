<?php
/**
 * Raw Child.
 *
 * single template.
 *
 * @package Raw Child
 * @author  rawsta
 * @license GPL-2.0-or-later
 * @link    https://github.com/rawsta/raw-child/
 */

// Entry category in header.
add_action( 'genesis_entry_header', 'raw_child_entry_category', 8 );
add_action( 'genesis_entry_header', 'raw_child_entry_author', 12 );
add_action( 'genesis_entry_header', 'raw_child_entry_header_share', 13 );

/**
 * Entry header share.
 */
function raw_child_entry_header_share() {
	do_action( 'raw_child_entry_header_share' );
}

/**
 * After Entry.
 */
function raw_child_single_after_entry() {
	echo '<div class="after-entry">';

	// Breadcrumbs.
	genesis_do_breadcrumbs();

	// Publish date
	echo '<p class="publish-date">Published on ' . get_the_date( 'F j, Y' ) . '</p>';

	// Sharing.
	do_action( 'raw_child_entry_footer_share' );

	// Author Box.
	genesis_do_author_box_single();
}
add_action( 'genesis_after_entry', 'raw_child_single_after_entry', 8 );
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );

genesis();
