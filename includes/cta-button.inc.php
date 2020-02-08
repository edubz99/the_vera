
    <?php
        // Helper Variable(s)
        $user = wp_get_current_user();
        $is_admin = in_array('administrator', (array) $user->roles);
        $is_employer = in_array(get_option('job_manager_registration_role', 'employer'), (array) $user->roles);
        $is_candidate = in_array(get_option('resume_manager_registration_role', 'candidate'), (array) $user->roles);
        $button_visible = false;

        // CTA Default URLs
        $employer_cta_url = class_exists( 'WP_Job_Manager' ) && get_option('job_manager_submit_job_form_page_id') ? get_permalink(get_option('job_manager_submit_job_form_page_id')) : wp_login_url();
        $candidate_cta_url = class_exists( 'WP_Resume_Manager' ) && get_option('resume_manager_submit_resume_form_page_id') ? get_permalink(get_option('resume_manager_submit_resume_form_page_id')) : wp_login_url();

        // Custom Values
        $disable_employer_button = get_theme_mod('capstone_header_cta_disable', false);
        $disable_candidate_button = get_theme_mod('capstone_header_cta_disable_candidate', false);
        $employer_custom_text = get_theme_mod('capstone_header_cta_text', esc_html__('Post a Job', 'capstone'));
        $candidate_custom_text = get_theme_mod('capstone_header_cta_text_candidate');
        $employer_custom_url = get_theme_mod('capstone_header_cta_url', $employer_cta_url);
        $candidate_custom_url = get_theme_mod('capstone_header_cta_url_candidate', $candidate_cta_url);
        $employer_custom_icon = get_theme_mod('capstone_header_cta_icon', get_template_directory_uri() .'/images/dashboard.svg');
        $candidate_custom_icon = get_theme_mod('capstone_header_cta_icon_candidate', get_template_directory_uri() .'/images/dashboard.svg');

        // Button Logic
        if ( is_user_logged_in() && ($is_candidate || $is_employer || $is_admin) ) {
            if ($is_candidate && !$disable_candidate_button) {
                if ($candidate_custom_text || $candidate_custom_url || $candidate_custom_icon) {
                    $cta_text = $candidate_custom_text;
                    $cta_url = $candidate_custom_url;
                    $cta_button_icon = $candidate_custom_icon;
                    $button_visible = true;
                } else {
                    $cta_text = esc_html__('Post a Resume', 'capstone');
                    $cta_url = $candidate_cta_url;
                    $cta_button_icon = get_template_directory_uri() .'/images/dashboard.svg';
                    $button_visible = true;
                }
            } else if (($is_employer || $is_admin) && !$disable_employer_button) {
                if ($employer_custom_text || $employer_custom_url || $employer_custom_icon) {
                    $cta_text = $employer_custom_text;
                    $cta_url = $employer_custom_url;
                    $cta_button_icon = $employer_custom_icon;
                    $button_visible = true;
                } else {
                    $cta_text = esc_html__('Post a Job', 'capstone');
                    $cta_url = $employer_cta_url;
                    $cta_button_icon = get_template_directory_uri() .'/images/dashboard.svg';
                    $button_visible = true;
                }
            }
        } else if (!$disable_employer_button) {
            if ($employer_custom_text || $employer_custom_url || $employer_custom_icon) {
                $cta_text = $employer_custom_text;
                $cta_url = $employer_custom_url;
                $cta_button_icon = $employer_custom_icon;
                $button_visible = true;
            } else {
                $cta_text = esc_html__('Post a Job', 'capstone');
                $cta_url = $employer_cta_url;
                $cta_button_icon = get_template_directory_uri() .'/images/dashboard.svg';
                $button_visible = true;
            }
        }
    ?>
    <?php if ($button_visible) { ?>
        <a class="add-to-listing button" href="<?php echo esc_url($cta_url); ?>">
            <?php if ($cta_button_icon) { ?>    
                <img src="<?php echo esc_url($cta_button_icon); ?>" alt="<?php echo esc_attr($cta_text); ?>">
            <?php } ?>    
            <?php if (class_exists( 'WP_Job_Manager' ) || class_exists( 'WP_Resume_Manager' )) { ?>
                <span><?php echo esc_html($cta_text); ?></span>
            <?php } else { ?>
                <span><?php echo get_theme_mod('capstone_header_cta_text', esc_html__('Dashboard', 'capstone')); ?></span>
            <?php } ?>
        </a>
    <?php } ?>