<?php get_header(); ?>

	<?php include(locate_template( 'includes/page-config.inc.php' )); ?>

	<?php 

	// Helper Variable(s)
	$company_content_order = get_theme_mod( 'capstone_companies_single_content_order', array( 'company_header', 'company_meta', 'company_desc', 'company_positions', 'company_actions' ) );
	$company_sidebar_order = get_theme_mod( 'capstone_companies_single_sidebar_order', array( 'native_widgets', 'company_profile', 'listing_url' ) );

	?>

	<style>
		.page-content .entry-details .entry-header { order: <?php echo esc_attr(array_search('company_header', $company_content_order)); ?> !important; <?php echo in_array('company_header', $company_content_order) ? '' : 'display: none !important;'; ?> } 
		.page-content .entry-details .entry-meta--before { order: <?php echo esc_attr(array_search('company_meta', $company_content_order)); ?> !important; <?php echo in_array('company_meta', $company_content_order) ? '' : 'display: none !important;'; ?> } 
		.page-content .entry-details .entry-meta { order: <?php echo esc_attr(array_search('company_meta', $company_content_order)); ?> !important; <?php echo in_array('company_meta', $company_content_order) ? '' : 'display: none !important;'; ?> } 
		.page-content .entry-details .entry-meta--after { order: <?php echo esc_attr(array_search('company_meta', $company_content_order)); ?> !important; <?php echo in_array('company_meta', $company_content_order) ? '' : 'display: none !important;'; ?> } 
		.page-content .entry-details .entry-description { order: <?php echo esc_attr(array_search('company_desc', $company_content_order)); ?> !important; <?php echo in_array('company_desc', $company_content_order) ? '' : 'display: none !important;'; ?> } 
		.page-content .entry-details .company-positions { order: <?php echo esc_attr(array_search('company_positions', $company_content_order)); ?> !important; <?php echo in_array('company_positions', $company_content_order) ? '' : 'display: none !important;'; ?> } 
		.page-content .entry-details .entry-actions { order: <?php echo esc_attr(array_search('company_actions', $company_content_order)); ?> !important; <?php echo in_array('company_actions', $company_content_order) ? '' : 'display: none !important;'; ?> } 
	
		.page-sidebar #widgets-module { order: <?php echo esc_attr(array_search('native_widgets', $company_sidebar_order)); ?> !important; <?php echo in_array('native_widgets', $company_sidebar_order) ? '' : 'display: none !important;'; ?> } 
		.page-sidebar .profile-module { order: <?php echo esc_attr(array_search('company_profile', $company_sidebar_order)); ?> !important; <?php echo in_array('company_profile', $company_sidebar_order) ? '' : 'display: none !important;'; ?> } 
		.page-sidebar .permalink-module { order: <?php echo esc_attr(array_search('listing_url', $company_sidebar_order)); ?> !important; <?php echo in_array('listing_url', $company_sidebar_order) ? '' : 'display: none !important;'; ?> } 
	</style>

	<main id="site-body">
		<?php do_action('capstone_site_body_start'); ?>

		<div id="inner-body" class="has-sidebar right-sidebar">

			<section class="page-content company-<?php echo get_the_ID(); ?>">
				<?php capstone_breadcrumbs(); ?>
				<div class="entry-details">
					<?php do_action( 'single_company_start' ); ?>
					<?php get_template_part( 'includes/company-header.inc' ); ?>
					<?php get_template_part( 'includes/company-meta.inc' ); ?> 
					<?php get_template_part( 'includes/company-desc.inc' ); ?> 
					<?php get_template_part( 'includes/company-positions.inc' ); ?> 
					<?php get_template_part( 'includes/company-actions.inc' ); ?> 
					<?php do_action( 'single_company_end' ); ?>
				</div>
			</section>
		
			<aside class="page-sidebar">
				<a href="<?php echo esc_url(get_permalink(get_theme_mod('capstone_companies_page_id'))); ?>" class="back-link">&#8592; <?php esc_html_e('See all companies', 'capstone'); ?></a>
				<?php get_sidebar('company-detail'); ?>
				<?php get_template_part( 'includes/company-profile.inc' ); ?> 
				<?php get_template_part( 'includes/page-permalink.inc' ); ?> 
			</aside>

		</div>
		<?php do_action('capstone_site_body_end'); ?>
	</main>

<?php get_footer(); ?>