<?php

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

add_filter( 'add_to_cart_text', 'wcpt_modify_add_to_cart_text', 999 );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'wcpt_modify_add_to_cart_text', 999 );

function wcpt_modify_add_to_cart_text( $text ) {
    if ( did_action( 'wc_product_table_before_get_data' ) ) {
        $text = 'Add'; // change as required
     }
     return $text;
 }