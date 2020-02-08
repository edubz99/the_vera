<?php

class Capstone_WP_Job_Manager_Listing {

	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	public function init() {
        global $job_manager_application_deadline, $job_manager_alerts;
        
        /** Modify query parameters */
        add_action( 'pre_get_posts', array( $this, 'modify_jobs_query') );
        
        /** Allow `search_type` query parameter */
        add_filter( 'job_manager_output_jobs_defaults', array( $this, 'query_param_search_type' ));

        /** Remove Application Deadline */
        remove_filter( 'job_listing_meta_end', array( $job_manager_application_deadline, 'display_the_deadline' ));
        remove_filter( 'single_job_listing_meta_end', array( $job_manager_application_deadline, 'display_the_deadline' ));
        
        /** Remove Job Alerts */
        remove_filter( 'single_job_listing_end', array( $job_manager_alerts, 'single_alert_link' ) );
    
        /** Master Listings - Add Auto Excerpt  */
        add_action( 'job_listing_meta_end', array( $this, 'add_auto_excerpt' ), 99);

        /** Remove Default Meta from Detail Page */
        add_action( 'wp_head', array( $this, 'remove_single_job_listing_actions') );
        
        /** Bind default `job_content_start` to theme hook */
        add_action( 'single_job_listing_start', array( $this, 'job_content_start') );
        
        /** Add "Video" in Detail Page */
        add_action( 'single_job_listing_desc_before', array( $this, 'add_video_above_job_desc'), -1 );
    
        /** Add "Apply Now" Button */
        add_action( 'job_actions_start', array($this, 'add_application_button'), 10 );
        
        /** Add "More Actions" - Trigger */
        add_action( 'job_actions_end', array($this, 'add_more_actions'), 10 );

        /** Add "More Actions" - Links */
        add_action( 'single_job_listing_more_actions_start', array($this, 'print_the_job'), 10 );
        add_action( 'single_job_listing_more_actions_start', array($this, 'share_via_email'), 10 );
        add_action( 'single_job_listing_more_actions_start', array($this, 'share_via_twitter'), 10 );
        add_action( 'single_job_listing_more_actions_start', array($this, 'share_via_facebook'), 10 );
        add_action( 'single_job_listing_more_actions_start', array($this, 'report_the_job'), 10 );

        /** Register Settings */
		add_filter( 'job_manager_settings', array( $this, 'job_manager_settings' ) );
        
        /** Enable Shortcodes in Job Description */
        add_action( 'wpjm_the_job_description', array($this, 'enable_shortcode_wpjm_description'), 10 );
    }

    #-------------------------------------------------------------------------------#
	#  WP Job Manager - Merge `job_content_start` with `single_job_listing_start`
	#-------------------------------------------------------------------------------#

    function job_content_start() {
        return do_action('job_content_start');
    }

    #-------------------------------------------------------------------------------#
	#  WP Job Manager - Modify Main Query
	#-------------------------------------------------------------------------------#

    function modify_jobs_query( $query ) {
        $post_type = $query->get('post_type');

        if ( !is_admin() && $post_type == 'job_listing' && $query->is_main_query() ) {
            $query->query_vars['posts_per_page'] = apply_filters('capstone_jobs_per_page', 10);
            
            if ( intval( get_option( 'job_manager_hide_expired', get_option( 'job_manager_hide_expired_content', 1 ) )) !== 0 ) {
                $query->set( 'post_status', [ 'publish' ] );
            }
        }
    }
    
    #-------------------------------------------------------------------------------#
	#  WP Job Manager - Allow `search_type` query parameter
	#-------------------------------------------------------------------------------#

    function query_param_search_type($atts) {
        if ( ! empty( $_GET['search_type'] ) ) {
			$atts['selected_job_types'] = sanitize_text_field( $_GET['search_type'] );
        }
        
        return $atts;
    }

    #-------------------------------------------------------------------------------#
	#  Master Listings - Add Auto Excerpt
	#-------------------------------------------------------------------------------#
    
    function add_auto_excerpt() {
        $auto_job_excerpt = get_theme_mod('capstone_jobs_enable_auto_excerpt');
        if ($auto_job_excerpt) {
            echo '<li class="auto-excerpt" data-full-width>';
                echo '<label>'. esc_html__('Excerpt:', 'capstone') .'</label>';
                echo '<p>'. get_the_excerpt() .'</p>';
            echo '</li>';
        }
    }

	#-------------------------------------------------------------------------------#
	#  WP Job Manager - Fields Configuration
	#-------------------------------------------------------------------------------#
    
    function remove_single_job_listing_actions() {
        remove_action( 'single_job_listing_start', 'job_listing_meta_display', 20);
        remove_action( 'single_job_listing_start', 'job_listing_company_display', 30);

        if ( class_exists('WP_Job_Manager_Field_Editor_Auto_Output') ) {
            remove_action( 'single_job_listing_start', array( WP_Job_Manager_Field_Editor_Auto_Output::get_instance(), 'single_job_listing_company_before' ), 25);
        }
    }

    #-------------------------------------------------------------------------------#
	#  WP Job Manager - Add "Video" Field above "Job Description"
	#-------------------------------------------------------------------------------#

