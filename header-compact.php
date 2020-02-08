<!DOCTYPE html>
<html <?php language_attributes(); ?>>

    <head>

        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="<?php bloginfo( 'charset' ); ?>" />

        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Pingback
        ================================================== -->
        <link rel="pingback" href="<?php esc_url( bloginfo('pingback_url') ); ?>" />

        <!-- WP Head
        ================================================== -->
        <?php wp_head(); ?>


    </head>

    <body <?php body_class(); ?>>

        <?php
          // Helper Variable(s)
          $user = wp_get_current_user();
          $is_employer = in_array(get_option('job_manager_registration_role', 'employer'), (array) $user->roles);
          $is_candidate = in_array(get_option('resume_manager_registration_role', 'candidate'), (array) $user->roles);
        ?>

        <?php get_template_part( 'includes/preloader.inc' ); ?>

        <div id="compact-container">
            <?php do_action('capstone_site_container_start'); ?>

            <nav id="compact-sidebar">
                <div id="dashboard-logo">
                    <?php get_template_part( 'includes/dashboard-logo.inc' ); ?>
                </div>
                <?php get_template_part( 'includes/page-header.inc' ); ?>
                <a id="back-to-site" href="<?php echo esc_url( home_url('/') ); ?>"><span>&#8592;</span> <?php esc_html_e('Back to site', 'capstone'); ?></a>
            </nav>