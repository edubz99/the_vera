<?php

class Capstone_WP_Job_Manager_Submission {

	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	public function init() {
		/** Fields Configuration */
		add_filter( 'submit_job_form_fields', array( $this, 'submit_job_form_fields' ) );
		add_filter( 'submit_job_form_submit_button_text', array( $this, 'submit_job_form_button_text' ) );
	
		/** Form Markup - Job Fields */
		add_action( 'submit_job_form_job_fields_start', array( $this, 'submit_form_job_fields_start' ) );
		add_action( 'submit_job_form_job_fields_end', array( $this, 'submit_form_job_fields_end' ) );
		
		/** Form Markup - Company Fields */
		add_action( 'submit_job_form_company_fields_start', array( $this, 'submit_form_company_fields_start' ) );
		add_action( 'submit_job_form_company_fields_end', array( $this, 'submit_form_company_fields_end' ) );
	
		/** Form Markup - Company Selection */
		add_action( 'submit_job_form_company_fields_start', array( $this, 'submit_form_company_selection' ) );

		/** WP Editor Toolbar */
		add_filter( 'submit_job_form_wp_editor_args', array( $this, 'customize_editor_toolbar' ) );
	
		/** Login URL */
    	add_filter( 'submit_job_form_login_url', array( $this, 'job_manager_login_url') );
	
		/** Submission Flow */
		add_action( 'capstone_page_content_start', array($this, 'job_submission_flow') );
		add_action( 'capstone_dashboard_page_content_start', array($this, 'job_submission_flow') );
	
		/** Register Settings */
		add_filter( 'job_manager_settings', array( $this, 'job_manager_settings' ) );

	}

	#-------------------------------------------------------------------------------#
	#  WP Job Manager - Fields Configuration
	#-------------------------------------------------------------------------------#

	function submit_job_form_fields( $fields ) {
		if (array_key_exists('job_tags', $fields['job'])) {
			$fields['job']['job_tags']['priority'] = 2.5;
		}
		$fields['job']['job_location']['description'] = '';
		$fields['company']['company_name']['label'] = esc_html__('Company Name', 'capstone');
		$fields['company']['company_logo']['label'] = esc_html__('Upload Logo', 'capstone');
		
		return $fields;
	}

	function submit_job_form_button_text( $text ) {
		return esc_html__( 'Preview Listing', 'capstone' ) ;
	}

	#-------------------------------------------------------------------------------#
	#  WP Job Manager - Append Markup
	#-------------------------------------------------------------------------------#

    // Job Fields
    function submit_form_job_fields_start() {
        echo '<div class="job-info-fields">';
            echo '<h3 class="title">'. esc_html__('Job Information', 'capstone') .'</h3>';
            echo '<div class="form-fields">';
    }
    function submit_form_job_fields_end() {
            echo '</div>';
        echo '</div>';
    }

    // Company Fields
    function submit_form_company_fields_start() {
        echo '<div class="company-info-fields">';
            echo '<h3 class="title">'. esc_html__('Company Information', 'capstone') .'</h3>';
            echo '<div class="form-fields">';
    }
    function submit_form_company_fields_end() {
            echo '</div>';
        echo '</div>';
	}

	// Company Selection
	function submit_form_company_selection() {
		// Helper Variable(s)
		if ( get_option('job_manager_enable_user_specific_company') ) {
			$current_user_id = get_current_user_id();
			$current_user_terms = capstone_get_user_companies($current_user_id);
			$terms_status_class = $current_user_terms ? 'has-terms' : 'no-terms';
		} else {
			$terms_status_class = 'has-terms';
		}

		echo '<div id="company-selection" class="'. $terms_status_class .'">';
			echo '<a class="fieldset new-company active" href="#company-selection" >';
				echo '<span class="icon"><img src="'. get_template_directory_uri() .'/images/add-company.svg' .'" alt="'. esc_html__('Create New Company', 'capstone') .'"></span>';
				echo '<span class="text">'. esc_html__('Create New Company', 'capstone') .'</span>';
			echo '</a>';

			echo '<a class="fieldset existing-company" href="#company-selection" >';
				echo '<span class="icon"><img src="'. get_template_directory_uri() .'/images/company.svg' .'" alt="'. esc_html__('Existing Company', 'capstone') .'"></span>';
				echo '<span class="text">'. esc_html__('Existing Company', 'capstone') .'</span>';
			echo '</a>';
		echo '</div>';

		echo '<p class="no-terms-message hidden">';
			echo esc_html__('You either have not logged in or you don\'t have any company assigned.', 'capstone');
		echo '</p>';

	}
	
