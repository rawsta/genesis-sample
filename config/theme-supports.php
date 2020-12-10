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
	'genesis-accessibility'           => [
		'drop-down-menu',
		'headings',
		'search-form',
		'skip-links',
	],
	'genesis-after-entry-widget-area' => '',
	'genesis-footer-widgets'          => 3, // up to 6
	'genesis-menus'                   => [
		'primary'   => __( 'Header Menu', 'raw-child' ),
		'secondary' => __( 'Footer Menu', 'raw-child' ),
	],
];
