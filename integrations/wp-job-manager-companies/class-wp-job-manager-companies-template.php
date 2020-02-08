<?php

class Capstone_WP_Job_Manager_Companies_Template {

	public function __construct() {
        add_action('single_company_listing_quick_meta_start', array($this, 'company_profile_location_meta'));

        add_action('single_company_listing_meta_start', array( $this, 'company_size_meta' ));
		add_action('single_company_listing_meta_start', array( $this, 'foundation_year_meta' ));
    
        add_action('single_company_listing_social_before', array($this, 'company_profile_facebook_meta'));
        add_action('single_company_listing_social_before', array($this, 'company_profile_twitter_meta'));
        add_action('single_company_listing_social_before', array($this, 'company_profile_linkedin_meta'));
        add_action('single_company_listing_social_before', array($this, 'company_profile_website_meta'));
    }
    
    #-------------------------------------------------------------------------------#
    #  WP Job Manager - Company Profiles Fields
    #-------------------------------------------------------------------------------#

    // Company Name Meta
    function company_profile_location_meta() {
        $company_location = get_post_meta(get_the_ID(), '_company_location', true);
        if ($company_location) {
            echo '<li class="location">';
            echo '<span class="value">'. esc_html($company_location) .'</span>';
            echo '</li>';
        }
    }

    #-------------------------------------------------------------------------------#
	#  WP Job Manager - Companies - Meta Fields
	#-------------------------------------------------------------------------------#

    // Company Size Meta
    function company_size_meta() {
        if (get_field('_company_size')) {
            echo '<li class="meta-field size-meta">';
            echo '<img class="icon svg-icon" src="'. esc_url( get_template_directory_uri() .'/images/company-size-icon.svg') .'" alt="'. esc_html__('Company Size', 'capstone') .'">';
            echo '<label class="title">'. esc_html__('Company Size', 'capstone') .':</label>';
            echo '<span class="value">'. wp_kses_post(get_post_meta(get_the_ID(), '_company_size', true)) .'</span>';
            echo '</li>';
        }
    }

    // Foundation Year Meta
    function foundation_year_meta() {
        if (get_field('_company_foundation')) {
            echo '<li class="meta-field foundation-meta">';
            echo '<img class="icon svg-icon" src="'. esc_url( get_template_directory_uri() .'/images/foundation-icon.svg') .'" alt="'. esc_html__('Foundation Year', 'capstone') .'">';
            echo '<label class="title">'. esc_html__('Foundation Year', 'capstone') .':</label>';
            echo '<span class="value">'. wp_kses_post(get_post_meta(get_the_ID(), '_company_foundation', true)) .'</span>';
            echo '</li>';
    
        }
    }

    #-------------------------------------------------------------------------------#
    #  WP Job Manager - Company Profiles Social Fields
    #-------------------------------------------------------------------------------#

    // Facebook Profile
    function company_profile_facebook_meta() {
        $facebook_profile = get_post_meta(get_the_ID(), '_company_facebook', true);
        if ( $facebook_profile ) {
            echo '<li class="facebook">';
            echo '<a href="https://facebook.com/'. esc_attr($facebook_profile) .'" rel="_blank"><i class="fab fa-facebook-f"></i></a>';
            echo '</li>';
        }
    }

    // Facebook Profile
    function company_profile_twitter_meta() {
        $twitter_profile = get_the_company_twitter();
        if ( $twitter_profile ) {
            echo '<li class="twitter">';
            echo '<a href="https://twitter.com/'. esc_attr($twitter_profile) .'" rel="_blank"><i class="fab fa-twitter"></i></a>';
            echo '</li>';
        }
    }

    // LinkedIn Profile
    function company_profile_linkedin_meta() {
        $linkedin_profile = get_post_meta(get_the_ID(), '_company_linkedin', true);
        if ( $linkedin_profile ) {
            echo '<li class="linkedin">';
            echo '<a href="https://linkedin.com/company/'. esc_attr($linkedin_profile) .'" rel="_blank"><i class="fab fa-linkedin-in"></i></a>';
            echo '</li>';
        }
    }

    // Website Link
    function company_profile_website_meta() {
        $website_link = get_the_company_website();
        if ( $website_link ) {
            echo '<li class="website">';
            echo '<a href="'. esc_url($website_link) .'" rel="_blank"><i class="fas fa-globe-americas"></i></a>';
            echo '</li>';
        }
    }

}
