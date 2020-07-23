<?php
/**
 * WC_GC_Notices class
 *
 * @author   SomewhereWarm <info@somewherewarm.com>
 * @package  WooCommerce Gift Cards
 * @since    1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Notice handling.
 *
 * @class    WC_GC_Notices
 * @version  1.3.2
 */
class WC_GC_Notices {

	/**
	 * Constructor.
	 */
	public static function init() {
		add_action( 'woocommerce_gc_queue_test', array( __CLASS__, 'run_queue_test' ) );
	}


	/**
	 * Shuts down the 'queue' maintenance notice.
	 */
	public static function run_queue_test() {

		if ( ! class_exists( 'WC_GC_Admin_Notices' ) ) {
			require_once  WC_GC_ABSPATH . 'includes/admin/class-wc-gc-admin-notices.php' ;
		}

		WC_GC_Admin_Notices::remove_maintenance_notice( 'queue' );
		WC_GC_Admin_Notices::save_notices();
	}
}

WC_GC_Notices::init();
