<?php get_header(); ?>

	<?php include(locate_template( 'includes/page-config.inc.php' )); ?>

	<main id="site-body">
		<?php do_action('capstone_site_body_start'); ?>
		
		<div id="inner-body" class="has-sidebar right-sidebar">

			<?php if ( is_archive() || is_search() ) { ?>
				<?php get_template_part( 'includes/page-header-blog-archive.inc' ); ?> 
			<?php } ?>
			
			<section class="page-content" data-blog-sidebar="<?php echo is_active_sidebar( 'blog-sidebar' ) ? 'true' : 'false'; ?>">

				<div class="posts-grid" data-layout="<?php echo esc_attr(get_theme_mod('capstone_blog_layout', 'traditional')); ?>">
					<?php
						if ( have_posts() ) :
							$counter = 1;
							while( have_posts() ) : the_post();
								include( locate_template( 'content-post.php' ) ); 
								$counter++;
								$thumbnail_size = null;
							endwhile;
						else:
							get_template_part( 'content', 'none' );
						endif;
					?>				
				</div>

				<?php if ( get_theme_mod('capstone_blog_pagination', 'infinite-scroll') == 'infinite-scroll' ) { ?>
					<?php if ( get_next_posts_link() ) { ?> 
						<div class="load-more"><?php echo get_next_posts_link( esc_html__('Load More', 'capstone') ); ?></div>
						<div class="page-load-status">
							<p class="infinite-scroll-last"><?php esc_html_e('End of content', 'capstone'); ?></p>
							<p class="infinite-scroll-error"><?php esc_html_e('No more pages to load', 'capstone'); ?></p>
						</div>
					<?php } ?>
				<?php } else { ?>
					<?php
						the_posts_pagination( array(
							'mid_size'  => 2,
							'prev_text' => '&larr;',
							'next_text' => '&rarr;',
							'screen_reader_text' => esc_html__( 'Pages:', 'capstone' ),
						) );
					?>
				<?php }?>

			</section>

			<aside class="page-sidebar">
				<?php get_sidebar(); ?> 
			</aside>

		</div>
		<?php do_action('capstone_site_body_end'); ?>
	</main>

<?php get_footer(); ?>