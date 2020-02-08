<?php

class Capstone_WP_Job_Manager_Shortcodes {

	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	public function init() {
		/** Register Shortcode */
        add_shortcode( 'listing_spotlight', array( $this, 'listing_spotlight' ) );
    }

    #-------------------------------------------------------------------------------#
    #  Register the `[listing_spotlight]` shortcode
    #-------------------------------------------------------------------------------#

	public function listing_spotlight( $atts ) {
		// Default Attributes
		$_atts = shortcode_atts( array(
			'type'  => 'job_listing', // "job_listing" or "resume"
			'taxonomy'  => 'job_listing_category', // "job_listing_category" or "resume_category"
			'source'  => 'featured', // "fetured" or "ids"
			'sort'  => 'date',
			'order'  => 'DESC', // "asc" or "desc"
			'count'  => 3,
			'ids'  => '', // Comma seperate IDs of job or resume listings
		), $atts );

        // Query Variable(s)
        $query_args = array(
            'post_type'       => $_atts['type'],
            'orderby'         => $_atts['sort'],
            'order'           => $_atts['order'],
            'post_status'     => 'publish',
            'posts_per_page'  => intval($_atts['count']),
        );

        // Query Modification
        if ($_atts['source'] == 'ids') {
            $custom_listings = array_map('intval', explode(',', $_atts['ids']));
            $query_args['post__in'] = $custom_listings;
        } else if ($_atts['source'] == 'featured') {
            $query_args['meta_query'][] = array(
                'key'     => '_featured',
                'value'   => '1',
                'compare' => '=',
            );
        }

        // Generating Query
        $listing_query = new WP_Query($query_args);

        // Helper Variable(s) - Pass Variables
        set_query_var( '_atts', $_atts );
        set_query_var( 'listing_query', $listing_query );

        ob_start();
		get_template_part( '/integrations/wp-job-manager/templates/listing-spotlight' );
        return str_replace("\r\n",'',trim(ob_get_clean()));
	}


}