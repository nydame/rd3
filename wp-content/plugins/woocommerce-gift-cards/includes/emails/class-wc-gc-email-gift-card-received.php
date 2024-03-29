<?php
/**
 * WC_GC_Email_Gift_Card_Received class
 *
 * @author   SomewhereWarm <info@somewherewarm.com>
 * @package  WooCommerce Gift Cards
 * @since    1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WC_GC_Email_Gift_Card_Received', false ) ) :

/**
 * Gift Card Received email controller.
 *
 * @class    WC_GC_Email_Gift_Card_Received
 * @version  1.3.2
 */
class WC_GC_Email_Gift_Card_Received extends WC_Email {

	/**
	 * Current giftcard object.
	 *
	 * @var WC_GC_Gift_Card
	 */
	protected $giftcard;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->id             = 'gift_card_received';
		$this->customer_email = true;
		$this->title          = __( 'Gift Card received', 'woocommerce-gift-cards' );
		$this->description    = __( '&quot;Gift Card Received&quot; e-mails are sent to Gift Card recipients when a new Gift Card code is issued and activated.', 'woocommerce-gift-cards' );

		$this->template_plain = 'emails/plain/gift-card-received.php';
		$this->template_base  = WC_GC()->get_plugin_path() . '/templates/';

		$this->placeholders   = array(
			'{site_title}'      => '',
			'{giftcard_from}'   => '',
			'{giftcard_amount}' => ''
		);

		// Triggers for this email.
		add_action( 'woocommerce_gc_send_gift_card_to_customer_notification', array( $this, 'process_giftcards' ), 10, 3 );
		add_action( 'woocommerce_gc_force_send_gift_card_to_customer_notification', array( $this, 'force_trigger' ) );
		add_action( 'woocommerce_gc_schedule_send_gift_card_to_customer_notification', array( $this, 'schedule_trigger' ), 10, 2 );

