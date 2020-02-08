<?php

class Capstone_WP_Resume_Manager extends Capstone_Integration {

	public function __construct() {
		// include sub-classes
		$this->includes = array(
			'class-wp-job-manager-resumes-template.php',
			'class-wp-job-manager-resumes-submission.php',
			'class-wp-job-manager-resumes-listing.php',
			'class-wp-job-manager-resumes-menu.php',
		);

		// add customizer support
		$this->has_customizer = true;

		parent::__construct( dirname( __FILE__ ) );
	}

	public function init() {
		$this->listing = new Capstone_WP_Resume_Manager_Listing();
		$this->template = new Capstone_WP_Resume_Manager_Template();
		$this->submission = new Capstone_WP_Resume_Manager_Submission();
		$this->menu = new Capstone_WP_Resume_Manager_Menu();
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
		add_theme_support( 'resume-manager-templates' );
	}

	/**
	 * Register scripts.
	 */
	public function register_scripts() {
		wp_register_script( 'capstone-wp-job-manager-resumes', $this->get_url() . 'scripts/js/wp-job-manager-resumes.min.js', array( 'jquery', 'capstone-main' ) );
	}

	/**
	 * Enqueue script.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'capstone-wp-job-manager-resumes' );
	}

	/**
	 * Register Sidebars.
	 */
	public function register_sidebar() {

		// Register "Resumes Master" Sidebar
		register_sidebar( array(
			'name' => esc_html__( 'Resumes Master Sidebar', 'capstone' ),
			'id' => 'resumes-master',
			'description'   => esc_html__( 'To configure this widget\'s area visibility/order go to "Appearance -> Customize -> Resumes Settings -> Master Page".', 'capstone' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Register "Resumes Detail" Sidebar
		register_sidebar( array(
			'name' => esc_html__( 'Resume Detail Sidebar', 'capstone' ),
			'id' => 'resume-detail',
			'description'   => esc_html__( 'To configure this widget\'s area visibility/order go to "Appearance -> Customize -> Resumes Settings -> Detail Page".', 'capstone' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

	}


}