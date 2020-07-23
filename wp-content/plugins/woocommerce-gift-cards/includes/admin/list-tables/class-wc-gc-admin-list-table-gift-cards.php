<?php
/**
 * WC_GC_Gift_Cards_List_Table class
 *
 * @author   SomewhereWarm <info@somewherewarm.com>
 * @package  WooCommerce Gift Cards
 * @since    1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * Adds a custom deployments list table.
 *
 * @class    WC_GC_Gift_Cards_List_Table
 * @version  1.0.0
 */
class WC_GC_Gift_Cards_List_Table extends WP_List_Table {

	/**
	 * Page home URL.
	 *
	 * @const PAGE_URL
	 */
	const PAGE_URL = 'admin.php?page=gc_giftcards';

	/**
	 * Total view records.
	 *
	 * @var int
	 */
	public $total_items = 0;

	/**
	 * Total redeemed records.
	 *
	 * @var int
	 */
	public $total_redeemed_items = 0;

	/**
	 * Whether or not to mask the gift card codes.
	 *
	 * @var bool
	 */
	private $mask_codes;

	/**
	 * Constructor
	 */
	public function __construct() {
		global $status, $page;

		$this->total_items          = WC_GC()->db->giftcards->query( array( 'count' => true ) );
		$this->total_redeemed_items = WC_GC()->db->giftcards->query( array( 'count' => true, 'is_redeemed' => true ) );
		$this->mask_codes           = wc_gc_mask_codes( 'admin' );

		parent::__construct( array(
			'singular' => 'gift card',
			'plural'   => 'gift cards'
		) );
	}

	/**
	 * This is a default column renderer
	 *
	 * @param $item - row (key, value array)
	 * @param $column_name - string (key)
	 * @return string
	 */
	public function column_default( $item, $column_name ) {
		return isset( $item[ $column_name ] ) ? $item[ $column_name ] : '-';
	}

	/**
	 * Handles the title column output.
	 *
	 * @param array $item
	 */
	public function column_gc_code( $item ) {

		$actions = array(
			'edit'       => sprintf( '<a href="' . admin_url( 'admin.php?page=gc_giftcards&section=edit&giftcard=%d' ) . '">%s</a>', $item[ 'id' ], __( 'View Gift Card', 'woocommerce-gift-cards' ) ),
			'order'      => sprintf( '<a id="%d" href="' . admin_url( 'post.php?post=%d&action=edit' ) . '">%s</a>', $item[ 'id' ], $item[ 'order_id' ], __( 'View Order', 'woocommerce-gift-cards' ) )
		);

		$title = $this->mask_codes ? wc_gc_mask_code( $item[ 'code' ] ) : $item[ 'code' ];

		printf(
			'<a class="row-title" href="%s" aria-label="%s">%s</a>%s',
			esc_url( admin_url( 'admin.php?page=gc_giftcards&section=edit&giftcard=' . $item[ 'id' ] ) ),
			/* translators: %s: Giftcard code */
			sprintf( esc_attr__( '&#8220;%s&#8221; (Edit)', 'woocommerce-gift-cards' ), esc_attr( $title ) ),
			esc_html( $title ),
			$this->row_actions( $actions )
		);
	}

	/**
	 * Handles the checkbox column output.
	 *
	 * @param array $item
	 */
	public function column_cb( $item ) {
		?><label class="screen-reader-text" for="cb-select-<?php echo intval( $item[ 'id' ] ); ?>">
		<?php
			/* translators: %s: Giftcard code */
			printf( esc_html__( 'Select %s', 'woocommerce-gift-cards' ), esc_html( $item[ 'code' ] ) );
		?>
		</label>
		<input id="cb-select-<?php echo intval( $item[ 'id' ] ); ?>" type="checkbox" name="giftcard[]" value="<?php echo intval( $item[ 'id' ] ); ?>" />
		<?php
	}

	/**
	 * Handles the balance column output.
	 *
	 * @param array $item
	 */
	public function column_balance( $item ) {
		echo wc_price( (float) $item[ 'remaining' ] );
	}

