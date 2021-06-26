<?php
/**
 * Raw Child.
 *
 * Partial
 *
 * @package Raw Child
 * @author  rawsta
 * @license GPL-2.0-or-later
 * @link    https://github.com/rawsta/raw-child/
 */

echo '<section class="no-results not-found">';

echo '<header class="entry-header"><h1 class="entry-title">' . esc_html__( 'Nothing Found', 'raw-child' ) . '</h1></header>';
echo '<div class="entry-content">';

if ( is_search() ) {

	echo '<p>' . esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'raw-child' ) . '</p>';
	get_search_form();

} else {

	echo '<p>' . esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'raw-child' ) . '</p>';
	get_search_form();
}

echo '</div>';
echo '</section>';
