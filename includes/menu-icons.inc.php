<ul class="icons-nav sf-menu">
    <?php if (!class_exists('FacetWP')) { ?>
        <li class="search menu-item-has-children">
            <a href="#search-module"><img src="<?php echo esc_url( get_template_directory_uri() .'/images/search-icon.svg'); ?>" alt="<?php echo esc_html__('Search' , 'capstone'); ?>"></a>
            <?php get_template_part( 'includes/menu-search.inc' ); ?>
        </li>
    <?php } else { ?>
        <?php
            $search_type = get_theme_mod('capstone_header_search_type', 'blog');
            switch ($search_type) {
                case 'job':
                    $detail_page_url = get_permalink(get_option('job_manager_jobs_page_id'));
                break;
                case 'resume':
                    $detail_page_url = get_permalink(get_option('resume_manager_resumes_page_id'));
                    break;
                case 'company':
                    $detail_page_url = get_permalink(get_theme_mod('capstone_companies_page_id'));
                    break;
                default:
                    $detail_page_url = get_option('page_for_posts') ? get_permalink(get_option('page_for_posts')) : home_url('/');
            } 
        ?>        
        <li class="search-link">
            <a href="<?php echo esc_url($detail_page_url); ?>"><img src="<?php echo esc_url( get_template_directory_uri() .'/images/search-icon.svg'); ?>" alt="<?php echo esc_html__('Search' , 'capstone'); ?>"></a>
        </li>
    <?php } ?>
    <?php if (class_exists( 'Private_Messages' ) && is_user_logged_in() && get_option('pm_settings')['pm_dashboard_page_id']) { ?>
        <li class="messages">
            <a href="<?php echo esc_url(get_permalink(get_option('pm_settings')['pm_dashboard_page_id'])); ?>"><img src="<?php echo esc_url( get_template_directory_uri() .'/images/messages-icon.svg'); ?>" alt="<?php echo pm_get_unread_count( get_current_user_id() ); ?> <?php echo esc_html__('Unread Messages' , 'capstone'); ?>"><span class="count"><?php echo pm_get_unread_count( get_current_user_id() ); ?></span></a>
        </li>
    <?php } ?>
    <li class="account menu-item-has-children">
        <a href="#account-menu-module">
            <img src="<?php echo esc_url( get_template_directory_uri() .'/images/account-icon.svg'); ?>" alt="<?php echo esc_html__('Search' , 'capstone'); ?>">
            <?php if (is_user_logged_in()) { ?>
                <span class="status logged-in"></span>
            <?php } ?>
        </a>
        <?php get_template_part( 'includes/menu-account.inc' ); ?>
    </li>
    <li class="hamburger">
        <a class="hamburger-icon" href="#"><span></span><span></span><span></span><span></span></a>
        <?php get_template_part( 'includes/menu-mobile.inc' ); ?>
    </li>
</ul>
