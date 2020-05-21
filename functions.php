<?php
/**
 * Raw Child.
 *
 * This file adds functions to the Raw Child Theme.
 *
 * @package Raw Child
 * @author  rawsta
 * @license GPL-2.0-or-later
 * @link    https://www.rawsta.de/
 */

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Sets up the Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

add_action( 'after_setup_theme', 'raw_child_localization_setup' );
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function raw_child_localization_setup() {

	load_child_theme_textdomain( genesis_get_theme_handle(), get_stylesheet_directory() . '/languages' );

}

// Adds helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds image upload and color select to Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

// Adds WooCommerce support.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Adds the required WooCommerce styles and Customizer CSS.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Adds the Genesis Connect WooCommerce notice.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

// Let's get my stuff
//---------------->
// Removes unused Functions.
require_once get_stylesheet_directory() . '/lib/wp-clean.php';

// Let's add some branding.
require_once get_stylesheet_directory() . '/lib/branding.php';

// // Terminarten Taxonomie
// require_once get_stylesheet_directory() . '/lib/terminarten.php';

// // Termine PostType
// require_once get_stylesheet_directory() . '/lib/termine.php';


add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );
/**
 * Adds Gutenberg opt-in features and styling.
 *
 * @since 1.0.0
 */
function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
}

// Registers the responsive menus.
if ( function_exists( 'genesis_register_responsive_menus' ) ) {
	genesis_register_responsive_menus( genesis_get_config( 'responsive-menus' ) );
}

add_action( 'wp_enqueue_scripts', 'raw_child_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function raw_child_enqueue_scripts_styles() {

	$appearance = genesis_get_config( 'appearance' );

	wp_enqueue_style(
		genesis_get_theme_handle() . '-fonts',
		$appearance['fonts-url'],
		[],
		genesis_get_theme_version()
	);

	wp_enqueue_style( 'dashicons' );

	if ( genesis_is_amp() ) {
		wp_enqueue_style(
			genesis_get_theme_handle() . '-amp',
			get_stylesheet_directory_uri() . '/lib/amp/amp.css',
			[ genesis_get_theme_handle() ],
			genesis_get_theme_version()
		);
	}

	// Add initial Javascript.
	wp_enqueue_script(
		genesis_get_theme_handle() . '-js',
		get_stylesheet_directory_uri() . '/js/rawchild.js',
		array( 'jquery' ),
		genesis_get_theme_version(),
		true
	);

}

add_action( 'after_setup_theme', 'raw_child_theme_support', 9 );
/**
 * Add desired theme supports.
 *
 * See config file at `config/theme-supports.php`.
 *
 * @since 1.0.0
 */
function raw_child_theme_support() {

	$theme_supports = genesis_get_config( 'theme-supports' );

	foreach ( $theme_supports as $feature => $args ) {
		add_theme_support( $feature, $args );
	}

}

add_action( 'after_setup_theme', 'raw_child_post_type_support', 9 );
/**
 * Add desired post type supports.
 *
 * See config file at `config/post-type-supports.php`.
 *
 * @since 1.0.0
 */
function raw_child_post_type_support() {

	$post_type_supports = genesis_get_config( 'post-type-supports' );

	foreach ( $post_type_supports as $post_type => $args ) {
		add_post_type_support( $post_type, $args );
	}

}

/**
 * Add various Imagesizes and register them
 *  TODO: Fix sizes
 */
add_image_size( 'sidebar-featured', 75, 75, true ); // Hard Crop Mode.
add_image_size( 'raw-squared', 400, 400, [ 'left', 'top' ] ); // Hard Crop center/top Mode.
add_image_size( 'raw-post-images', 480, 320, true ); // Hard Crop Mode.
add_image_size( 'raw-homepage-thumb', 600, 300, [ 'left', 'top' ], true ); // Soft Crop Mode.
add_image_size( 'raw-singlepost', 1920, 9999 ); // Unlimited Height Mode.

add_filter( 'image_size_names_choose', 'raw_child_custom_sizes' );
/**
 * Makes new image sizes available in MediaLibrary.
 *
 *  @since 3.0
 *
 * @param array $sizes Imagesizes.
 */
function raw_child_custom_sizes( $sizes ) {
	return array_merge(
		$sizes,
		[
			'sidebar-featured'        => __( 'Sidebar', 'raw-child'  ),
			'raw-squared'        => __( 'Squared', 'raw-child'  ),
			'raw-post-images'    => __( 'Post Image', 'raw-child'  ),
			'raw-homepage-thumb' => __( 'Homepage Thumb', 'raw-child'  ),
			'raw-singlepost'     => __( 'Singlepost', 'raw-child'  ),
		]
	);
}

// Removes header right widget area.
unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Repositions the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 10 );

add_filter( 'wp_nav_menu_args', 'raw_child_secondary_menu_args' );
/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 1.0.0
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function raw_child_secondary_menu_args( $args ) {

	if ( 'secondary' === $args['theme_location'] ) {
		$args['depth'] = 1;
	}

	return $args;

}

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

