<?php
/**
 * Use this file for all your template filters and actions.
 * Requires WooCommerce PDF Invoices & Packing Slips 1.4.13 or higher
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action('wpo_wcpdf_before_order_details', 'rd3_wcpdf_insert_pickup_date_time', 10, 2);

function rd3_wcpdf_insert_pickup_date_time($template_type, $order) {
  if ($template_type === 'packing-slip') : 
    // $ps = wcpdf_get_document($template_type, $order); 
    $pickup_date = $order->get_meta('pickup_date');
    $pickup_time = $order->get_meta('pickup_time');
    if ( ! empty($pickup_date) ) : ?>
      <p class="pickup">Pickup: <span class="pickup-date"><?php echo $pickup_date; ?></span> at <span class="pickup-time"><?php echo $pickup_time; ?></span></p> 
  <?php
    endif;
  endif;
}