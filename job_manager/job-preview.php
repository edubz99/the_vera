<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<form method="post" id="job_preview" action="<?php echo esc_url( $form->get_action() ); ?>">
	<?php
	/**
	 * Fires at the top of the preview job form.
	 *
	 * @since 1.32.2
	 */
	do_action( 'preview_job_form_start' );
	?>
	<div class="entry-header">
		<div class="left">
			<h1 class="title"><?php wpjm_the_job_title(); ?></h1>
			<span class="location">In <?php the_job_location(); ?></span>
		</div>
		<div class="right">
			<?php if (has_action('single_company_listing_social_before') || has_action('single_company_listing_social_after')) { ?>
				<ul class="listing-links">
					<?php do_action('single_company_listing_social_before'); ?>
					<?php do_action('single_company_listing_social_after'); ?>
				</ul>
			<?php } ?>
		</div>
	</div>
	<div class="entry-meta">
		<h4 class="title"><?php esc_html_e('Meta Info', 'capstone'); ?></h4>
		<ul class="meta-fields">
			<?php do_action( 'preview_job_listing_meta_start' ); ?>
			<?php if ( taxonomy_exists('job_listing_type') ) { ?>
				<?php echo get_the_term_list( get_the_ID(), 'job_listing_type', '<li class="job-type"><span>'. esc_html__('Job Type:', 'capstone') .'</span>', null, '</li>' ); ?>
			<?php } ?>
			<?php echo capstone_display_the_deadline('preview'); ?>
			<li class="company"><span><?php esc_html_e('Company:', 'capstone'); ?></span> <?php the_company_name(); ?></li>
			<li class="tagline"><span><?php esc_html_e('Tagline:', 'capstone'); ?></span> <?php the_company_tagline(); ?></li>
			<?php do_action( 'preview_job_listing_meta_end' ); ?>
		</ul>
	</div>
	<div class="entry-content">
		<?php do_action( 'preview_job_listing_desc_before' ); ?>
		<div class="description">
			<h3 class="title"><?php echo esc_html__('Description', 'capstone'); ?></h3>
			<?php wpjm_the_job_description(); ?>
		</div>
		<?php do_action( 'preview_job_listing_desc_after' ); ?>
	</div>
	<div class="entry-footer">
		<input type="hidden" name="job_id" value="<?php echo esc_attr( $form->get_job_id() ); ?>" />
		<input type="hidden" name="step" value="<?php echo esc_attr( $form->get_step() ); ?>" />
		<input type="hidden" name="job_manager_form" value="<?php echo esc_attr( $form->get_form_name() ); ?>" />
		<input type="submit" name="continue" id="job_preview_submit_button" class="button job-manager-button-submit-listing" value="<?php echo apply_filters( 'submit_job_step_preview_submit_text', esc_attr__( 'Submit Listing', 'capstone' ) ); ?>" />
		<input type="submit" name="edit_job" class="button job-manager-button-edit-listing" value="<?php esc_attr_e( 'Edit listing', 'capstone' ); ?>" />
	</div>
	<?php
	/**
	 * Fires at the bottom of the preview job form.
	 *
	 * @since 1.32.2
	 */
	do_action( 'preview_job_form_end' );
	?>
</form>