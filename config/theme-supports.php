<?php
/**
 * Raw Child child theme.
 *
 * Theme supports.
 *
 * @package Raw Child
 * @author  rawsta
 * @license GPL-2.0-or-later
 * @link    https://github.com/rawsta/raw-child/
 */

return [
	'genesis-custom-logo'             => [
		'height'      => 100,
		'width'       => 640,
		'flex-height' => true,
		'flex-width'  => true,
	],
	'html5'                           => [
		'caption',
		'comment-form',
		'comment-list',
		'navigation-widgets',
		'gallery',
		'search-form',
		'script',
		'style',
	],
	'genesis-structural-wraps'        => [
		'header',
		'menu-secondary',
		'site-inner',
		'footer-widgets',
		'footer',
	],
	'genesis-accessibility'           => [
		'404-page',
		'drop-down-menu',
		'headings',
		'rems',
		'search-form',
		'skip-links',
		'screen-reader-text'
	],
	'genesis-after-entry-widget-area' => '',
	'genesis-responsive-viewport'     => '',
	'genesis-footer-widgets'          => 3, // up to 6
	'genesis-menus'                   => [
		'primary'   => __( 'Header Menu', 'raw-child' ),
		'secondary' => __( 'Footer Menu', 'raw-child' ),
	],
];
