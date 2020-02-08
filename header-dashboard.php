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

        <?php include(locate_template( 'includes/dashboard-config.inc.php' )); ?>

        <?php get_template_part( 'includes/preloader.inc' ); ?>

        <section id="dashboard-container">
          <?php do_action('capstone_site_container_start'); ?>

          <div id="logout-dashboard">
            <a class="logout-link" href="<?php echo esc_url( wp_logout_url(home_url('/')) ); ?>"><img class="icon svg-icon" src="<?php echo esc_url( get_template_directory_uri() .'/images/logout-icon.svg' ); ?>"><?php esc_html_e('Logout', 'capstone'); ?></a>
          </div>

          <ul id="dashboard-icons-nav" class="icons-nav sf-menu">
              <li class="back">
                <a href="<?php echo esc_url( home_url('/') ); ?>" data-balloon="<?php esc_attr_e('Exit Dashboard', 'capstone'); ?>" data-balloon-pos="left"><img class="icon svg-icon" src="<?php echo esc_url( get_template_directory_uri() .'/images/back.svg' ); ?>" alt="<?php esc_attr_e('Exit Dashboard', 'capstone'); ?>"></a>
              </li>    
              <?php if (class_exists( 'Private_Messages' ) && is_user_logged_in() && get_option('pm_settings')['pm_dashboard_page_id']) { ?>
                <li class="messages">
                  <a href="<?php echo esc_url(get_permalink(get_option('pm_settings')['pm_dashboard_page_id'])); ?>"><img src="<?php echo esc_url( get_template_directory_uri() .'/images/messages-icon.svg'); ?>" alt="<?php echo pm_get_unread_count( get_current_user_id() ); ?> <?php echo esc_html__('Unread Messages' , 'capstone'); ?>"><span class="count"><?php echo pm_get_unread_count( get_current_user_id() ); ?></span></a>
                </li>
              <?php } ?>
              <li class="account menu-item-has-children">
                <a href="#account-menu-module">
                    <img class="icon svg-icon" src="<?php echo esc_url( get_template_directory_uri() .'/images/account-icon.svg'); ?>" alt="<?php echo esc_html__('Search' , 'capstone'); ?>">
                </a>
                <?php get_template_part( 'includes/menu-account.inc' ); ?>
              </li>
              <li class="hamburger">
                <a class="hamburger-icon" href="#"><span></span><span></span><span></span><span></span></a>
              </li>
          </ul>

          <?php get_template_part( 'includes/dashboard-menu-mobile.inc' ); ?>

          <nav id="dashboard-sidebar">
            <div id="dashboard-logo" itemscope itemtype="https://schema.org/Brand">
              <?php get_template_part( 'includes/dashboard-logo.inc' ); ?>
            </div>
  
            <div class="dashboard-menus-wrap">
            <div id="dashboard-primary-nav" class="nav-container">
              <h4 class="title"><?php esc_html_e('Main', 'capstone'); ?></h4>
              
              <?php if ( has_nav_menu('capstone-dashboard-primary-navigation') ) { ?>
                <?php 
                    $args = array(
                        'theme_location'  => 'capstone-dashboard-primary-navigation',
                        'container'       => 'nav',
                        'menu_class'      => 'nav-links',
                        'fallback_cb'     => ''
                    );

                    wp_nav_menu($args);
                ?>
              <?php } else { ?>
                <div class="assign-menu"><?php echo esc_html__('Please assign a menu to this location from wordpress admin panel.', 'capstone'); ?></div>
              <?php } ?>
            </div>

            <?php if ( has_nav_menu('capstone-dashboard-secondary-navigation') ) { ?>

              <hr>

              <div id="dashboard-secondary-nav" class="nav-container">
                <h4 class="title"><?php esc_html_e('Others', 'capstone'); ?></h4>
                <?php 
                  $args = array(
                      'theme_location'  => 'capstone-dashboard-secondary-navigation',
                      'container'       => 'nav',
                      'menu_class'      => 'nav-links',
                      'fallback_cb'     => ''
                  );

                  wp_nav_menu($args);
                ?>
              </div>

            <?php } ?>

            </div>

          </nav>