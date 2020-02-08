<?php

class Capstone_FacetWP extends Capstone_Integration {

	public function __construct() {
		// include sub-classes
		$this->includes = array(
			'class-facetwp-template.php',
			'class-facetwp-submit.php',
		);

		parent::__construct( dirname( __FILE__ ) );
	}

	public function init() {
		$this->template = new Capstone_FacetWP_Template();
		$this->submit = new Capstone_FacetWP_Submit();
	}

	public function setup_actions() {
		/** Register & Enqueue Scripts */
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		
		/** Dequeue GMAP Script */
		add_filter( 'facetwp_assets', array( $this, 'dequeue_gmap' ) );

		/** Theme Support */
		add_action( 'after_setup_theme', array( $this, 'add_theme_support' ) );
	}

	/**
	 * Sets up theme support.
	 */
	public function add_theme_support() {
	}

	/**
	 * Register scripts.
	 */
	public function register_scripts() {
		wp_register_script( 'capstone-facetwp', $this->get_url() . 'scripts/js/facetwp.min.js', array( 'jquery', 'capstone-main' ) );
	}

	/**
	 * Enqueue script.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'capstone-facetwp' );
	}

	/**
	 * Enqueue script.
	 */
	public function dequeue_gmap( $assets ) {
		unset( $assets['gmaps'] );
		return $assets;
	}


}