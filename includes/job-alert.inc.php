<?php if ( class_exists( 'WP_Job_Manager_Alerts' ) ) { ?>
  <?php do_action('capstone_jobs_alert_start'); ?>
  <div id="jobs-alert-module" class="job_alert">
    <h4 class="title"><?php esc_html_e('Jobs Alert', 'capstone'); ?></h4>
    <p class="description"><?php esc_html_e('You can create alerts based on a defined criteria, you can create Daily, weekly &amp; fortnightly email alerts.', 'capstone'); ?></p>
    <a class="create-alert" href="<?php echo esc_url( get_permalink( get_theme_mod('capstone_dashboard_manage_alerts_page') ) ) . '?action=add_alert'; ?>"><?php esc_html_e('Create Alert', 'capstone'); ?> &#10230;</a>
  </div>
  <?php do_action('capstone_jobs_alert_start'); ?>
<?php } ?>