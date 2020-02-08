<?php

class Capstone_WP_Job_Manager_Template {

	public function __construct() {
        add_filter('capstone_site_body_start', array($this, 'job_archive_map_wrappper'));

		add_action('single_job_listing_quick_meta_start', array( $this, 'company_name_meta' ));
		add_action('single_job_listing_quick_meta_start', array( $this, 'company_location_meta' ));
	
	    add_action('single_job_listing_meta_start', array( $this, 'job_salary_meta' ));
		add_action('single_job_listing_meta_start', array( $this, 'job_experience_meta' ));
		add_action('single_job_listing_meta_start', array( $this, 'job_career_level_meta' ));
		add_action('single_job_listing_meta_start', array( $this, 'job_qualification_meta' ));
    }
    
    #-------------------------------------------------------------------------------#
    #  Job Archive - Add Map Wrapper
    #-------------------------------------------------------------------------------#

    function job_archive_map_wrappper( $args ) {
        $is_mapbox_token = get_theme_mod('capstone_mapbox_access_token');
        $maps_enabled = get_theme_mod( 'capstone_jobs_enable_map', false ) || get_query_var('map_enabled');
        $is_job_master_page = ( get_option('job_manager_jobs_page_id') && is_page(get_option('job_manager_jobs_page_id')) ) || is_post_type_archive('job_listing');
        
        if ($maps_enabled && $is_mapbox_token) {
            if ( $is_job_master_page ) {
                echo '<div id="map-wrapper"></div>';
            }
        }
    }

	#-------------------------------------------------------------------------------#
	#  WP Job Manager - Quick Meta Fields
	#-------------------------------------------------------------------------------#

    // Company Name Meta
    function company_name_meta() {
        echo '<li class="company">';
        echo '<span class="value">'. get_the_company_name() .'</span>';
        echo '</li>';
    }

    // Company Location Meta
    function company_location_meta() {
        echo '<li class="location">';
        echo '<span class="value">'. get_the_job_location() .'</span>';
        echo '</li>';
	}
	

	#-------------------------------------------------------------------------------#
	#  WP Job Manager - Meta Fields
	#-------------------------------------------------------------------------------#

    // Job Salary Meta
    function job_salary_meta() {
        if (get_field('_job_salary')) {
            echo '<li class="meta-field salary-meta">';
            echo '<img class="icon svg-icon" src="'. esc_url( get_template_directory_uri() .'/images/salary-icon.svg') .'" alt="'. esc_html__('Salary', 'capstone') .'">';
            echo '<label class="title">'. esc_html__('Salary', 'capstone') .':</label>';
            echo '<span class="value">'. wp_kses_post(get_post_meta(get_the_ID(), '_job_salary', true)) .'</span>';
            echo '</li>';
        }
    }

    // Job Experience Meta
    function job_experience_meta() {
        if (get_field('_job_experience')) {
            echo '<li class="meta-field experience-meta">';
            echo '<img class="icon svg-icon" src="'. esc_url( get_template_directory_uri() .'/images/experience-icon.svg') .'" alt="'. esc_html__('Experience', 'capstone') .'">';
            echo '<label class="title">'. esc_html__('Experience', 'capstone') .':</label>';
            echo '<span class="value">'. wp_kses_post(get_post_meta(get_the_ID(), '_job_experience', true)) .'</span>';
            echo '</li>';
    
        }
    }

    // Job Career Level Meta
    function job_career_level_meta() {
        if (get_field('_job_career_level')) {
            echo '<li class="meta-field career-level-meta">';
            echo '<img class="icon svg-icon" src="'. esc_url( get_template_directory_uri() .'/images/career-level-icon.svg') .'" alt="'. esc_html__('Career Level', 'capstone') .'">';
            echo '<label class="title">'. esc_html__('Career Level', 'capstone') .':</label>';
            echo '<span class="value">'. wp_kses_post(get_post_meta(get_the_ID(), '_job_career_level', true)) .'</span>';
            echo '</li>';
        }
    }

    // Job Qualification Meta
    function job_qualification_meta() {
        if (get_field('_job_qualification')) {
            echo '<li class="meta-field career-level-meta">';
            echo '<img class="icon svg-icon" src="'. esc_url( get_template_directory_uri() .'/images/qualification-icon.svg') .'" alt="'. esc_html__('Qualification', 'capstone') .'">';
            echo '<label class="title">'. esc_html__('Qualification', 'capstone') .':</label>';
            echo '<span class="value">'. wp_kses_post(get_post_meta(get_the_ID(), '_job_qualification', true)) .'</span>';
            echo '</li>';
        }
    }

}
