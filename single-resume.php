<?php get_header(); ?>

    <?php include(locate_template( 'includes/page-config.inc.php' )); ?>
    
    <?php
        // Helper Variable(s)
        $candidate_education = get_field('_candidate_education');
        $candidate_experience = get_field('_candidate_experience');
        $application_uri = '#contact-candidate';
    ?>

    <?php 
        // Helper Variable(s)
        $resume_content_order = get_theme_mod( 'capstone_resumes_single_content_order', array( 'resume_header', 'resume_meta', 'resume_desc', 'resume_education', 'resume_experience', 'resume_actions' ) );
        $resume_sidebar_order = get_theme_mod( 'capstone_resumes_single_sidebar_order', array( 'native_widgets', 'candidate_profile', 'listing_url', 'similiar_resumes' ) );
    ?>

    <style>
        .page-content .entry-details .entry-header { order: <?php echo esc_attr(array_search('resume_header', $resume_content_order)); ?> !important; <?php echo in_array('resume_header', $resume_content_order) ? '' : 'display: none !important;'; ?> } 
        .page-content .entry-details .entry-meta--before { order: <?php echo esc_attr(array_search('resume_meta', $resume_content_order)); ?> !important; <?php echo in_array('resume_meta', $resume_content_order) ? '' : 'display: none !important;'; ?> } 
        .page-content .entry-details .entry-meta { order: <?php echo esc_attr(array_search('resume_meta', $resume_content_order)); ?> !important; <?php echo in_array('resume_meta', $resume_content_order) ? '' : 'display: none !important;'; ?> } 
        .page-content .entry-details .entry-meta--after { order: <?php echo esc_attr(array_search('resume_meta', $resume_content_order)); ?> !important; <?php echo in_array('resume_meta', $resume_content_order) ? '' : 'display: none !important;'; ?> } 
        .page-content .entry-details .entry-description { order: <?php echo esc_attr(array_search('resume_desc', $resume_content_order)); ?> !important; <?php echo in_array('resume_desc', $resume_content_order) ? '' : 'display: none !important;'; ?> } 
        .page-content .entry-details .resume-education { order: <?php echo esc_attr(array_search('resume_education', $resume_content_order)); ?> !important; <?php echo in_array('resume_education', $resume_content_order) ? '' : 'display: none !important;'; ?> } 
        .page-content .entry-details .resume-experience { order: <?php echo esc_attr(array_search('resume_experience', $resume_content_order)); ?> !important; <?php echo in_array('resume_experience', $resume_content_order) ? '' : 'display: none !important;'; ?> } 
        .page-content .entry-details .entry-actions { order: <?php echo esc_attr(array_search('resume_actions', $resume_content_order)); ?> !important; <?php echo in_array('resume_actions', $resume_content_order) ? '' : 'display: none !important;'; ?> } 

        .page-sidebar #widgets-module { order: <?php echo esc_attr(array_search('native_widgets', $resume_sidebar_order)); ?> !important; <?php echo in_array('native_widgets', $resume_sidebar_order) ? '' : 'display: none !important;'; ?> } 
        .page-sidebar .profile-module { order: <?php echo esc_attr(array_search('candidate_profile', $resume_sidebar_order)); ?> !important; <?php echo in_array('candidate_profile', $resume_sidebar_order) ? '' : 'display: none !important;'; ?> } 
        .page-sidebar .permalink-module { order: <?php echo esc_attr(array_search('listing_url', $resume_sidebar_order)); ?> !important; <?php echo in_array('listing_url', $resume_sidebar_order) ? '' : 'display: none !important;'; ?> } 
        .page-sidebar .related-entries-module { order: <?php echo esc_attr(array_search('similiar_resumes', $resume_sidebar_order)); ?> !important; <?php echo in_array('similiar_resumes', $resume_sidebar_order) ? '' : 'display: none !important;'; ?> } 
    </style>


    <main id="site-body">
        <?php do_action('capstone_site_body_start'); ?>

        <div id="inner-body" class="has-sidebar right-sidebar">
        
            <?php if ( resume_manager_user_can_view_resume( $post->ID ) ) : ?>

                <section class="page-content resume-<?php echo get_the_ID(); ?>">
                    <?php capstone_breadcrumbs(); ?>
                    <div class="entry-details">
                        <?php do_action( 'single_resume_start' ); ?>
                        <?php get_template_part( 'includes/resume-header.inc' ); ?>
                        <?php get_template_part( 'includes/resume-meta.inc' ); ?> 
                        <?php get_template_part( 'includes/resume-desc.inc' ); ?> 
                        <?php get_template_part( 'includes/resume-education.inc' ); ?> 
                        <?php get_template_part( 'includes/resume-experience.inc' ); ?> 
                        <?php get_template_part( 'includes/resume-actions.inc' ); ?>
                        <?php do_action( 'single_resume_end' ); ?>
                    </div>
                    <?php if ( comments_open() || get_comments_number() ) : ?>
                        <?php comments_template( '', true ); ?>
                    <?php endif; ?>
                </section>

                <aside class="page-sidebar">
                    <a href="<?php echo esc_url(get_post_type_archive_link('resume')); ?>" class="back-link">&#8592; <?php esc_html_e('See all resumes', 'capstone'); ?></a>
                    <?php get_sidebar('resume-detail'); ?>
                    <?php get_template_part( 'includes/candidate-profile.inc' ); ?>
                    <?php get_template_part( 'includes/page-permalink.inc' ); ?>
                    <?php get_template_part( 'includes/related-resumes.inc' ); ?> 
                </aside>

            <?php else : ?>

                <?php get_job_manager_template_part( 'access-denied', 'single-resume', 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/' ); ?>

            <?php endif; ?>

        </div>
        
        <?php do_action('capstone_site_body_end'); ?>
    </main>

<?php get_footer(); ?>