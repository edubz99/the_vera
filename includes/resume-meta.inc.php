<?php
    // Helper Variable(s)
    ob_start();
        do_action('single_resume_meta_before');
        $single_resume_meta_before = ob_get_contents();
    ob_end_clean();

    ob_start();
        do_action('single_resume_meta_start');
        $single_resume_meta_start = ob_get_contents();
    ob_end_clean();

    ob_start();
        do_action('single_resume_meta_end');
        $single_resume_meta_end = ob_get_contents();
    ob_end_clean();

    ob_start();
        do_action('single_resume_meta_after');
        $single_resume_meta_after = ob_get_contents();
    ob_end_clean();
?>

<?php if (!empty($single_resume_meta_before)) { ?>
    <ul class="entry-meta--before">
        <?php do_action( 'single_resume_meta_before' ); ?>
    </ul>
<?php } ?>

<?php if (!empty($single_resume_meta_start) || !empty($single_resume_meta_end)) { ?>
    <div class="entry-meta">
        <h4 class="section-title"><?php esc_html_e('Overview', 'capstone'); ?></h4>
        <a href="#" class="meta-link">
            <span class="see-more"><?php echo sprintf( __( 'See all %s fields', 'capstone' ), '<em class="count">0</em>' ); ?></span>
            <span class="see-less"><?php esc_html_e('See less fields', 'capstone'); ?></span>
            <img class="icon svg-icon" src="<?php echo get_template_directory_uri() .'/images/arrow-down-menu.svg'; ?>" alt="<?php esc_attr_e('Toggle fields visibility', 'capstone'); ?>"/>
        </a>
        <ul class="meta-fields">
            <?php do_action( 'single_resume_meta_start' ); ?>
            <?php do_action( 'single_resume_meta_end' ); ?>
        </ul>
    </div>
<?php } ?>

<?php if (!empty($single_resume_meta_after)) { ?>
    <ul class="entry-meta--after">
        <?php do_action( 'single_resume_meta_after' ); ?>
    </ul>
<?php } ?>