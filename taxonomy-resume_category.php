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
				<?php if ( shortcode_exists( 'resumes' ) ) { ?> 
					<?php echo do_shortcode('[resumes categories='. esc_attr(get_query_var('resume_category')) .']'); ?>
				<?php } ?>
				<?php do_action('capstone_page_content_end'); ?>
			</section>		

		</div>
		<?php do_action('capstone_site_body_end'); ?>
	</main>

<?php get_footer(); ?>