<?php include(locate_template( 'includes/page-config.inc.php' )); ?>

<div class="hero-facets">

    <?php 
    // Helper Variable(s)
    $search_facets = get_field( 'hero_facets' );
    $search_facets = explode(', ', $search_facets);

    $output = '';
    if ( !empty( $search_facets ) ) {
        foreach ( $search_facets as $facet ) {
            $facet_name = is_array( $facet ) ? $facet['name'] : $facet;
            $output .= facetwp_display( 'facet', $facet_name );
        }
    }
    echo wp_kses_post($output);
    ?>

    <?php if (empty($output)) { ?>
        <p class="no-facets"><?php esc_html_e('Please assign some facets to this search module under "Page Hero" meta panel.', 'capstone'); ?></p>
    <?php } ?>

    <?php if ($hero_search_module == 'job') { ?>
        <div style="display:none"><?php echo facetwp_display( 'template', 'job_listings' ); ?></div>
        <button class="fwp-submit" data-href="<?php echo esc_url( home_url('/') ); ?>job-listings/"><?php esc_html_e('Search', 'capstone'); ?></button>
    <?php } else if ($hero_search_module == 'resume') { ?>
        <div style="display:none"><?php echo facetwp_display( 'template', 'resume_listings' ); ?></div>
        <button class="fwp-submit" data-href="<?php echo esc_url( home_url('/') ); ?>resumes/"><?php esc_html_e('Search', 'capstone'); ?></button>
    <?php } ?>

</div>