	/**
	 * Handles the status column output.
	 *
	 * @param array $item
	 */
	public function column_status( $item ) {

		if ( 'on' !== $item[ 'is_active' ] || ( absint( $item[ 'expire_date' ] ) !== 0 && absint( $item[ 'expire_date' ] ) < time() ) ) {
			$status = 'cancelled';
			$label  = __( 'Inactive', 'woocommerce-gift-cards' );

			// Build tooltip.
			$tooltip = '';
			if ( absint( $item[ 'expire_date' ] ) !== 0 && absint( $item[ 'expire_date' ] ) < time() ) {
				$tooltip .= 'Gift Card has <strong>expired</strong>';
			} elseif ( 'on' !== $item[ 'is_active' ] ) {
				$tooltip .= 'Gift Card is <strong>disabled</strong>';
			}

		} else {
			$status = 'completed';
			$label  = __( 'Active', 'woocommerce-gift-cards' );
		}


		if ( isset( $tooltip ) ) {
			printf( '<mark class="order-status %s tips" data-tip="%s"><span>%s</span></mark>', esc_attr( sanitize_html_class( 'status-' . $status ) ), wp_kses_post( $tooltip ), esc_html( $label ) );
		} else {
			printf( '<mark class="order-status %s"><span>%s</span></mark>', esc_attr( sanitize_html_class( 'status-' . $status ) ), esc_html( $label ) );
		}
	}

	/**
	 * Handles the delivery column output.
	 *
	 * @param array $item
	 */
	public function column_delivery( $item ) {

		if ( 'no' === $item[ 'delivered' ] ) {
			$label   = esc_html__( 'Scheduled', 'woocommerce-gift-cards' );
			$tooltip = sprintf( 'Scheduled for %s', date_i18n( get_option( 'date_format' ), $item[ 'deliver_date' ] ) );
		} else {
			$label = esc_html__( 'Delivered', 'woocommerce-gift-cards' );
		}

		$html = $label;

		if ( isset( $tooltip ) && ! empty( $tooltip ) ) {
			$html .= '&nbsp;' . wc_help_tip( $tooltip );
		}

		echo $html;
	}

	/**
	 * Handles the redeemed user column output.
	 *
	 * @param array $item
	 */
	public function column_redeemed( $item ) {

		if ( $item[ 'redeemed_by' ] ) {
			$user = get_user_by( 'id', $item[ 'redeemed_by' ] );
		}

		if ( isset( $user ) && $user ) {
			echo sprintf( '<a href="%s" target="_blank">%s</a>', esc_url( get_edit_user_link( $user->ID ) ), esc_html( $user->display_name ) );
		} else {
			echo '-';
		}
	}

	/**
	 * Handles the date column output.
	 *
	 * @param array $item
	 */
	public function column_date( $item ) {

		if ( '0' === $item[ 'create_date' ] ) {
			$t_time    = __( 'Unpublished', 'woocommerce-gift-cards' );
			$h_time    = $t_time;
			$time_diff = 0;
		} else {
			$t_time    = date_i18n( _x( 'Y/m/d g:i:s a', 'list table date hover format', 'woocommerce-gift-cards' ), $item[ 'create_date' ] );
			$time_diff = time() - $item[ 'create_date' ];

			if ( $time_diff > 0 && $time_diff < DAY_IN_SECONDS ) {
				/* translators: %s: human time diff */
				$h_time = sprintf( __( '%s ago', 'woocommerce-gift-cards' ), human_time_diff( $item[ 'create_date' ] ) );
			} else {
				$h_time = date_i18n( _x( 'Y/m/d', 'list table date format', 'woocommerce-gift-cards' ), $item[ 'create_date' ] );
			}
		}

		echo '<span title="' . esc_attr( $t_time ) . '">' . esc_html( $h_time ) . '</span>';
	}

	/**
	 * Handles the expires column output.
	 *
	 * @param array $item
	 */
	public function column_expire( $item ) {
		if ( 0 == $item[ 'expire_date' ] ) {
			echo esc_html__( 'Never', 'woocommerce-gift-cards' );
		} else {
			echo esc_html( date_i18n( get_option( 'date_format' ), $item[ 'expire_date' ] ) );
		}
	}

