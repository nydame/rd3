<?php
/**
 * WC_GC_Admin_Menus class
 *
 * @author   SomewhereWarm <info@somewherewarm.com>
 * @package  WooCommerce Gift Cards
 * @since    1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Setup GC menus in WP admin.
 *
 * @version 1.0.0
 */
class WC_GC_Admin_Menus {

	/**
	 * Setup.
	 */
	public static function init() {
		self::add_hooks();
	}

	/**
	 * Admin hooks.
	 */
	public static function add_hooks() {

		// Menu.
		add_action( 'admin_menu', array( __CLASS__, 'gc_menu' ), 10 );
		add_action( 'current_screen', array( __CLASS__, 'gc_remove_submenu_link' ), 10 );
		add_filter( 'parent_file', array( __CLASS__, 'gc_fix_menu_highlight' ) );

		// Tweak title.
		add_filter( 'admin_title', array( __CLASS__, 'tweak_page_title' ), 10, 2 );

		// Integrate WooCommerce navigation bar.
		add_action( 'admin_menu', array( __CLASS__, 'wc_admin_connect_gc_pages' ) );
		add_filter( 'woocommerce_navigation_pages_with_tabs', array( __CLASS__, 'wc_admin_navigation_pages_with_tabs' ) );
		add_filter( 'woocommerce_navigation_page_tab_sections', array( __CLASS__, 'wc_admin_navigation_page_tab_sections' ) );
	}

	/**
	 * Configure giftcard tabs.
	 *
	 * @param  array  $pages
	 * @return array
	 */
	public static function wc_admin_navigation_page_tab_sections( $pages ) {
		$pages[ 'giftcards' ] = array( 'edit' );
		return $pages;
	}

	/**
	 * Configure giftcard page sections.
	 *
	 * @param  array  $pages
	 * @return array
	 */
	public static function wc_admin_navigation_pages_with_tabs( $pages ) {
		$pages[ 'gc_giftcards' ] = 'giftcards';
		return $pages;
	}

	/**
	 * Connect pages with navigation bar.
	 *
	 * @return void
	 */
	public static function wc_admin_connect_gc_pages() {

		if ( WC_GC_Core_Compatibility::is_wc_admin_enabled() ) {

			$page = 'admin.php?page=gc_giftcards';

			wc_admin_connect_page(
				array(
					'id'        => 'woocommerce-gift-cards',
					'screen_id' => 'woocommerce_page_gc_giftcards-giftcards',
					'title'     => __( 'Gift Cards', 'woocommerce-gift-cards' ),
					'path'      => add_query_arg(
						array(
							'page' => 'gc_giftcards'
						),
						'admin.php'
					)
				)
			);

			wc_admin_connect_page(
				array(
					'id'        => 'woocommerce-gift-card-edit',
					'parent'    => 'woocommerce-gift-cards',
					'screen_id' => 'woocommerce_page_gc_giftcards-giftcards-edit',
					'title'     => __( 'Edit Gift Card', 'woocommerce-gift-cards' ),
					'path'      => add_query_arg(
						array(
							'page' => 'gc_giftcards',
							'section' => 'edit',
							'giftcard' => 1
						),
						'admin.php'
					)
				)
			);

			wc_admin_connect_page(
				array(
					'id'        => 'woocommerce-gift-cards-activity',
					'parent'    => 'woocommerce-gift-cards',
					'screen_id' => 'woocommerce_page_gc_activity',
					'title'     => __( 'Activity', 'woocommerce-gift-cards' ),
					'path'      => add_query_arg(
						array(
							'page' => 'gc_activity'
						),
						'admin.php'
					)
				)
			);
		}
	}

	/**
	 * Renders tabs on our custom post types pages.
	 *
	 * @see includes/admin/views templates.
	 * @internal
	 *
	 * @since 1.0.0
	 */
	public static function render_tabs() {
		$screen = get_current_screen();

		// Handle tabs on the relevant WooCommerce pages.
		if ( $screen && ! in_array( $screen->id, WC_GC()->get_screen_ids(), true ) ) {
			return;
		}

		$tabs = array();

		$tabs[ 'giftcards' ] = array(
			'title' => __( 'Gift Cards', 'woocommerce-gift-cards' ),
			'url'   => admin_url( 'admin.php?page=gc_giftcards' ),
		);

		$tabs[ 'activity' ] = array(
			'title' => __( 'Activity', 'woocommerce-gift-cards' ),
			'url'   => admin_url( 'admin.php?page=gc_activity' ),
		);

		$tabs = apply_filters( 'woocommerce_gc_admin_tabs', $tabs );

		if ( is_array( $tabs ) ) {
			?>
			<nav class="nav-tab-wrapper woo-nav-tab-wrapper">
				<?php $current_tab = self::get_current_tab(); ?>
				<?php foreach ( $tabs as $tab_id => $tab ) : ?>
					<?php $class = $tab_id === $current_tab ? array( 'nav-tab', 'nav-tab-active' ) : array( 'nav-tab' ); ?>
					<?php printf( '<a href="%1$s" class="%2$s">%3$s</a>', esc_url( $tab[ 'url' ] ), implode( ' ', array_map( 'sanitize_html_class', $class ) ), esc_html( $tab[ 'title' ] ) ); ?>
				<?php endforeach; ?>
			</nav>
			<?php
		}
	}

