<?php

#-------------------------------------------------------------------------------#
#  WP Job Manager - Application Deadline
#-------------------------------------------------------------------------------#

    function capstone_display_the_deadline($type = null) {
        global $post;

        if ( $deadline = get_post_meta( $post->ID, '_application_deadline', true ) ) {
            $expiring_days = apply_filters( 'job_manager_application_deadline_expiring_days', 2 );
            $expiring = ( floor( ( time() - strtotime( $deadline ) ) / ( 60 * 60 * 24 ) ) >= $expiring_days );
            $expired  = ( floor( ( time() - strtotime( $deadline ) ) / ( 60 * 60 * 24 ) ) >= 0 );

            if ( is_singular( 'job_listing' ) && $expired ) {
                return;
            }

            if ($type == 'preview') {
                echo '<li class="close-date ' . ( $expiring ? 'expiring' : '' ) . ' ' . ( $expired ? 'expired' : '' ) . '"><span>' . esc_html__( 'Close Date:', 'capstone' ) . '</span> ' . date_i18n( esc_html__( 'M j, Y', 'capstone' ), strtotime( $deadline ) ) . '</li>';
            } else {
                echo '<li class="application-deadline ' . ( $expiring ? 'expiring' : '' ) . ' ' . ( $expired ? 'expired' : '' ) . '"><label>(' . ( $expired ? esc_html__( 'Closed', 'capstone' ) : esc_html__( 'Closes', 'capstone' ) ) . ')</label> ' . date_i18n( esc_html__( 'M j, Y', 'capstone' ), strtotime( $deadline ) ) . '</li>';
            }
        }
    }



