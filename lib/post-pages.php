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


 /* Customize the read more text */
add_filter(
	'genesis_more_text',
	function () {

		$more_text = genesis_a11y_more_link( __( '[ Read More ]', 'imagagc' ) );

		return $more_text;

	}
);

 /* Display featured image on page and post */
add_action(
	'genesis_before_content',
	function () {

		if ( ! is_singular( array( 'post', 'page', 'project' ) ) ||
			! has_post_thumbnail() ) {

			return;

		}

		// Display featured image above content.
		$thumb = get_the_post_thumbnail_url(); ?>

		<div class="featured-image-wrapper" style="background-image: url('<?php echo esc_url( $thumb ); ?>')">
		</div>

		<?php
	},
	5
);
