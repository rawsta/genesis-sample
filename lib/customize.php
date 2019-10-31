<?php
/**
 * Raw Child.
 *
 * This file adds the Customizer additions to the Raw Child Theme.
 *
 * @package Raw Child
 * @author  rawsta
 * @license GPL-2.0-or-later
 * @link    https://www.rawsta.de/
 */

add_action( 'customize_register', 'raw_child_customizer_register' );
/**
 * Registers settings and controls with the Customizer.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function raw_child_customizer_register( $wp_customize ) {

	$appearance = genesis_get_config( 'appearance' );

	$wp_customize->add_setting(
		'raw_child_link_color',
		[
			'default'           => $appearance['default-colors']['link'],
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'raw_child_link_color',
			[
				'description' => __( 'Change the color of post info links and button blocks, the hover color of linked titles and menu items, and more.', 'raw-child' ),
				'label'       => __( 'Link Color', 'raw-child' ),
				'section'     => 'colors',
				'settings'    => 'raw_child_link_color',
			]
		)
	);

	$wp_customize->add_setting(
		'raw_child_accent_color',
		[
			'default'           => $appearance['default-colors']['accent'],
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'raw_child_accent_color',
			[
				'description' => __( 'Change the default hover color for button links, menu buttons, and submit buttons. The button block uses the Link Color.', 'raw-child' ),
				'label'       => __( 'Accent Color', 'raw-child' ),
				'section'     => 'colors',
				'settings'    => 'raw_child_accent_color',
			]
		)
	);

	$wp_customize->add_setting(
		'raw_child_logo_width',
		[
			'default'           => 350,
			'sanitize_callback' => 'absint',
			'validate_callback' => 'raw_child_validate_logo_width',
		]
	);

	// Add a control for the logo size.
	$wp_customize->add_control(
		'raw_child_logo_width',
		[
			'label'       => __( 'Logo Width', 'raw-child' ),
			'description' => __( 'The maximum width of the logo in pixels.', 'raw-child' ),
			'priority'    => 9,
			'section'     => 'title_tagline',
			'settings'    => 'raw_child_logo_width',
			'type'        => 'number',
			'input_attrs' => [
				'min' => 100,
			],

		]
	);

}

/**
 * Displays a message if the entered width is not numeric or greater than 100.
 *
 * @param object $validity The validity status.
 * @param int    $width The width entered by the user.
 * @return int The new width.
 */
function raw_child_validate_logo_width( $validity, $width ) {

	if ( empty( $width ) || ! is_numeric( $width ) ) {
		$validity->add( 'required', __( 'You must supply a valid number.', 'raw-child' ) );
	} elseif ( $width < 100 ) {
		$validity->add( 'logo_too_small', __( 'The logo width cannot be less than 100.', 'raw-child' ) );
	}

	return $validity;

}
