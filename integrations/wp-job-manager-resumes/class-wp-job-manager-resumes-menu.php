<?php

class Capstone_WP_Resume_Manager_Menu {

	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	public function init() {
        /** Helper Variable(s) */
        $this->menu_order_default = array( 'resume_categories', 'resume_regions', 'companies_list' );
        $this->menu_limit = get_theme_mod('capstone_header_explore_menu_limit', 8);
        $this->menu_items_order = get_theme_mod( 'capstone_header_explore_menu_order', $this->menu_order_default );

        /** Menu Items */
		add_action( 'capstone_explore_menu_item', array( $this, 'resume_category_menu' ) );
		add_action( 'capstone_explore_menu_item', array( $this, 'resume_tag_menu' ) );
        add_action( 'capstone_explore_menu_item', array( $this, 'resume_region_menu' ) );
    }

	#-------------------------------------------------------------------------------#
	#  Menu Item - Resume Categories
	#-------------------------------------------------------------------------------#

	function resume_category_menu() {

        if ( taxonomy_exists('resume_category') && in_array('resume_categories', $this->menu_items_order) ) { ?>
            <li class="menu-resume_categories">
                <a href="#resume-categories"><?php esc_html_e('Resume Category', 'capstone'); ?></a>
                <?php
                    // Helper Variable(s)
                    $resume_categories = get_terms( array(
                        'taxonomy' => 'resume_category',
                        'hide_empty' => true,
                    ) );
                    $count = count($resume_categories);
                    $has_more = $count > $this->menu_limit;
                    $has_more_class = $has_more ? 'has-more' : '';
                ?>
                <ul id="resume-categories" class="sub-menu tab-content <?php echo esc_attr($has_more_class); ?>">
                    <li><span class="title"><?php echo esc_html__('All Categories', 'capstone'); ?></span></li>
                    <?php $i = 0; ?>
                    <?php if ($resume_categories) { ?>
                        <?php foreach ($resume_categories as $category) : ?>
                            <li data-tax="<?php echo esc_attr($category->taxonomy); ?>" data-term-id="<?php echo esc_attr($category->term_id); ?>" data-term="<?php echo esc_attr($category->name); ?>"><a href="<?php echo esc_url(get_term_link($category->term_id, $category->taxonomy)); ?>"><?php echo esc_html($category->name); ?> <span><?php echo esc_html($category->count); ?></span></a></li>
                            <?php if (++$i == $this->menu_limit) break; ?>
                        <?php endforeach; ?>
                    <?php } else { ?>
                        <li><span class="text"><?php echo esc_html__('No resume category defined or is assigned a resume listing.', 'capstone'); ?></span></li>
                    <?php } ?>
                    <?php if ($has_more) { ?>
                        <li class="more-link"><a href="#taxonomy-resume_category"><?php echo esc_html__('View all categories', 'capstone'); ?> <em>&#8594;</em></a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php }        

	}

	#-------------------------------------------------------------------------------#
	#  Menu Item - Resume Tags
	#-------------------------------------------------------------------------------#

	function resume_tag_menu() {

        if ( taxonomy_exists('resume_skill') && in_array('resume_skills', $this->menu_items_order) ) { ?>
            <li class="menu-resume_skills">
                <a href="#resume-skills"><?php esc_html_e('Resume Skills', 'capstone'); ?></a>
                <?php
                    // Helper Variable(s)
                    $resume_skills = get_terms( array(
                        'taxonomy' => 'resume_skill',
                        'hide_empty' => true,
                    ) );
                    $count = count($resume_skills);
                    $has_more = $count > $this->menu_limit;
                    $has_more_class = $has_more ? 'has-more' : '';
                ?>
                <ul id="resume-skills" class="sub-menu tab-content  <?php echo esc_attr($has_more_class); ?>">
                    <li><span class="title"><?php echo esc_html__('All Skills', 'capstone'); ?></span></li>
                    <?php $i = 0; ?>
                    <?php if ($resume_skills) { ?>
                        <?php foreach ($resume_skills as $tag) : ?>
                            <li data-tax="<?php echo esc_attr($tag->taxonomy); ?>" data-term-id="<?php echo esc_attr($tag->term_id); ?>" data-term="<?php echo esc_attr($tag->name); ?>"><a href="<?php echo esc_url(get_term_link($tag->term_id, $tag->taxonomy)); ?>"><?php echo esc_html($tag->name); ?> <span><?php echo esc_html($tag->count); ?></span></a></li>
                            <?php if (++$i == $this->menu_limit) break; ?>
                        <?php endforeach; ?>
                    <?php } else { ?>
                        <li><span class="text"><?php echo esc_html__('No resume skill defined or is assigned a resume listing.', 'capstone'); ?></span></li>
                    <?php } ?>
                    <?php if ($has_more) { ?>
                        <li class="more-link"><a href="#taxonomy-resume_skill"><?php echo esc_html__('View all skills', 'capstone'); ?> <em>&#8594;</em></a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php }        

	}

	#-------------------------------------------------------------------------------#
	#  Menu Item - Resume Regions
	#-------------------------------------------------------------------------------#

	function resume_region_menu() {

        if ( taxonomy_exists('resume_region') && in_array('resume_regions', $this->menu_items_order) ) { ?>
            <li class="menu-resume_regions">
                <a class="sf-with-ul" href="#resume-regions"><?php esc_html_e('Resume Regions', 'capstone'); ?></a>
                <?php
                    // Helper Variable(s)
                    $resume_regions = get_terms( array(
                        'taxonomy' => 'resume_region',
                        'hide_empty' => true,
                    ) );
                    $count = count($resume_regions);
                    $has_more = $count > $this->menu_limit;
                    $has_more_class = $has_more ? 'has-more' : '';
                ?>
                <ul id="resume-regions" class="sub-menu tab-content <?php echo esc_attr($has_more_class); ?>">
                    <li><span class="title"><?php echo esc_html__('All Regions', 'capstone'); ?></span></li>
                    <?php $i = 0; ?>
                    <?php if ($resume_regions) { ?>
                        <?php foreach ($resume_regions as $region) : ?>
                            <li data-tax="<?php echo esc_attr($region->taxonomy); ?>" data-term-id="<?php echo esc_attr($region->term_id); ?>" data-term="<?php echo esc_attr($region->name); ?>"><a href="<?php echo esc_url(get_term_link($region->term_id, $region->taxonomy)); ?>"><?php echo esc_html($region->name); ?> <span><?php echo esc_html($region->count); ?></span></a></li>
                            <?php if (++$i == $this->menu_limit) break; ?>
                        <?php endforeach; ?>
                    <?php } else { ?>
                        <li><span class="text"><?php echo esc_html__('No resume region defined or is assigned a resume listing.', 'capstone'); ?></span></li>
                    <?php } ?>
                    <?php if ($has_more) { ?>
                        <li class="more-link"><a href="#taxonomy-resume_region"><?php echo esc_html__('View all regions', 'capstone'); ?> <em>&#8594;</em></a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php }        

	}

}