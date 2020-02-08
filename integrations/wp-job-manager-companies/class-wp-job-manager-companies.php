<?php

class Capstone_WP_Job_Manager_Companies extends Capstone_Integration {

	public function __construct() {
		// include sub-classes
		$this->includes = array(
			'class-wp-job-manager-companies-template.php',
			'class-wp-job-manager-companies-menu.php',
		);

		// add customizer support
		$this->has_customizer = true;

		parent::__construct( dirname( __FILE__ ) );
	}

	public function init() {
		$this->template = new Capstone_WP_Job_Manager_Companies_Template();
		$this->menu = new Capstone_WP_Job_Manager_Companies_Menu();
	}

	public function setup_actions() {
		/** Register & Enqueue Scripts */
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		/** Register Sidebars */
		add_action('widgets_init', array($this, 'register_sidebar'));

		/** Modify Taxonomy Page Query */
		add_action( 'pre_get_posts', array($this, 'modify_company_taxonomy_query'));
	}

	/**
	 * Register scripts.
	 */
	public function register_scripts() {
		wp_register_script( 'capstone-wp-job-manager-companies', $this->get_url() . 'scripts/js/wp-job-manager-companies.min.js', array( 'jquery', 'capstone-main' ) );
	}

	/**
	 * Enqueue script.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'capstone-wp-job-manager-companies' );
	}

	/**
	 * Register Sidebars.
	 */
	public function register_sidebar() {

		// Register "Companies Master" Sidebar
		register_sidebar( array(
			'name' => esc_html__( 'Companies Master Sidebar', 'capstone' ),
			'id' => 'companies-master',
			'description'   => esc_html__( 'To configure this widget\'s area visibility/order go to "Appearance -> Customize -> Companies Settings -> Master Page".', 'capstone' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Register "Company Detail" Sidebar
		register_sidebar( array(
			'name' => esc_html__( 'Company Detail Sidebar', 'capstone' ),
			'id' => 'company-detail',
			'description'   => esc_html__( 'To configure this widget\'s area visibility/order go to "Appearance -> Customize -> Companies Settings -> Detail Page".', 'capstone' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

	}


	/**
	 * Modify Company Taxonomy Query.
	 */
    public function modify_company_taxonomy_query( $query ) {

        if ( $query->is_main_query() && $query->is_tax( 'job_listing_company' ) ) {
            // preliminary data
            $term = get_queried_object(); // get the current taxonomy term
            $meta_source = get_field('company_meta_source', $term);

            // modify main query
            if ($meta_source == 'latest') {
                $query->set( 'order', 'DESC' );
            } else {
                $query->set( 'order', 'ASC' );
            }
        }
    }

}