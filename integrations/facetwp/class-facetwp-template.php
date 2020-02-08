<?php

class Capstone_FacetWP_Template {

	public function __construct() {
        // Wrap Facet Template
        add_action('capstone_page_content_start', array($this, 'facetwp_template_start'));
        add_action('capstone_page_content_end', array($this, 'facetwp_template_end'));

        // Register Jobs Template
        add_filter( 'facetwp_templates', array($this, 'register_job_listings_template'));
        add_filter( 'facetwp_query_args', array($this, 'facetwp_job_query_args'), 10, 2 );
        
        // Register Resumes Template
        add_filter( 'facetwp_templates', array($this, 'register_resume_listings_template'));
        add_filter( 'facetwp_query_args', array($this, 'facetwp_resume_query_args'), 10, 2 );

        // Facet Controls
        add_action('capstone_facet_controls', array($this, 'facetwp_controls'));
        add_action('capstone_facet_pagination', array($this, 'facetwp_pagination'));

        // Result Count String
        add_filter('facetwp_result_count', array($this, 'result_count'), 10, 2);

        // Enable Indexing of Resumes
        add_filter('register_post_type_resume', array($this, 'resume_index'));
    }

    #-------------------------------------------------------------------------------#
    #  Wrap FacetWP Template
    #-------------------------------------------------------------------------------#

    function facetwp_template_start() {
        if ( !is_singular() && (is_post_type_archive('job_listing') || is_post_type_archive('resume')) && !get_query_var('is_standard') ) {
            echo '<div class="facetwp-template">';
                echo do_action('capstone_facet_controls');
        }
    }

    function facetwp_template_end() {
        if ( !is_singular() && (is_post_type_archive('job_listing') || is_post_type_archive('resume')) && !get_query_var('is_standard') ) {
                echo do_action('capstone_facet_pagination');
            echo '</div>';
        }
    }

    #-------------------------------------------------------------------------------#
    #  Register Jobs FacetWP Template
    #-------------------------------------------------------------------------------#

    // Register the Template
    function register_job_listings_template( $templates ) {
        $templates[] = array(
            'label'     => 'Job Listings',
            'name'      => 'job_listings',
            'query'     => '',
            'template'  => ''
        );
        return $templates;
    }

    // Filter the FacetWP query when using the "job_listings" template in FacetWP
    function facetwp_job_query_args( $query_args, $facet ) {
        if ( 'job_listings' != $facet->template[ 'name' ] ) {
            return $query_args;
        }
        if ( '' == $query_args ) {
            $query_args = array();
        }
    
        // Prevent "Undefined index" error for search facets
        $search = '';
        if ( ! empty( $facet->http_params[ 'get' ][ 's' ] ) ) {
            $search = $facet->http_params[ 'get' ][ 's' ];
        }
        $defaults = array(
            'post_type' => 'job_listing',
            'post_status' => 'publish',
            's' => $search,
        );
        $query_args = wp_parse_args( $query_args, $defaults );
        return $query_args;
    }


    #-------------------------------------------------------------------------------#
    #  Register Resume FacetWP Template
    #-------------------------------------------------------------------------------#

    // Register the Template
    function register_resume_listings_template( $templates ) {
        $templates[] = array(
            'label'     => 'Resume Listings',
            'name'      => 'resume_listings',
            'query'     => '',
            'template'  => ''
        );
        return $templates;
    }

    // Filter the FacetWP query when using the "resume_listings" template in FacetWP
    function facetwp_resume_query_args( $query_args, $facet ) {
        if ( 'resume_listings' != $facet->template[ 'name' ] ) {
            return $query_args;
        }
        if ( '' == $query_args ) {
            $query_args = array();
        }
        // Prevent "Undefined index" error for search facets
        $search = '';
        if ( ! empty( $facet->http_params[ 'get' ][ 's' ] ) ) {
            $search = $facet->http_params[ 'get' ][ 's' ];
        }
        $defaults = array(
            'post_type' => 'resume',
            'posts_per_page' => 10,
            'post_status' => 'publish',
            's' => $search,
        );
        $query_args = wp_parse_args( $query_args, $defaults );
        return $query_args;
    }


    #-------------------------------------------------------------------------------#
    #  FacetWP Controls
    #-------------------------------------------------------------------------------#

    function facetwp_controls() {
        if (!get_query_var('is_standard')) {

            if ( !is_singular() && (is_post_type_archive('job_listing') || is_post_type_archive('resume')) ) {
                echo '<div class="facetwp-controls">';
                    echo facetwp_display( 'counts' );
                    echo '<a class="facetwp-reset" href="javascript:FWP.reset()">Reset</a>';
                    // echo facetwp_display( 'selections' );
                echo '</div>';
            }
    
        }
    }

    #-------------------------------------------------------------------------------#
    #  FacetWP Pagination
    #-------------------------------------------------------------------------------#

    function facetwp_pagination() {
        if (!get_query_var('is_standard')) {

            if ( !is_singular() && (is_post_type_archive('job_listing') || is_post_type_archive('resume')) ) {
                echo facetwp_display( 'pager' );
            }
    
        }
    }

    #-------------------------------------------------------------------------------#
    #  Filter Result Count
    #-------------------------------------------------------------------------------#

    function result_count( $output, $params ) {
        if (!get_query_var('is_standard')) {

            $first = $params['lower'];
            $last = $params['upper'];
            $total = $params['total'];

            ob_start();

            printf( _nx( 'Showing the single result', 'Showing %1$d&ndash;%2$d of %3$d results', $total, '%1$d = first, %2$d = last, %3$d = total', 'capstone' ), $first, $last, $total );

            return ob_get_clean();

        }
    }

    #-------------------------------------------------------------------------------#
    #  Enable Indexing of Resumes
    #-------------------------------------------------------------------------------#

    function resume_index( $output ) {
        $output['exclude_from_search'] = false;
        return $output;
    }


}
