<?php
/**
 * Raw Child.
 *
 *
 * @package Raw Child
 * @author  rawsta
 * @license GPL-2.0-or-later
 *  @link    https://github.com/rawsta/raw-child/
 */

add_action('wp_footer','header_sticky_script');
/**
 * Hide Header on Scroll Down but Show when Scroll Up
 *
 */
function header_sticky_script()
{
?>
	<script>
		var didScroll;
		var lastScrollTop = 0;
		var delta = 5;
		var navbarHeight = '';

		jQuery(window).load( function() {
			navbarHeight = jQuery('header.site-header').outerHeight();
			jQuery('body').css('paddingTop',navbarHeight);
		});

		jQuery(window).scroll(function(event){
			didScroll = true;
		});

		setInterval(function() {
			if (didScroll) {
				ghasScrolled();
				didScroll = false;
			}
		}, 250);

		function hasScrolled()
		{
			var st = jQuery(this).scrollTop();

			// Make sure to scroll more than delta
			if(Math.abs(lastScrollTop - st) <= delta)
				return;

			// If scrolled down and are past the navbar
			// This is necessary so you never see what is "behind" the navbar.
			if (st > lastScrollTop && st > navbarHeight){
				// Scroll Down
				jQuery('header.site-header').css('top',-navbarHeight).removeClass('shadow');
			} else {
				// Scroll Up
				if(st + jQuery(window).height() < jQuery(document).height()) {
					jQuery('header.site-header').css('top',0).addClass('shadow');
				}
			}

			if (st < 15){
				jQuery('header.site-header').css('top',0).removeClass('shadow');
			}

			lastScrollTop = st;
		}
	</script>
<?php
}
