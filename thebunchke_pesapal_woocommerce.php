<?php
/**
 * Plugin Name:         TheBunch KE Pesapal Woocommerce
 * Plugin URI:          https://www.hubloy.com
 * Description:         Add PesaPal payment gateway to your Woocommerce plugin
 * Version:             1.4.8
 * Author:              rixeo
 * Author URI:          https://www.hubloy.com
 * License:             GPLv2
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package TheBunchKEPesaPal
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define constants.
define( 'THEBUNCHKE_PESAPAL_WOO_PLUGIN_DIR', dirname( __FILE__ ) . '/' );
define( 'THEBUNCHKE_PESAPAL_WOO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Functions called to initiate the plugin.
 */
function thebunchke_pesapal_woo_init() {

	// Load required files.

	require_once THEBUNCHKE_PESAPAL_WOO_PLUGIN_DIR . 'lib/OAuth.php';
	require_once THEBUNCHKE_PESAPAL_WOO_PLUGIN_DIR . 'lib/gateway.php';

	add_filter( 'woocommerce_payment_gateways', 'add_pesapal_gateway_class' );
	/**
	 * Add the gateway class.
	 *
	 * @param array $methods The current methods.
	 *
	 * @return array
	 */
	function add_pesapal_gateway_class( $methods ) {
		$methods[] = 'WC_TheBunchKE_PesaPal_Pay_Gateway';
		return $methods;
	}

	add_action( 'init', 'thebunchke_pesapal_woo_check_cron_status' );
}

// Initialize the plugin.
add_action( 'plugins_loaded', 'thebunchke_pesapal_woo_init' );



add_filter( 'cron_schedules', 'thebunchke_pesapal_woo_cron_recurrence_interval' );
/**
 * Add custom cron schedule.
 *
 * @param array $schedules The current schedules.
 *
 * @return array
 */
function thebunchke_pesapal_woo_cron_recurrence_interval( $schedules ) {
	$schedules['every_five_minutes'] = array(
		'interval'  => 300,
		'display'   => __( 'Every 5 Minutes', 'thebunchke_pesapal_woocommerce' )
	);
	return $schedules;
}



/**
 * Check status of cron and set it.
 *
 * @return void
 */
function thebunchke_pesapal_woo_check_cron_status() {
	if ( ! wp_next_scheduled( 'thebunchke_pesapal_woo_check_order_status' ) ) {
		wp_schedule_event( time(), 'every_five_minutes', 'thebunchke_pesapal_woo_check_order_status' );
	}
}


add_action( 'thebunchke_pesapal_woo_check_order_status', 'thebunchke_pesapal_woo_check_order_status_function' );
/**
 * Check the order status.
 *
 * @return void
 */
function thebunchke_pesapal_woo_check_order_status_function() {
	if ( class_exists( 'WC_TheBunchKE_PesaPal_Pay_Gateway' ) ) {
		new WC_TheBunchKE_PesaPal_Pay_Gateway();
	}
	do_action( 'thebunchke_pesapal_woo_bckground_cron' );
}


add_action( 'rest_api_init', 'thebunchke_pesapal_woo_rest_api' );
/**
 * Register rest route.
 *
 * @param object $wp_rest_server The rest server.
 *
 * @return void
 */
function thebunchke_pesapal_woo_rest_api( $wp_rest_server ) {
	register_rest_route(
		'thebunchke-pespal/v1',
		'ipn-listener',
		array(
			'methods'  => 'GET',
			'callback' => 'thebunchke_pesapal_woo_check_ipn_function',
		)
	);
}

/**
 * IPN check function.
 */
function thebunchke_pesapal_woo_check_ipn_function() {
	if ( class_exists( 'WC_TheBunchKE_PesaPal_Pay_Gateway' ) ) {
		$wc_thebunch_pesapal_instance = new WC_TheBunchKE_PesaPal_Pay_Gateway();
		$wc_thebunch_pesapal_instance->ipn_response();
	} else {
		return 'invalid';
	}
}
