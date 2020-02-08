<?php

class Capstone_WP_Job_Manager extends Capstone_Integration {

	public function __construct() {
		// include sub-classes
		$this->includes = array(
			'class-wp-job-manager-template.php',
			'class-wp-job-manager-submission.php',
			'class-wp-job-manager-fields.php',
			'class-wp-job-manager-schema.php',
			'class-wp-job-manager-shortcodes.php',
			'class-wp-job-manager-listing.php',
			'class-wp-job-manager-menu.php',
		);

		// add customizer support
		$this->has_customizer = true;

		parent::__construct( dirname( __FILE__ ) );
	}

	public function init() {
		$this->listing = new Capstone_WP_Job_Manager_Listing();
		$this->template = new Capstone_WP_Job_Manager_Template();
		$this->fields = new Capstone_WP_Job_Manager_Fields();
		$this->schema = new Capstone_WP_Job_Manager_Schema();
		$this->shortcodes = new Capstone_WP_Job_Manager_Shortcodes();
		$this->submission = new Capstone_WP_Job_Manager_Submission();
		$this->menu = new Capstone_WP_Job_Manager_Menu();
	}

	public function setup_actions() {
		/** Register & Enqueue Scripts */
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		/** Theme Support */
		add_action( 'after_setup_theme', array( $this, 'add_theme_support' ) );
		
		/** Register Sidebars */
		add_action('widgets_init', array($this, 'register_sidebar'));
	}

	/**
	 * Sets up theme support.
	 */
	public function add_theme_support() {
		add_theme_support( 'job-manager-templates' );
	}

	/**
	 * Register scripts.
	 */
	public function register_scripts() {
		wp_register_script( 'capstone-wp-job-manager', $this->get_url() . 'scripts/js/wp-job-manager.min.js', array( 'jquery', 'capstone-main' ) );
	}

	/**
	 * Enqueue script.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'capstone-wp-job-manager' );
		wp_enqueue_style( 'chosen', JOB_MANAGER_PLUGIN_URL . '/assets/css/chosen.css', array(), '1.1.0' );
	}

	/**
	 * Register Sidebars.
	 */
	public function register_sidebar() {

		// Register "Jobs Master" Sidebar
		register_sidebar( array(
			'name' => esc_html__( 'Jobs Master Sidebar', 'capstone' ),
			'id' => 'jobs-master',
			'description'   => esc_html__( 'To configure this widget\'s area visibility/order go to "Appearance -> Customize -> Jobs Settings -> Master Page".', 'capstone' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Register "Jobs Detail" Sidebar
		register_sidebar( array(
			'name' => esc_html__( 'Job Detail Sidebar', 'capstone' ),
			'id' => 'job-detail',
			'description'   => esc_html__( 'To configure this widget\'s area visibility/order go to "Appearance -> Customize -> Jobs Settings -> Detail Page".', 'capstone' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

	}

}