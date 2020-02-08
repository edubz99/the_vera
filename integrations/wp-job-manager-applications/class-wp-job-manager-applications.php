<?php

class Capstone_WP_Job_Manager_Applications extends Capstone_Integration {

	public function __construct() {
		parent::__construct( dirname( __FILE__ ) );
	}

	public function setup_actions() {
		/** Register & Enqueue Scripts */
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	
		/** Custom Login Permalink */
		add_filter( 'job_manager_job_applications_login_required_message', array($this, 'custom_login_permalink') );
	}

	/**
	 * Register scripts.
	 */
	public function register_scripts() {
		wp_register_script( 'capstone-wp-job-manager-applications', $this->get_url() . 'scripts/js/wp-job-manager-applications.min.js', array( 'jquery', 'capstone-main' ) );
	}

	/**
	 * Enqueue script.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'capstone-wp-job-manager-applications' );
	}

	#-------------------------------------------------------------------------------#
	#  Use Custom Login Permalink in Applications Popup
	#-------------------------------------------------------------------------------#

	function custom_login_permalink() {
		$login_url = get_theme_mod('capstone_auth_login_page') ? get_permalink(get_theme_mod('capstone_auth_login_page')) . '?redirect_to=' .  get_permalink() : wp_login_url( get_permalink() );
		echo sprintf( __( 'You must <a href="%s">sign in</a> to apply for this position.', 'capstone' ), $login_url );
	}


}