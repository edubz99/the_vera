<?php

#-----------------------------------------------------------------#
#
#	Here we have all the custom functions for the theme.
#	Please be extremely cautious editing this file,
#	When things go wrong, they intend to go wrong in a big way.
#	You have been warned!
#
#-----------------------------------------------------------------#


#-----------------------------------------------------------------#
# Define Theme Constants
#-----------------------------------------------------------------#

	define('CAPSTONE_THEME_VERSION', '1.7.2');
	define('CAPSTONE_PRO_PLUGIN_VERSION', '1.2.6');
	define('CAPSTONE_COMPANIES_PLUGIN_VERSION', '2.1.1');

	define('CAPSTONE_ADMIN', get_template_directory() .'/admin');
	define('CAPSTONE_ADMIN_URI', get_template_directory_uri() .'/admin');
	define('CAPSTONE_INTEGRATIONS', get_template_directory() .'/integrations');
	define('CAPSTONE_INTEGRATIONS_URI', get_template_directory_uri() .'/integrations');
	define('CAPSTONE_JS', get_template_directory() .'/scripts/js');
	define('CAPSTONE_JS_URI', get_template_directory_uri() .'/scripts/js');
	define('CAPSTONE_CSS', get_template_directory() .'/styles/css');
	define('CAPSTONE_CSS_URI', get_template_directory_uri() .'/styles/css');
	define('CAPSTONE_INC', get_template_directory() .'/includes');
	define('CAPSTONE_INC_URI', get_template_directory_uri() .'/includes');
	define('CAPSTONE_HELPERS', get_template_directory() .'/helpers');
	define('CAPSTONE_HELPERS_URI', get_template_directory_uri() .'/helpers');


#-----------------------------------------------------------------#
# Theme Setup
#-----------------------------------------------------------------#

	function capstone_theme_setup() {

		global $content_width;

		// Set Content Width
		if ( !isset($content_width) ) {
			$content_width = 960;
		}

		// Load Translation Text Domain
		load_theme_textdomain( 'capstone', get_template_directory() . '/lang' );

		// Support for Feed Links
		add_theme_support('automatic-feed-links');

		// Support for Title Tag
		add_theme_support( 'title-tag' );

		// Support for Title Tag
		add_theme_support( 'title-tag' );

		// Support for Theme Logo (since 4.5)
		add_theme_support( 'custom-logo' );

		// Suport for Post Thumbnails
		add_theme_support( 'post-thumbnails' );

		// Custom Image Sizes
		add_image_size( 'capstone-listing-thumbnail', 150, 0, false );
        add_image_size( 'capstone-blog-large', 845, 400, true );
        add_image_size( 'capstone-blog-medium', 385, 235, true );

	    // Register WP3.0+ Menus
	    add_action('init', 'capstone_register_menu');

	    // Register Sidebars
	    add_action('widgets_init', 'capstone_register_sidebar');

	    // Register and Enqueue Frontend JS
	    add_action('wp_enqueue_scripts', 'capstone_frontend_js');

	    // Register and Enqueue Frontend CSS
	    add_action('wp_enqueue_scripts', 'capstone_frontend_styles');

	    // Register and Enqueue Backend CSS
		add_action('admin_enqueue_scripts', 'capstone_backend_styles');

		// Don't let WooCommerce run its setup guide
		add_filter('woocommerce_prevent_automatic_wizard_redirect', '__return_true');
	}

	add_action('after_setup_theme', 'capstone_theme_setup');


#-----------------------------------------------------------------#
# Register WP3.0+ Menu(s)
#-----------------------------------------------------------------#

	function capstone_register_menu() {
		register_nav_menu('capstone-primary-navigation', esc_html__('Primary Navigation', 'capstone'));
		register_nav_menu('capstone-secondary-navigation', esc_html__('Secondary Navigation', 'capstone'));
		register_nav_menu('capstone-account-navigation', esc_html__('Account Navigation', 'capstone'));
		register_nav_menu('capstone-dashboard-primary-navigation', esc_html__('Primary Navigation - Dashboard', 'capstone'));
		register_nav_menu('capstone-dashboard-secondary-navigation', esc_html__('Secondary Navigation - Dashboard', 'capstone'));
	}
	