		// Call parent constructor.
		parent::__construct();
	}

	/*---------------------------------------------------*/
	/*  Triggers.                                        */
	/*---------------------------------------------------*/

	/**
	 * Process giftcards.
	 *
	 * @param array           $giftcards
	 * @param int             $order_id
	 * @param WC_Order|false  $order
	 */
	public function process_giftcards( $giftcards, $order_id, $order = false ) {
		$this->setup_locale();

		foreach ( $giftcards as $giftcard_id ) {
			$giftcard = new WC_GC_Gift_card( $giftcard_id );
			if ( ! $giftcard->get_id() ) {
				continue;
			}

			if ( $giftcard->get_deliver_date() > 0 ) {

				$args = array(
					'giftcard' => $giftcard->get_id(),
					'order_id' => $order_id
				);

				WC_GC_Core_Compatibility::schedule_single_action( $giftcard->get_deliver_date(), 'woocommerce_gc_schedule_send_gift_card_to_customer', $args, 'send_giftcards' );

			} else {
				$this->trigger( $giftcard, $order_id, $order );
			}
		}

		$this->restore_locale();
	}

	/**
	 * Trigger the sending of this email.
	 *
	 * @param WC_GC_Gift_Card $giftcard
	 */
	public function force_trigger( $giftcard ) {
		$this->setup_locale();

		if ( is_numeric( $giftcard ) || is_a( $giftcard, 'WC_GC_Gift_Card_Data' ) ) {
			$giftcard = new WC_GC_Gift_Card( $giftcard );
		}

		$order = wc_get_order( $giftcard->get_order_id() );

		if ( ! is_a( $order, 'WC_Order' ) || ! is_a( $giftcard, 'WC_GC_Gift_Card' ) ) {
			return;
		}

		$this->giftcard                            = $giftcard;
		$this->object                              = $order;
		$this->recipient                           = $giftcard->get_recipient();
		$this->placeholders[ '{site_title}' ]      = $this->get_blogname();
		$this->placeholders[ '{giftcard_from}' ]   = $giftcard->get_sender();
		$this->placeholders[ '{giftcard_amount}' ] = preg_replace( $this->plain_search, $this->plain_replace, wp_strip_all_tags( wc_price( $giftcard->get_balance() ) ) );

		// Update delivery status.
		$this->giftcard->data->set_delivered( get_current_user_id() );

		// Get the product instance.
		$order_item = new WC_Order_Item_Product( $giftcard->get_order_item_id() );
		$product    = $order_item->get_product();

		// Force set delivery & expiration time.
		if ( is_a( $product, 'WC_Product' ) ) {

			// If has a scheduled time, and it's not already sent, force it to now.
			if ( $giftcard->get_deliver_date() > 0 && $giftcard->get_deliver_date() <= time() ) {

				$this->giftcard->data->set_deliver_date( time() );
				$expire_in_days = absint( $product->get_meta( '_gift_card_expiration_days', true ) );
				$expire_date    = 0;

				// Re-align expiration if needed.
				if ( $expire_in_days > 0 ) {
					$base_datetime = new DateTime();
					$base_datetime->setTimestamp( $giftcard->get_deliver_date() );
					$base_datetime->add( new DateInterval( 'P' . absint( $expire_in_days ) . 'D' ) );
					$expire_date = $base_datetime->getTimestamp();
				}

				$this->giftcard->data->set_expire_date( $expire_date );
			}
		}

		$this->giftcard->data->save();

		if ( $this->is_enabled() && $this->get_recipient() ) {
			$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
		}

		$this->restore_locale();
	}

	/**
	 * Trigger the sending of this email.
	 *
	 * @param WC_GC_Gift_card $giftcard
	 * @param int             $order_id
	 * @param WC_Order|false  $order
	 */
	public function trigger( $giftcard, $order_id, $order ) {

		if ( is_numeric( $giftcard ) ) {
			$giftcard = new WC_GC_Gift_Card( $giftcard );
		}

		if ( $order_id && ! is_a( $order, 'WC_Order' ) ) {
			$order = wc_get_order( $order_id );
		}

		if ( ! is_a( $order, 'WC_Order' ) || ! $giftcard->get_id() ) {
			return;
		}

		$this->giftcard                            = $giftcard;
		$this->object                              = $order;
		$this->recipient                           = $giftcard->get_recipient();
		$this->placeholders[ '{giftcard_from}' ]   = $giftcard->get_sender();
		$this->placeholders[ '{giftcard_amount}' ] = preg_replace( $this->plain_search, $this->plain_replace, wp_strip_all_tags( wc_price( $giftcard->get_balance() ) ) );

		// Update status.
		$this->giftcard->data->set_active( 'on' );
		$this->giftcard->data->set_delivered( 0 ); // 0: for auto-delivery by system. (int): User ID that forced the delivery.
		$this->giftcard->data->save();

		if ( $this->is_enabled() && $this->get_recipient() ) {
			$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
		}
	}

	/**
	 * Trigger the sending of a scheduled email.
	 *
	 * @param int $giftcard
	 * @param int $order_id
	 */
	public function schedule_trigger( $giftcard, $order_id ) {

		if ( is_numeric( $giftcard ) ) {
			$giftcard = new WC_GC_Gift_Card( $giftcard );
		}

		$order = false;
		if ( $order_id ) {
			$order = wc_get_order( $order_id );
		}

		if ( ! is_a( $order, 'WC_Order' ) || ! $giftcard->get_id() ) {
			return;
		}

		$this->giftcard                            = $giftcard;
		$this->object                              = $order;
		$this->recipient                           = $giftcard->get_recipient();
		$this->placeholders[ '{giftcard_from}' ]   = $giftcard->get_sender();
		$this->placeholders[ '{giftcard_amount}' ] = preg_replace( $this->plain_search, $this->plain_replace, wp_strip_all_tags( wc_price( $giftcard->get_balance() ) ) );

		// Update status.
		$this->giftcard->data->set_active( 'on' );
		$this->giftcard->data->set_delivered( 0 );
		$this->giftcard->data->save();

		if ( $this->is_enabled() && $this->get_recipient() ) {
			$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
		}
	}

	/*---------------------------------------------------*/
	/*  Defaults.                                        */
	/*---------------------------------------------------*/

	/**
	 * Get email subject.
	 *
	 * @return string
	 */
	public function get_default_subject() {
		return __( 'You have received a {giftcard_amount} {site_title} Gift Card from {giftcard_from}!', 'woocommerce-gift-cards' );
	}

	/**
	 * Get email heading.
	 *
	 * @return string
	 */
	public function get_default_heading() {
		return __( 'Your gift card is ready!', 'woocommerce-gift-cards' );
	}

	/**
	 * Get default email gift card content.
	 *
	 * @since  1.1.0
	 *
	 * @return string
	 */
	public function get_default_intro_content() {
		return __( 'Great news! You have received a gift card from {giftcard_from}.', 'woocommerce-gift-cards' );
	}

	/**
	 * Default content to show below main email content.
	 *
	 * @return string
	 */
	public function get_default_additional_content() {
		return __( 'Thanks for shopping with us.', 'woocommerce' );
	}

	/*---------------------------------------------------*/
	/*  Getters.                                         */
	/*---------------------------------------------------*/

	/**
	 * Get giftcard.
	 *
	 * @since  1.2.0
	 *
	 * @return string
	 */
	public function get_gift_card() {
		return $this->giftcard;
	}

	/**
	 * Get email gift card content.
	 *
	 * @since  1.1.0
	 *
	 * @return string
	 */
	public function get_into_content() {
		return apply_filters( 'woocommerce_gc_email_intro_content', $this->format_string( $this->get_option( 'intro_content', $this->get_default_intro_content() ) ), $this->giftcard, $this->object, $this );
	}

	/**
	 * Get content html.
	 *
	 * @return string
	 */
	public function get_content_html() {

		// Default template params.
		$template_args = array(
			'giftcard'           => $this->get_gift_card(),
			'email_heading'      => $this->get_heading(),
			'intro_content'      => $this->get_into_content(),
			'additional_content' => WC_GC_Core_Compatibility::is_wc_version_gte( '3.7' ) ? $this->get_additional_content() : false,
			'email'              => $this,
		);

		// Redeem button.
		$template_args[ 'show_redeem_button' ] = false;
		if ( $this->get_gift_card()->is_redeemable() ) {
			$customer = get_user_by( 'email', $this->get_gift_card()->get_recipient() );
			if ( $customer && is_a( $customer, 'WP_User' ) ) {
				$template_args[ 'show_redeem_button' ] = true;
			}
		}

		// Fetch the template.
		$template = WC_GC()->emails->get_template( $this->giftcard->get_template_id() );

		// Setup template hooks & filters.
		$template->setup();

		$template_args = array_merge( $template_args, $template->get_args( $this ) );

		// Get the template.
		return wc_get_template_html(
			$template->get_template_html(),
			$template_args,
			false,
			WC_GC()->get_plugin_path() . '/templates/'
		);
	}

	/**
	 * Get content plain.
	 *
	 * @return string
	 */
	public function get_content_plain() {
		return wc_get_template_html(
			$this->template_plain,
			array(
				'giftcard'           => $this->giftcard,
				'email_heading'      => $this->get_heading(),
				'intro_content'      => $this->get_into_content(),
				'additional_content' => WC_GC_Core_Compatibility::is_wc_version_gte( '3.7' ) ? $this->get_additional_content() : false,
				'email'              => $this,
			),
			false,
			WC_GC()->get_plugin_path() . '/templates/'
		);
	}

	/*---------------------------------------------------*/
	/*  Init.                                            */
	/*---------------------------------------------------*/

	/**
	 * Initialize Settings Form Fields.
	 *
	 * @since  1.1.0
	 *
	 * @return void
	 */
	public function init_form_fields() {

		parent::init_form_fields();

		/* translators: %s: list of placeholders */
		$placeholder_text = sprintf( __( 'Available placeholders: %s', 'woocommerce' ), '<code>' . esc_html( implode( '</code>, <code>', array_keys( $this->placeholders ) ) ) . '</code>' );

		$intro_content_field = array(
			'title'       => __( 'Email content', 'woocommerce-gift-cards' ),
			'description' => __( 'Text to appear below the main email header.', 'woocommerce-gift-cards' ) . ' ' . $placeholder_text,
			'css'         => 'width:400px; height: 75px;',
			'placeholder' => $this->get_default_intro_content(),
			'type'        => 'textarea',
			'desc_tip'    => true,
		);

		// Find `heading` key.
		$inject_index = array_search( 'heading', array_keys( $this->form_fields ), true );
		if ( $inject_index ) {
			$inject_index++;
		} else {
			$inject_index = 0;
		}

		// Inject.
		$this->form_fields = array_slice( $this->form_fields, 0, $inject_index, true ) + array( 'intro_content' => $intro_content_field ) + array_slice( $this->form_fields, $inject_index, count( $this->form_fields ) - $inject_index, true );
	}
}

endif;

return new WC_GC_Email_Gift_Card_Received();
