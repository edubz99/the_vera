<?php
    // Helper Variable(s)
    $search_type = get_theme_mod('capstone_header_search_type', 'blog');
    $search_desc = get_theme_mod('capstone_header_search_desc', esc_html__('Enter query below and click "search" or go for advanced search.', 'capstone'));

    switch ($search_type) {
        case 'job':
            $form_title = get_theme_mod('capstone_header_search_title', esc_html__('Search Jobs', 'capstone'));
            $detail_page_url = get_permalink(get_option('job_manager_jobs_page_id'));
        break;
        case 'resume':
            $form_title = get_theme_mod('capstone_header_search_title', esc_html__('Search Resumes', 'capstone'));
            $detail_page_url = get_permalink(get_option('resume_manager_resumes_page_id'));
            break;
        case 'company':
            $form_title = get_theme_mod('capstone_header_search_title', esc_html__('Search Companies', 'capstone'));
            $detail_page_url = get_permalink(get_theme_mod('capstone_companies_page_id'));
            break;
        default:
            $form_title = get_theme_mod('capstone_header_search_title', esc_html__('Search Blog', 'capstone'));
            $detail_page_url = get_option('page_for_posts') ? get_permalink(get_option('page_for_posts')) : home_url('/');
            $action_page_url = home_url('/');
            $keywords_placeholder = esc_html__('e.g. Hiring Tips', 'capstone');
            $keywords_query_var = 's';
    } 

?>

<ul id="search-module" class="search-menu white-popup-block">
    <li class="menu-item">
        <div id="<?php echo esc_attr($search_type); ?>-search" class="inner">
            <header class="menu-header">
                <span class="title"><?php echo esc_html($form_title); ?></span>
                <p class="desc"><?php echo wp_kses_post($search_desc); ?></p>
            </header>
            <hr>
            <?php if (class_exists('FacetWP') && ($search_type == 'job' || $search_type == 'resume')) { ?>
                <?php get_template_part( 'includes/header-facets.inc' ); ?>
            <?php } else  { ?>
                <?php get_template_part( 'includes/'. $search_type .'-search.inc' ); ?>
            <?php } ?>
        </div>
    </li>
</ul>
