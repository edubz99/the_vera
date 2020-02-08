<?php

class Capstone_WooCommerce_Account {

	public function __construct() {
        /** Strip Content */
		if (get_theme_mod('capstone_woocommerce_restore_my_account', false) == false) {
			remove_action( 'woocommerce_account_navigation', 'woocommerce_account_navigation' ); // woocommerce native hook
			add_action( 'woocommerce_account_navigation', array( $this, 'strip_my_account_pages' ) );
		}
    }

    #-------------------------------------------------------------------------------#
    #  Checkout Form Hooks
    #-------------------------------------------------------------------------------#

	// Remove "My Account" redundant content
    function strip_my_account_pages() {
        // use default content if any of following end-point
        if ( is_wc_endpoint_url( 'orders' ) || is_wc_endpoint_url( 'view-order' ) || is_wc_endpoint_url( 'downloads' ) || is_wc_endpoint_url( 'edit-account' ) || is_wc_endpoint_url( 'edit-address' ) || is_wc_endpoint_url( 'payment-methods' ) ) return;

        // otherwise use 'orders' end-point content as default may-account page
        remove_action( 'woocommerce_account_content', 'woocommerce_account_content' );
        add_action( 'woocommerce_account_content', 'woocommerce_account_orders' );
    }

}
