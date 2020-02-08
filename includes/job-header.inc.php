<?php
    // Helper Variable(s)
    ob_start();
        do_action('single_job_listing_quick_meta_start');
        $single_job_listing_quick_meta_start = ob_get_contents();
    ob_end_clean();

    ob_start();
        do_action('single_job_listing_quick_meta_end');
        $single_job_listing_quick_meta_end = ob_get_contents();
    ob_end_clean();
?>

<?php do_action('capstone_job_header_start'); ?>
<div class="entry-header">
    <div class="left">
        <div class="logo">
            <?php the_company_logo('capstone-listing-thumbnail'); ?>
        </div>
    </div>
    <div class="right">
        <div class="heading">
            <h1 class="title"><?php the_title(); ?></h1>
            <?php if ( taxonomy_exists('job_listing_type') ) { ?>
                <?php echo get_the_term_list( get_the_ID(), 'job_listing_type', '<div class="type">', null, '</div>' ); ?>
            <?php } ?>
        </div>
        <?php if (!empty($single_job_listing_quick_meta_start) || !empty($single_job_listing_quick_meta_end)) { ?>
            <ul class="meta-info">
                <?php do_action( 'single_job_listing_quick_meta_start' ); ?>
                <?php do_action( 'single_job_listing_quick_meta_end' ); ?>
            </ul>
        <?php } ?>
        <?php if ( taxonomy_exists('job_listing_category') ) { ?>
            <?php echo get_the_term_list( get_the_ID(), 'job_listing_category', '<div class="taxonomy-terms">', null, '</div>' ); ?>
        <?php } ?>
    </div>
</div>
<?php do_action('capstone_job_header_end'); ?>