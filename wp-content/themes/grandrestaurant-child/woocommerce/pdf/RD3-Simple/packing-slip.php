<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

$order_meta = get_post_meta($this->order->id);
$is_pickup_order = count( $order_meta['pickup_date'] ) > 0;

do_action( 'wpo_wcpdf_before_document', $this->type, $this->order );
// echo "<pre>";
// var_dump($this->settings);
// echo "</pre>";
// echo "<pre>";
// var_dump($this->order);
// echo "</pre>";
// echo "<pre>";
// print_r($order_meta);
// echo "</pre>";
?>
<table class="head container">
	<tr>
		<td class="header">
		<?php
		if( $this->has_header_logo() ) {
			$this->header_logo();
		}
		?>
		</td>
		<td class="shop-info">
			<div class="shop-name"><h3><?php $this->shop_name(); ?></h3></div>
			<div class="shop-address"><?php $this->shop_address(); ?></div>
		</td>
	</tr>
</table>

<?php do_action( 'wpo_wcpdf_after_document_label', $this->type, $this->order ); ?>

<table class="order-data-addresses">
	<tr>
		<td class="customer">
			<h2><?php _e($order_meta['_shipping_first_name'][0], 'woocommerce-pdf-invoices-packing-slips'); echo "&nbsp;"; _e($order_meta['_shipping_last_name'][0], 'woocommerce-pdf-invoices-packing-slips') ?></h2>
			
			<?php if ( isset($this->settings['display_email']) ) { ?>
				<div class="billing-email"><?php $this->billing_email(); ?></div>
			<?php } 
			if ( isset($order_meta['_shipping_phone']) ) { 
			$phone = $order_meta['_shipping_phone'][0]; 
			$pattern = 
				'/^\s*1?\s*(?\s*(\d{3})\s*)?\s*(\d{3})\s*-?\s*(\d{4})/';
			$replacement = '\1\2\3';
			$phone_digits = preg_replace($pattern, $replacement, $phone);
			$us_formatted_phone = "(" . substr($phone_digits, 0, 3) . ") " . substr($phone_digits, 3, 3) . " - " . substr($phone_digits, 6, 4); ?>
				<div class="billing-phone"><?php _e($us_formatted_phone) ?></div>
				<br />
			<?php } 
			if ( isset(($order_meta['_shipping_address_1'])) ) { ?>
				<div class="shipping-address"><?php _e($order_meta['_shipping_address_1'][0]) ?></div>
			<?php }
			if ( isset( $order_meta['_shipping_city'] ) && isset( $order_meta['_shipping_state'] )  ) { 
			?>
				<div class="shipping-city-state">
					<span class="shipping-city"><?php _e($order_meta['_shipping_city'][0]) ?></span>,
					<span class="shipping-state"><?php _e(" " . $order_meta['_shipping_state'][0]) ?></span>
					<span class="shipping-postcode"><?php _e(" " . $order_meta['_shipping_postcode'][0]) ?></span>				
				</div>
			<?php } ?>
		</td>
		<td class="address">
			<?php if (! $is_pickup_order): ?>
				<h3><?php _e( 'Ship to:', 'woocommerce-pdf-invoices-packing-slips' ); ?></h3>
				<?php if ( $this->ships_to_different_address()) { 
					do_action( 'wpo_wcpdf_before_shipping_address', $this->type, $this->order ); 
					$this->shipping_address(); 
					do_action( 'wpo_wcpdf_after_shipping_address', $this->type, $this->order ); 
				} else {
					do_action( 'wpo_wcpdf_before_billing_address', $this->type, $this->order ); 
					$this->billing_address(); 
					do_action( 'wpo_wcpdf_after_billing_address', $this->type, $this->order ); 
				}
			else: ?>
				<h3><?php _e('For pickup', 'woocommerce-pdf-invoices-packing-slips'); ?></h3>
			<?php endif; ?>
		</td>
		<td class="order-data">
			<table>
				<?php do_action( 'wpo_wcpdf_before_order_data', $this->type, $this->order ); ?>
				<tr class="order-number">
					<th><?php _e( 'Order Number:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td><?php $this->order_number(); ?></td>
				</tr>
				<tr class="payment-transaction">
					<th><?php _e( 'Transaction ID:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td><?php _e($order_meta['_transaction_id'][0]); ?></td>
				</tr>
				<tr class="order-date">
					<th><?php _e( 'Order Date:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td><?php $this->order_date(); ?></td>
				</tr>
				<?php if (! $is_pickup_order) { ?>
				<tr class="shipping-method">
					<th><?php _e( 'Shipping Method:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td><?php $this->shipping_method(); ?></td>
				</tr>
				<tr class="order-shh">
					<th><?php _e( 'Shipping & Handling:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td style="text-align: right;"><?php _e( $order_meta['_order_shipping'][0] ); ?></td>
				</tr>
			<?php } ?>
				<tr class="order-tax">
					<th><?php _e( 'Tax:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td style="text-align: right;"><?php 
						$stax = intval($order_meta['_shipping_tax'][0]); 
						$otax = intval($order_meta['_order_tax'][0]); 
						$total_tax = $stax + $otax; 
						_e($total_tax); 
					?></td>
				</tr>
				<tr class="price-total">
					<th><?php _e( 'Total:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td style="text-align: right;"><?php 
						if ($order_meta['_order_currency'][0] === 'USD') {_e('$');}
						_e($order_meta['_order_total'][0]); 
					?></td>
				</tr>
				<?php do_action( 'wpo_wcpdf_after_order_data', $this->type, $this->order ); ?>
			</table>			
		</td>
	</tr>
</table>

<?php do_action( 'wpo_wcpdf_before_order_details', $this->type, $this->order ); ?>

<table class="order-details">
	<thead>
		<tr>
			<th class="product"><?php _e('Product', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
			<th class="quantity"><?php _e('Quantity', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php $items = $this->get_order_items(); if( sizeof( $items ) > 0 ) : foreach( $items as $item_id => $item ) : ?>
		<tr class="<?php echo apply_filters( 'wpo_wcpdf_item_row_class', $item_id, $this->type, $this->order, $item_id ); ?>">
			<td class="product">
				<?php $description_label = __( 'Description', 'woocommerce-pdf-invoices-packing-slips' ); // registering alternate label translation ?>
				<span class="item-name"><?php echo $item['name']; ?></span>
				<?php do_action( 'wpo_wcpdf_before_item_meta', $this->type, $item, $this->order  ); ?>
				<span class="item-meta"><?php echo $item['meta']; ?></span>
				<dl class="meta">
					<?php $description_label = __( 'SKU', 'woocommerce-pdf-invoices-packing-slips' ); // registering alternate label translation ?>
					<?php if( !empty( $item['sku'] ) ) : ?><dt class="sku"><?php _e( 'SKU:', 'woocommerce-pdf-invoices-packing-slips' ); ?></dt><dd class="sku"><?php echo $item['sku']; ?></dd><?php endif; ?>
					<?php if( !empty( $item['weight'] ) ) : ?><dt class="weight"><?php _e( 'Weight:', 'woocommerce-pdf-invoices-packing-slips' ); ?></dt><dd class="weight"><?php echo $item['weight']; ?><?php echo get_option('woocommerce_weight_unit'); ?></dd><?php endif; ?>
				</dl>
				<?php do_action( 'wpo_wcpdf_after_item_meta', $this->type, $item, $this->order  ); ?>
			</td>
			<td class="quantity"><?php echo $item['quantity']; ?></td>
		</tr>
		<?php endforeach; endif; ?>
	</tbody>
</table>

<div class="bottom-spacer"></div>

<?php do_action( 'wpo_wcpdf_after_order_details', $this->type, $this->order ); ?>

<?php do_action( 'wpo_wcpdf_before_customer_notes', $this->type, $this->order ); ?>
<div class="customer-notes">
	<?php if ( $this->get_shipping_notes() ) : ?>
		<h3><?php _e( 'Customer Notes', 'woocommerce-pdf-invoices-packing-slips' ); ?></h3>
		<?php $this->shipping_notes(); ?>
	<?php endif; ?>
</div>
<?php do_action( 'wpo_wcpdf_after_customer_notes', $this->type, $this->order ); ?>

<?php if ( $this->get_footer() ): ?>
<div id="footer">
	<?php $this->footer(); ?>
</div><!-- #letter-footer -->
<?php endif; ?>

<?php do_action( 'wpo_wcpdf_after_document', $this->type, $this->order ); ?>