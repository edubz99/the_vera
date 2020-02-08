<?php

#-------------------------------------------------------------------------------#
#  Theme Customizer - Companies Settings
#-------------------------------------------------------------------------------#

	add_action( 'init', 'capstone_customizer_companies_settings' );

	function capstone_customizer_companies_settings() {

		// PANEL: Companies
		Kirki::add_panel( 'capstone_companies_settings', array(
			'priority'    => 65,
			'title'       => esc_html__( 'Companies Settings', 'capstone' ),
			'description' => esc_html__( 'This panels configures companies master and detail listing page settings.', 'capstone' ),
        ) );
        
        // SECTION: Companies Master
		Kirki::add_section( 'capstone_companies_master_page', array(
			'title'          => esc_html__( 'Master Page', 'capstone' ),
			'description'    => esc_html__( 'This section configures companies master listing page.', 'capstone' ),
			'panel'          => 'capstone_companies_settings',
			'priority'       => 10,
        ) );
        
        // OPTION: Select Field
        Kirki::add_field( 'capstone_companies_page_id', array(
            'type'        => 'dropdown-pages',
            'settings'    => 'capstone_companies_page_id',
            'label'       => esc_html__( 'Comapny Listings Page', 'capstone' ),
            'description' => esc_html__( 'This is the page where you are using `[job_manager_companies]` shortcode.', 'capstone' ),
            'section'     => 'capstone_companies_master_page',
        ) );

        // OPTION: Select Field
        Kirki::add_field( 'capstone_companies_jobs_excerpt', array(
            'type'        => 'select',
            'settings'    => 'capstone_companies_jobs_excerpt',
            'label'       => __( '"Open Positions" Excerpt', 'capstone' ),
            'description' => esc_html__( 'Display a list of company-specific recent companys?', 'capstone' ),
            'section'     => 'capstone_companies_master_page',
            'default'     => 'enable',
            'choices'     => array(
                'enable' => esc_html__( 'Enable Excerpt', 'capstone' ),
                'disable' => esc_html__( 'Disable Excerpt', 'capstone' ),
            ),
        ) );

        // OPTION: Companies Master --> Filter Breakpoint
		Kirki::add_field( 'capstone_companies_jobs_excerpt_limit', array(
			'type'        => 'number',
			'settings'    => 'capstone_companies_jobs_excerpt_limit',
			'label'       => esc_html__( 'Limit "Open Positions"', 'capstone' ),
			'description'    => esc_html__( 'How many "Open Positions" to display, if enabled?', 'capstone' ),
			'section'     => 'capstone_companies_master_page',
			'default'     => 2,
			'choices'     => array(
				'min'  => 1,
				'max'  => 100,
				'step' => 1,
			),
		) );
        

		// SECTION: Company Detail
		Kirki::add_section( 'capstone_companies_detail_page', array(
			'title'          => esc_html__( 'Detail Page', 'capstone' ),
			'description'    => esc_html__( 'This section configures company detail page.', 'capstone' ),
			'panel'          => 'capstone_companies_settings',
			'priority'       => 20,
		) );

		// OPTION: Companies Detail --> Content Order
		Kirki::add_field( 'capstone_companies_single_content_order', array(
			'type'        => 'sortable',
			'settings'    => 'capstone_companies_single_content_order',
			'label'       => __( 'Content Order', 'capstone' ),
			'description'    => esc_html__( 'Change the order and visibility (at global level) of company listing content.', 'capstone' ),
			'section'     => 'capstone_companies_detail_page',
			'default'     => array(
				'company_header',
				'company_meta',
				'company_desc',
				'company_positions',
				'company_actions',
			),
			'choices'     => array(
				'company_header' => esc_html__( 'Company Header', 'capstone' ),
				'company_meta' => esc_html__( 'Company Meta', 'capstone' ),
				'company_desc' => esc_html__( 'Companies Description', 'capstone' ),
				'company_positions' => esc_html__( 'Company Positions', 'capstone' ),
				'company_actions' => esc_html__( 'Company Actions', 'capstone' ),
			),
			'priority'    => 1,
		) );
		
		// OPTION: Companies Detail --> Sidebar Order
		Kirki::add_field( 'capstone_companies_single_sidebar_order', array(
			'type'        => 'sortable',
			'settings'    => 'capstone_companies_single_sidebar_order',
			'label'       => __( 'Sidebar Order', 'capstone' ),
			'description'    => esc_html__( 'Change the order and visibility (at global level) of company listing sidebar.', 'capstone' ),
			'section'     => 'capstone_companies_detail_page',
			'default'     => array(
				'native_widgets',
				'company_profile',
				'listing_url',
			),
			'choices'     => array(
				'native_widgets' => esc_html__( 'Native Widgets', 'capstone' ),
				'company_profile' => esc_html__( 'Company Profile', 'capstone' ),
				'listing_url' => esc_html__( 'Listing URL', 'capstone' ),
			),
			'priority'    => 2,
		) );

		// OPTION: Number
		Kirki::add_field( 'capstone_companies_single_meta_limit', array(
			'type'        => 'number',
			'settings'    => 'capstone_companies_single_meta_limit',
			'label'       => __( 'Company Meta Limit', 'capstone' ),
			'description'    => esc_html__( 'How many meta values to show before "see all" link?', 'capstone' ),
			'section'     => 'capstone_companies_detail_page',
			'default'     => '4',
			'priority'    => 4,
		) );

	}
