<?php
    // Helper Variable(s)
    $menu_limit = get_theme_mod('capstone_header_explore_menu_limit', 8);
    $menu_items_order = get_theme_mod( 'capstone_header_explore_menu_order', array( 'job_categories', 'job_regions', 'job_companies' ) );
    global $taxonomy_grid_name;
?>

<!-- BEGIN: POPUP TAXONOMIES -->
<div id="popup-taxonomies" class="taxonomies-popup-group">

    <?php if ( taxonomy_exists('job_listing_category') ) { ?>
        <div id="taxonomy-job_listing_category" class="taxonomies-popup mfp-hide white-popup-block">
            <header class="taxonomies-header">
                <h2 class="title">
                    <span class="browse"><?php esc_html_e('Browse Categories', 'capstone'); ?></span>
                    <span class="choose"><?php esc_html_e('Choose Category', 'capstone'); ?></span>
                </h2>
                <p class="subtitle"><?php esc_html_e('Showing all categories for the jobs.', 'capstone'); ?></p>
            </header>
            <?php
                // Helper Variable(s)
                $job_listing_categories = get_terms( array(
                    'taxonomy' => 'job_listing_category',
                    'hide_empty' => true,
                ) );
                $has_terms = $job_listing_categories ? '' : ' no-terms';
            ?>
            <ul class="taxonomy-terms <?php echo esc_attr($has_terms); ?>">
                <?php if ($job_listing_categories) { ?>
                    <?php foreach ($job_listing_categories as $category) : ?>
                        <li data-tax="<?php echo esc_attr($category->taxonomy); ?>" data-term-id="<?php echo esc_attr($category->term_id); ?>" data-term="<?php echo esc_attr($category->name); ?>"><a href="<?php echo esc_url(get_term_link($category->term_id, $category->taxonomy)); ?>"><?php echo esc_html($category->name); ?> <span><?php echo esc_html($category->count); ?></span></a></li>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <li><span class="text"><?php echo esc_html__('No job category is defined or is assigned a job listing.', 'capstone'); ?></span></li>
                <?php } ?>
                <li class="more-link"><?php echo esc_html__('or go to', 'capstone'); ?> <a href="<?php echo esc_url(get_permalink(get_option('job_manager_jobs_page_id'))); ?>"><?php echo esc_html__('advanced search', 'capstone'); ?> <em>&#8594;</em></a></li>
            </ul>
        </div>
    <?php } ?>

    <?php if ( taxonomy_exists('job_listing_tag') && (in_array('job_tags', $menu_items_order) || $taxonomy_grid_name == 'job_listing_tag') ) { ?>
        <div id="taxonomy-job_listing_tag" class="taxonomies-popup mfp-hide white-popup-block">
            <header class="taxonomies-header">
                <h2 class="title"><?php esc_html_e('Browse Tags', 'capstone'); ?></h2>
                <p class="subtitle"><?php esc_html_e('Showing all tags for the jobs.', 'capstone'); ?></p>
            </header>
            <?php
                // Helper Variable(s)
                $job_listing_tags = get_terms( array(
                    'taxonomy' => 'job_listing_tag',
                    'hide_empty' => true,
                ) );
                $has_terms = $job_listing_tags ? '' : ' no-terms';
            ?>
            <ul class="taxonomy-terms <?php echo esc_attr($has_terms); ?>">
                <?php if ($job_listing_tags) { ?>
                    <?php foreach ($job_listing_tags as $category) : ?>
                        <li data-tax="<?php echo esc_attr($category->taxonomy); ?>" data-term-id="<?php echo esc_attr($category->term_id); ?>" data-term="<?php echo esc_attr($category->name); ?>"><a href="<?php echo esc_url(get_term_link($category->term_id, $category->taxonomy)); ?>"><?php echo esc_html($category->name); ?> <span><?php echo esc_html($category->count); ?></span></a></li>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <li><span class="text"><?php echo esc_html__('No job tags are defined or is assigned a job listing.', 'capstone'); ?></span></li>
                <?php } ?>
                <li class="more-link"><?php echo esc_html__('or go to', 'capstone'); ?> <a href="<?php echo esc_url(get_permalink(get_option('job_manager_jobs_page_id'))); ?>"><?php echo esc_html__('advanced search', 'capstone'); ?> <em>&#8594;</em></a></li>
            </ul>
        </div>
    <?php } ?>

    <?php if ( taxonomy_exists('job_listing_type') && (in_array('job_types', $menu_items_order) || $taxonomy_grid_name == 'job_listing_type') ) { ?>
        <div id="taxonomy-job_listing_type" class="taxonomies-popup mfp-hide white-popup-block">
            <header class="taxonomies-header">
                <h2 class="title"><?php esc_html_e('Browse Types', 'capstone'); ?></h2>
                <p class="subtitle"><?php esc_html_e('Showing all types for the jobs.', 'capstone'); ?></p>
            </header>
            <?php
                // Helper Variable(s)
                $job_listing_types = get_terms( array(
                    'taxonomy' => 'job_listing_type',
                    'hide_empty' => true,
                ) );
                $has_terms = $job_listing_types ? '' : ' no-terms';
            ?>
            <ul class="taxonomy-terms <?php echo esc_attr($has_terms); ?>">
                <?php if ($job_listing_types) { ?>
                    <?php foreach ($job_listing_types as $category) : ?>
                        <li data-tax="<?php echo esc_attr($category->taxonomy); ?>" data-term-id="<?php echo esc_attr($category->term_id); ?>" data-term="<?php echo esc_attr($category->name); ?>"><a href="<?php echo esc_url(get_term_link($category->term_id, $category->taxonomy)); ?>"><?php echo esc_html($category->name); ?> <span><?php echo esc_html($category->count); ?></span></a></li>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <li><span class="text"><?php echo esc_html__('No type defined or is assigned a job listing.', 'capstone'); ?></span></li>
                <?php } ?>
                <li class="more-link"><?php echo esc_html__('or go to', 'capstone'); ?> <a href="<?php echo esc_url(get_permalink(get_option('job_manager_jobs_page_id'))); ?>"><?php echo esc_html__('advanced search', 'capstone'); ?> <em>&#8594;</em></a></li>
            </ul>
        </div>
    <?php } ?>

    <?php if ( taxonomy_exists('job_listing_region') && (in_array('job_regions', $menu_items_order) || $taxonomy_grid_name == 'job_listing_region') ) { ?>
        <div id="taxonomy-job_listing_region" class="taxonomies-popup mfp-hide white-popup-block">
            <header class="taxonomies-header">
                <h2 class="title"><?php esc_html_e('Browse Regions', 'capstone'); ?></h2>
                <p class="subtitle"><?php esc_html_e('Showing all regions for the jobs.', 'capstone'); ?></p>
            </header>
            <?php
                // Helper Variable(s)
                $job_listing_regions = get_terms( array(
                    'taxonomy' => 'job_listing_region',
                    'hide_empty' => true,
                ) );
                $has_terms = $job_listing_regions ? '' : ' no-terms';
            ?>
            <ul class="taxonomy-terms <?php echo esc_attr($has_terms); ?>">
                <?php if ($job_listing_regions) { ?>
                    <?php foreach ($job_listing_regions as $region) : ?>
                        <li data-tax="<?php echo esc_attr($region->taxonomy); ?>" data-term-id="<?php echo esc_attr($region->term_id); ?>" data-term="<?php echo esc_attr($region->name); ?>"><a href="<?php echo esc_url(get_term_link($region->term_id, $region->taxonomy)); ?>"><?php echo esc_html($region->name); ?> <span><?php echo esc_html($region->count); ?></span></a></li>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <li><span class="text"><?php echo esc_html__('No region defined or is assigned a job listing.', 'capstone'); ?></span></li>
                <?php } ?>
                <li class="more-link"><?php echo esc_html__('or go to', 'capstone'); ?> <a href="<?php echo esc_url(get_permalink(get_option('job_manager_jobs_page_id'))); ?>"><?php echo esc_html__('advanced search', 'capstone'); ?> <em>&#8594;</em></a></li>
            </ul>
        </div>
    <?php } ?>

    <?php if ( taxonomy_exists('job_listing_company') && (in_array('job_companies', $menu_items_order) || $taxonomy_grid_name == 'job_listing_company') ) { ?>
        <div id="taxonomy-job_listing_company" class="taxonomies-popup mfp-hide white-popup-block">
            <header class="taxonomies-header">
                <h2 class="title"><?php esc_html_e('Browse Companies', 'capstone'); ?></h2>
                <p class="subtitle"><?php esc_html_e('Showing all companies for the jobs.', 'capstone'); ?></p>
            </header>
            <?php
                // Helper Variable(s)
                $job_listing_companies = get_terms( array(
                    'taxonomy' => 'job_listing_company',
                    'hide_empty' => true,
                ) );
                $has_terms = $job_listing_companies ? '' : ' no-terms';
            ?>
            <ul class="taxonomy-terms <?php echo esc_attr($has_terms); ?>">
                <?php if ($job_listing_companies) { ?>
                    <?php foreach ($job_listing_companies as $company) : ?>
                        <li data-tax="<?php echo esc_attr($company->taxonomy); ?>" data-term-id="<?php echo esc_attr($company->term_id); ?>" data-term="<?php echo esc_attr($company->name); ?>"><a href="<?php echo esc_url(get_term_link($company->term_id, $company->taxonomy)); ?>"><?php echo esc_html($company->name); ?> <span><?php echo esc_html($company->count); ?></span></a></li>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <li><span class="text"><?php echo esc_html__('No company defined or is assigned a job listing.', 'capstone'); ?></span></li>
                <?php } ?>
                <li class="more-link"><?php echo esc_html__('or go to', 'capstone'); ?> <a href="<?php echo esc_url(get_permalink(get_option('job_manager_jobs_page_id'))); ?>"><?php echo esc_html__('advanced search', 'capstone'); ?> <em>&#8594;</em></a></li>
            </ul>
        </div>
    <?php } ?>
    
    <?php if ( taxonomy_exists('job_listing_industry') ) { ?>
        <div id="taxonomy-job_listing_industry" class="taxonomies-popup mfp-hide white-popup-block">
            <header class="taxonomies-header">
                <h2 class="title"><?php esc_html_e('Browse Industries', 'capstone'); ?></h2>
                <p class="subtitle"><?php esc_html_e('Showing all industries for the jobs.', 'capstone'); ?></p>
            </header>
            <?php
                // Helper Variable(s)
                $job_listing_industries = get_terms( array(
                    'taxonomy' => 'job_listing_industry',
                    'hide_empty' => true,
                ) );
                $has_terms = $job_listing_industries ? '' : ' no-terms';
            ?>
            <ul class="taxonomy-terms <?php echo esc_attr($has_terms); ?>">
                <?php if ($job_listing_industries) { ?>
                    <?php foreach ($job_listing_industries as $industry) : ?>
                        <li data-tax="<?php echo esc_attr($industry->taxonomy); ?>" data-term-id="<?php echo esc_attr($industry->term_id); ?>" data-term="<?php echo esc_attr($industry->name); ?>"><a href="<?php echo esc_url(get_term_link($industry->term_id, $industry->taxonomy)); ?>"><?php echo esc_html($industry->name); ?> <span><?php echo esc_html($industry->count); ?></span></a></li>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <li><span class="text"><?php echo esc_html__('No industry defined or is assigned a job listing.', 'capstone'); ?></span></li>
                <?php } ?>
                <li class="more-link"><?php echo esc_html__('or go to', 'capstone'); ?> <a href="<?php echo esc_url(get_permalink(get_option('job_manager_jobs_page_id'))); ?>"><?php echo esc_html__('advanced search', 'capstone'); ?> <em>&#8594;</em></a></li>
            </ul>
        </div>
    <?php } ?>

    <?php if ( taxonomy_exists('resume_category') ) { ?>
        <div id="taxonomy-resume_category" class="taxonomies-popup mfp-hide white-popup-block">
            <header class="taxonomies-header">
                <h2 class="title">
                    <span class="browse"><?php esc_html_e('Browse Categories', 'capstone'); ?></span>
                    <span class="choose"><?php esc_html_e('Choose Category', 'capstone'); ?></span>
                </h2>
                <p class="subtitle"><?php esc_html_e('Showing all categories for the resumes.', 'capstone'); ?></p>
            </header>
            <?php
                // Helper Variable(s)
                $resume_categories = get_terms( array(
                    'taxonomy' => 'resume_category',
                    'hide_empty' => true,
                ) );
                $has_terms = $resume_categories ? '' : ' no-terms';
            ?>
            <ul class="taxonomy-terms <?php echo esc_attr($has_terms); ?>">
                <?php if ($resume_categories) { ?>
                    <?php foreach ($resume_categories as $category) : ?>
                        <li data-tax="<?php echo esc_attr($category->taxonomy); ?>" data-term-id="<?php echo esc_attr($category->term_id); ?>" data-term="<?php echo esc_attr($category->name); ?>"><a href="<?php echo esc_url(get_term_link($category->term_id, $category->taxonomy)); ?>"><?php echo esc_html($category->name); ?> <span><?php echo esc_html($category->count); ?></span></a></li>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <li><span class="text"><?php echo esc_html__('No resume category defined or is assigned a resume listing.', 'capstone'); ?></span></li>
                <?php } ?>
                <li class="more-link"><?php echo esc_html__('or go to', 'capstone'); ?> <a href="<?php echo esc_url(get_permalink(get_option('resume_manager_resumes_page_id'))); ?>"><?php echo esc_html__('advanced search', 'capstone'); ?> <em>&#8594;</em></a></li>
            </ul>
        </div>
    <?php } ?>

    <?php if ( taxonomy_exists('resume_skill') && (in_array('resume_skills', $menu_items_order) || $taxonomy_grid_name == 'resume_skill') ) { ?>
        <div id="taxonomy-resume_skill" class="taxonomies-popup mfp-hide white-popup-block">
            <header class="taxonomies-header">
                <h2 class="title"><?php esc_html_e('Browse Skills', 'capstone'); ?></h2>
                <p class="subtitle"><?php esc_html_e('Showing all skills for the resumes.', 'capstone'); ?></p>
            </header>
            <?php
                // Helper Variable(s)
                $resume_skills = get_terms( array(
                    'taxonomy' => 'resume_skill',
                    'hide_empty' => true,
                ) );
                $has_terms = $resume_skills ? '' : ' no-terms';
            ?>
            <ul class="taxonomy-terms <?php echo esc_attr($has_terms); ?>">
                <?php if ($resume_skills) { ?>
                    <?php foreach ($resume_skills as $category) : ?>
                        <li data-tax="<?php echo esc_attr($category->taxonomy); ?>" data-term-id="<?php echo esc_attr($category->term_id); ?>" data-term="<?php echo esc_attr($category->name); ?>"><a href="<?php echo esc_url(get_term_link($category->term_id, $category->taxonomy)); ?>"><?php echo esc_html($category->name); ?> <span><?php echo esc_html($category->count); ?></span></a></li>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <li><span class="text"><?php echo esc_html__('No resume skill defined or is assigned a resume listing.', 'capstone'); ?></span></li>
                <?php } ?>
                <li class="more-link"><?php echo esc_html__('or go to', 'capstone'); ?> <a href="<?php echo esc_url(get_permalink(get_option('resume_manager_resumes_page_id'))); ?>"><?php echo esc_html__('advanced search', 'capstone'); ?> <em>&#8594;</em></a></li>
            </ul>
        </div>
    <?php } ?>

    <?php if ( taxonomy_exists('resume_region') && (in_array('resume_regions', $menu_items_order) || $taxonomy_grid_name == 'resume_region') ) { ?>
        <div id="taxonomy-resume_region" class="taxonomies-popup mfp-hide white-popup-block">
            <header class="taxonomies-header">
                <h2 class="title"><?php esc_html_e('Browse Regions', 'capstone'); ?></h2>
                <p class="subtitle"><?php esc_html_e('Showing all regions for the resumes.', 'capstone'); ?></p>
            </header>
            <?php
                // Helper Variable(s)
                $resume_regions = get_terms( array(
                    'taxonomy' => 'resume_region',
                    'hide_empty' => true,
                ) );
                $has_terms = $resume_regions ? '' : ' no-terms';
            ?>
            <ul class="taxonomy-terms <?php echo esc_attr($has_terms); ?>">
                <?php if ($resume_regions) { ?>
                    <?php foreach ($resume_regions as $region) : ?>
                        <li data-tax="<?php echo esc_attr($region->taxonomy); ?>" data-term-id="<?php echo esc_attr($region->term_id); ?>" data-term="<?php echo esc_attr($region->name); ?>"><a href="<?php echo esc_url(get_term_link($region->term_id, $region->taxonomy)); ?>"><?php echo esc_html($region->name); ?> <span><?php echo esc_html($region->count); ?></span></a></li>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <li><span class="text"><?php echo esc_html__('No resume region defined or is assigned a resume listing.', 'capstone'); ?></span></li>
                <?php } ?>
                <li class="more-link"><?php echo esc_html__('or go to', 'capstone'); ?> <a href="<?php echo esc_url(get_permalink(get_option('resume_manager_resumes_page_id'))); ?>"><?php echo esc_html__('advanced search', 'capstone'); ?> <em>&#8594;</em></a></li>
            </ul>
        </div>
    <?php } ?>

</div>
<!-- END: POPUP TAXONOMIES -->