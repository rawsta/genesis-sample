<?php
/**
 * Raw Child child theme.
 *
 * @package Raw Child
 * @author  rawsta
 * @license GPL-2.0-or-later
 * @link    https://github.com/rawsta/raw-child/
 */

/**
 * Genesis responsive menus settings. (Requires Genesis 3.0+.)
 */
return [
	'script' => [
		'mainMenu'          => __( 'Menu', 'raw-child' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'raw-child' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses' => [
			'combine' => [
				'.nav-primary',
				'.nav-header',
			],
			'others' => [],
		],
	],
	'extras' => [
		'media_query_width' => '960px',
	],
];
