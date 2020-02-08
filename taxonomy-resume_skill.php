<?php get_header(); ?>

	<?php include(locate_template( 'includes/page-config.inc.php' )); ?>

	<?php
		// Helper Variable(s)
		$query_args = array(
			'post_type' 	   => 'resume',
			'posts_per_page'   => get_option( 'resume_manager_per_page' ),
			'tax_query' => array(
				array(
					'taxonomy' => 'resume_skill',
					'field'    => 'slug',
					'terms'    => get_query_var('resume_skill'),
				),
			),
			'post_status' => 'publish',
		);
		$resumes = new WP_Query( $query_args );
	?>

	<main id="site-body">
		<?php do_action('capstone_site_body_start'); ?>
		<div id="inner-body" class="has-sidebar">
			
			<aside class="page-sidebar">
				<?php get_template_part( 'includes/page-header.inc' ); ?> 
			</aside>

			<section class="page-content">
				<?php do_action('capstone_page_content_start'); ?>
				<?php if ( $resumes->have_posts() ) : ?>
					<?php get_job_manager_template( 'resumes-start.php', array(), 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/' ); ?>
					<?php while ( $resumes->have_posts() ) : $resumes->the_post(); ?>
						<?php get_job_manager_template_part( 'content', 'resume', 'resume_manager', RESUME_MANAGER_PLUGIN_DIR . '/templates/' ); ?>
					<?php endwhile; ?>
					<?php get_job_manager_template( 'resumes-end.php', array(), 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/' ); ?>
				<?php else : ?>
					<?php do_action( 'resume_manager_output_resumes_no_results' ); ?>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
				<?php do_action('capstone_page_content_end'); ?>
			</section>		

		</div>
		<?php do_action('capstone_site_body_end'); ?>
	</main>


<?php get_footer(); ?>