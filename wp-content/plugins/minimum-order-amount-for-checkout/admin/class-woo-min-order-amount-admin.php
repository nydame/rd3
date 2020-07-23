<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://refactorr.com/wordpress-plugins/woocommerce-minimum-order-amount/
 * @since      1.0.0
 *
 * @package    Woo_Min_Order_Amount
 * @subpackage Woo_Min_Order_Amount/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woo_Min_Order_Amount
 * @subpackage Woo_Min_Order_Amount/admin
 * @author     Scott Stocker <scott@refactorr.com>
 */
class Woo_Min_Order_Amount_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Min_Order_Amount_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Min_Order_Amount_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/woo-min-order-amount-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Min_Order_Amount_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Min_Order_Amount_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/woo-min-order-amount-admin.js', array('jquery'), $this->version, false);
	}

	/**
	 * Add the "Minimum Order Amount tab on Woocommerce settings page.
	 * 
	 */

	public static function add_settings_tab($settings_tabs)
	{
		$settings_tabs['settings_tab_min_order'] = __('Minimum Order Amount', 'woocommerce-settings-tab-min-order');
		return $settings_tabs;
	}

	/**
	 * Uses the WooCommerce admin fields API to output settings via the @see woocommerce_admin_fields() function.
	 *
	 * @uses woocommerce_admin_fields()
	 * @uses self::get_settings()
	 */
	public static function settings_tab()
	{
		woocommerce_admin_fields(self::get_settings());
	}


	/**
	 * Uses the WooCommerce options API to save settings via the @see woocommerce_update_options() function.
	 *
	 * @uses woocommerce_update_options()
	 * @uses self::get_settings()
	 */
	public static function update_settings()
	{
		woocommerce_update_options(self::get_settings());
	}

	/**
	 * Build all the settings options for this plugin for @see woocommerce_admin_fields() function.
	 *
	 * @return array Array of settings for @see woocommerce_admin_fields() function.
	 */
	public static function get_settings()
	{

		$settings = array(
			'section_title' => array(
				'name'     => __('Minimum Order Amount', 'woocommerce-settings-tab-min-order'),
				'type'     => 'title',
				'desc'     => 'Set a minimum purchase amount for orders.',
				'id'       => 'woo_min_order_amount_section_title'
			),
			'amount_value' => array(
				'title'             => __('Order minimum', 'woocommerce-settings-tab-min-order'),
				'desc'              => __('Set a minimum purchase amount for orders.  Leave empty to accept any order amount.', 'woocommerce-settings-tab-min-order'),
				'id'                => 'woo_min_order_amount_value',
				'default'           => '',
				'type'              => 'number',
				'desc_tip'          => true,
				'css'      => 'width:70px;',
			),
			'trigger_value' => array(
				'title'             => __('Apply to', 'woocommerce-settings-tab-min-order'),
				'desc'              => __('Should the order minimum be applied to the cart total (including taxes/fees) or the subtotal?', 'woocommerce-settings-tab-min-order'),
				'id'                => 'woo_min_order_trigger_value',
				'options'           => array(
					'total' => __('Total', 'woocommerce-settings-tab-min-order'),
					'subtotal' => __('Subtotal', 'woocommerce-settings-tab-min-order'),
				),
				'default'           => 'total',
				'type'              => 'radio',
				'desc_tip'          => true,
			),
			'cart_message' => array(
				'title'    => __('Cart message', 'woocommerce-settings-tab-min-order'),
				'desc'     => __('Display this warning in CART. Replacements: [minimum] = order minimum; [current] = current total. [total] = total or subtotal.', 'woocommerce-settings-tab-min-order'),
				'id'       => 'woo_min_order_amount_cart_message',
				'default'  => 'A minimum order of [minimum] is required. Your cart\'s current [total] is [current].',
				'type'     => 'text',
				'desc_tip' => true,
				'css'      => 'width:100%;  max-width: 800px;',
			),
			'checkout_message' => array(
				'title'    => __('Checkout message', 'woocommerce-settings-tab-min-order'),
				'desc'     => __('Display this warning at CHECKOUT. Replacements: [minimum] = order minimum; [current] = current total. [total] = total or subtotal.', 'woocommerce-settings-tab-min-order'),
				'id'       => 'woo_min_order_amount_checkout_message',
				'default'  => 'A minimum order of [minimum] is required. Your cart\'s current [total] is [current].',
				'type'     => 'text',
				'desc_tip' => true,
				'css'      => 'width:100%; max-width: 800px;',
			),
			'continue_shopping_link' => array(
				'title'    => __('Continue Shopping Link', 'woocommerce-settings-tab-min-order'),
				'desc'     => __('URL for Continue Shopping link.  Leave blank for no link.', 'woocommerce-settings-tab-min-order'),
				'id'       => 'woo_min_order_amount_shop_link',
				'default'  => '/shop',
				'type'     => 'text',
				'desc_tip' => true,
				'css'      => 'width:100%; max-width: 800px;',
			),
			'continue_shopping_link_text' => array(
				'title'    => __('Continue Shopping Link Text', 'woocommerce-settings-tab-min-order'),
				'desc'     => __('Text for Continue Shopping link.', 'woocommerce-settings-tab-min-order'),
				'id'       => 'woo_min_order_amount_shop_link_text',
				'default'  => 'Continue Shopping',
				'type'     => 'text',
				'desc_tip' => true,
				'css'      => 'width:100%; max-width: 800px;',
			),

			'section_end' => array(
				'type' => 'sectionend',
				'id' => 'woo_min_order_amount_section_end'
			)
		);

		return apply_filters('woo_min_order_amount_settings', $settings);
	}
}
