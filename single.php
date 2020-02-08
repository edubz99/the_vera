<?php get_header(); ?>

	<?php include(locate_template( 'includes/page-config.inc.php' )); ?>

	<main id="site-body">
		<?php do_action('capstone_site_body_start'); ?>
		<div id="inner-body" class="has-sidebar right-sidebar">
			
			<section class="page-content" data-blog-sidebar="<?php echo is_active_sidebar( 'blog-sidebar' ) ? 'true' : 'false'; ?>">
				<div class="posts-grid">
					<?php
						if ( have_posts() ) :
							$counter = 1;
							while( have_posts() ) : the_post();
								include( locate_template( 'content-post.php' ) ); 
								$counter++;
							endwhile;
						else:
							get_template_part( 'content', 'none' );
						endif;
					?>	
				</div>

				<?php if ( comments_open() || get_comments_number() ) : ?>
					<?php comments_template( '', true ); ?>
				<?php endif; ?>
			</section>

			<aside class="page-sidebar">
				<?php get_sidebar('blog'); ?> 
			</aside>

		</div>
		<?php do_action('capstone_site_body_end'); ?>
	</main>

<?php get_footer(); ?>