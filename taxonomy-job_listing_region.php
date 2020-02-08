<?php get_header(); ?>

	<?php include(locate_template( 'includes/page-config.inc.php' )); ?>

	<main id="site-body">
		<?php do_action('capstone_site_body_start'); ?>
		<div id="inner-body" class="has-sidebar">
			
			<aside class="page-sidebar">
				<?php get_template_part( 'includes/page-header.inc' ); ?> 
			</aside>

			<section class="page-content">
				<?php do_action('capstone_page_content_start'); ?>

				<?php if ( have_posts() ) : ?>
					<div class="job_listings">
						<ul class="job_listings">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_job_manager_template_part( 'content', 'job_listing' ); ?>
							<?php endwhile; ?>
						</ul>
					</div>
				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>

				<?php do_action('capstone_page_content_end'); ?>
			</section>		

		</div>
		<?php do_action('capstone_site_body_end'); ?>
	</main>

<?php get_footer(); ?>