	/**
	 * Get a list of columns. The format is:
	 * 'internal-name' => 'Title'
	 */
	public function get_columns() {

		$columns                = array();
		$columns[ 'cb' ]        = '<input type="checkbox" />';
		$columns[ 'gc_code' ]   = _x( 'Code', 'column_name', 'woocommerce-gift-cards' );
		$columns[ 'balance' ]   = _x( 'Balance', 'column_name', 'woocommerce-gift-cards' );
		$columns[ 'status' ]    = _x( 'Status', 'column_name', 'woocommerce-gift-cards' );
		$columns[ 'delivery' ]  = _x( 'Delivery', 'column_name', 'woocommerce-gift-cards' );
		$columns[ 'date' ]      = _x( 'Date', 'column_name', 'woocommerce-gift-cards' );
		$columns[ 'sender' ]    = _x( 'From', 'column_name', 'woocommerce-gift-cards' );
		$columns[ 'recipient' ] = _x( 'To', 'column_name', 'woocommerce-gift-cards' );
		$columns[ 'redeemed' ]  = _x( 'Redeemed by', 'column_name', 'woocommerce-gift-cards' );
		$columns[ 'expire' ]    = _x( 'Expires', 'column_name', 'woocommerce-gift-cards' );

		return $columns;
	}

	/**
	 * Return sortable columns.
	 *
	 * @return array
	 */
	public function get_sortable_columns() {
		$sortable_columns = array(
			'balance' => array( 'balance', true ),
			'date'    => array( 'create_date', true ),
			'expire'  => array( 'expire_date', true )
		);

		return $sortable_columns;
	}

	/**
	 * Returns bulk actions.
	 *
	 * @return array
	 */
	protected function get_bulk_actions() {
		$actions              = array();
		$actions[ 'enable' ]  = __( 'Enable', 'woocommerce-gift-cards' );
		$actions[ 'disable' ] = __( 'Disable', 'woocommerce-gift-cards' );
		$actions[ 'delete' ]  = __( 'Delete permanently', 'woocommerce-gift-cards' );
		return $actions;
	}

	/**
	 * Process bulk actions.
	 *
	 * @return void
	 */
	private function process_bulk_action() {

		if ( $this->current_action() ) {

			$giftcards = isset( $_GET[ 'giftcard' ] ) && is_array( $_GET[ 'giftcard' ] ) ? array_map( 'absint', $_GET[ 'giftcard' ] ) : array();

			if ( empty( $giftcards ) ) {
				return;
			}

			if ( 'enable' === $this->current_action() ) {

				foreach ( $giftcards as $id ) {

					$args = array(
						'is_active' => 'on'
					);

					WC_GC()->db->giftcards->update( $id, $args );
				}

				WC_GC_Admin_Notices::add_notice( __( 'Gift Cards updated.', 'woocommerce-gift-cards' ), 'success', true );

			} elseif ( 'disable' === $this->current_action() ) {

				foreach ( $giftcards as $id ) {

					$args = array(
						'is_active' => 'off'
					);

					WC_GC()->db->giftcards->update( $id, $args );
				}

				WC_GC_Admin_Notices::add_notice( __( 'Gift Cards updated.', 'woocommerce-gift-cards' ), 'success', true );

			} elseif ( 'delete' === $this->current_action() ) {

				foreach ( $giftcards as $id ) {
					WC_GC()->db->giftcards->delete( $id );
				}

				WC_GC_Admin_Notices::add_notice( __( 'Gift Cards deleted.', 'woocommerce-gift-cards' ), 'success', true );
			}

			wp_redirect( admin_url( self::PAGE_URL ) );
			exit();
		}
	}

