<?php

$account_menu = wp_nav_menu(
    array(
        'theme_location'  => 'capstone-account-navigation',
        'container'       => 'ul',
        'container_id'    => 'account-navigation',
        'menu_id'         => 'account-menu-module',
        'menu_class'      => 'account-menu white-popup-block',
        'fallback_cb'     => '',
        'echo'            => false,
    )
);

if ( $account_menu ) {
    echo wp_kses_post($account_menu);
} else { ?>

    <ul class="guest-menu">
        <li class="menu-item">
            <div class="inner">
                <?php if ( !is_user_logged_in() ) { ?>
                    <div class="menu-header">
                        <span class="title"><?php echo esc_html__('Hello Guest', 'capstone'); ?>,</span>
                        <p class="desc"><?php echo esc_html__('You can login or register a new account with us.', 'capstone'); ?></p>
                    </div>
                    <hr>
                    <div class="auth-links">
                        <?php
                            // Helper Variable(s)
                            $login_url = get_theme_mod('capstone_auth_login_page') ? get_permalink(get_theme_mod('capstone_auth_login_page')) : wp_login_url();
                        ?>
                        <a class="button" href="<?php echo esc_url($login_url); ?>"><?php echo esc_html__('Sign In', 'capstone'); ?></a>
                        <?php if ( get_theme_mod('capstone_auth_register_page') ) { ?>
                            <p class="caption"><?php echo esc_html__('or', 'capstone'); ?> <a href="<?php echo esc_url(get_permalink(get_theme_mod('capstone_auth_register_page'))); ?>"><?php echo esc_html__('register new account', 'capstone'); ?></a></p>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <div class="menu-header">
                        <span class="title"><?php echo esc_html__('Hello', 'capstone'); ?> {{username}},</span>
                        <p class="desc"><?php echo esc_html__('You can visit your dashboard by clicking the button below.', 'capstone'); ?></p>
                    </div>
                    <hr>
                    <div class="auth-links">
                        <?php
                            // Helper Variable(s)
                            $dashboard_url = get_theme_mod('capstone_dashboard_main_page') ? get_permalink(get_theme_mod('capstone_dashboard_main_page')) : admin_url();
                        ?>
                        <a class="button" href="<?php echo esc_url($dashboard_url); ?>"><?php echo esc_html__('My Dashboard', 'capstone'); ?></a>
                        <p class="caption"><?php echo esc_html__('or', 'capstone'); ?> <a href="#logout-link"><?php echo esc_html__('logout from account', 'capstone'); ?></a></p>
                    </div>
                <?php } ?>
            </div>
        </li>
    </ul>

<?php  
}
