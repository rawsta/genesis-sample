<?php
/**
 * WordPress Cleanup and speedup
 *
 * @package      Raw Child
 * @author       Sebastian Fiele
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

add_filter( 'style_loader_tag', 'sinus_remove_type_attr', 10, 2 );
add_filter( 'script_loader_tag', 'sinus_remove_type_attr', 10, 2 );
/**
 * Remove obsolete 'type=...' from script/style tags.
 *
 * @param string $tag All script tags.
 */
function sinus_remove_type_attr( $tag, $handle ) {
	return preg_replace( '/ type=[\'"]text\/(javascript|css)[\'"]/', '', $tag );
}

add_filter( 'script_loader_tag', 'js_defer_attr', 10 );
/**
 * Function to add defer to all scripts
 *
 * @param string $tag All script tags.
 */
function js_defer_attr( $tag ) {
	// Add async to all remaining scripts.
	if ( ! is_admin() ) {
		return str_replace( ' src', ' defer="defer" src', $tag );
	} else {
		return $tag;
	}
}

add_filter( 'wp_default_scripts', 'raw_child_dequeue_jquery_migrate' );
/**
 * Dequeue jQuery Migrate
 * we don't need it anymore
 */
function raw_child_dequeue_jquery_migrate( &$scripts ) {
	if ( ! is_admin() ) {
		$scripts->remove( 'jquery' );
		$scripts->add( 'jquery', false, [ 'jquery-core' ], '1.10.2' );
	}
}

add_filter( 'nav_menu_css_class', 'raw_child_clean_nav_menu_classes', 5 );
/**
 * Clean Nav Menu Classes
 */
function raw_child_clean_nav_menu_classes( $classes ) {
	if ( ! is_array( $classes ) ) {
		return $classes;
	}
	foreach ( $classes as $i => $class ) {
		// Remove class with menu item id
		$id = strtok( $class, 'menu-item-' );
		if ( 0 < intval( $id ) ) {
			unset( $classes[ $i ] );
		}
		// Remove menu-item-type-*
		if ( false !== strpos( $class, 'menu-item-type-' ) ) {
			unset( $classes[ $i ] );
		}
		// Remove menu-item-object-*
		if ( false !== strpos( $class, 'menu-item-object-' ) ) {
			unset( $classes[ $i ] );
		}
		// Change page ancestor to menu ancestor
		if ( 'current-page-ancestor' == $class ) {
			$classes[] = 'current-menu-ancestor';
			unset( $classes[ $i ] );
		}
	}
	// Remove submenu class if depth is limited
	if ( isset( $args->depth ) && 1 === $args->depth ) {
		$classes = array_diff( $classes, [ 'menu-item-has-children' ] );
	}
	return $classes;
}

add_filter( 'post_class', 'raw_child_clean_post_classes', 5 );
/**
 * Clean Post Classes
 */
function raw_child_clean_post_classes( $classes ) {
	if ( ! is_array( $classes ) ) {
		return $classes;
	}
	$allowed_classes = [
		'hentry',
		'type-' . get_post_type(),
	];
	return array_intersect( $classes, $allowed_classes );
}

add_filter( 'comment_class', 'raw_child_staff_comment_class', 10, 5 );
/**
 * Staff comment class
 */
function raw_child_staff_comment_class( $classes, $class, $comment_id, $comment, $post_id ) {
	if ( empty( $comment->user_id ) ) {
		return $classes;
	}
	$staff_roles = [ 'comment_manager', 'author', 'editor', 'administrator' ];
	$staff_roles = apply_filters( 'raw_child_staff_roles', $staff_roles );
	$user        = get_userdata( $comment->user_id );
	if ( ! empty( array_intersect( $user->roles, $staff_roles ) ) ) {
		$classes[] = 'staff';
	}
	return $classes;
}

add_filter( 'get_avatar', 'raw_child_remove_avatars_from_comments' );
/**
 * Remove avatars from comment list
 */
function raw_child_remove_avatars_from_comments( $avatar ) {
	global $in_comment_loop;
	return $in_comment_loop ? '' : $avatar;
}

add_filter( 'comment_form_defaults', 'raw_child_comment_form_button_class' );
/**
 * Comment form, button class
 */
function raw_child_comment_form_button_class( $args ) {
	$args['class_submit'] = 'submit wp-block-button__link';
	return $args;
}

add_filter( 'excerpt_more', 'raw_child_excerpt_more' );
/**
 * Excerpt More
 */
function raw_child_excerpt_more() {
	return '&hellip;';
}

