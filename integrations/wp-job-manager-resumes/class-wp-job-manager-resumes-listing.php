<?php

class Capstone_WP_Resume_Manager_Listing {

	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	public function init() {
        global $job_manager_bookmarks;

        /** Modify query parameters */
        add_action( 'pre_get_posts', array( $this, 'modify_resumes_query') );
        
        /** Remove Deadline */
        remove_filter( 'single_resume_start', array( $job_manager_bookmarks, 'bookmark_form' ));

        /** Add "Contact Now" Button */
        add_action( 'resume_actions_start', array($this, 'add_contact_button'), 10 );

        /** Add "More Actions" - Trigger */
        add_action( 'resume_actions_end', array($this, 'add_more_actions'), 10 );

        /** Add "More Actions" - Links */
        add_action( 'single_resume_more_actions_start', array($this, 'print_the_resume'), 10 );
        add_action( 'single_resume_more_actions_start', array($this, 'share_via_email'), 10 );
        add_action( 'single_resume_more_actions_start', array($this, 'share_via_twitter'), 10 );
        add_action( 'single_resume_more_actions_start', array($this, 'share_via_facebook'), 10 );
        add_action( 'single_resume_more_actions_start', array($this, 'download_resume'), 10 );
        add_action( 'single_resume_more_actions_start', array($this, 'report_the_resume'), 10 );

        /** Add "Video" in Detail Page */
        add_action( 'single_resume_desc_after', array( $this, 'add_video_above_job_desc'), -1 );

        /** Enable Shortcodes in Resume Description */
        add_filter( 'the_resume_description', array($this, 'enable_shortcode_wpjm_description'), 10 );
    }

    #-------------------------------------------------------------------------------#
	#  WP Resume Manager - Modify Main Query
	#-------------------------------------------------------------------------------#

    function modify_resumes_query( $query ) {
        $post_type = $query->get('post_type');

        if ( !is_admin() && $post_type == 'resume' && $query->is_main_query() ) { // Run only on the homepage
            $query->query_vars['posts_per_page'] = apply_filters('capstone_resumes_per_page', 10);
        }
    }

    #-------------------------------------------------------------------------------#
	#  Add "Contact Now" Button
	#-------------------------------------------------------------------------------#

	function add_contact_button() {
        echo '<a href="#contact-candidate" class="contact-candidate button-default">'. esc_html__('Contact Now', 'capstone'). '</a>';
    }

    #-------------------------------------------------------------------------------#
	#  Add "More Actions" - Button + Menu
	#-------------------------------------------------------------------------------#

	function add_more_actions() {
        // Helper Variable(s)
        ob_start();
            do_action('single_resume_more_actions_start');
            $more_actions_start_links = ob_get_contents();
        ob_end_clean();

        ob_start();
            do_action('single_resume_more_actions_end');
            $more_actions_end_links = ob_get_contents();
        ob_end_clean();

        // display the (button + menu) if any link exist
        if (!empty($more_actions_start_links) || !empty($more_actions_end_links)) {
            echo '<div class="more-actions">';
                echo '<a href="#more-actions" class="trigger">';
                    echo '<img src="'. get_template_directory_uri() .'/images/more-icon.svg' .'" alt="'. esc_html__('More Actions', 'capstone'). '" />';
                echo '</a>';
                echo '<ul class="dropdown">';
                    do_action('single_resume_more_actions_start');
                    do_action('single_resume_more_actions_end');
                echo '</ul>';
            echo '</div>';
        }
    }

    #-------------------------------------------------------------------------------#
	#  Add "More Actions" - Links
	#-------------------------------------------------------------------------------#

    // Print the Resume
	function print_the_resume() {
        echo '<li class="print-resume"><a href="javascript:window.print()">'. esc_html__( 'Print Resume', 'capstone' ) .'</a></li>';
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

    // Download Resume
	function download_resume() {
        global $post;
        if ( resume_has_file() )  {
            get_job_manager_template( 'content-resume-file.php', array( 'post' => $post ), 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/' );
        }
    }

    // Report the Resume
	function report_the_resume() {
        echo '<li class="report-listing"><a href="mailto:'. antispambot(get_option('admin_email')) .'?subject='. esc_html__('Report Resume', 'capstone') .': '. get_the_title() .'&body='. get_permalink() .'">'. esc_html__( 'Report', 'capstone' ) .'</a></li>';
    }

    #-------------------------------------------------------------------------------#
	#  WP Job Manager - Add "Video" Field above "Job Description"
	#-------------------------------------------------------------------------------#

    function add_video_above_job_desc() {
        the_candidate_video();
    }

    #-------------------------------------------------------------------------------#
    #  Enable shortcodes in resume description
    #-------------------------------------------------------------------------------#

    function enable_shortcode_wpjm_description($description) {
        return do_shortcode($description);
    }

}