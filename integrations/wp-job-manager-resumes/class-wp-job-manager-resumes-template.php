<?php

class Capstone_WP_Resume_Manager_Template {

	public function __construct() {
        add_filter( 'capstone_site_body_start', array($this, 'resume_archive_map_wrappper') );

        add_action('single_resume_quick_meta_start', array($this, 'resume_tagline_meta'), 1);
        add_action('single_resume_quick_meta_end', array($this, 'resume_location_meta'), 1);
	}

    #-------------------------------------------------------------------------------#
    #  Resume Archive - Add Map Wrapper
    #-------------------------------------------------------------------------------#

    function resume_archive_map_wrappper( $args ) {
        $is_mapbox_token = get_theme_mod('capstone_mapbox_access_token');
        $maps_enabled = get_theme_mod( 'capstone_resumes_enable_map', false ) || get_query_var('map_enabled');
        $is_resume_master_page = ( get_option('resume_manager_resumes_page_id') && is_page(get_option('resume_manager_resumes_page_id')) ) || is_post_type_archive('resume');
        
        if ($maps_enabled && $is_mapbox_token) {
            if ( $is_resume_master_page ) {
                echo '<div id="map-wrapper"></div>';
            }
        }
    }

    #-------------------------------------------------------------------------------#
    #  WP Resume Manager - Compact Meta Fields
    #-------------------------------------------------------------------------------#

    // Resume Tagline Meta
    function resume_tagline_meta() {
        echo '<li class="tagline">';
        echo '<span class="value">'. get_the_candidate_title() .'</span>';
        echo '</li>';
    }

    // Resume Location Meta
    function resume_location_meta() {
        echo '<li class="location">';
        echo '<span class="value">'. get_the_candidate_location() .'</span>';
        echo '</li>';
    }

}
