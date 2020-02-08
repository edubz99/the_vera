<?php

class Capstone_WooCommerce_Shop {

	public function __construct() {
		/** Products Grid */
		$this->remove_products_grid();

		/** Remove Product Permalink Refrences */
		if (!get_theme_mod('capstone_woocommerce_enable_product_permalink')) {
			add_filter( 'post_type_link' , array( $this, 'remove_product_permalink' ), 10, 2 );
		}
	}

    #-------------------------------------------------------------------------------#
    #  Products Grid
    #-------------------------------------------------------------------------------#
    
    // Remove Products Grid Markup from 'Shop' page
    function remove_products_grid() {
			if (get_theme_mod('capstone_woocommerce_restore_products_grid', false) == false) {
				remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
				remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
				remove_action( 'woocommerce_no_products_found', 'wc_no_products_found' );
				// also override default `woocommerce/content-product.php` file
			}
		}

		#-------------------------------------------------------------------------------#
		#  Remove WooCommerce "Product Permalink" Refrences
		#-------------------------------------------------------------------------------#

		function remove_product_permalink($url, $post) {
			if ( 'product' == get_post_type( $post ) ) {
				return '#';
			}
			return $url;
		}
}
