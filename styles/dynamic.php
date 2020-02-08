<?php

#-----------------------------------------------------------------#
# Helper Variable(s) and Function(s)
#-----------------------------------------------------------------#


	// Post or Page ID
	if( is_home() || is_archive() || is_search() ) {
		$post_ID = get_option('page_for_posts');
	} else {
		$post_ID = get_the_ID();
	}
?>

	/** CSS Variable(s) */
	:root {
		--primary-accent-color: <?php echo get_theme_mod('capstone_primary_accent_color', '#FA6800'); ?>;
		--secondary-accent-color: <?php echo get_theme_mod('capstone_secondary_accent_color', '#5786EC'); ?>;
		--tertiary-accent-color: <?php echo get_theme_mod('capstone_tertiary_accent_color', '#7BC44F'); ?>;
		
		--top-left-background: url(<?php echo get_theme_mod('capstone_site_bg_top_left', get_template_directory_uri() .'/images/site-top-left-bg.png'); ?>);
		--top-right-background: url(<?php echo get_theme_mod('capstone_site_bg_top_right', get_template_directory_uri() .'/images/site-top-right-bg.png'); ?>);
		--bottom-left-background: url(<?php echo get_theme_mod('capstone_site_bg_bottom_left'); ?>);
		--bottom-right-background: url(<?php echo get_theme_mod('capstone_site_bg_bottom_right', get_template_directory_uri() .'/images/site-bottom-right-bg.png'); ?>);
	
		--compact-sidebar-background: url(<?php echo get_theme_mod('capstone_compact_sidebar_bg', get_template_directory_uri() .'/images/job-bg-pattern.png'); ?>);
	}
	#dashboard-container {
		--primary-accent-color: <?php echo get_theme_mod('capstone_dashboard_primary_accent_color', '#FA6800'); ?>;
		--secondary-accent-color: <?php echo get_theme_mod('capstone_dashboard_secondary_accent_color', '#5786EC'); ?>;
		--tertiary-accent-color: <?php echo get_theme_mod('capstone_dashboard_tertiary_accent_color', '#7BC44F'); ?>;
	}

<?php
#-----------------------------------------------------------------#
# Hero Header (Parent)
#-----------------------------------------------------------------#

	// Meta Panel - Original
	$is_hero = get_field('is_hero', $post_ID);
	$hero_image = get_field('hero_image', $post_ID);
	$hero_text_align = get_field('hero_text_align', $post_ID);
	$hero_height = get_field('hero_height', $post_ID);
	
	$hero_overlay = get_field('hero_overlay', $post_ID);
	$hero_overlay_color = !empty($hero_overlay['color']) ? $hero_overlay['color'] : '#000';
	$hero_overlay_opacity = !empty($hero_overlay['opacity']) ? $hero_overlay['opacity'] : '0.2';
  
	// Meta Panel - Modified
	$hero_text_align = !empty($hero_text_align) ? $hero_text_align : 'left';
	$hero_height = !empty($hero_height) ? $hero_height : '600';
	
?>

/** == CUSTOM PROPERTIES == */
/** ================================================== */

	<?php if ( $is_hero ) { ?>

		
		<?php if ( $hero_image ) { ?>
			.page-hero {
				background-image: url(<?php echo esc_url($hero_image); ?>);
				background-size: cover;
			}
		<?php } ?>

		.page-hero {
			height: <?php echo esc_attr($hero_height); ?>px;
		}

		<?php if ( $hero_overlay ) { ?>
			.page-hero:after {
				content: '';
				position: absolute;
				left: 0; top: 0; right: 0; bottom: 0;
				background: <?php echo esc_attr($hero_overlay_color); ?>;
				opacity: <?php echo esc_attr($hero_overlay_opacity); ?>;
				z-index: 50;
			}
		<?php } ?>


		<?php if ( $hero_text_align == 'right' ) { ?>
			.page-hero .inner {
				flex-direction: row-reverse;
				text-align: <?php echo esc_attr($hero_text_align); ?>;
			}
			.page-hero .inner .primary,
			.page-hero .inner .secondary
			{
				padding-right: 0 !important;
			}

			.page-hero .search-form {
				justify-content: flex-start !important;
			}
			.page-hero .search-form .inner {
				text-align: left !important;
			}
		<?php } else if ( $hero_text_align == 'center' ) { ?>
			.page-hero .inner {
				justify-content: center;
				text-align: <?php echo esc_attr($hero_text_align); ?>;
			}
			.page-hero .inner .primary,
			.page-hero .inner .secondary
			{
				padding-right: 0 !important;
			}
		<?php } ?>


	<?php } ?>


/** == HEADER - CUSTOMIZER == */
/** ================================================== */

	#site-header #site-menu {
		padding: <?php echo get_theme_mod('capstone_header_vertical_padding', 20); ?>px 0;
	}
	#site-logo img {
		width: <?php echo get_theme_mod('capstone_header_primary_logo_width', 165); ?>px !important;
	}
	#dashboard-logo img {
		width: <?php echo get_theme_mod('capstone_header_dashboard_logo_width', 34); ?>px !important;
	}