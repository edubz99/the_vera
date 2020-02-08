<?php
    $open_positions_query = new WP_Query( array( 
        "posts_per_page" => isset($company_positions_limit) ? $company_positions_limit : -1,
        "post_status" => 'publish',
        "orderby" => 'date', // this is the default
        "order" => 'DESC', // this is the default
        "tax_query" => array(
            array (
                'taxonomy' => 'job_listing_company',
                'field' => 'term_id',
                'terms' => $term->term_id, // use the current term in your foreach loop
            ),
        ),
    ) );
?>

<?php do_action('capstone_company_positions_start'); ?>
<div class="company-positions">
    <h3 class="title"><?php echo esc_html__('Open Positions', 'capstone'); ?></h3>
    <?php if ( isset($company_positions_limit) && ($open_positions > $company_positions_limit) ) { ?>
        <a class="see-all" href="<?php echo esc_url($company_permalink); ?>" class="see-more"><?php echo esc_html__('see all', 'capstone'); ?> &#10230;</a>
    <?php } ?>
    <ul>
        <?php if ( $open_positions_query->have_posts() ) { ?>
            <?php while ( $open_positions_query->have_posts() ) : $open_positions_query->the_post(); ?>
                <li>
                    <div class="entry-header">
                        <h5 class="title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h5>
                        <?php if ( taxonomy_exists('job_listing_type') ) { ?>
                            <?php echo get_the_term_list( get_the_ID(), 'job_listing_type', '<span class="types">(', null, ')</span>' ); ?>
                        <?php } ?>
                    </div>
                    <div class="entry-footer">
                        <span class="location">
                            <?php the_job_location( false ); ?>
                        </span>
                        <?php if ( taxonomy_exists('job_listing_category') ) { ?>
                            <?php echo get_the_term_list( get_the_ID(), 'job_listing_category', '<span class="categories">', null, '</span>' ); ?>
                        <?php } ?>
                    </div>
                </li>
            <?php endwhile; ?>
            <?php wp_reset_postdata();	/* Restore original Post Data */ ?>
        <?php } else { ?>
            <li class="no-position"><?php esc_html_e('No open position found.', 'capstone'); ?></li>
        <?php } ?>
    </ul>
</div>
<?php do_action('capstone_company_positions_end'); ?>
