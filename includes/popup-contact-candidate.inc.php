<div id="contact-candidate" class="mfp-hide white-popup-block">
    <h2 class="title"><?php esc_html_e('Contact Candidate', 'capstone'); ?></h2>
    <?php if ( resume_manager_user_can_view_contact_details( $post->ID ) ) : wp_enqueue_script( 'wp-resume-manager-resume-contact-details' ); ?>
        <?php do_action( 'resume_manager_contact_details' ); ?>
    <?php else : ?>
        <?php get_job_manager_template_part( 'access-denied', 'contact-details', 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/' ); ?>
    <?php endif; ?>
</div>