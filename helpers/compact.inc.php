<?php

#-------------------------------------------------------------------------------#
#  Append 'Login Page' Link to Registration Form
#-------------------------------------------------------------------------------#

    function capstone_register_page_filter( $content ){
        $login_instead = '';
        $login_page_defined = get_theme_mod('capstone_auth_login_page');
        $is_registration_page = get_theme_mod('capstone_auth_register_page') && is_page(get_theme_mod('capstone_auth_register_page'));

        if ( $login_page_defined && $is_registration_page ){
            $login_instead = '<p class="login-instead">'. esc_html__('Login to your account instead?', 'capstone')  .' <a href="'. esc_url(get_permalink(get_theme_mod('capstone_auth_login_page'))) .'">'. esc_html__('click here', 'capstone') .' &#8594;</a></p>';
        }

        return $login_instead . $content;
    }

    add_filter( 'the_content', 'capstone_register_page_filter' );


#-------------------------------------------------------------------------------#
#  Append 'Register Page' Link to Login Form
#-------------------------------------------------------------------------------#

    function capstone_login_page_filter( $content ){
        $register_instead = '';
        $recovery_instead = '';
        $registration_page_defined = get_theme_mod('capstone_auth_register_page');
        $password_recovery_page_defined = get_theme_mod('capstone_auth_password_recovery_page');
        $is_login_page = get_theme_mod('capstone_auth_login_page') && is_page(get_theme_mod('capstone_auth_login_page'));

        if ( $registration_page_defined && $is_login_page ){
            $register_instead = '<p class="register-instead">'. esc_html__('Register an account instead?', 'capstone')  .' <a href="'. esc_url(get_permalink(get_theme_mod('capstone_auth_register_page'))) .'">'. esc_html__('click here', 'capstone') .' &#8594;</a></p>';
        }
        if ( $password_recovery_page_defined && $is_login_page ) {
            $recovery_instead = '<p class="recovery-instead">'. esc_html__('Forgot you password?', 'capstone')  .' <a href="'. esc_url(get_permalink(get_theme_mod('capstone_auth_password_recovery_page'))) .'">'. esc_html__('click here to recover', 'capstone') .' &#8594;</a></p>';
        }

        return $register_instead . $content . $recovery_instead;
    }

    add_filter( 'the_content', 'capstone_login_page_filter' ); 


#-------------------------------------------------------------------------------#
#  Append 'Login Page' Link to Password Recovery Form
#-------------------------------------------------------------------------------#

    function capstone_password_recovery_page_filter( $content ){
        $login_instead = '';
        $login_page_defined = get_theme_mod('capstone_auth_login_page');
        $is_pass_recovery_page = get_theme_mod('capstone_auth_password_recovery_page') && is_page(get_theme_mod('capstone_auth_password_recovery_page'));
        
        if ( $login_page_defined && $is_pass_recovery_page ){
            $login_instead = '<p class="login-instead">'. esc_html__('Login to your account instead?', 'capstone')  .' <a href="'. esc_url(get_permalink(get_theme_mod('capstone_auth_login_page'))) .'">'. esc_html__('click here', 'capstone') .' &#8594;</a></p>';
        }

        return $login_instead . $content;
    }

    add_filter( 'the_content', 'capstone_password_recovery_page_filter' );


#-------------------------------------------------------------------------------#
#  Protect (Register + Login) from Unauthorized Access
#-------------------------------------------------------------------------------#
    
    function capstone_template_register_login_protection() {
        if ( is_page_template( 'template-compact.php' ) ) { // is user accessing a compact template page?
            $is_login_page = get_theme_mod('capstone_auth_login_page') && is_page(get_theme_mod('capstone_auth_login_page'));
            $is_register_page = get_theme_mod('capstone_auth_register_page') && is_page(get_theme_mod('capstone_auth_register_page'));
            $redirect_to = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : '';

            if ( is_user_logged_in() && ($is_login_page || $is_register_page) ) {
                if ($redirect_to) {
                    wp_redirect( $redirect_to );
                    exit;
                } else { // is user logged in + visiting login/register page?
                    wp_redirect( esc_url(get_permalink(get_theme_mod('capstone_dashboard_main_page'))) );
                    exit;
                }
            }

        }
    }
    add_action( 'template_redirect', 'capstone_template_register_login_protection' );

#-------------------------------------------------------------------------------#
#  Modify Registration Success Message
#-------------------------------------------------------------------------------#

    function capstone_registraion_message( $msg ) {
        return $msg . do_shortcode('[wppb-login]');
    }
    add_filter( 'wppb_register_success_message', 'capstone_registraion_message' );
