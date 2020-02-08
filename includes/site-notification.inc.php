<?php if ( !get_theme_mod('capstone_notification_disable') ) { ?>

    <!-- Site Notification -->
    <div id="site-notice" class="site-notice">
        <a href="#" class="close"><img src="<?php echo esc_url( get_template_directory_uri() .'/images/close-icon.svg' ); ?>" alt="<?php esc_attr_e('Close Notification' ,'capstone'); ?>"></a>
        <div class="inner-wrap">
            <h3 class="title"><?php echo wp_kses_post(get_theme_mod('capstone_notification_title')); ?></h3>
            <div class="content">
                <?php echo wp_kses_post(get_theme_mod('capstone_notification_content')); ?>
            </div>
        </div>
    </div>

<?php } ?>