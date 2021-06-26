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

echo '<article class="post-summary">';

raw_child_post_summary_image();

echo '<div class="post-summary__content">';
	raw_child_entry_category();
	raw_child_post_summary_title();
echo '</div>';

echo '</article>';
