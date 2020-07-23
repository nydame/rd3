<?php
/**
 * WC_GC_Compatibility class
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
 * Handles compatibility with other WC extensions.
 *
 * @class    WC_GC_Compatibility
 * @version  1.1.5
 */
class WC_GC_Compatibility {

	/**
	 * Min required plugin versions to check.
	 *
	 * @var array
	 */
	private static $required = array(
		'wc_stripe' => '4.0.0'
	);

	/**
	 * Setup compatibility class.
	 */
	public static function init() {
		// Initialize.
		self::load_modules();
	}

	/**
	 * Initialize.
	 *
	 * @return void
	 */
	protected static function load_modules() {

		if ( is_admin() ) {
			// Check plugin min versions.
			add_action( 'admin_init', array( __CLASS__, 'add_compatibility_notices' ) );
		}

		// Include core compatibility class.
		self::core_includes();

		// Load modules.
		add_action( 'plugins_loaded', array( __CLASS__, 'module_includes' ), 100 );

		// Prevent initialization of deprecated mini-extensions usually loaded on 'plugins_loaded' -- 10.
		self::unload_modules();
	}

	/**
	 * Core compatibility functions.
	 *
	 * @return void
	 */
	public static function core_includes() {
		require_once  WC_GC_ABSPATH . 'includes/compatibility/core/class-wc-gc-core-compatibility.php' ;
	}

	/**
	 * Prevent deprecated mini-extensions from initializing.
	 *
	 * @return void
	 */
	protected static function unload_modules() {
		// Silence.
	}

	/**
	 * Load compatibility classes.
	 *
	 * @return void
	 */
	public static function module_includes() {

		$module_paths = array();

		// WooCommerce PDF Invoices & Packing Slips by Ewout Fernhout support.
		if ( class_exists( 'WPO_WCPDF' ) ) {
			$module_paths[ 'wpowcpdf' ] = 'modules/class-wc-gc-wpowcpdf-compatibility.php';
		}

		// WooCommerce PIP.
		if ( class_exists( 'WC_PIP' ) ) {
			$module_paths[ 'pip' ] = 'modules/class-wc-gc-pip-compatibility.php';
		}

		// WC Stripe support.
		if ( class_exists( 'WC_Stripe' ) && defined( 'WC_STRIPE_VERSION' ) && version_compare( WC_STRIPE_VERSION, self::$required[ 'wc_stripe' ] ) >= 0 ) {
			$module_paths[ 'wc_stripe' ] = 'modules/class-wc-gc-stripe-compatibility.php';
		}

		/**
		 * 'woocommerce_gc_compatibility_modules' filter.
		 *
		 * Use this to filter the required compatibility modules.
		 *
		 * @since  1.0.0
		 * @param  array $module_paths
		 */
		$module_paths = apply_filters( 'woocommerce_gc_compatibility_modules', $module_paths );

		foreach ( $module_paths as $name => $path ) {
			require_once $path ;
		}
	}

	/**
	 * Checks versions of compatible/integrated/deprecated extensions.
	 *
	 * @return void
	 */
	public static function add_compatibility_notices() {

		// WC Stripe version check.
		if ( class_exists( 'WC_Stripe' ) ) {

			$required_version = self::$required[ 'wc_stripe' ];

			if ( ! defined( 'WC_STRIPE_VERSION' ) || version_compare( WC_STRIPE_VERSION, $required_version ) < 0 ) {

				$extension      = __( 'Stripe Gateway', 'woocommerce-gift-cards' );
				$extension_full = __( 'WooCommerce Stripe Gateway', 'woocommerce-gift-cards' );
				$extension_url  = 'https://woocommerce.com/products/stripe/';
				$notice         = sprintf( __( 'The installed version of <strong>%1$s</strong> is not supported by <strong>Gift Cards</strong>. Please update <a href="%2$s" target="_blank">%3$s</a> to version <strong>%4$s</strong> or higher.', 'woocommerce-gift-cards' ), $extension, $extension_url, $extension_full, $required_version );

				WC_GC_Admin_Notices::add_dismissible_notice( $notice, array( 'dismiss_class' => 'wc_stripe_lt_' . $required_version, 'type' => 'warning' ) );
			}
		}
	}
}

WC_GC_Compatibility::init();
