<?php
    // Helper Variable(s)
    ob_start();
        do_action('single_company_listing_quick_meta_start');
        $single_company_listing_quick_meta_start = ob_get_contents();
    ob_end_clean();

    ob_start();
        do_action('single_company_listing_quick_meta_end');
        $single_company_listing_quick_meta_end = ob_get_contents();
    ob_end_clean();
?>

<?php do_action('capstone_company_header_start'); ?>
<?php
    // Helper Variable(s)
    $company_industry = get_field('_company_industry', $meta_source_id);
?>
<div class="entry-header">
    <div class="left">
        <div class="logo">
            <?php the_company_logo('capstone-listing-thumbnail'); ?>
        </div>
    </div>
    <div class="right">
        <div class="heading">
            <?php the_company_name( '<h2 class="title">', '</h2>' ); ?>
            <span class="positions"><?php echo esc_html($term->count); ?> <?php echo _n( 'Open Position', 'Open Positions', $term->count, 'capstone' ); ?></span>
        </div>
        <?php if (!empty($single_company_listing_quick_meta_start) || !empty($single_company_listing_quick_meta_end)) { ?>
            <ul class="meta-info">
                <?php do_action( 'single_company_listing_quick_meta_start' ); ?>
                <?php do_action( 'single_company_listing_quick_meta_end' ); ?>
            </ul>
        <?php } ?>
        <?php if ( $company_industry ) { ?>
            <div class="taxonomy-terms">
                <span><?php echo esc_html($company_industry); ?></span>
            </div>
        <?php } ?>
    </div>
</div>
<?php do_action('capstone_company_header_end'); ?>