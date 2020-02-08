<?php

class Capstone_Private_Messages extends Capstone_Integration {

	public function __construct() {
		parent::__construct( dirname( __FILE__ ) );
	}

	public function init() {
	}

	public function setup_actions() {
		/** Theme Support */
		if (pm_get_option( 'pm_wpjm_contact_method', true ) && is_user_logged_in()) {
			add_action( 'init', array( $this, 'resume_manager_support' ) );
		}
	}

	/**
	 * Sets resume manager support.
	 */
	public function resume_manager_support() {
		global $resume_manager;
	
		remove_action( 'resume_manager_contact_details', array( $resume_manager->post_types, 'contact_details_email' ) );
		add_action( 'resume_manager_contact_details', function() {
			$apply = new stdClass();
			$apply->to = get_post()->post_author;
			$apply->subject = esc_html__('Hello there', 'capstone');
			$apply->message = '';
	
			wp_enqueue_style( 'private-messages-frontend' );
	
			echo Private_Messages_Templates::get_template( 'frontend/job-application-pm.php', array(
				'apply' => $apply,
			) );
		} );
	}

}