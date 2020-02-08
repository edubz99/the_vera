<?php

class Capstone_WP_Job_Manager_Bookmarks extends Capstone_Integration {

	public function __construct() {
		parent::__construct( dirname( __FILE__ ) );
	}

	public function setup_actions() {
		global $job_manager_bookmarks;

		/** Register & Enqueue Scripts */
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		
		remove_filter( 'single_job_listing_meta_after', array( $job_manager_bookmarks, 'bookmark_form' ));

		add_action( 'capstone_bookmark_popup', array( $job_manager_bookmarks, 'bookmark_form' ), 11 );
		
		/** Add "Bookmark" Button */
		add_action( 'job_actions_end', array($this, 'add_bookmark_button'), 10 );
		add_action( 'resume_actions_end', array($this, 'add_bookmark_button'), 10 );
	}

	/**
	 * Register scripts.
	 */
	public function register_scripts() {
		wp_register_script( 'capstone-wp-job-manager-bookmarks', $this->get_url() . 'scripts/js/wp-job-manager-bookmarks.min.js', array( 'jquery', 'capstone-main' ) );
	}

	/**
	 * Enqueue script.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'capstone-wp-job-manager-bookmarks' );
	}

	#-------------------------------------------------------------------------------#
	#  Add "Bookmark" Button
	#-------------------------------------------------------------------------------#

	function add_bookmark_button() {
		echo '<a href="#add-bookmark-'. esc_attr(get_the_ID()) .'" class="add-bookmark">'. esc_html__('Bookmark It', 'capstone'). '</a>';
	}

}