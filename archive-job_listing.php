<?php get_header(); ?>

	<?php include(locate_template( 'includes/page-config.inc.php' )); ?>

	<main id="site-body">
		<?php do_action('capstone_site_body_start'); ?>

		<div id="inner-body" class="has-sidebar">
			
			<aside class="page-sidebar">
				<?php get_template_part( 'includes/page-header.inc' ); ?> 
				<?php get_template_part( 'includes/sidebar-modules.inc' ); ?> 
			</aside>

			<section class="page-content">
				<?php do_action('capstone_page_content_start'); ?>

				<?php if ( class_exists('FacetWP') && !get_query_var('is_standard') ) { ?>
					<?php if ( have_posts() ) : ?>
						<?php get_job_manager_template( 'job-listings-start.php' ); ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_job_manager_template_part( 'content', 'job_listing' ); ?>
						<?php endwhile; ?>
						<?php get_job_manager_template( 'job-listings-end.php' ); ?>
					<?php else : ?>
						<?php do_action( 'job_manager_output_jobs_no_results' );?>
					<?php endif; ?>
				<?php } else { ?>
					<?php if ( shortcode_exists( 'jobs' ) ) { ?> 
						<?php echo do_shortcode('[jobs]'); ?>
					<?php } ?>
				<?php } ?>

				<?php do_action('capstone_page_content_end'); ?>
			</section>		

		</div>
		
		<?php do_action('capstone_site_body_end'); ?>
	</main>

<?php get_footer(); ?>