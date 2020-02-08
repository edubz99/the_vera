<?php

#-------------------------------------------------------------------------------#
#  Protect (Dashboard - Generic) Pages from Unauthorized Access
#-------------------------------------------------------------------------------#

    function capstone_dashboard_protection() {
        if( is_page_template( 'template-dashboard.php' ) ) { // is user accessing a dashboard page?
            if ( !is_user_logged_in() ) { // is user properly authenticated?
                wp_redirect( esc_url(get_permalink(get_theme_mod('capstone_auth_login_page'))) );
                exit;
            }
        }
    }

    add_action( 'template_redirect', 'capstone_dashboard_protection' );