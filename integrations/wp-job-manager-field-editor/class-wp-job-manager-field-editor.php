<?php

class Capstone_WP_Job_Manager_Field_Editor extends Capstone_Integration {

	/**
	 * WP_Job_Manager_Field_Editor_Integration constructor.
	 */
	public function __construct() {
		parent::__construct( dirname( __FILE__ ) );
	}

	public function init() {}

	public function setup_actions() {
		add_filter( 'field_editor_auto_output_li_actions', array( $this, 'add_li_actions' ) );
		add_filter( 'field_editor_output_options', array( $this, 'auto_output' ), 10, 2 );
	}

	/**
	 * Add Custom Keywords to recognize Company Actions
	 *
	 */
	function auto_output_custom_company_actions(){
		return array('company_listing');
	}

	/**
	 * Add Custom Keywords to recognize Resume Actions
	 *
	 */
	function auto_output_custom_resume_actions(){
		return array('resume_listing');
	}

	/**
	 * Add Hooks that should be wrapped in <li> tags
	 *
	 */
	function add_li_actions( $actions ) {

		$actions[] = 'job_listing_meta_start';
		$actions[] = 'job_listing_meta_end';
		$actions[] = 'single_job_listing_quick_meta_start';
		$actions[] = 'single_job_listing_quick_meta_end';
		$actions[] = 'single_job_listing_meta_before';
		$actions[] = 'single_job_listing_meta_after';
		$actions[] = 'single_job_listing_more_actions_start';
		$actions[] = 'single_job_listing_more_actions_end';
		$actions[] = 'preview_job_listing_meta_start';
		$actions[] = 'preview_job_listing_meta_end';

		$actions[] = 'single_company_listing_quick_meta_start';
		$actions[] = 'single_company_listing_quick_meta_end';
		$actions[] = 'single_company_listing_meta_before';
		$actions[] = 'single_company_listing_meta_start';
		$actions[] = 'single_company_listing_meta_end';
		$actions[] = 'single_company_listing_meta_after';
		$actions[] = 'single_company_listing_social_before';
		$actions[] = 'single_company_listing_social_after';

		$actions[] = 'resume_listing_meta_start';
		$actions[] = 'resume_listing_meta_end';
		$actions[] = 'single_resume_quick_meta_start';
		$actions[] = 'single_resume_quick_meta_end';
		$actions[] = 'single_resume_meta_before';
		$actions[] = 'single_resume_meta_after';
		$actions[] = 'single_resume_candidate_social_before';
		$actions[] = 'single_resume_candidate_social_after';
		$actions[] = 'single_resume_more_actions_start';
		$actions[] = 'single_resume_more_actions_end';
		$actions[] = 'preview_resume_listing_meta_start';
		$actions[] = 'preview_resume_listing_meta_end';


		return $actions;
	}

