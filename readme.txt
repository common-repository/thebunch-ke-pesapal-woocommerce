=== TheBunch KE Pesapal Gateway for Woocommerce ===
Contributors: rixeo
Donate link: https://www.paypal.me/paultitude
Tags: pesapal, woocommerce, ecommerce, gateway, payment
Requires at least: 5.0
Tested up to: 6.0.2
Requires PHP: 5.6
Stable tag: 1.4.8
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

== Description ==

Simple and easy to use plugin for pesapal.com payment gateway. The plugins allows for currencies from Kenya, Tanzania and Uganda

Please raise any issues though [our support page](https://wordpress.org/support/plugin/thebunch-ke-pesapal-woocommerce), thanks.

You will need to set up the IPN call backs. Cron's are not supported in this version

If you like this plugin consider [donating](https://www.paypal.me/paultitude) a few bob for a coffee :)



== Installation ==

1. Upload `thebunchke-pesapal-woocommerce` directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Enter your consumer and secret key in the Payment Gateway section of the Woocommerce settings page.
1. Enable the gateway.
1. **Test before production!**


== Changelog ==

= 1.4.8 =
* Fix: Remove currencies that are already supported in WooCommerce.
* Fix: Code improvements.

= 1.4.7 =
* Fix : Order status update for completed purchases

= 1.4.6 =
* Fix : Jquery scripts

= 1.4.5 =
Fixed : Checkout error
New : Introduced Rest IPN url. This will be defined in the settings of the gateway

= 1.4.4 =
Fixed : Check for IPN in request as at times it fails on the WooCommerce IPN url. This will ensure IPN is picked at all times


= 1.4.3 =
Fixed : Order id reference in background cron

= 1.4.2 =
Fixed : Product name quotes

= 1.4.1 =
Fixed : Handling of products on checkout

= 1.4.0 =
Added : WooCommerce order prefix
Added : New setting for background cron to check order status
Improved : Gateway class now in seperate file

= 1.3.2 =
Added : Better logging


= 1.3.1 =
Fix : IPN URL. Leave protocol as the site protocol as there could be issues pussing the IPN

= 1.3 =
Fix: PesaPal lib update fix for php 7.x

= 1.2 =
Fix: IPN callback

= 1.1.9.3 =
Fix: PesaPal Demo URL Https

= 1.1.9.2 =
Improvement : Remove unused code
Fix : PesaPal IPN method

= 1.1.9.1 =
Fix : Webhook URL

= 1.1.9 =
* Update from Curl to WordPress HTTP API
* Fix WooCommerce deprecated functions

= 1.1.8 =
* Fixed : Error on IPN


= 1.1.7 =
Version bump

= 1.1.6 =
Version bump


= 1.1.5 =
Fix on order status

= 1.1.4 =
Version bump

= 1.1.3 =
Added a Preloader when the PesaPal payment page is still loading

= 1.1.2 =
Fixes

= 1.1.1 =
Fix to redirect

= 1.1.0 =
1. Fixes on the WooCommerce API Methods
1. Removed unecessary functions

= 1.0.5 =
Fix on the function before_pay() which prevents a user from paying twice for the same order

= 1.0.4 =
Fixes on Oauth libs to avoid conflict with Twitters libraries if present

= 1.0.3 =
Working now. Redirects from PesaPal Payment to thank you page

= 1.0.2 =
Redirect URL from PesaPal

= 1.0.1 =
Fixed functions that were preventing checkout from completing. 


= 1.0 =
New Plugin to handle PesaPal payments