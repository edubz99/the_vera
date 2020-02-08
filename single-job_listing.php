<?php get_header(); ?>

	<?php include(locate_template( 'includes/page-config.inc.php' )); ?>

	<?php get_template_part( 'includes/application-deadline.inc' ); ?> 

	<?php 

	// Helper Variable(s)
	$job_content_order = get_theme_mod( 'capstone_jobs_single_content_order', array( 'job_header', 'job_meta', 'job_desc', 'job_tags', 'job_actions' ) );
	$job_sidebar_order = get_theme_mod( 'capstone_jobs_single_sidebar_order', array( 'native_widgets', 'company_profile', 'listing_url', 'similiar_jobs' ) );

	?>

	<style>
		.page-content .entry-details .entry-header { order: <?php echo esc_attr(array_search('job_header', $job_content_order)); ?> !important; <?php echo in_array('job_header', $job_content_order) ? '' : 'display: none !important;'; ?> } 
		.page-content .entry-details .entry-meta--before { order: <?php echo esc_attr(array_search('job_meta', $job_content_order)); ?> !important; <?php echo in_array('job_meta', $job_content_order) ? '' : 'display: none !important;'; ?> } 
		.page-content .entry-details .entry-meta { order: <?php echo esc_attr(array_search('job_meta', $job_content_order)); ?> !important; <?php echo in_array('job_meta', $job_content_order) ? '' : 'display: none !important;'; ?> } 
		.page-content .entry-details .entry-meta--after { order: <?php echo esc_attr(array_search('job_meta', $job_content_order)); ?> !important; <?php echo in_array('job_meta', $job_content_order) ? '' : 'display: none !important;'; ?> } 
		.page-content .entry-details .entry-description { order: <?php echo esc_attr(array_search('job_desc', $job_content_order)); ?> !important; <?php echo in_array('job_desc', $job_content_order) ? '' : 'display: none !important;'; ?> } 
		.page-content .entry-details .entry-tags { order: <?php echo esc_attr(array_search('job_tags', $job_content_order)); ?> !important; <?php echo in_array('job_tags', $job_content_order) ? '' : 'display: none !important;'; ?> } 
		.page-content .entry-details .entry-actions { order: <?php echo esc_attr(array_search('job_actions', $job_content_order)); ?> !important; <?php echo in_array('job_actions', $job_content_order) ? '' : 'display: none !important;'; ?> } 
	
		.page-sidebar #widgets-module { order: <?php echo esc_attr(array_search('native_widgets', $job_sidebar_order)); ?> !important; <?php echo in_array('native_widgets', $job_sidebar_order) ? '' : 'display: none !important;'; ?> } 
		.page-sidebar .profile-module { order: <?php echo esc_attr(array_search('company_profile', $job_sidebar_order)); ?> !important; <?php echo in_array('company_profile', $job_sidebar_order) ? '' : 'display: none !important;'; ?> } 
		.page-sidebar .permalink-module { order: <?php echo esc_attr(array_search('listing_url', $job_sidebar_order)); ?> !important; <?php echo in_array('listing_url', $job_sidebar_order) ? '' : 'display: none !important;'; ?> } 
		.page-sidebar .related-entries-module { order: <?php echo esc_attr(array_search('similiar_jobs', $job_sidebar_order)); ?> !important; <?php echo in_array('similiar_jobs', $job_sidebar_order) ? '' : 'display: none !important;'; ?> } 
	</style>

	<main id="site-body">
		<?php do_action('capstone_site_body_start'); ?>

		<div id="inner-body" class="has-sidebar right-sidebar">

			<section class="page-content job-<?php echo get_the_ID(); ?>">
				<?php capstone_breadcrumbs(); ?>
				<div class="entry-details">
					<?php do_action( 'single_job_listing_start' ); ?>
					<?php get_template_part( 'includes/job-header.inc' ); ?> 
					<?php get_template_part( 'includes/job-meta.inc' ); ?> 
					<?php get_template_part( 'includes/job-desc.inc' ); ?> 
					<?php get_template_part( 'includes/job-tags.inc' ); ?> 
					<?php get_template_part( 'includes/job-actions.inc' ); ?>
					<?php do_action( 'single_job_listing_end' ); ?>
				</div>
				<?php if ( comments_open() || get_comments_number() ) : ?>
					<?php comments_template( '', true ); ?>
				<?php endif; ?>
			</section>
		
			<aside class="page-sidebar">
				<a href="<?php echo esc_url(get_post_type_archive_link('job_listing')); ?>" class="back-link">&#8592; <?php esc_html_e('See all jobs', 'capstone'); ?></a>
				<?php get_sidebar('job-detail'); ?>
				<?php get_template_part( 'includes/company-profile.inc' ); ?> 
				<?php get_template_part( 'includes/page-permalink.inc' ); ?> 
				<?php get_template_part( 'includes/related-jobs.inc' ); ?> 
			</aside>

		</div>
		<?php do_action('capstone_site_body_end'); ?>
	</main>

<?php get_footer(); ?>