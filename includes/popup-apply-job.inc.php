<?php if ( $apply = get_the_job_application_method() ) { ?>
    <div id="apply-job" class="mfp-hide white-popup-block">
        <h2 class="title"><?php esc_html_e('Apply For job', 'capstone'); ?></h2>
        <?php do_action( 'job_application_start', $apply ); ?>
        <div class="application_details">
            <?php do_action( 'job_manager_application_details_' . $apply->type, $apply ); ?>
        </div>
        <?php do_action( 'job_application_end', $apply ); ?>
    </div>
<?php } ?>
