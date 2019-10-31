/**
 * Trigger AJAX request to save state when the WooCommerce notice is dismissed.
 *
 * @version 2.3.0
 *
 * @author rawsta
 * @license GPL-2.0-or-later
 * @package RawChild
 */

jQuery( document ).on(
	'click', '.raw-child-woocommerce-notice .notice-dismiss', function() {

		jQuery.ajax(
			{
				url: ajaxurl,
				data: {
					action: 'raw_child_dismiss_woocommerce_notice'
				}
			}
		);

	}
);
