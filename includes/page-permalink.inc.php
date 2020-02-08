<?php do_action('capstone_page_permalink_widget_start'); ?>

<section class="permalink-module">
    <h4 class="module-title"><?php esc_html_e('Listing URL', 'capstone'); ?></h4>
    <div class="field-group">
        <?php if ( is_tax('job_listing_company') ) { ?>
            <input id="page-permalink" type="text" value="<?php echo esc_url(get_term_link($term->slug, 'job_listing_company')); ?>" readonly>
        <?php } else { ?>
            <input id="page-permalink" type="text" value="<?php the_permalink(); ?>" readonly>
        <?php }?>
        <a href="#copy-permalink" class="button copy-permalink" data-copied-text="<?php esc_attr_e('Copied!', 'capstone'); ?>"><?php esc_html_e('Copy', 'capstone'); ?></a>
    </div>
</section>

<?php do_action('capstone_page_permalink_widget_end'); ?>