<?php
/**
 * Raw Child.
 *
 * Onboarding config shared between Starter Packs.
 *
 * Genesis Starter Packs give you a choice of content variation when activating
 * the theme. The content below is common to all packs for this theme.
 *
 * @package Raw Child
 * @author  rawsta
 * @license GPL-2.0-or-later
 *  @link    https://github.com/rawsta/raw-child/
 */

return [
	'plugins'          => [
		[
			'name'       => __( 'Genesis Blocks', 'raw-child' ),
			'slug'       => 'genesis-blocks/genesis-blocks.php',
			'public_url' => 'https://wordpress.org/plugins/genesis-blocks/',
		],
		[
			'name'       => __( 'Simple Social Icons', 'raw-child' ),
			'slug'       => 'simple-social-icons/simple-social-icons.php',
			'public_url' => 'https://wordpress.org/plugins/simple-social-icons/',
		],
		[
			'name'       => __( 'Antispam Bee (Third Party)', 'raw-child' ),
			'slug'       => 'antispam-bee/antispam_bee.php',
			'public_url' => 'https://wordpress.org/plugins/antispam-bee/',
		],
		[
			'name'       => __( 'Contact Form 7 (Third Party)', 'raw-child' ),
			'slug'       => 'contact-form-7/wp-contact-form-7.php',
			'public_url' => 'https://wordpress.org/plugins/contact-form-7/',
		],
	],
	'content'          => [
		'blocks'  => [
			'post_title'     => 'Block Beispiele',
			'post_content'   => require dirname( __FILE__ ) . '/import/content/block-examples.php',
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
			'meta_input'     => [ '_genesis_layout' => 'full-width-content' ],
		],
		'about'   => [
			'post_title'     => '&Uuml;ber uns',
			'post_content'   => require dirname( __FILE__ ) . '/import/content/about.php',
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'featured_image' => CHILD_URL . '/config/import/images/about.jpg',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
			'meta_input'     => [
				'_genesis_layout'              => 'full-width-content',
				'_genesis_hide_singular_image' => true,
			],
		],
		'contact' => [
			'post_title'     => 'Contact Us',
			'post_content'   => require dirname( __FILE__ ) . '/import/content/contact.php',
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
		],
		'landing' => [
			'post_title'     => 'Landing Page',
			'post_content'   => require dirname( __FILE__ ) . '/import/content/landing-page.php',
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'page_template'  => 'page-templates/landing.php',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
			'meta_input'     => [
				'_genesis_layout'              => 'full-width-content',
				'_genesis_hide_breadcrumbs'    => true,
				'_genesis_hide_singular_image' => true,
			],
		],
	],
	'navigation_menus' => [
		'primary' => [
			'homepage' => [
				'title' => 'Start',
			],
			'about'    => [
				'title' => '&Uuml;ber Uns',
			],
			'blocks'   => [
				'title' => 'Block Beispiele',
			],
			'landing'  => [
				'title' => 'Landing Page',
			],
			'contact'  => [
				'title' => 'Kontakt',
			],
		],
	],
	'widgets'          => [
		'footer-1' => [
			[
				'type' => 'text',
				'args' => [
					'title'  => 'Design',
					'text'   => '<p>With an emphasis on typography, white space, and mobile-optimized design, your website will look absolutely breathtaking.</p><p><a href="#">Learn more about design</a>.</p>',
					'filter' => 1,
					'visual' => 1,
				],
			],
		],
		'footer-2' => [
			[
				'type' => 'text',
				'args' => [
					'title'  => 'Content',
					'text'   => '<p>Our team will teach you the art of writing audience-focused content that will help you achieve the success you truly deserve.</p><p><a href="#">Learn more about content</a>.</p>',
					'filter' => 1,
					'visual' => 1,
				],
			],
		],
		'footer-3' => [
			[
				'type' => 'text',
				'args' => [
					'title'  => 'Strategie',
					'text'   => '<p>We help creative entrepreneurs build their digital business by focusing on three key elements of a successful online platform.</p><p><a href="#">Learn more about strategy</a>.</p>',
					'filter' => 1,
					'visual' => 1,
				],
			],
		],
	],
];
