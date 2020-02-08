<div class="entry-description">
    <?php do_action( 'single_job_listing_desc_before' ); ?>
    <div class="inner">
        <?php while ( have_posts() ) : the_post(); ?>
            <?php echo wpjm_get_the_job_description(); ?>
        <?php endwhile; ?>
    </div>
    <?php do_action( 'single_job_listing_desc_after' ); ?>
</div>
