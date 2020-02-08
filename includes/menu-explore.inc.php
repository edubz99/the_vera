<?php
    // Helper Variable(s)
    $menu_limit = get_theme_mod('capstone_header_explore_menu_limit', 8);
    $menu_items_order = get_theme_mod( 'capstone_header_explore_menu_order', array( 'job_categories', 'job_regions', 'job_companies' ) );
?>

<ul id="explore-menu" class="sub-menu tabbed-menu" style="display: none;">
    <li><span class="title"><?php echo esc_html__('Browse By', 'capstone'); ?></span></li>
    <?php do_action('capstone_explore_menu_item'); ?>
</ul>

<style>
    ul#explore-menu li.menu-job_categories { order: <?php echo esc_attr(array_search('job_categories', $menu_items_order)); ?> !important; } 
    ul#explore-menu li.menu-job_tags { order: <?php echo esc_attr(array_search('job_tags', $menu_items_order)); ?> !important; } 
    ul#explore-menu li.menu-job_types { order: <?php echo esc_attr(array_search('job_types', $menu_items_order)); ?> !important; } 
    ul#explore-menu li.menu-job_regions { order: <?php echo esc_attr(array_search('job_regions', $menu_items_order)); ?> !important; } 
    ul#explore-menu li.menu-companies_list { order: <?php echo esc_attr(array_search('companies_list', $menu_items_order)); ?> !important; } 
    ul#explore-menu li.menu-resume_categories { order: <?php echo esc_attr(array_search('resume_categories', $menu_items_order)); ?> !important; } 
    ul#explore-menu li.menu-resume_skills { order: <?php echo esc_attr(array_search('resume_skills', $menu_items_order)); ?> !important; } 
    ul#explore-menu li.menu-resume_regions { order: <?php echo esc_attr(array_search('resume_regions', $menu_items_order)); ?> !important; } 
</style>