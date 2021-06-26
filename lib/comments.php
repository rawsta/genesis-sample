<?php
/**
 * Raw Child.
 *
 * Filter and functions to handle
 *
 * @package Raw Child
 * @author  rawsta
 * @license GPL-2.0-or-later
 *  @link    https://github.com/rawsta/raw-child/
 */


add_filter( 'genesis_author_box_gravatar_size', 'raw_child_author_box_gravatar' );
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 1.0.0
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function raw_child_author_box_gravatar( $size ) {
	return 90;
}

add_filter( 'genesis_comment_list_args', 'raw_child_comments_gravatar' );
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 1.0.0
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function raw_child_comments_gravatar( $args ) {
	$args['avatar_size'] = 60;
	return $args;
}

add_filter( 'comment_class', 'raw_child_staff_comment_class', 10, 5 );
/**
 * Staff comment class
 * @author Bill Erickson
 */
function raw_child_staff_comment_class( $classes, $class, $comment_id, $comment, $post_id ) {
	if( empty( $comment->user_id ) )
		return $classes;
	$staff_roles = array( 'author', 'editor', 'administrator' );
	$user = get_userdata( $comment->user_id );
	if( !empty( array_intersect( $user->roles, $staff_roles ) ) )
		$classes[] = 'staff';
	return $classes;
}

add_filter( 'comment_form_defaults', 'raw_child_comment_form_button_class' );
/**
 * Comment form, button class
 */
function raw_child_comment_form_button_class( $args ) {
	$args['class_submit'] = 'submit wp-block-button__link';
	return $args;
}
