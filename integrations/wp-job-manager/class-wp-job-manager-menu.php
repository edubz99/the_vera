<?php

class Capstone_WP_Job_Manager_Menu {

	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	public function init() {
        /** Helper Variable(s) */
        $this->menu_order_default = array( 'job_categories', 'job_regions', 'companies_list' );
        $this->menu_limit = get_theme_mod('capstone_header_explore_menu_limit', 8);
        $this->menu_items_order = get_theme_mod( 'capstone_header_explore_menu_order', $this->menu_order_default );

        /** Menu Items */
		add_action( 'capstone_explore_menu_item', array( $this, 'job_listing_category_menu' ) );
		add_action( 'capstone_explore_menu_item', array( $this, 'job_listing_tag_menu' ) );
        add_action( 'capstone_explore_menu_item', array( $this, 'job_listing_types_menu' ) );
        add_action( 'capstone_explore_menu_item', array( $this, 'job_listing_region_menu' ) );
    
        /** Menu Styles */
        // wp_add_inline_style( 'capstone-main', $this->menu_styles() );
    }

	#-------------------------------------------------------------------------------#
	#  Menu Item - Styles
	#-------------------------------------------------------------------------------#

    function menu_styles() {
        $custom_css = "ul#explore-menu li.menu-job_categories { order:". esc_attr(array_search('job_categories', $this->menu_items_order)) ." !important; }";
        $custom_css .= "ul#explore-menu li.menu-job_tags { order:". esc_attr(array_search('job_tags', $this->menu_items_order)) ." !important; }";
        $custom_css .= "ul#explore-menu li.menu-job_types { order:". esc_attr(array_search('job_types', $this->menu_items_order)) ." !important; }";

        return $custom_css;
    }

	#-------------------------------------------------------------------------------#
	#  Menu Item - Job Categories
	#-------------------------------------------------------------------------------#