	/**
	 * Query the DB and attach items.
	 *
	 * @return void
	 */
	public function prepare_items() {

		$per_page = 10;

		// Table columns.
		$columns               = $this->get_columns();
		$hidden                = array();
		$sortable              = $this->get_sortable_columns();
		$this->_column_headers = array( $columns, $hidden, $sortable );

		// Process actions.
		$this->process_bulk_action();


		// Setup params.
		$paged   = isset( $_REQUEST[ 'paged' ] ) ? max( 0, intval( $_REQUEST[ 'paged' ] ) - 1 ) : 0;
		$orderby = ( isset( $_REQUEST[ 'orderby' ] ) && in_array( $_REQUEST[ 'orderby' ], array_keys( $this->get_sortable_columns() ) ) ) ? wc_clean( $_REQUEST[ 'orderby' ] ) : 'id';
		$order   = ( isset( $_REQUEST[ 'order' ] ) && in_array( $_REQUEST[ 'order' ], array( 'asc', 'desc' ) ) ) ? wc_clean( $_REQUEST[ 'order' ] ) : 'desc';

		// Query args.
		$query_args = array(
			'order_by' => array( $orderby => $order ),
			'limit'    => $per_page,
			'offset'   => $paged * $per_page
		);

		// Search.
		if ( isset( $_REQUEST[ 's' ] ) && ! empty( $_REQUEST[ 's' ] ) ) {
			$query_args[ 'search' ] = wc_clean( $_REQUEST[ 's' ] );
		}

		// Views.
		if ( ! empty( $_REQUEST[ 'status' ] ) && 'redeemed' === $_REQUEST[ 'status' ] ) {
			$query_args[ 'is_redeemed' ] = true;
		}

		// Filters.
		if ( ! empty( $_GET[ '_redeemed_filter' ] ) ) {
			$filter                      = absint( $_GET[ '_redeemed_filter' ] );
			$query_args[ 'redeemed_by' ] = array( $filter );
		}

		// Fetch the items.
		$this->items = WC_GC()->db->giftcards->query( $query_args );

		// Count total items.
		$query_args[ 'count' ] = true;
		unset( $query_args[ 'limit' ] );
		unset( $query_args[ 'offset' ] );
		$total_items = WC_GC()->db->giftcards->query( $query_args );

		// Configure pagination.
		$this->set_pagination_args( array(
			'total_items' => $total_items, // total items defined above
			'per_page'    => $per_page, // per page constant defined at top of method
			'total_pages' => ceil( $total_items / $per_page ) // calculate pages count
		) );
	}

	/**
	 * Message to be displayed when there are no items.
	 *
	 * @return void
	 */
	public function no_items() {
		?>
		<p class="main">
			<?php esc_html_e( 'No Gift Cards found', 'woocommerce-gift-cards' ); ?>
		</p>
		<?php
	}

	/**
	 * Items of the `subsubsub` status menu.
	 *
	 * @return array
	 */
	protected function get_views() {

		$status_links = array();

		// ALl view.
		$class          = ! empty( $_REQUEST[ 'all_gc' ] ) ? 'current' : '';
		$all_inner_html = sprintf(
			/* translators: %s: Giftcards count */
			_nx(
				'All <span class="count">(%s)</span>',
				'All <span class="count">(%s)</span>',
				$this->total_items,
				'giftccard_status',
				'woocommerce-gift-cards'
			),
			number_format_i18n( $this->total_items )
		);

		$status_links[ 'all' ] = $this->get_link( array( 'all_gc' => 1 ), $all_inner_html, $class );

		// Redeemed view.
		$class             = ! empty( $_REQUEST[ 'status' ] ) ? 'current' : '';
		$redeem_inner_html = sprintf(
			/* translators: %s: Redeemed giftcards count */
			_nx(
				'Redeemed <span class="count">(%s)</span>',
				'Redeemed <span class="count">(%s)</span>',
				$this->total_redeemed_items,
				'giftccard_status',
				'woocommerce-gift-cards'
			),
			number_format_i18n( $this->total_redeemed_items )
		);

		$status_links[ 'redeemed' ] = $this->get_link( array( 'status' => 'redeemed' ), $redeem_inner_html, $class );


		return $status_links;
	}

