<?php
/**
 * Raw Child.
 *
 * Contact page content optionally installed after theme activation.
 * Will create a form with WPForms and embed on the page as a WPForms block.
 *
 * Visit `/wp-admin/admin.php?page=genesis-getting-started` to trigger import.
 *
 * @package Raw Child
 * @author  rawsta
 * @license GPL-2.0-or-later
 *  @link    https://github.com/rawsta/raw-child/
 */


// Swaps the default content below with a WPForms contact form block if the WPForms plugin is active.
add_action( 'genesis_onboarding_after_import_content', 'rawsta_insert_contact_form', 10, 2 );

return <<<CONTENT
<!-- wp:paragraph -->
<p>Add a contact form to this page with the WPForms Lite plugin (Third Party). Learn <a href="https://my.studiopress.com/documentation/wpforms/plugin-usage/create-contact-forms-with-wpforms/" target="_blank" rel="noreferrer noopener" aria-label=" (opens in a new tab)">how to create a form using WPForms</a>.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p>But of course, you've got Contact Form 7 installed, so it's much easier :).</p>
<!-- /wp:paragraph -->
CONTENT;
