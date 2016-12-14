<?php
/*
 * Plugin Name: WooCommerce Add to Cart by Product
 * Version: 1.0
 * Plugin URI: http://jonathanbossenger.com/
 * Description: Provides a simpler add to cart shortcode for WooCommerce products.
 * Author: Jonathan Bossenger
 * Author URI: http://jonathanbossenger.com/
 * Requires at least: 4.0
 * Tested up to: 4.0
 *
 * Text Domain: atcbp
 * Domain Path: /lang/
 *
 * @package WordPress
 * @author Jonathan Bossenger
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check if WooCommerce is loaded
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	/**
	 * Check if the shortcode has been registered elsewhere
	 */
	if ( !shortcode_exists( 'add_to_cart_by_product' ) ) {

		/**
		 * Output the WooCommerce add to cart button, based on the product being rendered.
		 * @return string
		 */
		function cdbl_wc_direct_add_to_cart_shortcode(){
			global $product;
			if ( $product ) {
				if ( 'instock' == $product->stock_status ) {
					$id = $product->id;
					$add_to_cart_by_product = do_shortcode( '[add_to_cart id="' . $id . '" show_price="false" style=""]' );
					return $add_to_cart_by_product;
				}else {
					return '<p class="stock out-of-stock">' . __( 'Out of stock.', 'woocommerce' ) .'</p>';
				}
			}
		}

		/**
		 * Adds the add_to_cart_by_product shortcode
		 */
		if ( !shortcode_exists( 'add_to_cart_by_product' ) ) {
			add_shortcode( 'add_to_cart_by_product' , 'cdbl_wc_direct_add_to_cart_shortcode' );
		}

	}

}