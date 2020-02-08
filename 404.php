<?php get_header(); ?>

	<main id="site-body">
		<?php do_action('capstone_site_body_start'); ?>
		<div id="inner-body" class="has-not-sidebar has-full-width">
			<section class="page-content">
				<h1 class="error-code"><?php esc_html_e('404', 'capstone'); ?></h1>
				<h4 class="error-status"><?php esc_html_e('The page you are looking for is not available.', 'capstone'); ?></h4>
				<a id="go-to-home" class="button-default" href="<?php echo esc_url( home_url('/') ); ?>"><?php esc_html_e('Go Back Home', 'capstone'); ?></a>
			</section>		
		</div>
		<?php do_action('capstone_site_body_end'); ?>
	</main>

<?php get_footer(); ?>