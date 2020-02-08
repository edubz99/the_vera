<?php

class Capstone_WP_Job_Manager_Companies_Menu {

	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	public function init() {
        /** Helper Variable(s) */
        $this->menu_order_default = array( 'job_categories', 'job_regions', 'job_companies' );
        $this->menu_limit = get_theme_mod('capstone_header_explore_menu_limit', 8);
        $this->menu_items_order = get_theme_mod( 'capstone_header_explore_menu_order', $this->menu_order_default );

        /** Menu Items */
		add_action( 'capstone_explore_menu_item', array( $this, 'job_company_menu' ) );
		add_action( 'capstone_explore_menu_item', array( $this, 'job_industry_menu' ) );
	}

	#-------------------------------------------------------------------------------#
	#  Menu Item - Companies
	#-------------------------------------------------------------------------------#

	function job_company_menu() {
        
        if ( taxonomy_exists('job_listing_company') && in_array('job_companies', $this->menu_items_order) ) { ?>
            <li class="menu-job_companies">
                <a class="sf-with-ul" href="#job-companies"><?php esc_html_e('Companies', 'capstone'); ?></a>
                <?php
                    // Helper Variable(s)
                    $job_listing_companies = get_terms( array(
                        'taxonomy' => 'job_listing_company',
                        'hide_empty' => true,
                    ) );
                    $count = count($job_listing_companies);
                    $has_more = $count > $this->menu_limit;
                    $has_more_class = $has_more ? 'has-more' : '';
                ?>
                <ul id="job-companies" class="sub-menu tab-content <?php echo esc_attr($has_more_class); ?>">
                    <li><span class="title"><?php echo esc_html__('All Companies', 'capstone'); ?></span></li>
                    <?php $i = 0; ?>
                    <?php if ($job_listing_companies) { ?>
                        <?php foreach ($job_listing_companies as $company) : ?>
                            <li data-tax="<?php echo esc_attr($company->taxonomy); ?>" data-term-id="<?php echo esc_attr($company->term_id); ?>" data-term="<?php echo esc_attr($company->name); ?>"><a href="<?php echo esc_url(get_term_link($company->term_id, $company->taxonomy)); ?>"><?php echo esc_html($company->name); ?> <span><?php echo esc_html($company->count); ?></span></a></li>
                            <?php if (++$i == $this->menu_limit) break; ?>
                        <?php endforeach; ?>
                    <?php } else { ?>
                        <li><span class="text"><?php echo esc_html__('No company defined or is assigned a job listing.', 'capstone'); ?></span></li>
                    <?php } ?>
                    <?php if ($has_more) { ?>
                        <li class="more-link"><a href="#taxonomy-job_listing_company"><?php echo esc_html__('View all companies', 'capstone'); ?> <em>&#8594;</em></a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php }    

    }
    
	#-------------------------------------------------------------------------------#
	#  Menu Item - Industries
	#-------------------------------------------------------------------------------#

	function job_industry_menu() {
        
        if ( taxonomy_exists('job_listing_industry') && in_array('job_industries', $this->menu_items_order) ) { ?>
            <li class="menu-job_industries">
                <a class="sf-with-ul" href="#job-industries"><?php esc_html_e('Industries', 'capstone'); ?></a>
                <?php
                    // Helper Variable(s)
                    $job_listing_industries = get_terms( array(
                        'taxonomy' => 'job_listing_industry',
                        'hide_empty' => true,
                    ) );
                    $count = count($job_listing_industries);
                    $has_more = $count > $this->menu_limit;
                    $has_more_class = $has_more ? 'has-more' : '';
                ?>
                <ul id="job-industries" class="sub-menu tab-content <?php echo esc_attr($has_more_class); ?>">
                    <li><span class="title"><?php echo esc_html__('All Industries', 'capstone'); ?></span></li>
                    <?php $i = 0; ?>
                    <?php if ($job_listing_industries) { ?>
                        <?php foreach ($job_listing_industries as $industry) : ?>
                            <li data-tax="<?php echo esc_attr($industry->taxonomy); ?>" data-term-id="<?php echo esc_attr($industry->term_id); ?>" data-term="<?php echo esc_attr($industry->name); ?>"><a href="<?php echo esc_url(get_term_link($industry->term_id, $industry->taxonomy)); ?>"><?php echo esc_html($industry->name); ?> <span><?php echo esc_html($industry->count); ?></span></a></li>
                            <?php if (++$i == $this->menu_limit) break; ?>
                        <?php endforeach; ?>
                    <?php } else { ?>
                        <li><span class="text"><?php echo esc_html__('No industry defined or is assigned a job listing.', 'capstone'); ?></span></li>
                    <?php } ?>
                    <?php if ($has_more) { ?>
                        <li class="more-link"><a href="#taxonomy-job_listing_industry"><?php echo esc_html__('View all industries', 'capstone'); ?> <em>&#8594;</em></a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php }    

	}


}