	/**
	 * Returns the current admin tab.
	 *
	 * @param  string  $current_tab
	 * @return string
	 */
	public static function get_current_tab( $current_tab = 'giftcards' ) {
		$screen = get_current_screen();
		if ( $screen ) {
			if ( in_array( $screen->id, array( 'woocommerce_page_gc_giftcards' ), true ) ) {
				$current_tab = 'giftcards';
			} elseif ( in_array( $screen->id, array( 'woocommerce_page_gc_activity' ), true ) ) {
				$current_tab = 'activity';
			}
		}

		/**
		 * Filters the current Admin tab.
		 *
		 * @param  string    $current_tab
		 * @param  WP_Screen $screen
		 */
		return (string) apply_filters( 'woocommerce_gc_admin_current_tab', $current_tab, $screen );
	}

	/**
	 * Removes multiple submenu links for that are not being used as a menu item.
	 */
	public static function gc_remove_submenu_link() {

		$submenu_slugs = array(
			'gc_activity'
		);

		foreach ( $submenu_slugs as $slug ) {
			remove_submenu_page( 'woocommerce', $slug );
		}
	}

	/**
	 * Add menu items.
	 */
	public static function gc_menu() {

		if ( ! current_user_can( 'manage_woocommerce' ) ) {
			return false;
		}

		$giftcards_page = add_submenu_page( 'woocommerce', __( 'Gift Cards', 'woocommerce-gift-cards' ), __( 'Gift Cards', 'woocommerce-gift-cards' ), 'manage_woocommerce', 'gc_giftcards', array( __CLASS__, 'giftcards_page' ) );

		$activity_page = add_submenu_page( 'woocommerce', __( 'Activity', 'woocommerce-gift-cards' ), __( 'Activity', 'woocommerce-gift-cards' ), 'manage_woocommerce', 'gc_activity', array( __CLASS__, 'activity_page' ) );

		add_action( 'load-' . $giftcards_page, array( __CLASS__, 'giftcards_page_init' ) );
	}

	/**
	 * Render "Gift Cards" page.
	 */
	public static function giftcards_page() {

		// Select section.
		$section = '';

		if ( isset( $_GET[ 'section' ] ) ) {
			$section = wc_clean( $_GET[ 'section' ] );
		}

		switch ( $section ) {
			case 'delete':
				WC_GC_Admin_Gift_Cards_Page::delete();
				break;
			case 'edit':
				WC_GC_Admin_Gift_Cards_Page::edit_output();
				break;
			default:
				WC_GC_Admin_Gift_Cards_Page::output();
				break;
		}
	}

	/**
	 * Init admin page. Setups the `save` feature and adds messages.
	 */
	public static function giftcards_page_init() {

		WC_GC_Admin_Gift_Cards_Page::process();

		do_action( 'woocommerce_gc_giftcards_page_init' );
	}

	/**
	 * Render "Activity" page.
	 */
	public static function activity_page() {
		WC_GC_Admin_Activity_Page::output();
	}

	/**
	 * Changes the admin title based on the section.
	 */
	public static function tweak_page_title( $admin_title, $title ) {

		$screen = get_current_screen();

		if ( $screen && 'woocommerce_page_gc_giftcards' === $screen->id ) {

			// Fix the main title issue cause by the remove_submenu_page.
			$title = __( 'Gift Cards', 'woocommerce-gift-cards' );

			if ( ! isset( $_GET[ 'section' ] ) ) {
				return $admin_title;
			}

			$section = wc_clean( $_GET[ 'section' ] );
			switch ( $section ) {
				case 'edit':
					$admin_title = str_replace( $title, __( 'Edit Gift Card', 'woocommerce-gift-cards' ), $admin_title );
					break;
			}
		} elseif ( 'woocommerce_page_gc_activity' === $screen->id ) {

			// Fix the main title issue cause by the null title.
			$title = __( 'Activity', 'woocommerce-gift-cards' );
			return $title . $admin_title;
		}

		return $admin_title;
	}

	/**
	 * Fix the active menu item.
	 */
	public static function gc_fix_menu_highlight() {
		global $parent_file, $submenu_file;

		if ( WC_GC()->is_current_screen() ) {
			$submenu_file = 'gc_giftcards';
			$parent_file  = 'woocommerce';
		}

		return $parent_file;
	}
}

WC_GC_Admin_Menus::init();
