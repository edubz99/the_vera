<?php if (get_field('_company_description', $meta_source_id)) { ?>
    <div class="entry-description">
        <?php do_action('single_job_listing_company_desc_start'); ?>
        <h3 class="title"><?php echo esc_html__('About Company', 'capstone'); ?></h3>
        <p><?php echo get_field('_company_description', $meta_source_id); ?></p>
        <?php do_action('single_job_listing_company_desc_end'); ?>
    </div>
<?php } ?>