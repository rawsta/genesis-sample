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

 /**
 * Apply Content Sidebar content layout to single posts.
 *
 * @return string layout ID.
 */
function raw_child_set_single_posts_layout() {
    if ( is_single() ) {
        return 'content-sidebar';
    }
}
add_filter( 'genesis_pre_get_option_site_layout', 'raw_child_set_single_posts_layout' );

 /* Customize the read more text */
add_filter(
	'genesis_more_text',
	function () {

		$more_text = genesis_a11y_more_link( __( '[ Read More ]', 'imagagc' ) );

		return $more_text;

	}
);

/**
 *  Get First Image and set it as featured image
 */
function raw_child_autoset_featured() {
    global $post;
    $already_has_thumb = has_post_thumbnail($post->ID);
    if (!$already_has_thumb)  {
        $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
        if ($attached_image) {
            foreach ($attached_image as $attachment_id => $attachment) {
                set_post_thumbnail($post->ID, $attachment_id);
            }
        }
    }
}
add_action('the_post', 'raw_child_autoset_featured');
add_action('save_post', 'raw_child_autoset_featured');
add_action('draft_to_publish', 'raw_child_autoset_featured');
add_action('new_to_publish', 'raw_child_autoset_featured');
add_action('pending_to_publish', 'raw_child_autoset_featured');
add_action('future_to_publish', 'raw_child_autoset_featured');