	/**
	 * Capstone Theme custom action output areas
	 *
	 * @since @@since
	 *
	 * @param $current_options
	 * @param $type
	 *
	 * @return array|bool
	 */
	function auto_output( $output_options, $list_field_group ) {
		
		$job_options = array(
			'capstone_master_job_output_page_label' => '---' . __( 'Master Job Page', 'capstone' ),
			'job_listing_meta_start' => __( 'Preview Meta Start', 'capstone' ),
			'job_listing_meta_end'  => __( 'Preview Meta End', 'capstone' ),

			'capstone_detail_job_output_page_label' => '---' . __( 'Detail Job Page', 'capstone' ),
			'single_job_listing_quick_meta_start' => __( 'Quick Job Meta Start', 'capstone' ),
			'single_job_listing_quick_meta_end'  => __( 'Quick Job Meta End', 'capstone' ),
			'single_job_listing_meta_before' => __( 'Before Job Meta', 'capstone' ),
			'single_job_listing_meta_start' => __( 'Job Meta Start', 'capstone' ),
			'single_job_listing_meta_end' => __( 'Job Meta End', 'capstone' ),
			'single_job_listing_meta_after'  => __( 'After Job Meta', 'capstone' ),
			'single_job_listing_desc_before'  => __( 'Before Job Description', 'capstone' ),
			'single_job_listing_desc_after'  => __( 'After Job Description', 'capstone' ),
			'single_job_listing_more_actions_start' => __( 'Job More Actions Start', 'capstone' ),
			'single_job_listing_more_actions_end' => __( 'Job More Actions End', 'capstone' ),

			'capstone_preview_job_output_page_label' => '---' . __( 'Preview Job Page', 'capstone' ),
			'preview_job_listing_meta_start' => __( 'Job Meta Start', 'capstone' ),
			'preview_job_listing_meta_end'  => __( 'Job Meta End', 'capstone' ),
			'preview_job_listing_desc_before' => __( 'Before Job Description', 'capstone' ),
			'preview_job_listing_desc_after'  => __( 'After Job Description', 'capstone' ),
		);

		$company_options = array(
			'capstone_detail_company_output_page_label' => '---' . __( 'Detail Company Page', 'capstone' ),
			'single_company_listing_quick_meta_start' => __( 'Quick Company Meta Start', 'capstone' ),
			'single_company_listing_quick_meta_end'  => __( 'Quick Company Meta End', 'capstone' ),
			'single_company_listing_meta_before' => __( 'Before Company Meta', 'capstone' ),
			'single_company_listing_meta_start' => __( 'Company Meta Start', 'capstone' ),
			'single_company_listing_meta_end' => __( 'Company Meta End', 'capstone' ),
			'single_company_listing_meta_after'  => __( 'After Company Meta', 'capstone' ),
			
			'capstone_sidebar_company_listing_output_page_label' => '---' . __( 'Sidebar Company Modules', 'capstone' ),
			'single_company_listing_social_before' => __( 'Before Company Social Icons', 'capstone' ),
			'single_company_listing_social_after'  => __( 'After Company Social Icons', 'capstone' ),
		);
	
		$resume_options = array(
			'capstone_master_resume_output_page_label' => '---' . __( 'Master Resume Page', 'capstone' ),
			'resume_listing_meta_start' => __( 'Preview Meta Start', 'capstone' ),
			'resume_listing_meta_end'  => __( 'Preview Meta End', 'capstone' ),

			'capstone_detail_resume_output_page_label' => '---' . __( 'Detail Resume Page', 'capstone' ),
			'single_resume_quick_meta_start' => __( 'Quick Resume Meta Start', 'capstone' ),
			'single_resume_quick_meta_end'  => __( 'Quick Resume Meta End', 'capstone' ),
			'single_resume_meta_before' => __( 'Before Resume Meta', 'capstone' ),
			'single_resume_meta_start' => __( 'Resume Meta Start', 'capstone' ),
			'single_resume_meta_end' => __( 'Resume Meta End', 'capstone' ),
			'single_resume_meta_after'  => __( 'After Resume Meta', 'capstone' ),
			'single_resume_desc_before'  => __( 'Before Resume Description', 'capstone' ),
			'single_resume_desc_after'  => __( 'After Resume Description', 'capstone' ),
			'single_resume_more_actions_start' => __( 'Resume More Actions Start', 'capstone' ),
			'single_resume_more_actions_end' => __( 'Resume More Actions End', 'capstone' ),

			'capstone_sidebar_resume_output_page_label' => '---' . __( 'Sidebar Resume Modules', 'capstone' ),
			'single_resume_candidate_social_before' => __( 'Before Candidate Social Icons', 'capstone' ),
			'single_resume_candidate_social_after'  => __( 'After Candidate Social Icons', 'capstone' ),

			'capstone_preview_resume_output_page_label' => '---' . __( 'Preview Resume Page', 'capstone' ),
			'preview_resume_listing_meta_start' => __( 'Resume Meta Start', 'capstone' ),
			'preview_resume_listing_meta_end'  => __( 'Resume Meta End', 'capstone' ),
			'preview_resume_listing_desc_before' => __( 'Before Resume Description', 'capstone' ),
			'preview_resume_listing_desc_after'  => __( 'After Resume Description', 'capstone' ),

		);
		
		switch ( $list_field_group ) {
			
			case 'job':
				$my_output_options = $job_options;
				break;
			case 'company':
				// $my_output_options = $company_options;
				$my_output_options = array_merge( $company_options, $job_options );
				break;
			case 'resume_fields':
				$my_output_options = $resume_options;
				break;
			default:
				// We merge both resume and job when no $list_field_group provided/matches, so they are automatically
				// added using add_action and then we don't have to manually define them
				$my_output_options = array_merge( $job_options, $company_options, $resume_options );
		}
		
		// We MUST (or not) merge the original passed array of hooks, with our added ones
		return $my_output_options;
		
	}

}