#-----------------------------------------------------------------#
# Register Sidebar(s)
#-----------------------------------------------------------------#

	function capstone_register_sidebar() {

		// Register "Page" Sidebar
		register_sidebar( array(
			'name' => esc_html__( 'Page Sidebar', 'capstone' ),
			'id' => 'page',
			'description'   => esc_html__( 'This widget area will appear in all other pages sidebar (if sidebar enabled for the page) which do not have their dedicated widget area.', 'capstone' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Register "Blog" Sidebar
		register_sidebar( array(
			'name' => esc_html__( 'Blog Sidebar', 'capstone' ),
			'id' => 'blog-sidebar',
			'description'   => esc_html__( 'This widget area will appear in blog master, detail page as well as blog archive pages.', 'capstone' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Register "Jobs Master" Sidebar
		register_sidebar( array(
			'name' => esc_html__( 'Jobs Master Sidebar', 'capstone' ),
			'id' => 'jobs-master',
			'description'   => esc_html__( 'To configure this widget\'s area visibility/order go to "Appearance -> Customize -> Jobs Settings -> Master Page".', 'capstone' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Register "Jobs Detail" Sidebar
		register_sidebar( array(
			'name' => esc_html__( 'Job Detail Sidebar', 'capstone' ),
			'id' => 'job-detail',
			'description'   => esc_html__( 'To configure this widget\'s area visibility/order go to "Appearance -> Customize -> Jobs Settings -> Detail Page".', 'capstone' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		
		// Register "Resumes Master" Sidebar
		register_sidebar( array(
			'name' => esc_html__( 'Resumes Master Sidebar', 'capstone' ),
			'id' => 'resumes-master',
			'description'   => esc_html__( 'To configure this widget\'s area visibility/order go to "Appearance -> Customize -> Resumes Settings -> Master Page".', 'capstone' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Register "Resumes Detail" Sidebar
		register_sidebar( array(
			'name' => esc_html__( 'Resume Detail Sidebar', 'capstone' ),
			'id' => 'resume-detail',
			'description'   => esc_html__( 'To configure this widget\'s area visibility/order go to "Appearance -> Customize -> Resumes Settings -> Detail Page".', 'capstone' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Register "Companies Master" Sidebar
		register_sidebar( array(
			'name' => esc_html__( 'Companies Master Sidebar', 'capstone' ),
			'id' => 'companies-master',
			'description'   => esc_html__( 'To configure this widget\'s area visibility/order go to "Appearance -> Customize -> Companies Settings -> Master Page".', 'capstone' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// Register "Company Detail" Sidebar
		register_sidebar( array(
			'name' => esc_html__( 'Company Detail Sidebar', 'capstone' ),
			'id' => 'company-detail',
			'description'   => esc_html__( 'To configure this widget\'s area visibility/order go to "Appearance -> Customize -> Companies Settings -> Detail Page".', 'capstone' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

	}


#-----------------------------------------------------------------#
# Register and Enqueue Frontend JS
#-----------------------------------------------------------------#

	function capstone_frontend_js() {
		if ( !is_admin() ) {

			global $wp_query;
			$current_user = wp_get_current_user();

			// Enqueue Scripts
			wp_register_script('superfish', CAPSTONE_JS_URI .'/lib/superfish/superfish.min.js', array('jquery'), null, true);
			wp_register_script('headroom', CAPSTONE_JS_URI .'/lib/headroom.js/headroom.min.js', null, null, true);
			wp_register_script('jquery-headroom', CAPSTONE_JS_URI .'/lib/headroom.js/jQuery.headroom.min.js', array('jquery'), null, true);
			wp_register_script('infinite-scroll', CAPSTONE_JS_URI .'/lib/infinite-scroll/infinite-scroll.pkgd.min.js', array('jquery'), null, true);
			wp_register_script('jquery-magnific-popup', CAPSTONE_JS_URI .'/lib/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), null, true);
			wp_register_script('icheck', CAPSTONE_JS_URI .'/lib/icheck/icheck.min.js', array('jquery'), null, true);
			wp_register_script('images-loaded', CAPSTONE_JS_URI .'/lib/images-loaded/imagesloaded.pkgd.min.js', array('jquery'), null, true);
			wp_register_script('flickity', CAPSTONE_JS_URI .'/lib/flickity/flickity.pkgd.min.js', array('jquery'), null, true);
			wp_register_script('tendina', CAPSTONE_JS_URI .'/lib/tendina/tendina.min.js', array('jquery'), null, true);
			wp_register_script('smooth-scroll', CAPSTONE_JS_URI .'/lib/smooth-scroll/jquery.smooth-scroll.min.js', null, null, true);
			wp_register_script('element-queries-resize-sensor', CAPSTONE_JS_URI .'/lib/element-queries/ResizeSensor.js', null, null, true);
			wp_register_script('element-queries', CAPSTONE_JS_URI .'/lib/element-queries/ElementQueries.js', array('element-queries-resize-sensor'), null, true);
			wp_enqueue_script('capstone-main', CAPSTONE_JS_URI . '/main.min.js', array('jquery', 'superfish', 'headroom', 'jquery-headroom', 'infinite-scroll', 'jquery-magnific-popup', 'icheck', 'images-loaded', 'flickity', 'tendina', 'smooth-scroll'), null, true);
			
			wp_localize_script( 'capstone-main', 'capstone_args', array(
				'templateUrl' 			=> get_template_directory_uri(),
				'ajaxurl' 				=> esc_url( admin_url('admin-ajax.php') ),
				'query_vars' 			=> json_encode( $wp_query->query ),
				'translate_strings' 	=> json_encode( array(
															'load_more' => esc_html__('Load More' ,'capstone'),
															'loading' => esc_html__('Loading' ,'capstone'),
															'data_loaded' => esc_html__('Data Loaded' ,'capstone'),
															'manage_applications' => esc_html__('Manage Applications' ,'capstone'),
															'submit_resume' => esc_html__('Submit Resume' ,'capstone'),
															'select_package' => esc_html__('Select Package' ,'capstone'),
															'select_package_caption' => esc_html__('Select a package above and click the button.' ,'capstone'),
															'add_new_job' => esc_html__('Add New Job' ,'capstone'),
															'delete' => esc_html__('Delete' ,'capstone'),
															'at' => esc_html__('At' ,'capstone'),
															'geocode_error_permission' => esc_html__('You\'ve decided not to share your position, but it\'s OK. We won\'t ask you again.' ,'capstone'),
															'geocode_error_network' => esc_html__('The network is down or the positioning service can\'t be reached.' ,'capstone'),
															'geocode_error_timeout' => esc_html__('The attempt timed out before it could get the location data.' ,'capstone'),
															'geocode_error_generic' => esc_html__('Geolocation failed due to unknown error.' ,'capstone'),
															'geocode_error_support' => esc_html__('Geolocation is not supported in your browser.' ,'capstone'),
														)),
				'ipdata_api_key' 		=> get_theme_mod('capstone_geolocation_api_key'),
				'map_default_location' 	=> get_theme_mod('capstone_map_default_coordinates', '-0.12775829999998223, 51.5073509'),
				'map_default_zoom'		=> get_theme_mod('capstone_map_default_zoom', 5),
				'gmap_api_key' 			=> get_option('job_manager_google_maps_api_key_alt'),
				'mapbox_access_token' 	=> get_theme_mod('capstone_mapbox_access_token'),
				'location_field_mask' 	=> get_theme_mod('capstone_geolocation_location_mask', '${city}, ${country}'),
				'single_job_meta_limit' => get_theme_mod('capstone_jobs_single_meta_limit', 4),
				'single_resume_meta_limit' => get_theme_mod('capstone_resumes_single_meta_limit', 4),
				'single_company_meta_limit' => get_theme_mod('capstone_companies_single_meta_limit', 4),
				'user_display_name' 	=> $current_user->display_name,
				'logout_url'		 	=> esc_url( wp_logout_url(home_url('/')) ),
				'header_stick_config'	=> get_theme_mod('capstone_header_stick_config', 'headroom--unpinned'),
				'location_autocomplete'	=> get_option('job_manager_enable_location_autocomplete'),
				'job_desc_template'		=> apply_filters('capstone_job_desc_template', ''),
				'resume_desc_template'	=> apply_filters('capstone_resume_desc_template', ''),
			));


			// Enqueue (conditional)
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
			if (get_option('job_manager_google_maps_api_key_alt')) {
				wp_enqueue_script('google-maps-api', 'https://maps.googleapis.com/maps/api/js?key='. get_option('job_manager_google_maps_api_key_alt') .'&libraries=places', null, null, true);
			}
			if (get_theme_mod('capstone_mapbox_access_token')) {
				wp_enqueue_script('mapbox', 'https://api.mapbox.com/mapbox-gl-js/v0.52.0/mapbox-gl.js', null, null, true);
				wp_enqueue_script('mapbox-geocoder', 'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js', null, null, true);
			}
		}
	}


#-----------------------------------------------------------------#
# Register and Enqueue Frontend CSS
#-----------------------------------------------------------------#

	function capstone_frontend_styles() {
		if ( !is_admin() ) {

			// Libraries Styles
			wp_enqueue_style('fontawesome', CAPSTONE_CSS_URI . '/lib/font-aswesome.css');
			wp_enqueue_style('icheck', CAPSTONE_JS_URI . '/lib/icheck/square/blue.css');
			wp_enqueue_style('material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons');
			wp_enqueue_style('flickity', CAPSTONE_CSS_URI . '/lib/flickity.min.css');
			wp_enqueue_style('mapbox', 'https://api.mapbox.com/mapbox-gl-js/v0.52.0/mapbox-gl.css');
			wp_enqueue_style('mapbox-geocoder', 'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css');
			
			// Theme Styles
			wp_enqueue_style('capstone-main', CAPSTONE_CSS_URI . '/main.min.css', array('wp-mediaelement'));
			
			// Google Fonts
			wp_enqueue_style('capstone-fonts', capstone_fonts_url(),  array(), '1.0.0');
			
			// Add Inline Styles (dynamic)
			ob_start();
			require( get_template_directory() .'/styles/dynamic.php' );
			$dynamic_css = ob_get_clean();
	        wp_add_inline_style('capstone-main', $dynamic_css);
		}
	}

	function capstone_backend_styles() {
	    wp_enqueue_style('capstone-admin-main', CAPSTONE_ADMIN_URI . '/admin-main.css');
	}


#-----------------------------------------------------------------#
# Register Google Fonts
#-----------------------------------------------------------------#

	function capstone_fonts_url() {
	  	
	  	// Setup font arguments
		$query_args = array(
			'family' => 'Open+Sans:300,400,600,700,800%7CRoboto:300,400,500,600,700%7CLato:400',
			'subset' => 'latin,latin-ext',
		);

		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );

		return $fonts_url;

	}


#-----------------------------------------------------------------#
# Require PHP Theme Resources
#-----------------------------------------------------------------#

	// require ADMIN resources
	require_once CAPSTONE_ADMIN . '/plugins/functions.php';

	// require INTEGRATIONS classes
	require_once CAPSTONE_INTEGRATIONS . '/class-integrations.php';
	require_once CAPSTONE_INTEGRATIONS . '/class-integration.php';
	new Capstone_Integrations();

	// require Merlin resources
	if ( is_admin() ) {
		require_once CAPSTONE_ADMIN .'/merlin/vendor/autoload.php';
		require_once CAPSTONE_ADMIN .'/merlin/class-merlin.php';
		require_once CAPSTONE_ADMIN .'/merlin-config.php';
	}
	
	// require HELPER theme functions
	require_once CAPSTONE_HELPERS . '/functions.php';
	add_filter('acf/settings/show_admin', '__return_true');