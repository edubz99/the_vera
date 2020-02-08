<?php
/**
 * Merlin WP configuration file.
 *
 * @package   Merlin WP
 * @version   @@pkg.version
 * @link      https://merlinwp.com/
 * @author    Rich Tabor, from ThemeBeans.com & the team at ProteusThemes.com
 * @copyright Copyright (c) 2018, Merlin WP of Inventionn LLC
 * @license   Licensed GPLv3 for Open Source Use
 */

if ( ! class_exists( 'Merlin' ) ) {
	return;
}

/**
 * Set directory locations, text strings, and settings.
 */
$wizard = new Merlin(

	$config = array(
		'directory'            => 'admin/merlin', // Location / directory where Merlin WP is placed in your theme.
		'merlin_url'           => 'merlin', // The wp-admin page slug where Merlin WP loads.
		'parent_slug'          => 'themes.php', // The wp-admin parent page slug for the admin menu item.
		'capability'           => 'manage_options', // The capability required for this menu to be displayed to the user.
		'child_action_btn_url' => 'https://codex.wordpress.org/child_themes', // URL for the 'child-action-link'.
		'dev_mode'             => !defined('WP_ENV') && !get_theme_mod('capstone_enable_dev_mode', false) ? false : true, // Enable development mode for testing.
		'license_step'         => false, // EDD license activation step.
		'license_required'     => false, // Require the license activation step.
		'license_help_url'     => '', // URL for the 'license-tooltip'.
		'edd_remote_api_url'   => '', // EDD_Theme_Updater_Admin remote_api_url.
		'edd_item_name'        => '', // EDD_Theme_Updater_Admin item_name.
		'edd_theme_slug'       => '', // EDD_Theme_Updater_Admin item_slug.
		'ready_big_button_url' => esc_url( home_url('/') ), // Link for the big button on the ready step.
	),
	$strings = array(
		'admin-menu'               => esc_html__( 'Theme Setup', 'capstone' ),

		/* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
		'title%s%s%s%s'            => esc_html__( '%1$s%2$s Themes &lsaquo; Theme Setup: %3$s%4$s', 'capstone' ),
		'return-to-dashboard'      => esc_html__( 'Return to the dashboard', 'capstone' ),
		'ignore'                   => esc_html__( 'Disable this wizard', 'capstone' ),

		'btn-skip'                 => esc_html__( 'Skip', 'capstone' ),
		'btn-next'                 => esc_html__( 'Next', 'capstone' ),
		'btn-start'                => esc_html__( 'Start', 'capstone' ),
		'btn-no'                   => esc_html__( 'Cancel', 'capstone' ),
		'btn-plugins-install'      => esc_html__( 'Install', 'capstone' ),
		'btn-child-install'        => esc_html__( 'Install', 'capstone' ),
		'btn-content-install'      => esc_html__( 'Install', 'capstone' ),
		'btn-import'               => esc_html__( 'Import', 'capstone' ),
		'btn-license-activate'     => esc_html__( 'Activate', 'capstone' ),
		'btn-license-skip'         => esc_html__( 'Later', 'capstone' ),

		/* translators: Theme Name */
		'license-header%s'         => esc_html__( 'Activate %s', 'capstone' ),
		/* translators: Theme Name */
		'license-header-success%s' => esc_html__( '%s is Activated', 'capstone' ),
		/* translators: Theme Name */
		'license%s'                => esc_html__( 'Enter your license key to enable remote updates and theme support.', 'capstone' ),
		'license-label'            => esc_html__( 'License key', 'capstone' ),
		'license-success%s'        => esc_html__( 'The theme is already registered, so you can go to the next step!', 'capstone' ),
		'license-json-success%s'   => esc_html__( 'Your theme is activated! Remote updates and theme support are enabled.', 'capstone' ),
		'license-tooltip'          => esc_html__( 'Need help?', 'capstone' ),

		/* translators: Theme Name */
		'welcome-header%s'         => esc_html__( 'Welcome to %s', 'capstone' ),
		'welcome-header-success%s' => esc_html__( 'Hi. Welcome back', 'capstone' ),
		'welcome%s'                => esc_html__( 'This wizard will set up your theme, install plugins, and import content. It is optional & should take only a few minutes.', 'capstone' ),
		'welcome-success%s'        => esc_html__( 'You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'capstone' ),

		'child-header'             => esc_html__( 'Install Child Theme', 'capstone' ),
		'child-header-success'     => esc_html__( 'You\'re good to go!', 'capstone' ),
		'child'                    => esc_html__( 'Let\'s build & activate a child theme so you may easily make theme changes.', 'capstone' ),
		'child-success%s'          => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'capstone' ),
		'child-action-link'        => esc_html__( 'Learn about child themes', 'capstone' ),
		'child-json-success%s'     => esc_html__( 'Awesome. Your child theme has already been installed and is now activated.', 'capstone' ),
		'child-json-already%s'     => esc_html__( 'Awesome. Your child theme has been created and is now activated.', 'capstone' ),

		'plugins-header'           => esc_html__( 'Install Plugins', 'capstone' ),
		'plugins-header-success'   => esc_html__( 'You\'re up to speed!', 'capstone' ),
		'plugins'                  => esc_html__( 'Let\'s install some essential WordPress plugins to get your site up to speed.', 'capstone' ),
		'plugins-success%s'        => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'capstone' ),
		'plugins-action-link'      => esc_html__( 'Advanced', 'capstone' ),

		'import-header'            => esc_html__( 'Import Content', 'capstone' ),
		'import'                   => esc_html__( 'Let\'s import content to your website, to help you get familiar with the theme.', 'capstone' ),
		'import-action-link'       => esc_html__( 'Advanced', 'capstone' ),

		'ready-header'             => esc_html__( 'All done. Have fun!', 'capstone' ),

		/* translators: Theme Author */
		'ready%s'                  => esc_html__( 'Your theme has been all set up. Enjoy your new theme by %s.', 'capstone' ),
		'ready-action-link'        => esc_html__( 'Extras', 'capstone' ),
		'ready-big-button'         => esc_html__( 'View your website', 'capstone' ),
		'ready-link-1'             => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'mailto:support@wpscouts.net', esc_html__( 'Get Theme Support', 'capstone' ) ),
		'ready-link-2'             => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'mailto:inquiry@wpscouts.net', esc_html__( 'Get Customization Quote', 'capstone' ) ),
	)
);

