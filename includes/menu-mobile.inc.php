<div id="mobile-menu-module">
    <div class="container">
        <h4 class="title"><?php esc_html_e('Main Menu', 'capstone'); ?></h4>
        <?php 
            $args = array(
                'theme_location'  => 'capstone-primary-navigation',
                'container'       => 'nav',
                'container_class' => 'mobile-menu-container',
                'menu_class'      => 'mobile-menu',
                'fallback_cb'     => ''
            );

            wp_nav_menu($args);
        ?>
        <hr>
        <div class="mobile-cta-container">
            <?php get_template_part( 'includes/cta-button.inc' ); ?>
            <?php if (is_user_logged_in()) { ?>
                <?php if (get_theme_mod('capstone_dashboard_main_page')) { ?>
                    <p class="caption">
                        <?php echo esc_html__('or', 'capstone'); ?> 
                        <a href="<?php echo esc_url(get_permalink(get_theme_mod('capstone_dashboard_main_page'))); ?>"><?php echo esc_html__('go to your dashboard', 'capstone'); ?></a>
                    </p>
                <?php } ?>
            <?php } else { ?>
                <?php
                    // Helper Variable(s)
                    $login_url = get_theme_mod('capstone_auth_login_page') ? get_permalink(get_theme_mod('capstone_auth_login_page')) : wp_login_url();
                ?>
                <p class="caption">
                    <?php echo esc_html__('or', 'capstone'); ?> 
                    <a href="<?php echo esc_url($login_url); ?>"><?php echo esc_html__('login to your account', 'capstone'); ?></a>
                </p>
            <?php } ?>
        </div>
    </div>
</div>
