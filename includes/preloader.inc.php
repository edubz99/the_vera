<?php if (!get_theme_mod('capstone_disable_preloader', false)) { ?>
    <!-- PRELOADER -->
    <div class="preloader">
        <div class="loader-icon">
            <?php if ( get_theme_mod('capstone_preloader_icon') ) { ?>
                <img src="<?php echo esc_url(get_theme_mod('capstone_preloader_icon')); ?>" alt="<?php esc_html_e('Site is loading.', 'capstone'); ?>">
            <?php } else { ?>
                <div class="preloader-dot dot-1"></div>
                <div class="preloader-dot dot-2"></div>
                <div class="preloader-dot dot-3"></div>
            <?php } ?>
        </div>            
    </div>
<?php } ?>