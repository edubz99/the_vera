<?php get_header(); ?>

	<?php include(locate_template( 'includes/page-config.inc.php' )); ?>

	<main id="site-body">
		<?php do_action('capstone_site_body_start'); ?>
		<?php get_template_part( 'includes/page-hero.inc' ); ?> 

		<div id="inner-body" class="<?php echo esc_attr($layout_class); ?>">

			<?php if ( $page_style == 'is_sidebar' ) { ?>
				<aside class="page-sidebar">
					<?php get_template_part( 'includes/page-header.inc' ); ?>
					<?php get_template_part( 'includes/sidebar-modules.inc' ); ?> 
				</aside>
			<?php } else { ?>
				<?php get_template_part( 'includes/page-header.inc' ); ?> 
			<?php } ?>	

			<section class="page-content">
				<?php do_action('capstone_page_content_start'); ?>

				<?php while( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>

				<?php
					$defaults = array(
						'before'           => '<hr><nav class="navigation pagination"><span class="screen-reader-text">' . esc_html__( 'Pages:', 'capstone' ) . '</span><div class="nav-links">',
						'after'            => '</div></nav>',
						'link_before'      => '<span class="page-numbers">',
						'link_after'       => '</span>',
					);
				?>
				<?php wp_link_pages( $defaults ); ?>

				<?php if ( comments_open() ) : ?>
					<?php comments_template( '', true ); ?>
				<?php endif; ?>

				<?php do_action('capstone_page_content_end'); ?>			
			</section>		

		</div>

		<?php do_action('capstone_site_body_end'); ?>
	</main>

<?php get_footer(); ?>