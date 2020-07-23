<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://refactorr.com/wordpress-plugins/woocommerce-minimum-order-amount/
 * @since      1.0.0
 *
 * @package    Woo_Min_Order_Amount
 * @subpackage Woo_Min_Order_Amount/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Woo_Min_Order_Amount
 * @subpackage Woo_Min_Order_Amount/public
 * @author     Scott Stocker <scott@refactorr.com>
 */
class Woo_Min_Order_Amount_Public
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/woo-min-order-amount-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/woo-min-order-amount-public.js', array('jquery'), $this->version, false);
	}

	/**
	 * Display the validation message on the cart or checkout page.
	 */

	public function woo_min_order_amount_cart()
	{
		$minimum = get_option('woo_min_order_amount_value');
		$trigger_value = get_option('woo_min_order_trigger_value');
		$shop_link = get_option('woo_min_order_amount_shop_link');
		$shop_link_text = get_option('woo_min_order_amount_shop_link_text') ? get_option('woo_min_order_amount_shop_link_text') : 'Continue Shopping';
		$cart_value = 0;
		if ('subtotal' == $trigger_value) {
			$cart_value =  wc()->cart->subtotal;
		} else {
			$cart_value =  wc()->cart->total;
		}

		if ($minimum && ($cart_value < $minimum)) {
			if (is_cart()) { // get cart message
				wc_print_notice($this->get_message(
					get_option('woo_min_order_amount_cart_message'),
					$minimum,
					$trigger_value,
					$cart_value,
					$shop_link,
					$shop_link_text
				),	'error');
			} else { // get checkout message
				wc_print_notice($this->get_message(
					get_option('woo_min_order_amount_checkout_message'),
					$minimum,
					$trigger_value,
					$cart_value,
					$shop_link,
					$shop_link_text
				),	'error');
			}
		}
	}

	/**
	 * Display the validation message when validating the order on the checkout page.
	 */
	public function woo_min_order_amount_checkout($fields, $errors)
	{
		$minimum = get_option('woo_min_order_amount_value');
		$trigger_value = get_option('woo_min_order_trigger_value');
		$shop_link = get_option('woo_min_order_amount_shop_link');
		$shop_link_text = get_option('woo_min_order_amount_shop_link_text') ? get_option('woo_min_order_amount_shop_link_text') : 'Continue Shopping';
		$cart_value = 0;
		if ('subtotal' == $trigger_value) {
			$cart_value =  wc()->cart->subtotal;
		} else {
			$cart_value =  wc()->cart->total;
		}
		if ($minimum && ($cart_value < $minimum)) {
			$errors->add('validation', $this->get_message(
				get_option('woo_min_order_amount_cart_message'),
				$minimum,
				$trigger_value,
				$cart_value,
				$shop_link,
				$shop_link_text
			));
		}
	}

	private function get_message($message, $minimum, $trigger_value, $cart_total, $shop_link, $shop_link_text)
	{
		$price_format = get_woocommerce_price_format();
		$price_format_current = str_replace(array('1', '2'), array('3', '4'), $price_format);
		$decimal_separator = wc_get_price_decimal_separator();
		$thousand_separator = wc_get_price_thousand_separator();
		$num_decimals = wc_get_price_decimals();
		$currency_symbol = get_woocommerce_currency_symbol();

		$parsedMessage = str_replace('[minimum]', $price_format, $message);
		$parsedMessage = str_replace('[total]', $trigger_value, $parsedMessage);
		$parsedMessage = str_replace('[current]', $price_format_current, $parsedMessage);

		if ($shop_link) {
			$parsedMessage .= '&nbsp;&nbsp;  <a class=\"min_order_amount_shop_link\" href=\"' . $shop_link . '\" style="text-decoration: underline">' . $shop_link_text . '</a>';
		}

		return sprintf(
			$parsedMessage,
			$currency_symbol,
			number_format($minimum, $num_decimals, $decimal_separator, $thousand_separator),
			$currency_symbol,
			number_format($cart_total, $num_decimals, $decimal_separator, $thousand_separator)
		);
	}
}
