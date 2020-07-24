<?php

defined( 'ABSPATH' ) or die( 'Nice try!' );

// require( plugin_dir_path( __FILE__ ) . 'class-simple-settings-page.php' );

if ( ! class_exists('Custom_Order_List') ):

class Custom_Order_List {

    /**
     * Provide static variable to enforce singleton pattern
     * 
     * @var Object Instance of this class
     *
     * @since   0.0.1
     */
    private static $instance;

    public static function get_instance() {
        if( NULL == self::$instance ) {
            self::$instance = new self; // i.e., new Custom_Order_List()
        }
        return self::$instance;
    }

    public function __construct() {
        
        add_filter('manage_edit-shop_order_columns', array($this, 'set_custom_edit_order_columns'));
        add_action('manage_shop_order_posts_custom_column', array($this, 'do_custom_order_column'), 10, 2);

    }

    public function set_custom_edit_order_columns($columns) {
        $new_columns = array();
        foreach ($columns as $column_slug => $column_name) {
            $new_columns[$column_slug] = $column_name;
            if ($column_slug === 'order_status') {
                $new_columns['pickup_date'] = __('Pickup Date', RDCE_CUSTOM_ORDER_LIST_TEXT_DOMAIN);
            }
        }
        return $new_columns;
    }

    public function do_custom_order_column($column, $post_id) {
        switch ($column) {
            case 'pickup_date':
                $order_meta = get_post_meta($post_id);
                if (count($pickup_date = $order_meta['pickup_date']) > 0) {
                    _e($pickup_date[0], RDCE_CUSTOM_ORDER_LIST_TEXT_DOMAIN);
                }
                break;
            default:
                break;
        }
    }


}

endif;