    function add_video_above_job_desc() {
        if ( class_exists('WP_Job_Manager_Companies') ) { // no video popup
            if ( !get_theme_mod('capstone_jobs_single_toggle_video_visibility') ) {
                the_company_video();
            }
        } else { // video popup enabled
            if ( get_theme_mod('capstone_jobs_single_toggle_video_visibility') ) {
                the_company_video();
            }
        }
    }

    #-------------------------------------------------------------------------------#
	#  Add "Apply Now" Button
	#-------------------------------------------------------------------------------#

	function add_application_button() {
        if ( !is_position_filled() && candidates_can_apply() ) {
            if ( $apply = get_the_job_application_method() ) {
                $url_application_method = get_option( 'job_application_form_for_url_method') ? "application" : ( get_option( 'resume_manager_enable_application_for_url_method' ) ? "resume" : "default");
                $email_application_method = get_option( 'job_application_form_for_email_method') ? "application" : ( get_option( 'resume_manager_enable_application' ) ? "resume" : "default");
                
                if ( !get_option('job_manager_form_contact') ) {
                    if ($apply->type === 'url') {
                        $button_uri = ($url_application_method == 'application' || $url_application_method == 'resume') ? '#apply-job' : $apply->url;
                        $modal_class = ($url_application_method == 'application' || $url_application_method == 'resume') ? ' is-modal ' : '';
                    } else if ($apply->type === 'email') {
                        $button_uri = ($email_application_method == 'application' || $email_application_method == 'resume') ? '#apply-job' : 'mailto:'. $apply->email .sprintf(esc_html__('?subject=Application for "%s"', 'capstone'), get_the_title());
                        $modal_class = ($email_application_method == 'application' || $email_application_method == 'resume') ? ' is-modal ' : '';
                    } else {
                        $button_uri = '#apply-job';
                        $modal_class = ' is-modal ';
                    }
                } else {
                    $button_uri = '#apply-job';
                    $modal_class = ' is-modal ';
                }
                
                echo '<a href="'. esc_url($button_uri) .'" class="apply-job button-default '. esc_attr($modal_class) .'" target="_blank" rel="nofollow">'. esc_html__('Apply Now', 'capstone'). '</a>';
            }
        }
    }

    #-------------------------------------------------------------------------------#
	#  Add "More Actions" - Button + Menu
	#-------------------------------------------------------------------------------#

	function add_more_actions() {
        // Helper Variable(s)
        ob_start();
            do_action('single_job_listing_more_actions_start');
            $more_actions_start_links = ob_get_contents();
        ob_end_clean();

        ob_start();
            do_action('single_job_listing_more_actions_end');
            $more_actions_end_links = ob_get_contents();
        ob_end_clean();

        // display the (button + menu) if any link exist
        if (!empty($more_actions_start_links) || !empty($more_actions_end_links)) {
            echo '<div class="more-actions">';
                echo '<a href="#more-actions" class="trigger">';
                    echo '<img src="'. get_template_directory_uri() .'/images/more-icon.svg' .'" alt="'. esc_html__('More Actions', 'capstone'). '" />';
                echo '</a>';
                echo '<ul class="dropdown">';
                    do_action('single_job_listing_more_actions_start');
                    do_action('single_job_listing_more_actions_end');
                echo '</ul>';
            echo '</div>';
        }
    }

    #-------------------------------------------------------------------------------#
	#  Add "More Actions" - Links
	#-------------------------------------------------------------------------------#

    // Print the Job
	function print_the_job() {
        echo '<li class="print-job"><a href="javascript:window.print()">'. esc_html__( 'Print Job', 'capstone' ) .'</a></li>';
    }

    // Share via Email
	function share_via_email() {
        echo '<li class="share-email"><a href="mailto:?subject='. get_the_title() .'&body='. get_permalink() .'">'. esc_html__( 'Share via Email', 'capstone' ) .'</a></li>';
    }

    // Share via Twitter
	function share_via_twitter() {
        echo '<li class="social-share twitter"><a href="javascript:void(0);" data-title="'. esc_attr(get_the_title()) .'">'. esc_html__( 'Share via Twitter', 'capstone' ) .'</a></li>';
    }

    // Share via Twitter
	function share_via_facebook() {
        echo '<li class="social-share facebook"><a href="javascript:void(0);">'. esc_html__( 'Share via Facebook', 'capstone' ) .'</a></li>';
    }

    // Report the Job
	function report_the_job() {
        echo '<li class="report-listing"><a href="mailto:'. antispambot(get_option('admin_email')) .'?subject='. esc_html__('Report Job', 'capstone') .': '. get_the_title() .'&body='. get_permalink() .'">'. esc_html__( 'Report', 'capstone' ) .'</a></li>';
    }

    #-------------------------------------------------------------------------------#
    #  Register Job Manager Settings
    #-------------------------------------------------------------------------------#

	public function job_manager_settings( $settings ) {
        $settings[ 'job_listings' ][1][] = array(
            'name'     => 'job_manager_enable_location_autocomplete',
            'std'      => '0',
            'label'    => __( 'Location Auto-complete', 'capstone' ),
            'cb_label' => __( 'Enable Location Auto-complete', 'capstone' ),
            'desc'     => __( 'Check this to enable location autocomplete feature.', 'capstone' ),
            'type'     => 'checkbox'
        );

        return $settings;
    }

    #-------------------------------------------------------------------------------#
    #  Enable shortcodes in job description
    #-------------------------------------------------------------------------------#

    function enable_shortcode_wpjm_description($description) {
        return do_shortcode($description);
    }

}