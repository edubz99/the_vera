<div id="mobile-menu-module">
    <div class="container">
        <h4 class="title"><?php esc_html_e('Main Menu', 'capstone'); ?></h4>
        <?php if ( has_nav_menu('capstone-dashboard-primary-navigation') ) { ?>
            <?php 
                $args = array(
                    'theme_location'  => 'capstone-dashboard-primary-navigation',
                    'container'       => 'nav',
                    'container_class' => 'mobile-menu-container',
                    'menu_class'      => 'mobile-menu',
                    'fallback_cb'     => ''
                );

                wp_nav_menu($args);
            ?>
        <?php } else { ?>
            <div class="assign-menu"><?php echo esc_html__('Please assign a menu to this location from wordpress admin panel.', 'capstone'); ?></div>
        <?php } ?>
        <hr>
        <?php if ( has_nav_menu('capstone-dashboard-secondary-navigation') ) { ?>
            <h4 class="title"><?php esc_html_e('Other Menu', 'capstone'); ?></h4>
            <?php 
                $args = array(
                    'theme_location'  => 'capstone-dashboard-secondary-navigation',
                    'container'       => 'nav',
                    'container_class' => 'mobile-menu-container',
                    'menu_class'      => 'mobile-menu',
                    'fallback_cb'     => ''
                );

                wp_nav_menu($args);
            ?>
            <hr>
        <?php } ?>
        <div class="mobile-cta-container">
            <a class="button" href="<?php echo esc_url(home_url('/')); ?>">
                <span><?php esc_html_e('Back to Main Site', 'capstone'); ?></span>
            </a>
            <p class="caption"><?php echo esc_html__('or', 'capstone'); ?> <a href="<?php echo esc_url( wp_logout_url(home_url('/')) ); ?>"><?php echo esc_html__('logout of your account', 'capstone'); ?></a></p>
        </div>
    </div>
</div>
