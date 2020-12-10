<?php
/**
 * Genesis sample.
 *
 * Landing page content optionally installed after theme activation.
 *
 * Visit `/wp-admin/admin.php?page=genesis-getting-started` to trigger import.
 *
 * @package Raw Child
 * @author  rawsta
 * @license GPL-2.0-or-later
 *  @link    https://github.com/rawsta/raw-child/
 */

// Photo by Felipe Dolce on Unsplash.
$raw_child_landing_image_url = CHILD_URL . '/config/import/images/landing.jpg';

return <<<CONTENT
<!-- wp:image {"id":1377} -->
<figure class="wp-block-image"><img src="$raw_child_landing_image_url" alt="BoomBoxBurning" class="wp-image-1377"/><figcaption> Photo by <a href="https://www.google.com" target="_blank" rel="noreferrer noopener" aria-label=" (opens in a new tab)">Unknown</a></figcaption></figure>
<!-- /wp:image -->

<!-- wp:paragraph -->
<p>This is an example of a WordPress post, you could edit this to put information about yourself so readers know where you are coming from. You can create as many posts as you like in order to share with them what is on your mind.</p>
<!-- /wp:paragraph -->

<!-- wp:quote -->
<blockquote class="wp-block-quote"><p>“There are only two places in the world where we can live happy: at home and in Paris.”<br></p><cite>— Ernest Hemingway</cite></blockquote>
<!-- /wp:quote -->

<!-- wp:paragraph -->
<p>This is an example of a WordPress post, you could edit this to put information about yourself so readers know where you are coming from. You can create as many posts as you like in order to share with them what is on your mind.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4} -->
<h4>This is a Sample Heading</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>This is an example of a WordPress post, you could edit this to put information about yourself so readers know where you are coming from. You can create as many posts as you like in order to share with them what is on your mind.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Here’s a sample paragraph with a custom background color:</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"customBackgroundColor":"#f5f5f5"} -->
<p style="background-color:#f5f5f5" class="has-background">This is an example of a WordPress post, you could edit this to put information about yourself so readers know where you are coming from. You can create as many posts as you like in order to share with them what is on your mind.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>This is an example of a WordPress post, you could edit this to put information about yourself so readers know where you are coming from. You can create as many posts as you like in order to share with them what is on your mind. This is an example of a WordPress post, you could edit this to put information about yourself so readers know where you are coming from. You can create as many posts as you like in order to share with them what is on your mind.</p>
<!-- /wp:paragraph -->
CONTENT;
