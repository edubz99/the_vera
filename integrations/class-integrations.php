<?php

class Capstone_Integrations {

	private $supported_integrations;
	public $integrations;

	public function __construct() {
		// Load Integrations
		$this->supported_integrations = array(
			'wp-job-manager' => array(
				class_exists( 'WP_Job_Manager' ),
				'Capstone_WP_Job_Manager',
			),
			'wp-job-manager-resumes' => array(
				class_exists( 'WP_Resume_Manager' ),
				'Capstone_WP_Resume_Manager',
			),
			'wp-job-manager-companies' => array(
				class_exists( 'WP_Job_Manager_Companies' ),
				'Capstone_WP_Job_Manager_Companies',
			),			
			'wp-job-manager-applications' => array(
				class_exists( 'WP_Job_Manager_Applications' ),
				'Capstone_WP_Job_Manager_Applications',
			),
			'wp-job-manager-bookmarks' => array(
				class_exists( 'WP_Job_Manager_Bookmarks' ),
				'Capstone_WP_Job_Manager_Bookmarks',
			),
			'wp-job-manager-alerts' => array(
				class_exists( 'WP_Job_Manager_Alerts' ),
				'Capstone_WP_Job_Manager_Alerts',
			),
			'wp-job-manager-field-editor' => array(
				class_exists( 'WP_Job_Manager_Field_Editor' ),
				'Capstone_WP_Job_Manager_Field_Editor',
			),
			'private-messages' => array(
				class_exists( 'Private_Messages' ),
				'Capstone_Private_Messages',
			),
			'woocommerce' => array(
				class_exists( 'WooCommerce' ),
				'Capstone_WooCommerce',
			),
			'facetwp' => array(
				class_exists( 'FacetWP' ),
				'Capstone_FacetWP',
			),
		);

		$this->load_integrations();
	}

	public function has( $key ) {
		return isset( $this->integrations[ $key ] );
	}

	public function get( $key ) {
		if ( ! $this->has( $key ) ) {
			return false;
		}

		return $this->integrations[ $key ];
	}

	public function add( $key, $class ) {
		$this->integrations[ $key ] = $class;
	}

	private function load_integrations() {
		foreach ( $this->supported_integrations as $key => $integration ) {
			if ( $integration[0] ) {
				require_once( trailingslashit( dirname( __FILE__ ) ) . trailingslashit( $key ) . 'class-' . $key . '.php' );

				$class = new $integration[1];

				$this->add( $key, $class );
			}
		}
	}

}
