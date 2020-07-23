<?php
// Change page title for Shop Archive page
add_filter( 'wp_title', 'title_for_shop' );
function title_for_shop( $title )
{
  if ( is_shop() ) {
    return __( 'Delivery Store', THEMEDOMAIN );
  }
  return $title;
}

//Change number of products per page
add_filter( 'loop_shop_per_page', 'tg_shop_per_page', 20 );
function tg_shop_per_page()
{
	$tg_shop_items = kirki_get_option('tg_shop_items');
	return $tg_shop_items;
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */ 
add_filter( 'woocommerce_output_related_products_args', 'tg_related_products_args' );

function tg_related_products_args( $args ) 
{
  	//Check if display related products
	$tg_shop_related_products = kirki_get_option('tg_shop_related_products');
	
	if(!empty($tg_shop_related_products))
	{
		$args['posts_per_page'] = 3; // 4 related products
		$args['columns'] = 3; // arranged in 2 columns
	}
	else
	{
		$args['posts_per_page'] = 0;
	}
	
	return $args;
}
?>