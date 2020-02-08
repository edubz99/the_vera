<?php

#-------------------------------------------------------------------------------#
#  Theme Customizer - WooCommerce Settings
#-------------------------------------------------------------------------------#

	add_action( 'init', 'capstone_customizer_woocommerce_settings' );

	function capstone_customizer_woocommerce_settings() {

        // SECTION: Companies Master
		Kirki::add_section( 'woocommerce_theme_capstone', array(
			'title'          => esc_html__( 'Theme Settings', 'capstone' ),
			'description'    => esc_html__( 'This section configures woocommerce options relevant to capstone theme.', 'capstone' ),
			'panel'          => 'woocommerce',
        ) );
        
        // OPTION: Checkbox
		Kirki::add_field( 'capstone_woocommerce_restore_products_grid', array(
			'type'        => 'checkbox',
			'settings'    => 'capstone_woocommerce_restore_products_grid',
			'label'       => esc_html__( 'Restore Vanilla "Products Grid"', 'capstone' ),
			'description' => esc_html__( 'Check this to restore to default products grid.', 'capstone' ),
            'panel'       => 'woocommerce',
            'section'     => 'woocommerce_theme_capstone',
			'default'     => false,
		) );

		// OPTION: Checkbox
		Kirki::add_field( 'capstone_woocommerce_restore_my_account', array(
			'type'        => 'checkbox',
			'settings'    => 'capstone_woocommerce_restore_my_account',
			'label'       => esc_html__( 'Restore Vanilla "My Account"', 'capstone' ),
			'description' => esc_html__( 'Check this to disable [woocommerce_my_account] shortcode override.', 'capstone' ),
			'panel'       => 'woocommerce',
			'section'     => 'woocommerce_theme_capstone',
			'default'     => false,
		) );

		// OPTION: Checkbox
		Kirki::add_field( 'capstone_woocommerce_restore_checkout_fields', array(
			'type'        => 'checkbox',
			'settings'    => 'capstone_woocommerce_restore_checkout_fields',
			'label'       => esc_html__( 'Restore Vanilla "Checkout Fields"', 'capstone' ),
			'description' => esc_html__( 'Check this to restore to default checkout fields.', 'capstone' ),
			'panel'       => 'woocommerce',
			'section'     => 'woocommerce_theme_capstone',
			'default'     => false,
		) );
		
		// OPTION: Checkbox
		Kirki::add_field( 'capstone_woocommerce_enable_product_permalink', array(
			'type'        => 'checkbox',
			'settings'    => 'capstone_woocommerce_enable_product_permalink',
			'label'       => esc_html__( 'Enable "Product" Permalinks', 'capstone' ),
			'description' => esc_html__( 'Enable "product" permalinks which is disabled by the theme for redundancy reason.', 'capstone' ),
			'panel'       => 'woocommerce',
			'section'     => 'woocommerce_theme_capstone',
			'default'     => false,
		) );


	}
