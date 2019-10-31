<?php
/**
 * Raw Child child theme.
 *
 * Theme supports.
 *
 * @package Raw Child
 * @author  rawsta
 * @license GPL-2.0-or-later
 * @link    https://my.rawsta.com/themes/raw-child/
 */

return [
	'genesis-custom-logo'             => [
		'height'      => 120,
		'width'       => 700,
		'flex-height' => true,
		'flex-width'  => true,
	],
	'html5'                           => [
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form',
	],
	'genesis-accessibility'           => [
		'drop-down-menu',
		'headings',
		'search-form',
		'skip-links',
	],
	'genesis-after-entry-widget-area' => '',
	'genesis-footer-widgets'          => 3,
	'genesis-menus'                   => [
		'primary'   => __( 'Header Menu', 'raw-child' ),
		'secondary' => __( 'Footer Menu', 'raw-child' ),
	],
];
