<?php

class Capstone_WooCommerce extends Capstone_Integration {

	/**
	 * Constructor Function.
	 */
	public function __construct() {
		// include sub-classes
		$this->includes = array(
			'class-woocommerce-checkout.php',
			'class-woocommerce-account.php',
			'class-woocommerce-shop.php',
		);

		// add customizer support
		$this->has_customizer = true;

		parent::__construct( dirname( __FILE__ ) );
	}

	public function init() {
		$this->checkout = new Capstone_WooCommerce_Checkout();
		$this->account = new Capstone_WooCommerce_Account();
		$this->account = new Capstone_WooCommerce_Shop();
	}

	public function setup_actions() {
		/** Register & Enqueue Scripts */
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Register scripts.
	 */
	public function register_scripts() {
		wp_register_script( 'capstone-woocommerce', $this->get_url() . 'scripts/js/woocommerce.min.js', array( 'jquery', 'capstone-main' ) );
	}

	/**
	 * Enqueue script.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'capstone-woocommerce' );
	}
}