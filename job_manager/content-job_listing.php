<?php
/**
 * Job listing in the loop.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager
 * @category    Template
 * @since       1.0.0
 * @version     1.27.0
 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
	}

	// Helper Variable(s)
	global $post;
	$job_excerpt = get_field('_job_excerpt');
	$auto_job_excerpt = get_theme_mod('capstone_jobs_enable_auto_excerpt', false);
	$job_salary = get_post_meta( $post->ID, '_job_salary', true );
?>

<li <?php job_listing_class(); ?> data-longitude="<?php echo esc_attr( $post->geolocation_lat ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_long ); ?>" data-listing-id="<?php echo esc_attr(get_the_ID()); ?>" data-title="<?php echo esc_attr(get_the_title()); ?>">
	<a href="<?php the_job_permalink(); ?>">
		<div class="logo">
			<?php the_company_logo('capstone-listing-thumbnail'); ?>
		</div>
		<div class="position">
			<h3><?php wpjm_the_job_title(); ?></h3>

			<div class="company">
				<?php if($job_salary) : 
					echo esc_html($job_salary);
					the_company_tagline( '<span class="tagline">', '</span>' ); 
				else :
					the_company_name( '<strong>', '</strong> ' );
					the_company_tagline( '<span class="tagline">', '</span>' );
				endif; ?>
			</div>
		</div>
		<div class="location">
			<?php the_job_location( false ); ?>
		</div>
		<ul class="meta">
			<?php if ( get_option( 'job_manager_enable_types' ) ) { ?>
				<?php $types = wpjm_get_the_job_types(); ?>
				<?php if ( ! empty( $types ) ) : foreach ( $types as $type ) : ?>
					<li class="job-type <?php echo esc_attr( sanitize_title( $type->slug ) ); ?>"><?php echo esc_html( $type->name ); ?></li>
				<?php endforeach; endif; ?>
			<?php } ?>
			<li class="date"><?php the_job_publish_date(); ?></li>
		</ul>
	</a>

	<?php
		ob_start();
			do_action('job_listing_meta_start');
			$job_listing_meta_start = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action('job_listing_meta_end');
			$job_listing_meta_end = ob_get_contents();
		ob_end_clean();
	?>

	<?php if (!empty($job_listing_meta_start) || !empty($job_listing_meta_end)) { ?>
		<ul class="meta-fields">
			<?php do_action( 'job_listing_meta_start' ); ?>
			<?php do_action( 'job_listing_meta_end' ); ?>
		</ul>
	<?php } else if ($job_excerpt) { ?>
		<p class="description"><?php echo esc_html($job_excerpt); ?></p>
	<?php } else if ($auto_job_excerpt) { ?>
		<p class="description"><?php echo get_the_excerpt(); ?></p>
	<?php } ?>
	
</li>