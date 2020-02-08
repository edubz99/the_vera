<?php
    // Listing Expiry
    $expiring_date  = get_post_meta( $post->ID, '_job_expires', true );
    $is_expired     =  in_array( $post->post_status, array( 'expired' ) ); // is not expired (native)
    $show_deadline  = $is_expired ? false : true;
?>

<?php if ($is_expired) { ?>
    <aside id="application-deadline" class="application-deadline expired">
        <span class="icon"><img src="<?php echo esc_url( get_template_directory_uri() .'/images/clock.svg' ); ?>" alt="<?php esc_attr_e('Deadline', 'capstone'); ?>"></span>
        <span class="text"><?php esc_html_e('The job listing has expired.', 'capstone'); ?></span>
    </aside>
<?php } ?>

<?php if ($show_deadline) { ?>
    <?php
        // Helper Variable(s)
        global $post, $job_manager_application_deadline;

        $deadline = get_post_meta( $post->ID, '_application_deadline', true );
        $expiring = false;
        $expired  = false;
        $date_str = null;

        if ( $deadline ) {
            $expiring_days  = apply_filters( 'job_manager_application_deadline_expiring_days', 2 );
            $expiring       = ( floor( ( current_time( 'timestamp' ) - strtotime( $deadline ) ) / ( 60 * 60 * 24 ) ) >= -$expiring_days );
            $expired        = ( floor( ( current_time( 'timestamp' ) - strtotime( $deadline ) ) / ( 60 * 60 * 24 ) ) >= 0 );
            $date_str       = date_i18n( get_option( 'date_format' ), strtotime( $deadline ) );
            $deadline_class = ($expiring ? 'expiring' : ($expired ? 'expired' : ''));
        }

        if ( is_singular( 'job_listing' ) && $expired ) {
            $deadline_class = 'expired';
        }

        $timestamp = strtotime( $deadline );

        // Filters the display string for the application closing date.
        $date_str = apply_filters( 'job_manager_application_deadline_closing_date_display', $date_str, $timestamp );

    ?>
    <?php if ($deadline && class_exists( 'WP_Job_Manager_Application_Deadline' )) { ?>
        <aside id="application-deadline" class="application-deadline <?php echo esc_attr($deadline_class); ?>">
            <span class="icon"><img src="<?php echo esc_url( get_template_directory_uri() .'/images/clock.svg' ); ?>" alt="<?php esc_attr_e('Deadline', 'capstone'); ?>"></span>
            <?php if ($expired) { ?>
                <span class="text"><?php esc_html_e('The job application date has passed. It\'s closed now.', 'capstone'); ?></span>
            <?php } else { ?>
                <span class="text"><?php printf( esc_html__( 'The job closes on %s.', 'capstone' ), $date_str ); ?></span>
            <?php } ?>
        </aside>
    <?php } ?>
<?php } ?>