<?php 
// Helper Variable(s)
$header_facets = get_theme_mod( 'capstone_header_search_facets' );

?>

<div id="header-facets-module">
    <?php
        $output = '';
        if ( ! empty( $header_facets ) ) {
            foreach ( $header_facets as $facet ) {
                $facet_name = is_array( $facet ) ? $facet['name'] : $facet;
                $output .= facetwp_display( 'facet', $facet_name );
            }
        }
        echo wp_kses_post($output);
    ?>
    <div class="jobs_template" style="display:none"><?php echo facetwp_display( 'template', 'jobs_template' ); ?></div>
    <button class="fwp-submit" data-href="/wordpress/capstone/job-listings/">Search</button>
</div>