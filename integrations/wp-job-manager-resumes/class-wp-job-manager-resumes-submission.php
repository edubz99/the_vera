<?php

class Capstone_WP_Resume_Manager_Submission {

	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	public function init() {
		/** Login URL */
		add_filter( 'submit_resume_form_login_url', array( $this, 'resume_manager_login_url') );

		/** Fields Configuration */
		add_filter( 'submit_resume_form_fields', array($this, 'submit_resume_form_fields') );
		add_filter( 'submit_resume_form_submit_button_text', array($this, 'submit_resume_form_button_text') );

		/** Form Markup */
		add_action( 'submit_resume_form_resume_fields_start', array($this, 'submit_resume_form_resume_fields_start') );
		add_action( 'submit_resume_form_resume_fields_end', array($this, 'submit_resume_form_resume_fields_end') );
		
		/** Submission Flow */
		add_action( 'capstone_page_content_start', array($this, 'resume_submission_flow') );

		/** Register Settings */
		add_filter( 'resume_manager_settings', array( $this, 'resume_manager_settings' ) );
	}


	#-------------------------------------------------------------------------------#
	#  WP Resume Manager - Change Login URL
	#-------------------------------------------------------------------------------#

	function resume_manager_login_url( $login_url ) {
		$login_page = get_permalink(get_theme_mod('capstone_auth_login_page'));
		$submit_resume_page = get_permalink(get_option('resume_manager_submit_resume_form_page_id'));
		if ($login_page) {
			return $login_page . '?redirect_to=' . $submit_resume_page;
		}
		return $login_url;
	}

	#-------------------------------------------------------------------------------#
	#  Submit Resume Form - Fields Configuration
	#-------------------------------------------------------------------------------#

	function submit_resume_form_fields( $fields ) {
		$fields['resume_fields']['resume_skills']['priority'] = 7.5;
		return $fields;
	}

	function submit_resume_form_button_text( $text ) {
		return esc_html__( 'Preview Listing', 'capstone' ) ;
	}
	
	#-------------------------------------------------------------------------------#
	#  Submit Resume Form - Append Markup
	#-------------------------------------------------------------------------------#

    // Resume Fields
    function submit_resume_form_resume_fields_start() {
        echo '<div class="resume-info-fields">';
            echo '<h3 class="title">'. esc_html__('Resume Information', 'capstone') .'</h3>';
            echo '<div class="form-fields">';
    }

    function submit_resume_form_resume_fields_end() {
            echo '</div>';
        echo '</div>';
    }


	#-------------------------------------------------------------------------------#
	#  Resume Submission Flow
	#-------------------------------------------------------------------------------#

	function resume_submission_flow() {
		// temporary variables
		$is_packages_enabled = false;

		// get page IDs
		$current_page_id = get_queried_object_id();
		$resume_submission_page = intval( get_option( 'resume_manager_submit_resume_form_page_id', false ) );

		// get resume packages
		if (function_exists('wc_get_products')) {
			$resume_packages = wc_get_products( array( 'type' => array('resume_package', 'resume_package_subscription') ) );
			$is_packages_enabled = class_exists( 'WC_Paid_Listings' ) && !empty($resume_packages);
		}
		
		// display submission flow
		if ( !empty($resume_submission_page) && ($resume_submission_page == $current_page_id) ) { ?>

			<div class="submission-flow">
				<ul>
					<?php if ( get_option('resume_manager_paid_listings_flow') == 'before' && $is_packages_enabled ) { ?>
						<li class="choose-package"><span class="label"><?php echo esc_html__('Choose Package', 'capstone'); ?></span></li>
					<?php } ?>
					<li class="listing-details"><span class="label"><?php echo esc_html__('Listing Details', 'capstone'); ?></span></li>
					<li class="preview-listing"><span class="label"><?php echo esc_html__('Preview Listing', 'capstone'); ?></span></li>
					<?php if ( get_option('resume_manager_paid_listings_flow') != 'before' && $is_packages_enabled ) { ?>
						<li class="choose-package"><span class="label"><?php echo esc_html__('Choose Package', 'capstone'); ?></span></li>
					<?php } ?>
				</ul>
			</div>

		<?php
		}
	}

    #-------------------------------------------------------------------------------#
    #  Register Resume Manager Settings
    #-------------------------------------------------------------------------------#

	public function resume_manager_settings( $settings ) {
        $settings[ 'resume_submission' ][1][] = array(
            'name'     => 'resume_manager_disable_package_repurchase',
            'std'      => '0',
            'label'    => __( 'Package Repurchase', 'capstone' ),
            'cb_label' => __( 'Disable Package Repurchase', 'capstone' ),
            'desc'     => __( 'Check this to hide packages which user has already purchased.', 'capstone' ),
            'type'     => 'checkbox'
        );

        return $settings;
	}
	
}