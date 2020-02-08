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

        <?php get_template_part( 'includes/preloader.inc' ); ?>

        <div id="site-container">
            <?php do_action('capstone_site_container_start'); ?>

            <header id="site-header">
                <?php do_action('capstone_site_header_start'); ?>

                <?php get_template_part( 'includes/site-notice.inc' ); ?>

                <div id="site-menu">

                    <div class="container">
                        <?php do_action('capstone_site_header_container_start'); ?>
                        
                        <?php get_template_part( 'includes/site-logo.inc' ); ?>

                        <?php 
                        $args = array(
                            'theme_location'  => 'capstone-primary-navigation',
                            'container'       => 'nav',
                            'container_id'    => 'site-navigation',
                            'menu_class'      => 'sf-menu',
                            'fallback_cb'     => ''
                        );

                        wp_nav_menu($args);
                        ?>

                        <span class="seperator"></span>

                        <?php get_template_part( 'includes/menu-icons.inc' ); ?>
                        <?php get_template_part( 'includes/cta-button.inc' ); ?>

                        <?php do_action('capstone_site_header_container_end'); ?>
                    </div>                    
                </div>

                <?php do_action('capstone_site_header_end'); ?>
            </header>
