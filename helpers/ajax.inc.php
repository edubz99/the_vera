<?php

#-------------------------------------------------------------------------------#
#  Get Companies List
#-------------------------------------------------------------------------------#

    function capstone_companies_list() {
        $categories = []; //array to store all of your category names

        if ( taxonomy_exists('job_listing_company') ) {
            $category_list_items = get_terms( 'job_listing_company' );
            
            foreach($category_list_items as $category_list_item){
                if(! empty($category_list_item->name) ){
                    array_push($categories, $category_list_item->name);
                }
            }
        }

        wp_send_json_success( $categories );
    }

    add_action( 'wp_ajax_capstone_companies_list', 'capstone_companies_list' );
    add_action( 'wp_ajax_nopriv_capstone_companies_list', 'capstone_companies_list' );

#-------------------------------------------------------------------------------#
#  Return "Company Meta" for a given Term ID
#-------------------------------------------------------------------------------#

    function capstone_get_company_data($term, $search_query=null, $return='data') {
        // preliminary data
        $term_id = isset($_POST['id']) ? $_POST['id'] : (isset($_GET['id']) ? $_GET['id'] : null);

        if ( isset($term_id) )  { // if called via ajax method
            $term = get_term( $term_id, 'job_listing_company' ); 
        } else if ( !isset($term) ) { // if $term object is NOT provided manually
            $term = get_queried_object(); // get it from current loop
        }
        $meta_source = get_field('company_meta_source', $term);

        // create query based on 'term' and 'meta source'
        $args = array(
            "post_type" => 'job_listing',
            "posts_per_page" => 1,
            "post_status" => 'publish',
			"orderby" => 'date', // this is the default
			"order" => 'ASC', // this is the default
			"tax_query" => array(
                array (
                    'taxonomy' => 'job_listing_company',
                    'field' => 'term_id',
                    'terms' => $term->term_id,
                ),
			),
        );

        // MODIFY QUERY: If "Meta Source" is "latest"
        if ($meta_source == 'latest') {
            $args['order'] = 'DESC';
        }

        if ( isset($search_query) && !empty($search_query) ) {

            // MODIFY QUERY: If "Keyword" parameter exist
            if ( !empty($search_query[0]) ) {
                $args['meta_query'][] = array(
                    'key'     => '_company_name',
                    'value'   => $search_query[0],
                    'compare' => 'LIKE',
                );
            }

            // MODIFY QUERY: If "Location" parameter exist
            if ( !empty($search_query[1]) ) {
                $args['meta_query'][] = array(
                    'key'     => '_company_location',
                    'value'   => $search_query[1],
                    'compare' => 'LIKE',
                );
            } 

            // MODIFY QUERY: If "Industry" parameter exist
            if ( !empty($search_query[2]) ) {
                $args['tax_query'][] = array(
                    'taxonomy' => 'job_listing_industry',
                    'field' => 'name',
                    'terms'   => $search_query[2],
                );
            } 

        }

        $meta_source_query = new WP_Query($args);
        
        // RETURN the "QUERY"
        if ($return == 'query') {
            return $meta_source_query;
        }
        
        // get all meta keys:value pairs
        $meta_source_id = $meta_source_query->posts[0]->ID;
        $listing_meta = get_post_meta($meta_source_id);

        // RETURN the "ID"
        if ($return == 'id') {
            return $meta_source_id;
        }
        
        // narrow down keys to only those which are prefixed with "_company"
        $company_meta_unserialized = array_filter($listing_meta, function($key) {
            return strpos($key, '_company') === 0;
        }, ARRAY_FILTER_USE_KEY);

        // unserialize all meta values
        function unserialize_data($item) {
            return maybe_unserialize($item[0]);
        }
        $company_meta = array_map('unserialize_data', $company_meta_unserialized);

        // echo '<pre>' . var_export($company_meta, true) . '</pre>';

        // RETURN the "DATA"
        if ($return == 'data') {
            if ( isset($term_id) )  { // if called via ajax method
                wp_send_json_success( $company_meta );
            } else { // if called other ajax
                return $company_meta;
            }
        }

    }

    add_action( 'wp_ajax_capstone_get_company_data', 'capstone_get_company_data' );
    add_action( 'wp_ajax_nopriv_capstone_get_company_data', 'capstone_get_company_data' );


#-------------------------------------------------------------------------------#
#  Return Companies for a given User ID
#-------------------------------------------------------------------------------#

    function capstone_get_user_companies($user_id = 0) {
        if ($user_id == 0) {
            return null;
        }

        $current_user_id = isset($_GET['user_id']) ? $_GET['user_id'] : (isset($user_id) ? $user_id : get_current_user_id());
        $user_company_term_ids = []; //array to store all of user company term IDs

        // query `job_listing_company` taxonomy terms based on meta
        $term_args = array(
            'taxonomy'  => 'job_listing_company',
            'hide_empty' => false, // also retrieve terms which are not used yet
            'meta_query' => array(
                array(
                    'key'       => 'company_assigned_users',
                    'value'     => $current_user_id,
                    'compare'   => 'LIKE'
                )
            ),
        );
        $user_company_terms = get_terms($term_args);

        // narrow the result to only term IDs
        foreach($user_company_terms as $user_company_term){
            if(! empty($user_company_term->term_id) ){
                array_push($user_company_term_ids, $user_company_term->term_id);
            }
        }

        // wp_send_json_success( $user_company_terms ); // return company meta

        // return user-specific company term(s) IDs
        return $user_company_term_ids;
    }

    add_action( 'wp_ajax_capstone_get_user_companies', 'capstone_get_user_companies' );
    add_action( 'wp_ajax_nopriv_capstone_get_user_companies', 'capstone_get_user_companies' );


#-------------------------------------------------------------------------------#
#  Share via Email
#-------------------------------------------------------------------------------#

    function capstone_share_via_email() {
        header('Location: http://google.com');
        exit();
    }

    add_action( 'wp_ajax_capstone_share_via_email', 'capstone_share_via_email' );
    add_action( 'wp_ajax_nopriv_capstone_share_via_email', 'capstone_share_via_email' );


