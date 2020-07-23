<?php
/**
 * Status Report data.
 *
 * @author   SomewhereWarm <info@somewherewarm.com>
 * @package  WooCommerce Gift Cards
 * @since    1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?><table class="wc_status_table widefat" cellspacing="0" id="status">
	<thead>
		<tr>
			<th colspan="3" data-export-label="Gift Cards"><h2><?php esc_html_e( 'Gift Cards', 'woocommerce-gift-cards' ); ?></h2></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td data-export-label="Database Version"><?php esc_html_e( 'Database version', 'woocommerce-gift-cards' ); ?>:</td>
			<td class="help"><?php echo wc_help_tip( esc_html__( 'The version of WooCommerce Gift Cards reported by the database. This should be the same as the plugin version.', 'woocommerce-gift-cards' ) ); ?></td>
			<td>
			<?php

			if ( version_compare( $debug_data[ 'db_version' ], WC_GC()->get_plugin_version( true ), '<=' ) ) {
				echo '<mark class="yes">' . esc_html( $debug_data[ 'db_version' ] ) . '</mark>';
			} else {
				echo '<mark class="error"><span class="dashicons dashicons-warning"></span> ' . esc_html( $debug_data[ 'db_version' ] ) . ' - ' . esc_html__( 'Database version mismatch.', 'woocommerce-gift-cards' ) . '</mark>';
			}
			?>
			</td>
		</tr>
	</tbody>
</table>
