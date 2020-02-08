<!-- BEGIN: SITE CONTROLS -->
<div id="site-clipboard">

    <?php do_action('capstone_site_clipboard'); ?>

    <?php get_template_part( 'includes/popup-taxonomies.inc' ); ?>
    <?php get_template_part( 'includes/site-notification.inc' ); ?>

    <!-- Blog Headings -->
    <div id="blog-headings">
        <header class="section-header featured-news">
            <span class="icon"><img src="<?php echo esc_url( get_template_directory_uri() .'/images/featured-news-icon.svg'); ?>" alt="<?php esc_attr_e('Featured News', 'capstone'); ?>"></span>
            <h4 class="title"><?php echo esc_html__('Featured News', 'capstone'); ?></h4>
        </header>
        <header class="section-header recent-news"><h4 class="title"><?php echo esc_html__('Recent News', 'capstone'); ?></h4></header>
        <header class="section-header other-news"><h4 class="title"><?php echo esc_html__('Other News', 'capstone'); ?></h4></header>
    </div>

</div>
<!-- END: SITE CLIPBOARD -->