	/**
	 * Construct a link string from args.
	 *
	 * @param  array  $args
	 * @param  string $label
	 * @param  string $class
	 * @return string
	 */
	protected function get_link( $args, $label, $class = '' ) {

		$base_url = admin_url( 'admin.php?page=gc_giftcards' );
		$url      = add_query_arg( $args, $base_url );

		$class_html   = '';
		$aria_current = '';
		if ( ! empty( $class ) ) {
			$class_html = sprintf(
				' class="%s"',
				esc_attr( $class )
			);

			if ( 'current' === $class ) {
				$aria_current = ' aria-current="page"';
			}
		}

		return sprintf(
			'<a href="%s"%s%s>%s</a>',
			esc_url( $url ),
			$class_html,
			$aria_current,
			$label
		);
	}

	/**
	 * Display table extra nav.
	 *
	 * @param  string $which top|bottom
	 * @return void
	 */
	public function extra_tablenav( $which ) {
		if ( 'top' === $which && ! is_singular() ) {
			?>
			<div class="alignleft actions sw-select2-autoinit">
			<?php
				$this->render_filters();
				submit_button( __( 'Filter', 'woocommerce-gift-cards' ), '', 'filter_action', false, array( 'id' => 'post-query-submit' ) );
			?>
			</div>
			<?php
		}
	}

	/**
	 * Display table filters.
	 *
	 * @return void
	 */
	protected function render_filters() {

		$this->display_months_dropdown();

		$user_string = '';
		$user_id     = '';

		if ( ! empty( $_GET[ '_redeemed_filter' ] ) ) {

			$user_id = wc_clean( $_GET[ '_redeemed_filter' ] );
			$user    = get_user_by( 'id', absint( $user_id ) );

			if ( $user ) {
				$user_string = sprintf(
					/* translators: 1: user display name 2: user ID 3: user email */
					esc_html__( '%1$s (#%2$s &ndash; %3$s)', 'woocommerce' ),
					$user->display_name,
					absint( $user->ID ),
					$user->user_email
				);
			}
		}
		?>
		<select class="sw-select2-search--customers" name="_redeemed_filter" data-placeholder="<?php esc_attr_e( 'Redeemed by customer&hellip;', 'woocommerce-gift-cards' ); ?>" data-allow_clear="true">
			<?php if ( $user_string && $user_id ) { ?>
				<option value="<?php echo esc_attr( $user_id ); ?>" selected="selected"><?php echo wp_kses_post( htmlspecialchars( $user_string ) ); ?><option>
			<?php } ?>
		</select>
		<?php
	}

	/**
	 * Display dates dropdown filter.
	 *
	 * @return void
	 */
	protected function display_months_dropdown() {
		global $wp_locale;

		$months      = WC_GC()->db->giftcards->get_distinct_dates();
		$month_count = count( $months );

		if ( ! $month_count || ( 1 == $month_count && 0 == $months[0]->month ) ) {
			return;
		}

		$m = isset( $_GET[ 'm' ] ) ? (int) $_GET[ 'm' ] : 0;
		?>
		<label for="filter-by-date" class="screen-reader-text"><?php esc_html_e( 'Filter by date', 'woocommerce-gift-cards' ); ?></label>
		<select name="m" id="filter-by-date">
			<option<?php selected( $m, 0 ); ?> value="0"><?php esc_html_e( 'All dates', 'woocommerce-gift-cards' ); ?></option>
			<?php
			foreach ( $months as $arc_row ) {
				if ( 0 == $arc_row->year ) {
					continue;
				}

				$month = zeroise( $arc_row->month, 2 );
				$year  = $arc_row->year;

				printf(
					"<option %s value='%s'>%s</option>\n",
					selected( $m, $year . $month, false ),
					esc_attr( $arc_row->year . $month ),
					/* translators: %1$s: month %2$s: year */
					sprintf( esc_html__( '%1$s %2$d', 'woocommerce-gift-cards' ), esc_html( $wp_locale->get_month( $month ) ), esc_html( $year ) )
				);
			}
			?>
		</select>
		<?php
	}
}
