<?php do_action('capstone_job_actions_before'); ?>
<div class="entry-actions">
    <?php do_action('job_actions_start'); ?>
    <?php do_action('job_actions_end'); ?>
</div>

<?php get_template_part('includes/popup-add-bookmark.inc' ); ?>
<?php get_template_part('includes/popup-apply-job.inc' ); ?>
<?php do_action('capstone_job_actions_after'); ?>