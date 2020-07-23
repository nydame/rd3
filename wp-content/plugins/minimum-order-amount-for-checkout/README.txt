=== Minimum Order Amount for Checkout ===
Contributors: sbstocker
Donate link: https://refactorr.com/donate/
Tags: woocommerce, order, order amount, order total, minimum order, minimum purchase, cart, checkout, woo
Requires at least: 3.0.1
Tested up to: 5.4
Stable tag: 1.1.1
Requires PHP: 7.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Set a minimum purchase amount for Woocommerce orders.  Displays a validation message on both the cart and checkout pages and prevents orders below the set amount.

== Description ==

The **Minimum Order Amount for Checkout** plugin allows you to set a minimum purchase amount for Woocommerce orders.  The minimum amount can be based on the cart's subtotal or total (including fees and taxes).  The plugin displays a customizable error notification on both the cart and checkout pages. It also prevents an order from being submitted until the threshold amount has been satisfied.

The cart and checkout validation messages can be customized in the Woocommerce settings.



== Installation ==

To install and configure the plugin:

1.  Upload the plugin to the `/wp-content/plugins/` directory, or install the plugin through the WordPress 'Plugins -> Add New' screen.
2.  Activate the plugin on the 'Plugins -> Installed Plugins' page in WordPress.
3.  Navigate to 'Woocommerce -> Settings' and update the settings under the 'Minimum Order Amount' tab.

Under settings, you can set: 

* the minimum order amount
* the validation message text to display on the Cart pages
* the validation message text to display on the Checkout page
* whether the validation message should be triggered on the cart's subtotal or total (including fees / taxes)
* the URL and link text for a 'Continue Shopping' link in the validation message

When editing the validation message, there are three replacement strings available which will display the corresponding values in the message:

*  [minimum] -  the minimum order amount in your set currency, e.g. "$50.00".
*  [total]   -  the value used for triggering the message, either "total" or "subtotal".
*  [current] -  the cart's current total or subtotal in your set currency, e.g. "$25.00". 


== Frequently Asked Questions ==

= Who can I contact for support or suggestions? =

You can reach us at [https://refactorr.com/contact-us/]([https://refactorr.com/contact-us/]).



== Screenshots ==

1.  This is the plugin admin page found in 'WooCommerce -> Settings' in the 'Minimum Order Amount' tab.
2.  This is a screenshot of how the default validation message appears in the Cart.

== Changelog ==

= 1.1.1 =
* Add "Continue Shopping Link Text" setting, so you can customize the text that appears in the optional "Continue Shopping" link.

= 1.1 =
* Add "Continue Shopping Link" setting, to add an optional link back to your store page in the validation message.

= 1.0.2 = 
* Bug fix for validation message in checkout process.

= 1.0.1 = 
* Fix 'uninstall' function to properly clean up when plugin is removed.

= 1.0 =
* Initial release.

