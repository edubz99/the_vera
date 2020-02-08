<?php
    // Check user authetication status and role
    $user = wp_get_current_user();
    $is_admin = in_array('administrator', (array) $user->roles);
    $is_employer = in_array(get_option('job_manager_registration_role', 'employer'), (array) $user->roles);
    $is_candidate = in_array(get_option('resume_manager_registration_role', 'candidate'), (array) $user->roles);
    $is_logged_in = $is_admin || $is_employer || $is_candidate;

    // Check if it is demo user
    $demo_user_IDs = ['elon@wpscouts.net', 'robert@wpscouts.net'];
    $is_demo_user = in_array($user->user_email, $demo_user_IDs);