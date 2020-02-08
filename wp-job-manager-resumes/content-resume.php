<?php
/**
 * Template for resume content inside a list of resumes.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/content-resume.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager - Resume Manager
 * @category    Template
 * @version     1.13.0
 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	// Helper Variable(s)
	global $post;
	$category = get_the_resume_category();
?>
<li <?php resume_class(); ?>  data-longitude="<?php echo esc_attr( $post->geolocation_lat ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_long ); ?>" data-listing-id="<?php echo esc_attr(get_the_ID()); ?>" data-title="<?php echo esc_attr(get_the_title()); ?>">
	<a href="<?php the_resume_permalink(); ?>">
		<?php the_candidate_photo(); ?>
		<div class="candidate-column">
			<h3><?php the_title(); ?></h3>
			<div class="candidate-title">
				<?php the_candidate_title( '<strong>', '</strong> ' ); ?>
			</div>
		</div>
		<div class="candidate-location-column">
			<?php the_candidate_location( false ); ?>
		</div>
		<div class="resume-posted-column <?php if ( $category ) : ?>resume-meta<?php endif; ?>">
			<date><?php printf( __( '%s ago', 'capstone' ), human_time_diff( get_post_time( 'U' ), current_time( 'timestamp' ) ) ); ?></date>

			<?php if ( $category ) : ?>
				<div class="resume-category">
					<?php echo wp_kses_post($category); ?>
				</div>
			<?php endif; ?>
		</div>
	</a>

	<?php
		ob_start();
			do_action('resume_listing_meta_start');
			$resume_listing_meta_start = ob_get_contents();
		ob_end_clean();

		ob_start();
			do_action('resume_listing_meta_end');
			$resume_listing_meta_end = ob_get_contents();
		ob_end_clean();
	?>

	<?php if (!empty($resume_listing_meta_start) || !empty($resume_listing_meta_end)) { ?>
		<ul class="meta-fields">
			<?php do_action( 'resume_listing_meta_start' ); ?>
			<?php do_action( 'resume_listing_meta_end' ); ?>
		</ul>
	<?php } ?>
</li>
