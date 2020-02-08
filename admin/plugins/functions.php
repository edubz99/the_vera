<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Capstone for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once get_template_directory() . '/admin/plugins/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'capstone_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function capstone_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'     		=> esc_html__('Advanced Custom Fields Pro', 'capstone'),
			'slug'      	=> 'advanced-custom-fields-pro',
			'source'  		=> 'https://github.com/imfaisalkh/advanced-custom-fields-pro/archive/master.zip', // The plugin source
			'required'  => true,
		),

		array(
			'name'     		=> esc_html__('Capstone Pro', 'capstone'),
			'slug'      	=> 'capstone-pro',
			'source'  		=> 'https://github.com/imfaisalkh/capstone-pro/archive/'. CAPSTONE_PRO_PLUGIN_VERSION .'.zip', // The plugin source
			'required'  	=> true,
			'version'		=> CAPSTONE_PRO_PLUGIN_VERSION,
		),

		array(
			'name'      => esc_html__('Kirki', 'capstone'),
			'slug'      => 'kirki',
			'required'  => true,
		),

		array(
			'name'      => esc_html__('WooCommerce', 'capstone'),
			'slug'      => 'woocommerce',
		),

		array(
			'name' 		=> esc_html__('Classic Editor', 'capstone'),
			'slug' 		=> 'classic-editor',
		),

		array(
			'name' 		=> esc_html__('WP Job Manager', 'capstone'),
			'slug' 		=> 'wp-job-manager',
			'required' 	=> true,
		),

		array(
			'name'     		=> esc_html__('WP Job Manager - Resumes', 'capstone'),
			'slug'      	=> 'wp-job-manager-resumes',
			'source'  		=> 'https://github.com/imfaisalkh/wp-job-manager-resumes/archive/master.zip', // The plugin source
		),

		array(
			'name'     		=> esc_html__('WP Job Manager - Company Profiles', 'capstone'),
			'slug'      	=> 'wp-job-manager-company-profiles',
			'source'  		=> 'https://github.com/imfaisalkh/wp-job-manager-company-profiles/archive/'. CAPSTONE_COMPANIES_PLUGIN_VERSION .'.zip', // The plugin source
			'version'		=> CAPSTONE_COMPANIES_PLUGIN_VERSION,
		),

		array(
			'name'     		=> esc_html__('WP Job Manager - Alerts', 'capstone'),
			'slug'      	=> 'wp-job-manager-alerts',
			'source'  		=> 'https://github.com/imfaisalkh/wp-job-manager-alerts/archive/master.zip', // The plugin source
		),

		array(
			'name'     		=> esc_html__('WP Job Manager - Bookmarks', 'capstone'),
			'slug'      	=> 'wp-job-manager-bookmarks',
			'source'  		=> 'https://github.com/imfaisalkh/wp-job-manager-bookmarks/archive/master.zip', // The plugin source
		),

		array(
			'name'     		=> esc_html__('WP Job Manager - Tags', 'capstone'),
			'slug'      	=> 'wp-job-manager-tags',
			'source'  		=> 'https://github.com/imfaisalkh/wp-job-manager-tags/archive/master.zip', // The plugin source
		),

		array(
			'name'     		=> esc_html__('WP Job Manager - Applications', 'capstone'),
			'slug'      	=> 'wp-job-manager-applications',
			'source'  		=> 'https://github.com/imfaisalkh/wp-job-manager-applications/archive/master.zip', // The plugin source
		),

		array(
			'name'     		=> esc_html__('WP Job Manager - Application Deadline', 'capstone'),
			'slug'      	=> 'wp-job-manager-application-deadline',
			'source'  		=> 'https://github.com/imfaisalkh/wp-job-manager-application-deadline/archive/master.zip', // The plugin source
		),

		array(
			'name'     		=> esc_html__('WP Job Manager - WooCommerce Paid Listings', 'capstone'),
			'slug'      	=> 'wp-job-manager-wc-paid-listings',
			'source'  		=> 'https://github.com/imfaisalkh/wp-job-manager-wc-paid-listings/archive/master.zip', // The plugin source
		),

		array(
			'name'     		=> esc_html__('WP Job Manager - Indeed Integration', 'capstone'),
			'slug'      	=> 'wp-job-manager-indeed-integration',
			'source'  		=> 'https://github.com/imfaisalkh/wp-job-manager-indeed-integration/archive/master.zip', // The plugin source
		),

		array(
			'name'     		=> esc_html__('WP Job Manager - ZipRecruiter Integration', 'capstone'),
			'slug'      	=> 'wp-job-manager-ziprecruiter-integration',
			'source'  		=> 'https://github.com/imfaisalkh/wp-job-manager-ziprecruiter-integration/archive/master.zip', // The plugin source
		),

		array(
			'name' 		=> esc_html__('WP Job Manager - Regions', 'capstone'),
			'slug' 		=> 'wp-job-manager-locations',
			'required' 	=> false,
		),

		array(
			'name' 		=> esc_html__('Nav Menu Roles', 'capstone'),
			'slug' 		=> 'nav-menu-roles',
			'required' 	=> true,
		),

		array(
			'name' 		=> esc_html__('Content Control', 'capstone'),
			'slug' 		=> 'content-control',
			'required' 	=> false,
		),

		array(
			'name' 		=> esc_html__('Safe SVG', 'capstone'),
			'slug' 		=> 'safe-svg',
			'required' 	=> false,
		),

	);

	// Require Profile Buider plugin only if It's Pro version is not active
	if( !defined('PROFILE_BUILDER_VERSION') ) {
		array_push($plugins, array(
			'name' 		=> esc_html__('Profile Builder', 'capstone'),
			'slug' 		=> 'profile-builder',
			'required' 	=> true,
		));
	}

	// Require Beaver Builder Lite plugin only if It's Pro version is not active
	if( !class_exists( 'FLBuilder' ) ) {
		array_push($plugins, array(
			'name' 		=> esc_html__('Beaver Page Builder', 'capstone'),
			'slug' 		=> 'beaver-builder-lite-version',
			'required' 	=> true,
		));
	}

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'capstone',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}