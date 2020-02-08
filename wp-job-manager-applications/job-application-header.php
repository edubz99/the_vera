<?php echo get_job_application_avatar( $application->ID ) ?>
<h3>
	<?php if ( ( $resume_id = get_job_application_resume_id( $application->ID ) ) && 'publish' === get_post_status( $resume_id ) && function_exists( 'get_resume_share_link' ) && ( $share_link = get_resume_share_link( $resume_id ) ) ) : ?>
		<a href="<?php echo esc_url( $share_link ); ?>"><?php echo wp_kses_post($application->post_title); ?></a>
	<?php else : ?>
		<?php echo wp_kses_post($application->post_title); ?>
	<?php endif; ?>
</h3>
<ul class="job-dashboard-actions">
  <li class="notes <?php echo get_comments_number( $application->ID ) ? 'has-notes' : ''; ?>"><a href="#notes-application-<?php echo esc_attr( $application->ID ); ?>" title="<?php esc_attr_e( 'Notes', 'capstone' ); ?>" class="job-application-toggle-notes"><?php esc_html_e( 'Notes', 'capstone' ); ?></a></li>

  <?php if ( $email = get_job_application_email( $application->ID ) ) : ?>
    <li class="email"><a href="mailto:<?php echo esc_attr( $email ); ?>?subject=<?php echo esc_attr( sprintf( __( 'Your job application for %s', 'capstone' ), strip_tags( get_the_title( $job_id ) ) ) ); ?>&amp;body=<?php echo esc_attr( sprintf( __( 'Hello %s', 'capstone' ), get_the_title( $application->ID ) ) ); ?>" title="<?php esc_attr_e( 'Email', 'capstone' ); ?>" class="job-application-contact"><?php esc_html_e( 'Email', 'capstone' ); ?></a></li>
  <?php endif; ?>

  <?php if ( $attachments = get_job_application_attachments( $application->ID ) ) : ?>
    <?php foreach ( $attachments as $attachment ) : ?>
      <li class="attachment"><a href="<?php echo esc_url( $attachment ); ?>" target="_blank" title="<?php echo esc_attr( get_job_application_attachment_name( $attachment ) ); ?>" class="job-application-attachment"><?php echo esc_html__('Resume', 'capstone'); ?></a></li>
    <?php endforeach; ?>
  <?php endif; ?>

  <?php if ( ( $resume_id = get_job_application_resume_id( $application->ID ) ) && 'publish' === get_post_status( $resume_id ) && function_exists( 'get_resume_share_link' ) && ( $share_link = get_resume_share_link( $resume_id ) ) ) : ?>
    <li class="resume"><a href="<?php echo esc_url( $share_link ); ?>" target="_blank" class="job-application-resume"><?php echo esc_html__('Resume', 'capstone'); ?></a></li>
  <?php endif; ?>
  <li class="content"><a href="#detail-application-<?php echo esc_attr( $application->ID ); ?>" title="<?php esc_attr_e( 'Details', 'capstone' ); ?>" class="job-application-toggle-content"><?php esc_html_e( 'Details', 'capstone' ); ?></a></li>
  <li class="edit"><a href="#edit-application-<?php echo esc_attr( $application->ID ); ?>" title="<?php esc_attr_e( 'Edit', 'capstone' ); ?>" class="job-application-toggle-edit"><?php esc_html_e( 'Edit', 'capstone' ); ?></a></li>
</ul>