<?php do_action('capstone_company_actions_start'); ?>
<div class="entry-actions">
    <?php
        $company_email = get_field('_company_email', $meta_source_id);
        $company_site = get_field('_company_website', $meta_source_id);
        $contact_method = $company_email ? 'email' : 'site';
        $contact_uri = $contact_method == 'email' ? 'mailto:'. $company_email: ($company_site ? $company_site : '');
    ?>
    <?php if ($company_email || $company_site) { ?>
        <a href="<?php echo esc_url($contact_uri); ?>" class="contact-company button-default" target="_blank"><?php echo esc_html__('Contact Company', 'capstone'); ?></a>
    <?php } ?>

    <?php do_action('capstone_single_company_actions'); ?>
</div>
<?php do_action('capstone_company_actions_end'); ?>