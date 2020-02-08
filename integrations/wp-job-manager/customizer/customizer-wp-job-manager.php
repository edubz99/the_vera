<?php

/*
 * Retrieve all defined facets in the the settings
 */
function capstone_get_all_facets() {
	$facets_all = array();

	if ( class_exists('FacetWP') ) {
		$facets = FWP()->helper->get_facets();
		foreach ( $facets as $facet ) {
			$facets_all[$facet['name']] = $facet['label'];
		}
	}

	return $facets_all;
}

#-------------------------------------------------------------------------------#
#  Theme Customizer - Jobs Settings
#-------------------------------------------------------------------------------#

	add_action( 'init', 'capstone_customizer_jobs_settings' );

	function capstone_customizer_jobs_settings() {

		// PANEL: Jobs
		Kirki::add_panel( 'capstone_jobs_settings', array(
			'priority'    => 50,
			'title'       => esc_html__( 'Jobs Settings', 'capstone' ),
			'description' => esc_html__( 'This panels configures job archive and single job listing page settings.', 'capstone' ),
		) );

		// SECTION: Jobs Master
		Kirki::add_section( 'capstone_jobs_master_page', array(
			'title'          => esc_html__( 'Master Page', 'capstone' ),
			'description'    => esc_html__( 'This section configures jobs master listing page.', 'capstone' ),
			'panel'          => 'capstone_jobs_settings',
			'priority'       => 10,
		) );

		// OPTION: Jobs Master --> Google Maps
		Kirki::add_field( 'capstone_jobs_enable_map', array(
			'type'        => 'checkbox',
			'settings'    => 'capstone_jobs_enable_map',
			'label'       => esc_html__( 'Enable Maps', 'capstone' ),
			'description' => esc_html__( 'Check this to enable maps on jobs archive page. Also make sure that map is configured properly.', 'capstone' ),
			'section'     => 'capstone_jobs_master_page',
			'default'     => false,
		) );

		// OPTION: Jobs Master --> Auto Exerpt
		Kirki::add_field( 'capstone_jobs_enable_auto_excerpt', array(
			'type'        => 'checkbox',
			'settings'    => 'capstone_jobs_enable_auto_excerpt',
			'label'       => esc_html__( 'Auto Excerpt', 'capstone' ),
			'description' => esc_html__( 'It\'ll only be visible if custom excerpt is not defined for the listing.', 'capstone' ),
			'section'     => 'capstone_jobs_master_page',
			'default'     => false,
		) );

		// Sidebar order options
		$sidebar_order_options = array(
			'alert_module' => esc_html__( 'Alert Module', 'capstone' ),
			'native_widgets' => esc_html__( 'Native Widgets', 'capstone' ),
		);
		if ( class_exists('FacetWP') ) {
			$sidebar_order_default_options = array( 'facetwp_module', 'native_widgets', 'alert_module' );
			$sidebar_order_options['facetwp_module'] = esc_html__( 'Facets Module', 'capstone' );
		} else {
			$sidebar_order_default_options = array( 'search_module', 'filters_module', 'native_widgets', 'alert_module' );
			$sidebar_order_options['search_module'] = esc_html__( 'Search Module', 'capstone' );
			$sidebar_order_options['filters_module'] = esc_html__( 'Filters Module', 'capstone' );
		}

		// OPTION: Jobs Detail --> Sidebar Order
		Kirki::add_field( 'capstone_jobs_sidebar_order', array(
			'type'        => 'sortable',
			'settings'    => 'capstone_jobs_sidebar_order',
			'label'       => __( 'Sidebar Order', 'capstone' ),
			'description'    => esc_html__( 'Change the order and visibility (at global level) of job archive sidebar.', 'capstone' ),
			'section'     => 'capstone_jobs_master_page',
			'default'     => $sidebar_order_default_options,
			'choices'     => $sidebar_order_options,
		) );

		if ( !class_exists('FacetWP') ) {

			// OPTION: Sortable
			Kirki::add_field( 'capstone_jobs_search_order', array(
				'type'        => 'sortable',
				'settings'    => 'capstone_jobs_search_order',
				'label'       => __( 'Search Module Order', 'capstone' ),
				'description'    => esc_html__( 'Change the order and visibility (at global level) of "Search Module" elements.', 'capstone' ),
				'section'     => 'capstone_jobs_master_page',
				'default'     => array(
					'keywords',
					'location',
					'category_popup',
				),
				'choices'     => array(
					'keywords' => esc_html__( 'Keywords', 'capstone' ),
					'location' => esc_html__( 'Location', 'capstone' ),
					'category' => esc_html__( 'Category', 'capstone' ),
					'type' => esc_html__( 'Types', 'capstone' ),
					'category_popup' => esc_html__( 'Category - Popup', 'capstone' ),
				),
			) );

			// OPTION: Jobs Master --> Filter Order
			Kirki::add_field( 'capstone_jobs_filters_order', array(
				'type'        => 'sortable',
				'settings'    => 'capstone_jobs_filters_order',
				'label'       => __( 'Filters Module Order', 'capstone' ),
				'description'    => esc_html__( 'Change the order and visibility (at global level) of different filters within "Filters Module".', 'capstone' ),
				'section'     => 'capstone_jobs_master_page',
				'default'     => array(
					'job_types',
					'job_tags',
					// 'job_salary_range'
				),
				'choices'     => array(
					'job_types' => esc_html__( 'Job Types', 'capstone' ),
					'job_tags' => esc_html__( 'Job Tags', 'capstone' ),
					// 'job_salary_range' => esc_html__( 'Salary Range', 'capstone' ),
				),
			) );

			// OPTION: Jobs Master --> Filter Breakpoint
			Kirki::add_field( 'capstone_jobs_filters_breakpoint', array(
				'type'        => 'number',
				'settings'    => 'capstone_jobs_filters_breakpoint',
				'label'       => esc_html__( 'Filters Breakpoint', 'capstone' ),
				'description'    => esc_html__( 'How many filters to show before "More Filters" button.', 'capstone' ),
				'section'     => 'capstone_jobs_master_page',
				'default'     => 3,
				'choices'     => array(
					'min'  => 1,
					'max'  => 100,
					'step' => 1,
				),
			) );			

		} else {
	
			// OPTION: Jobs Master --> Filter Order
			Kirki::add_field( 'capstone_jobs_filters_order_facetwp', array(
				'type'        => 'sortable',
				'settings'    => 'capstone_jobs_filters_order_facetwp',
				'label'       => __( 'Facets Module Order', 'capstone' ),
				'description'    => esc_html__( 'Please enable only jobs related facets below.', 'capstone' ),
				'section'     => 'capstone_jobs_master_page',
				'default'     => array(),
				'choices'     => capstone_get_all_facets(),
			) );
		
		}

		// SECTION: Job Detail
		Kirki::add_section( 'capstone_jobs_detail_page', array(
			'title'          => esc_html__( 'Detail Page', 'capstone' ),
			'description'    => esc_html__( 'This section configures job detail page.', 'capstone' ),
			'panel'          => 'capstone_jobs_settings',
			'priority'       => 20,
		) );

		// OPTION: Jobs Detail --> Content Order
		Kirki::add_field( 'capstone_jobs_single_content_order', array(
			'type'        => 'sortable',
			'settings'    => 'capstone_jobs_single_content_order',
			'label'       => __( 'Content Order', 'capstone' ),
			'description'    => esc_html__( 'Change the order and visibility (at global level) of job listing content.', 'capstone' ),
			'section'     => 'capstone_jobs_detail_page',
			'default'     => array(
				'job_header',
				'job_meta',
				'job_desc',
				'job_tags',
				'job_actions',
			),
			'choices'     => array(
				'job_header' => esc_html__( 'Job Header', 'capstone' ),
				'job_meta' => esc_html__( 'Job Meta', 'capstone' ),
				'job_desc' => esc_html__( 'Jobs Description', 'capstone' ),
				'job_tags' => esc_html__( 'Job Tags', 'capstone' ),
				'job_actions' => esc_html__( 'Job Actions', 'capstone' ),
			),
			'priority'    => 1,
		) );
		
		// OPTION: Jobs Detail --> Sidebar Order
		Kirki::add_field( 'capstone_jobs_single_sidebar_order', array(
			'type'        => 'sortable',
			'settings'    => 'capstone_jobs_single_sidebar_order',
			'label'       => __( 'Sidebar Order', 'capstone' ),
			'description'    => esc_html__( 'Change the order and visibility (at global level) of job listing sidebar.', 'capstone' ),
			'section'     => 'capstone_jobs_detail_page',
			'default'     => array(
				'native_widgets',
				'company_profile',
				'listing_url',
				'similiar_jobs',
			),
			'choices'     => array(
				'native_widgets' => esc_html__( 'Native Widgets', 'capstone' ),
				'company_profile' => esc_html__( 'Company Profile', 'capstone' ),
				'listing_url' => esc_html__( 'Listing URL', 'capstone' ),
				'similiar_jobs' => esc_html__( 'Similiar Jobs', 'capstone' ),
			),
			'priority'    => 2,
		) );

		// OPTION: Number
		Kirki::add_field( 'capstone_jobs_single_meta_limit', array(
			'type'        => 'number',
			'settings'    => 'capstone_jobs_single_meta_limit',
			'label'       => __( 'Job Meta Limit', 'capstone' ),
			'description'    => esc_html__( 'How many meta values to show before "see all" link?', 'capstone' ),
			'section'     => 'capstone_jobs_detail_page',
			'default'     => '4',
			'priority'    => 4,
		) );

		// OPTION: Jobs Detail --> Sidebar Order
		Kirki::add_field( 'capstone_jobs_single_similiar_jobs_count', array(
			'type'        => 'number',
			'settings'    => 'capstone_jobs_single_similiar_jobs_count',
			'label'       => __( 'Similiar Jobs Count', 'capstone' ),
			'description'    => esc_html__( 'How many (at max) similiar jobs to display in sidebar.', 'capstone' ),
			'section'     => 'capstone_jobs_detail_page',
			'default'     => '3',
			'priority'    => 3,
		) );

		// OPTION: Checkbox
		Kirki::add_field( 'capstone_jobs_single_toggle_video_visibility', array(
			'type'        => 'checkbox',
			'settings'    => 'capstone_jobs_single_toggle_video_visibility',
			'label'       => esc_html__( 'Toggle "Video" visibility in Description', 'capstone' ),
			'description' => esc_html__( 'Check (or uncheck) this field to toggle "video" field visibility above job description.', 'capstone' ),
			'section'     => 'capstone_jobs_detail_page',
			'default'     => false,
		) );

		// SECTION: Job Detail
		Kirki::add_section( 'capstone_job_tags', array(
			'title'          => esc_html__( 'Job Tags', 'capstone' ),
			'description'    => esc_html__( 'This section is only applicable if you have activated "WP Job Manager - Tags" add-on.', 'capstone' ),
			'panel'          => 'capstone_jobs_settings',
			'priority'       => 30,
		) );

		// OPTION: Text Field
        Kirki::add_field( 'capstone_jobs_tags_title', array(
            'type'     => 'text',
            'settings' => 'capstone_jobs_tags_title',
            'label'    => __( 'Tags Title', 'capstone' ),
			'section'  => 'capstone_job_tags',
			'default'   => esc_html__('Perks & Privilges', 'capstone'),
            'description' => esc_html__('Job Tags would be represented with this title on the fron-end.', 'capstone'),
		) );

		// OPTION: Textarea Field
        Kirki::add_field( 'capstone_jobs_tags_desc', array(
            'type'          => 'textarea',
            'settings'      => 'capstone_jobs_tags_desc',
            'label'         => __( 'Tags Descripion', 'capstone' ),
			'section'       => 'capstone_job_tags',
			'default'   	=> esc_html__('This job listing offers following perks and privileges.', 'capstone'),
            'description'   => esc_html__('This text would be displayed in detail job listing page as a small description.', 'capstone'),
		) );

	}
