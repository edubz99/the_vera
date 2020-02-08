<?php

class Capstone_WooCommerce_Checkout {

	public function __construct() {
        /** Fields - Personal Info */
        add_action( 'woocommerce_checkout_before_customer_details', array($this, 'checkout_before_customer_details') );
        add_action( 'woocommerce_checkout_after_customer_details', array($this, 'checkout_after_customer_details') );

        /** Fields - Payment Info */
        add_action( 'woocommerce_review_order_before_payment', array($this, 'review_order_before_payment') );
        add_action( 'woocommerce_review_order_after_payment', array($this, 'review_order_after_payment') );
    
        /** Checkout Form */
		// add_action( 'woocommerce_before_checkout_form', array( $this, 'append_cart_on_checkout' ), 5 );
	    // add_action( 'template_redirect', array( $this, 'redirect_empty_cart_checkout_to_home' ) );
        
        /** Coupon Form */
        // remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 ); // woocommerce native hook
        
        /** Fields Configuration */
        add_filter( 'woocommerce_checkout_fields' , array( $this, 'strip_checkout_fields' ) );
    }

    #-------------------------------------------------------------------------------#
    #  Checkout Form Hooks
    #-------------------------------------------------------------------------------#

    // Personal Information - Fields
    function checkout_before_customer_details() {
        echo '<div class="personal-info-fields">';
            echo '<h3 class="title">'. esc_html__('Personal Information', 'capstone') .'</h3>';
            echo '<div class="form-fields">';
    }
    function checkout_after_customer_details() {
            echo '</div>';
        echo '</div>';
    }

    // Payment Information - Fields
    function review_order_before_payment() {
        echo '<div class="payment-info-fields">';
            echo '<h3 class="title">'. esc_html__('Payment Methods', 'capstone') .'</h3>';
            echo '<div class="form-fields">';
    }
    function review_order_after_payment() {
        echo '</div>';
            echo '</div>';
    }

    #-------------------------------------------------------------------------------#
    #  Cart Hooks
    #-------------------------------------------------------------------------------#

	// Append Cart on Checkout Page
    function append_cart_on_checkout() {
        if ( is_wc_endpoint_url( 'order-received' ) ) return;

        $return_to = apply_filters( 'woocommerce_continue_shopping_redirect', wc_get_raw_referer() ? wp_validate_redirect( wc_get_raw_referer(), false ) : wc_get_page_permalink( 'shop' ) );
        echo '<p class="shop-around">'. esc_html__('Still looking around?', 'capstone')  .' <a href="'. esc_url($return_to) .'">'. esc_html__('continue shopping', 'capstone') .' &#8594;</a></p>';
        echo do_shortcode('[woocommerce_cart]');
    }

	// Redirect Empty Cart to Specified Page
    function redirect_empty_cart_checkout_to_home() {
        if ( is_cart() && is_checkout() && 0 == WC()->cart->get_cart_contents_count() && ! is_wc_endpoint_url( 'order-pay' ) && ! is_wc_endpoint_url( 'order-received' ) ) {
            wp_safe_redirect( home_url() );
            exit;
        }
    }

    #-------------------------------------------------------------------------------#
    #  Checkout - Fields Configuration
    #-------------------------------------------------------------------------------#

    function strip_checkout_fields( $fields ) {
		if (get_theme_mod('capstone_woocommerce_restore_checkout_fields', false) == false) {
			// unset($fields['billing']['billing_first_name']);
			// unset($fields['billing']['billing_last_name']);
			// unset($fields['billing']['billing_email']);
			unset($fields['billing']['billing_company']);
			unset($fields['billing']['billing_address_1']);
			unset($fields['billing']['billing_address_2']);
			unset($fields['billing']['billing_city']);
			unset($fields['billing']['billing_postcode']);
			unset($fields['billing']['billing_country']);
			unset($fields['billing']['billing_state']);
			unset($fields['billing']['billing_phone']);
			unset($fields['order']['order_comments']);
			unset($fields['billing']['billing_address_2']);
			unset($fields['billing']['billing_postcode']);
			unset($fields['billing']['billing_company']);
			unset($fields['billing']['billing_city']);
			return $fields;
        }
        return $fields;
    }


}