	function job_listing_category_menu() {

        if ( taxonomy_exists('job_listing_category') && in_array('job_categories', $this->menu_items_order) ) { ?>
            <li class="menu-job_categories">
                <a class="sf-with-ul" href="#job-categories"><?php esc_html_e('Category', 'capstone'); ?></a>
                <?php
                    // Helper Variable(s)
                    $job_listing_categories = get_terms( array(
                        'taxonomy' => 'job_listing_category',
                        'hide_empty' => true,
                    ) );
                    $count = count($job_listing_categories);
                    $has_more = $count > $this->menu_limit;
                    $has_more_class = $has_more ? 'has-more' : '';
                ?>
                <ul id="job-categories" class="sub-menu tab-content <?php echo esc_attr($has_more_class); ?>">
                    <li><span class="title"><?php echo esc_html__('All Categories', 'capstone'); ?></span></li>
                    <?php $i = 0; ?>
                    <?php if ($job_listing_categories) { ?>
                        <?php foreach ($job_listing_categories as $category) : ?>
                            <li data-tax="<?php echo esc_attr($category->taxonomy); ?>" data-term-id="<?php echo esc_attr($category->term_id); ?>" data-term="<?php echo esc_attr($category->name); ?>"><a href="<?php echo esc_url(get_term_link($category->term_id, $category->taxonomy)); ?>"><?php echo esc_html($category->name); ?> <span><?php echo esc_html($category->count); ?></span></a></li>
                            <?php if (++$i == $this->menu_limit) break; ?>
                        <?php endforeach; ?>
                    <?php } else { ?>
                        <li><span class="text"><?php echo esc_html__('No job category is defined or is assigned a job listing.', 'capstone'); ?></span></li>
                    <?php } ?>
                    <?php if ($has_more) { ?>
                        <li class="more-link"><a href="#taxonomy-job_listing_category"><?php echo esc_html__('View all categories', 'capstone'); ?> <em>&#8594;</em></a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php }        

	}

	#-------------------------------------------------------------------------------#
	#  Menu Item - Job Tags
	#-------------------------------------------------------------------------------#

	function job_listing_tag_menu() {

        if ( taxonomy_exists('job_listing_tag') && in_array('job_tags', $this->menu_items_order) ) { ?>
            <li class="menu-job_tags">
                <a class="sf-with-ul" href="#job-tags"><?php esc_html_e('Tags', 'capstone'); ?></a>
                <?php
                    // Helper Variable(s)
                    $job_listing_tags = get_terms( array(
                        'taxonomy' => 'job_listing_tag',
                        'hide_empty' => true,
                    ) );
                    $count = count($job_listing_tags);
                    $has_more = $count > $this->menu_limit;
                    $has_more_class = $has_more ? 'has-more' : '';
                ?>
                <ul id="job-tags" class="sub-menu tab-content <?php echo esc_attr($has_more_class); ?>">
                    <li><span class="title"><?php echo esc_html__('All Tags', 'capstone'); ?></span></li>
                    <?php $i = 0; ?>
                    <?php if ($job_listing_tags) { ?>
                        <?php foreach ($job_listing_tags as $tag) : ?>
                            <li data-tax="<?php echo esc_attr($tag->taxonomy); ?>" data-term-id="<?php echo esc_attr($tag->term_id); ?>" data-term="<?php echo esc_attr($tag->name); ?>"><a href="<?php echo esc_url(get_term_link($tag->term_id, $tag->taxonomy)); ?>"><?php echo esc_html($tag->name); ?> <span><?php echo esc_html($tag->count); ?></span></a></li>
                            <?php if (++$i == $this->menu_limit) break; ?>
                        <?php endforeach; ?>
                    <?php } else { ?>
                        <li><span class="text"><?php echo esc_html__('No job tags are defined or is assigned a job listing.', 'capstone'); ?></span></li>
                    <?php } ?>
                    <?php if ($has_more) { ?>
                        <li class="more-link"><a href="#taxonomy-job_listing_tag"><?php echo esc_html__('View all tags', 'capstone'); ?> <em>&#8594;</em></a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php }        

	}

	#-------------------------------------------------------------------------------#
	#  Menu Item - Job Types
	#-------------------------------------------------------------------------------#

	function job_listing_types_menu() {

        if ( taxonomy_exists('job_listing_type') && in_array('job_types', $this->menu_items_order) ) { ?>
            <li class="menu-job_types">
                <a class="sf-with-ul" href="#job-types"><?php esc_html_e('Types', 'capstone'); ?></a>
                <?php
                    // Helper Variable(s)
                    $job_listing_types = get_terms( array(
                        'taxonomy' => 'job_listing_type',
                        'hide_empty' => true,
                    ) );
                    $count = count($job_listing_types);
                    $has_more = $count > $this->menu_limit;
                    $has_more_class = $has_more ? 'has-more' : '';
                ?> 
                <ul id="job-types" class="sub-menu tab-content <?php echo esc_attr($has_more_class); ?>">
                    <li><span class="title"><?php echo esc_html__('All Types', 'capstone'); ?></span></li>
                    <?php $i = 0; ?>
                    <?php if ($job_listing_types) { ?>
                        <?php foreach ($job_listing_types as $type) : ?>
                            <li><a href="<?php echo esc_url(get_term_link($type->term_id, $type->taxonomy)); ?>"><?php echo esc_html($type->name); ?> <span><?php echo esc_html($type->count); ?></span></a></li>
                            <?php if (++$i == $this->menu_limit) break; ?>
                        <?php endforeach; ?>
                    <?php } else { ?>
                        <li><span class="text"><?php echo esc_html__('No type defined or is assigned a job listing.', 'capstone'); ?></span></li>
                    <?php } ?>
                    <?php if ($has_more) { ?>
                        <li class="more-link"><a href="#taxonomy-job_listing_type"><?php echo esc_html__('View all types', 'capstone'); ?> <em>&#8594;</em></a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php }        

	}

	#-------------------------------------------------------------------------------#
	#  Menu Item - Job Regions
	#-------------------------------------------------------------------------------#

	function job_listing_region_menu() {

        if ( taxonomy_exists('job_listing_region') && in_array('job_regions', $this->menu_items_order) ) { ?>
            <li class="menu-job_regions">
                <a class="sf-with-ul" href="#job-regions"><?php echo esc_html__('Regions', 'capstone'); ?></a>
                <?php
                    // Helper Variable(s)
                    $job_listing_regions = get_terms( array(
                        'taxonomy' => 'job_listing_region',
                        'hide_empty' => true,
                    ) );
                    $count = count($job_listing_regions);
                    $has_more = $count > $this->menu_limit;
                    $has_more_class = $has_more ? 'has-more' : '';
                ?>
                <ul id="job-regions" class="sub-menu tab-content <?php echo esc_attr($has_more_class); ?>">
                    <li><span class="title"><?php echo esc_html__('All Regions', 'capstone'); ?></span></li>
                    <?php $i = 0; ?>
                    <?php if ($job_listing_regions) { ?>
                        <?php foreach ($job_listing_regions as $region) : ?>
                            <li data-tax="<?php echo esc_attr($region->taxonomy); ?>" data-term-id="<?php echo esc_attr($region->term_id); ?>" data-term="<?php echo esc_attr($region->name); ?>"><a href="<?php echo esc_url(get_term_link($region->term_id, $region->taxonomy)); ?>"><?php echo esc_html($region->name); ?> <span><?php echo esc_html($region->count); ?></span></a></li>
                            <?php if (++$i == $this->menu_limit) break; ?>
                        <?php endforeach; ?>
                    <?php } else { ?>
                        <li><span class="text"><?php echo esc_html__('No region defined or is assigned a job listing.', 'capstone'); ?></span></li>
                    <?php } ?>
                    <?php if ($has_more) { ?>
                        <li class="more-link"><a href="#taxonomy-job_listing_region"><?php echo esc_html__('View all regions', 'capstone'); ?> <em>&#8594;</em></a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php }        

	}

}