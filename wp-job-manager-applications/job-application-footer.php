<?php global $wp_post_statuses; ?>
<ul class="meta">
	<li><?php echo wp_kses_post($wp_post_statuses[ $application->post_status ]->label); ?></li>
	<li><?php echo wp_kses_post(date_i18n( get_option( 'date_format' ), strtotime( $application->post_date ) ) ); ?></li>
</ul>
<ul class="actions">
	<li class="edit"><a href="#" title="<?php esc_attr_e( 'Edit', 'capstone' ); ?>" class="job-application-toggle-edit"><?php esc_html_e( 'Edit', 'capstone' ); ?></a></li>
	<li class="notes <?php echo get_comments_number( $application->ID ) ? 'has-notes' : ''; ?>"><a href="#" title="<?php esc_attr_e( 'Notes', 'capstone' ); ?>" class="job-application-toggle-notes"><?php esc_html_e( 'Notes', 'capstone' ); ?></a></li>

	<?php if ( $email = get_job_application_email( $application->ID ) ) : ?>
		<li class="email"><a href="mailto:<?php echo esc_attr( $email ); ?>?subject=<?php echo esc_attr( sprintf( __( 'Your job application for %s', 'capstone' ), strip_tags( get_the_title( $job_id ) ) ) ); ?>&amp;body=<?php echo esc_attr( sprintf( __( 'Hello %s', 'capstone' ), get_the_title( $application->ID ) ) ); ?>" title="<?php esc_attr_e( 'Email', 'capstone' ); ?>" class="job-application-contact"><?php esc_html_e( 'Email', 'capstone' ); ?></a></li>
	<?php endif; ?>

	<?php if ( $attachments = get_job_application_attachments( $application->ID ) ) : ?>
		<?php foreach ( $attachments as $attachment ) : ?>
			<li class="attachment"><a href="<?php echo esc_url( $attachment ); ?>" title="<?php echo esc_attr( get_job_application_attachment_name( $attachment ) ); ?>" class="job-application-attachment"><?php echo esc_html( get_job_application_attachment_name( $attachment, 20 ) ); ?></a></li>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if ( ( $resume_id = get_job_application_resume_id( $application->ID ) ) && 'publish' === get_post_status( $resume_id ) && function_exists( 'get_resume_share_link' ) && ( $share_link = get_resume_share_link( $resume_id ) ) ) : ?>
		<li class="resume"><a href="<?php echo esc_url( $share_link ); ?>" target="_blank" class="job-application-resume"><?php echo esc_html( $resume_id ); ?></a></li>
	<?php endif; ?>

	<li class="content"><a href="#" title="<?php esc_attr_e( 'Details', 'capstone' ); ?>" class="job-application-toggle-content"><?php esc_html_e( 'Details', 'capstone' ); ?></a></li>
</ul>