/**
 * Set location of import files.
 */

#-----------------------------------------------------------------#
# Set location of import files.
#-----------------------------------------------------------------#

	function capstone_local_import_files() {
		return array(
			array(
				'import_file_name'             => 'Demo Import',
				'local_import_file'            => get_parent_theme_file_path( '/demo/content.xml' ),
				'local_import_widget_file'     => get_parent_theme_file_path( '/demo/widgets.wie' ),
				'local_import_customizer_file' => get_parent_theme_file_path( '/demo/customizer.dat' ),
				'import_preview_image_url'     => 'https://demo.wpscouts.net/capstone/wp-content/themes/capstone/screenshot.png',
				'import_notice'                => __( 'A special note for this import.', 'capstone' ),
				'preview_url'                  => 'https://demo.wpscouts.net/capstone/',
			),
		);
	}
	add_filter( 'merlin_import_files', 'capstone_local_import_files' );

#-----------------------------------------------------------------#
# Do some actions after Merlin Import
#-----------------------------------------------------------------#

	function capstone_merlin_after_import() {
	
		// Assign menus to their locations.
		$site_menu_main = get_term_by( 'name', 'Site Menu - Main', 'nav_menu' );
		$site_menu_footer = get_term_by( 'name', 'Site Menu - Footer', 'nav_menu' );
		$account_menu = get_term_by( 'name', 'Account Menu', 'nav_menu' );
		$dashboard_menu_main = get_term_by( 'name', 'Dashboard Menu - Main', 'nav_menu' );
		$dashboard_menu_others = get_term_by( 'name', 'Dashboard Menu - Others', 'nav_menu' );
		$menus = array(
			'capstone-primary-navigation' => $site_menu_main->term_id,
			'capstone-secondary-navigation' => $site_menu_footer->term_id,
			'capstone-account-navigation' => $account_menu->term_id,
			'capstone-dashboard-primary-navigation' => $dashboard_menu_main->term_id,
			'capstone-dashboard-secondary-navigation' => $dashboard_menu_others->term_id,
		);
		set_theme_mod( 'nav_menu_locations', $menus );
		
		// set job manager pages
		$job_submit_page = get_page_by_title( 'Post a Job' );
		$job_dashboard_page = get_page_by_title( 'Manage Jobs' );
		$jobs_listing_page = get_page_by_title( 'Jobs' );

		update_option( 'job_manager_submit_job_form_page_id', $job_submit_page->ID );
		update_option( 'job_manager_job_dashboard_page_id', $job_dashboard_page->ID );
		update_option( 'job_manager_jobs_page_id', $jobs_listing_page->ID );

		// set resume manager pages
		$resume_submit_page = get_page_by_title( 'Post a Resume' );
		$resume_dashboard_page = get_page_by_title( 'Manage Resumes' );
		$resumes_listing_page = get_page_by_title( 'Resumes' );

		update_option( 'resume_manager_submit_resume_form_page_id', $resume_submit_page->ID );
		update_option( 'resume_manager_candidate_dashboard_page_id', $resume_dashboard_page->ID );
		update_option( 'resume_manager_resumes_page_id', $resumes_listing_page->ID );

		// set woocommerce pages
		$checkout_page = get_page_by_title( 'Checkout' );
		$my_account_page = get_page_by_title( 'Manage Orders' );

		update_option( 'woocommerce_cart_page_id', $checkout_page->ID );
		update_option( 'woocommerce_checkout_page_id', $checkout_page->ID );
		update_option( 'woocommerce_myaccount_page_id', $my_account_page->ID );

		// configure default job manager options
		update_option( 'job_manager_enable_categories', 1 );
		update_option( 'job_manager_enable_types', 1 );
		update_option( 'job_manager_enable_tag_archive', 1 );
		update_option( 'job_manager_paid_listings_flow', 'before' );
		update_option( 'job_manager_enable_user_specific_company', 0 );

		// configure default resume manager options
		update_option( 'resume_manager_enable_categories', 1 );
		update_option( 'resume_manager_enable_skills', 1 );
		update_option( 'resume_manager_enable_categories', 1 );
		update_option( 'resume_manager_enable_categories', 1 );

		// configure default application methods
		update_option( 'resume_manager_enable_application', 0 );
		update_option( 'resume_manager_enable_application_for_url_method', 0 );
		update_option( 'job_application_form_for_email_method', 1 );
		update_option( 'job_application_form_for_url_method', 1 );

		// set misc. options
		$job_alerts_page = get_page_by_title( 'Manage Alerts' );

		update_option( 'job_manager_alerts_page_id', $job_alerts_page->ID );
		update_option( 'woocommerce_price_num_decimals', 0 );
		
	}
	add_action( 'merlin_after_all_import', 'capstone_merlin_after_import' );



#-----------------------------------------------------------------#
# Locate your Homepage for Merlin
#-----------------------------------------------------------------#

	function capstone_merlin_content_home_page_title( $output ) {
		return 'Home';
	}
	add_filter( 'merlin_content_home_page_title', 'capstone_merlin_content_home_page_title' );


#-----------------------------------------------------------------#
# Locate your Blog page for Merlin
#-----------------------------------------------------------------#

	function capstone_merlin_content_blog_page_title( $output ) {
		return 'News';
	}
	add_filter( 'merlin_content_blog_page_title', 'capstone_merlin_content_blog_page_title' );


#-----------------------------------------------------------------#
# Unset Default Widgets from following Sidebar
#-----------------------------------------------------------------#

	function capstone_merlin_unset_default_widgets_args( $widget_areas ) {
		$widget_areas = array(
			'page-sidebar' => array(),
		);
		return $widget_areas;
	}
	add_filter( 'merlin_unset_default_widgets_args', 'capstone_merlin_unset_default_widgets_args' );