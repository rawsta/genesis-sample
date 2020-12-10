<?php
/**
 * Raw Child appearance settings.
 *
 * @package Raw Child
 * @author  rawsta
 * @license GPL-2.0-or-later
 *  @link    https://github.com/rawsta/raw-child/
 */

$raw_child_default_colors = [
	'link'   => '#ff8300',
	'accent' => '#830000',
];

$raw_child_link_color = get_theme_mod(
	'raw_child_link_color',
	$raw_child_default_colors['link']
);

$raw_child_accent_color = get_theme_mod(
	'raw_child_accent_color',
	$raw_child_default_colors['accent']
);

$raw_child_link_color_contrast   = raw_child_color_contrast( $raw_child_link_color );
$raw_child_link_color_brightness = raw_child_color_brightness( $raw_child_link_color, 35 );

return [
	'fonts-url'            => 'https://fonts.googleapis.com/css?family=Barlow:wght@400,600,700&display=swap',
	'content-width'        => 1062,
	'button-bg'            => $raw_child_link_color,
	'button-color'         => $raw_child_link_color_contrast,
	'button-outline-hover' => $raw_child_link_color_brightness,
	'link-color'           => $raw_child_link_color,
	'default-colors'       => $raw_child_default_colors,
	'editor-color-palette' => [
		[
			'name'  => __( 'Custom color', 'raw-child' ), // Called “Link Color” in the Customizer options. Renamed because “Link Color” implies it can only be used for links.
			'slug'  => 'theme-primary',
			'color' => $raw_child_link_color,
		],
		[
			'name'  => __( 'Accent color', 'raw-child' ),
			'slug'  => 'theme-secondary',
			'color' => $raw_child_accent_color,
		],
	],
	'editor-font-sizes'    => [
		[
			'name' => __( 'Small', 'raw-child' ),
			'size' => 14,
			'slug' => 'small',
		],
		[
			'name' => __( 'Normal', 'raw-child' ),
			'size' => 18,
			'slug' => 'normal',
		],
		[
			'name' => __( 'Large', 'raw-child' ),
			'size' => 24,
			'slug' => 'large',
		],
		[
			'name' => __( 'Larger', 'raw-child' ),
			'size' => 28,
			'slug' => 'larger',
		],
	],
];
