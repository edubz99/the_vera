<?php

#-------------------------------------------------------------------------------#
#  Restrict DEMO user access in Dashboard
#-------------------------------------------------------------------------------#
    
    function capstone_restrict_demo_user($query) {
        // check if demo user
        $user = wp_get_current_user();
        $demo_user_IDs = ['elon@wpscouts.net', 'robert@wpscouts.net'];
        $is_demo_user = in_array($user->user_email, $demo_user_IDs);

        // If demo user, impose some restrictions
        if ($is_demo_user) {

            $is_dashboard_template = is_page_template( 'template-dashboard.php' );
            $is_singular_job_listing = ($query->get('post_type') === 'job_listing' && $query->is_single); // cannot use is_singular('job_listing') in `pre_get_posts`
            $is_singular_resume_listing = ($query->get('post_type') === 'resume' && $query->is_single);
            $is_submit_job_listing = $query->get('pagename') == 'post-a-job';
            $is_submit_resume_listing = $query->get('pagename') == 'submit-resume';
           
            if ( $is_dashboard_template || $is_singular_job_listing || $is_singular_resume_listing || $is_submit_job_listing || $is_submit_resume_listing ) {

                // actions to block
                $job_resume_manager_actions = isset($_GET['action']) && ($_GET['action'] == 'mark_filled' || $_GET['action'] == 'mark_not_filled' || $_GET['action'] == 'duplicate' || $_GET['action'] == 'delete' || $_GET['action'] == 'hide' || isset($_GET['delete_job_application']) );
                $bookmarks_actions = isset($_GET['remove_bookmark']);
                $alert_actions = isset($_GET['action']) && ($_GET['action'] == 'email' || $_GET['action'] == 'toggle_status' || $_GET['action'] == 'delete');
                
                // submissions to block
                $job_form_submissions = !empty($_POST) && !empty($_POST['submit_job']);
                $resume_form_submissions = !empty($_POST) && !empty($_POST['submit_resume']);
                $bookmarks_form_submissions = !empty($_POST) && !empty($_POST['submit_bookmark']);
                $job_application_form_submissions = !empty($_POST) && (!empty($_POST['wp_job_manager_edit_application']));
                $job_alert_form_submissions = !empty($_POST) && !empty($_POST['submit-job-alert']);
                $profile_form_submissions = !empty($_POST) && !empty($_POST['edit_profile']);
    
                if ( $job_resume_manager_actions || $bookmarks_actions || $alert_actions ) {
                    wp_die(esc_html__('You do not have sufficient permissions to perform this action.', 'capstone'));
                } else if ( $job_form_submissions || $resume_form_submissions || $job_alert_form_submissions || $bookmarks_form_submissions || $job_application_form_submissions || $profile_form_submissions ) {
                    wp_die(esc_html__('You do not have sufficient permissions to submit this form.', 'capstone'));
                }

            }
        }
    }
    add_action( 'pre_get_posts', 'capstone_restrict_demo_user' );
