<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://refactorr.com/wordpress-plugins/woocommerce-minimum-order-amount/
 * @since             1.0.0
 * @package           Woo_Min_Order_Amount
 *
 * @wordpress-plugin
 * Plugin Name:       Minimum Order Amount for Checkout
 * Plugin URI:        https://refactorr.com/wordpress-plugins/woocommerce-minimum-order-amount/
 * Description:       Set a minimum order amount for Woocommerce orders.  Shows a notice in cart and validates at checkout before order can be placed.
 * Version:           1.1.1
 * Author:            Refactorr
 * Author URI:        https://refactorr.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-min-order-amount
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WOO_MIN_ORDER_AMOUNT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo-min-order-amount-activator.php
 */
function activate_woo_min_order_amount() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-min-order-amount-activator.php';
	Woo_Min_Order_Amount_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo-min-order-amount-deactivator.php
 */
function deactivate_woo_min_order_amount() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-min-order-amount-deactivator.php';
	Woo_Min_Order_Amount_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woo_min_order_amount' );
register_deactivation_hook( __FILE__, 'deactivate_woo_min_order_amount' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woo-min-order-amount.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woo_min_order_amount() {

	$plugin = new Woo_Min_Order_Amount();
	$plugin->run();

}
run_woo_min_order_amount();