	#-------------------------------------------------------------------------------#
	#  WP Job Manager - Extend TinyMCE Editor Functionality
	#-------------------------------------------------------------------------------#

	function customize_editor_toolbar( $args ) {
		$args['tinymce']['toolbar1'] = 'formatselect,|,bold,italic,underline,|,bullist,numlist,|,link,unlink,|,undo,redo';
		return $args;
	}

	#-------------------------------------------------------------------------------#
	#  WP Job Manager - Change Login URL
	#-------------------------------------------------------------------------------#

	function job_manager_login_url( $login_url ) {
		$login_page = get_permalink(get_theme_mod('capstone_auth_login_page'));
		$submit_job_page = get_permalink(get_option('job_manager_submit_job_form_page_id'));
		if ($login_page) {
			return $login_page . '?redirect_to=' . $submit_job_page;
		}
		return $login_url;
	}

	#-------------------------------------------------------------------------------#
	#  Job Submission Flow
	#-------------------------------------------------------------------------------#

	function job_submission_flow() {
		// temporary variables
		$is_packages_enabled = false;

		// get page IDs
		$current_page_id = get_queried_object_id();
		$job_submission_page = intval( get_option( 'job_manager_submit_job_form_page_id', false ) );
		
		// get job packages
		if (function_exists('wc_get_products')) {
			$job_packages = wc_get_products( array( 'type' => array('job_package', 'job_package_subscription') ) );
			$is_packages_enabled = class_exists( 'WC_Paid_Listings' ) && !empty($job_packages);
		}

		// display submission flow
		if ( !empty($job_submission_page) && ($job_submission_page == $current_page_id) ) { ?>

			<div class="submission-flow">
				<ul>
					<?php if ( get_option('job_manager_paid_listings_flow') == 'before' && $is_packages_enabled ) { ?>
						<li class="choose-package"><span class="label"><?php echo esc_html__('Choose Package', 'capstone'); ?></span></li>
					<?php } ?>
					<li class="listing-details"><span class="label"><?php echo esc_html__('Listing Details', 'capstone'); ?></span></li>
					<li class="preview-listing"><span class="label"><?php echo esc_html__('Preview Listing', 'capstone'); ?></span></li>
					<?php if ( get_option('job_manager_paid_listings_flow') != 'before' && $is_packages_enabled ) { ?>
						<li class="choose-package"><span class="label"><?php echo esc_html__('Choose Package', 'capstone'); ?></span></li>
					<?php } ?>
				</ul>
			</div>

		<?php
		}
	}

    #-------------------------------------------------------------------------------#
    #  Register Job Manager Settings
    #-------------------------------------------------------------------------------#

	public function job_manager_settings( $settings ) {
		$settings[ 'general' ][1][] = array(
            'name'     => 'job_manager_google_maps_api_key_alt',
            'label'    => __( 'Google Maps API Key (alt)', 'capstone' ),
            'desc'     => __( 'This API key can be restricted with HTTP referrers. It is used for different clients-side google services e.g. user geolocation (geocode API), location autocomplete (places API).', 'capstone' ),
			'type'     => 'input'
        );

        $settings[ 'job_submission' ][1][] = array(
            'name'     => 'job_manager_disable_package_repurchase',
            'std'      => '0',
            'label'    => __( 'Package Repurchase', 'capstone' ),
            'cb_label' => __( 'Disable Package Repurchase', 'capstone' ),
            'desc'     => __( 'Check this to hide packages which user has already purchased.', 'capstone' ),
            'type'     => 'checkbox'
        );

        return $settings;
    }

}