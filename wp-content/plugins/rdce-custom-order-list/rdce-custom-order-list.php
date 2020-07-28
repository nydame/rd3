<?php 
/*
Version: 1.0.0
Text Domain: rdce-custom-order-list
Plugin Name: RDCE Custom Order List

Author URI: https://go-firefly.com
Author: Felicia Betancourt

Plugin URI: https://go-firefly.com
Description: This customizes the WooCommerce Orders list in the Dashboard.

*/

defined('ABSPATH') or die('Nice try!');

define('RDCE_CUSTOM_ORDER_LIST_VERSION', '1.0.0');
define('RDCE_CUSTOM_ORDER_LIST_TEXT_DOMAIN', 'rdce-custom-order-list');

require_once( plugin_dir_path( __FILE__ ) . 'class-custom-order-list.php' );
Custom_Order_List::get_instance();
